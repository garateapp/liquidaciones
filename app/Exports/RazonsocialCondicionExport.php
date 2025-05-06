<?php

namespace App\Exports;

use App\Models\Costo;
use App\Models\Condicionproductor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class RazonsocialCondicionExport implements FromView, ShouldAutoSize, WithEvents
{
    public $razons, $costo, $condiciones, $temporada;

    public function __construct($razons, $costo, $temporada)
    {
        $this->razons = $razons;

        if ($costo === "TODAS") {
            $this->condiciones = Condicionproductor::with('opcions')->get();
        } else {
            $this->costo = Costo::with('condicionproductor.opcions')->find($costo['id']);
        }

        $this->temporada = $temporada;
    }

    public function view(): View
    {
        if (isset($this->condiciones)) {
            return view('exports.razonsocial', [
                'razons' => $this->razons,
                'condiciones' => $this->condiciones,
                'temporada' => $this->temporada,
            ]);
        } else {
            return view('exports.razonsocial', [
                'razons' => $this->razons,
                'costo' => $this->costo,
                'temporada' => $this->temporada,
            ]);
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $spreadsheet = $event->sheet->getDelegate()->getParent();
                $mainSheet = $event->sheet->getDelegate();

                $razons = $this->razons;
                $condiciones = $this->condiciones ?? collect([$this->costo->condicionproductor]);

                $mainSheet->setCellValue('A1', 'PRODUCTOR');

                foreach ($razons as $index => $razon) {
                    $mainSheet->setCellValue("A" . ($index + 2), $razon->name);
                }

                $col = 2;
                foreach ($condiciones as $condicion) {
                    if (!$condicion || $condicion->opcions->isEmpty()) continue;

                    $colLetra = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
                    $mainSheet->setCellValue("{$colLetra}1", "CONDICIÓN {$condicion->id}");

                    // Crear hoja Opciones_{id}
                    $opcionesSheet = $spreadsheet->createSheet();
                    $sheetTitle = "Opciones_{$condicion->id}";
                    $opcionesSheet->setTitle($sheetTitle);

                    $opcionesSheet->setCellValue("A1", 'Value');
                    $opcionesSheet->setCellValue("B1", 'Text');

                    foreach ($condicion->opcions as $i => $opcion) {
                        $row = $i + 2;
                        $value = str_replace(',', '.', (string)$opcion->value);
                        $opcionesSheet->setCellValueExplicit("A{$row}", $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        $opcionesSheet->setCellValue("B{$row}", $opcion->text);
                    }

                    $opcionesSheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

                    // Validación y fórmula BUSCARV
                    $dropdownOptions = $condicion->opcions
                        ->pluck('value')
                        ->map(fn($v) => str_replace(',', '.', (string)$v))
                        ->implode(',');

                    $formulaSheetName = str_replace(' ', '_', $sheetTitle);
                    $startRow = 2;
                    $endRow = $startRow + count($razons) - 1;

                    for ($row = $startRow; $row <= $endRow; $row++) {
                        $cell = "{$colLetra}{$row}";

                        $validation = $mainSheet->getCell($cell)->getDataValidation();
                        $validation->setType(DataValidation::TYPE_LIST);
                        $validation->setErrorStyle(DataValidation::STYLE_STOP);
                        $validation->setAllowBlank(false);
                        $validation->setShowDropDown(true);
                        $validation->setFormula1("\"{$dropdownOptions}\"");
                        $mainSheet->getCell($cell)->setDataValidation($validation);

                        // Fórmula: BUSCARV inline para mostrar el text al lado
                        $formula = "=IF({$cell}<>\"\", VLOOKUP({$cell}, '{$formulaSheetName}'!A:B, 2, FALSE), \"n/a\")";
                        $mainSheet->setCellValue($cell, $formula);
                    }

                    $col++;
                }
            },
        ];
    }
}
