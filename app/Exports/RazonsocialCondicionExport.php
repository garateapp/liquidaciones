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
                    $colRespuesta = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1);
    
                    $mainSheet->setCellValue("{$colFactor}1", "FACTOR {$condicion->id}");
                    $mainSheet->setCellValue("{$colRespuesta}1", "RESPUESTA {$condicion->id}");
    
                    $sheetTitle = "Opciones_{$condicion->id}";
                    $opcionesSheet = $spreadsheet->createSheet();
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
    
                    $formulaSheetName = str_replace(' ', '_', $sheetTitle);
                    $startRow = 2;
                    $endRow = $startRow + count($razons) - 1;
    
                    $range = "'{$sheetTitle}'!\$A\$2:\$A\$" . ($condicion->opcions->count() + 1);
    
                    for ($row = $startRow; $row <= $endRow; $row++) {
                        $cellFactor = "{$colFactor}{$row}";
                        $cellRespuesta = "{$colRespuesta}{$row}";
    
                        // 1. Validación dropdown en FACTOR
                        $validation = $mainSheet->getCell($cellFactor)->getDataValidation();
                        $validation->setType(DataValidation::TYPE_LIST);
                        $validation->setErrorStyle(DataValidation::STYLE_STOP);
                        $validation->setAllowBlank(false);
                        $validation->setShowDropDown(true);
                        $validation->setFormula1($range);
                        $mainSheet->getCell($cellFactor)->setDataValidation($validation);
    
                        // 2. Valor inicial (después de validación)
                        $razon = $razons[$row - 2] ?? null;
                        $respuesta = $razon?->respuestas->first(fn($r) => in_array($r->opcion_condicion_id, $condicion->opcions->pluck('id')->toArray()));
                        $valorInicial = $respuesta ? str_replace(',', '.', (string)$respuesta->opcion_condicion->value) : null;
    
                        if ($valorInicial) {
                            $mainSheet->setCellValueExplicit($cellFactor, $valorInicial, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        }
    
                        // 3. Fórmula BUSCARV en RESPUESTA
                        $formula = "=IF({$cellFactor}<>\"\", VLOOKUP({$cellFactor}, '{$sheetTitle}'!A:B, 2, FALSE), \"n/a\")";
                        $mainSheet->setCellValue($cellRespuesta, $formula);
                    }
    
                    $col += 2;
                }
    
                // 🔁 Forzar recálculo automático al abrir el archivo
                $spreadsheet->getActiveSheet()->getParent()->setCalcMode(
                    \PhpOffice\PhpSpreadsheet\Calculation\Calculation::CALCULATION_AUTO
                );
            },
        ];
    }
    
}
