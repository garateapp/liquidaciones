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
        return view('exports.razonsocial', [
            'razons' => $this->razons,
            'condiciones' => $this->condiciones ?? [$this->costo->condicionproductor],
            'temporada' => $this->temporada,
        ]);
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

                    $colFactor = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);

                    $mainSheet->setCellValue("{$colFactor}1", "{$condicion->name}");

                    $sheetTitle = "Opciones_{$condicion->id}";
                    $opcionesSheet = $spreadsheet->createSheet();
                    $opcionesSheet->setTitle($sheetTitle);

                    $opcionesSheet->setCellValue("A1", 'Text');

                    foreach ($condicion->opcions as $i => $opcion) {
                        $row = $i + 2;
                        $opcionesSheet->setCellValueExplicit("A{$row}", (string)$opcion->text, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    }

                    $opcionesSheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

                    $dropdownOptions = $condicion->opcions
                        ->pluck('text')
                        ->map(fn($v) => str_replace(',', '.', (string)$v))
                        ->implode(',');

                    $startRow = 2;
                    $endRow = $startRow + count($razons) - 1;

                    for ($row = $startRow; $row <= $endRow; $row++) {
                        $cellFactor = "{$colFactor}{$row}";

                        $razon = $razons[$row - 2] ?? null;
                        $respuesta = $razon?->respuestas->first(fn($r) => in_array($r->opcion_condicion_id, $condicion->opcions->pluck('id')->toArray()));
                        $valorInicial = $respuesta ? (string)$respuesta->opcion_condicion->text : "Seleccione una opción";

                        if ($valorInicial) {
                            $mainSheet->setCellValueExplicit($cellFactor, $valorInicial, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        }

                        // Validación dropdown en FACTOR
                        $validation = $mainSheet->getCell($cellFactor)->getDataValidation();
                        $validation->setType(DataValidation::TYPE_LIST);
                        $validation->setErrorStyle(DataValidation::STYLE_STOP);
                        $validation->setAllowBlank(false);
                        $validation->setShowDropDown(true);
                        $validation->setFormula1("\"{$dropdownOptions}\"");
                        $mainSheet->getCell($cellFactor)->setDataValidation($validation);

                        $mainSheet->getStyle($cellFactor)->getNumberFormat()->setFormatCode('@');
                    }

                    $col += 1;
                }
            },
        ];
    }
}
