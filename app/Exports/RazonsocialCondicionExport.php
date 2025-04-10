<?php

namespace App\Exports;

use App\Models\Costo;
use App\Models\Razonsocial;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class RazonsocialCondicionExport implements FromView, ShouldAutoSize, WithEvents
{
    public $razons, $costo, $temporada;

    public function __construct($razons, $costo, $temporada)
    {
        $this->razons = $razons;
        //dd($costo['id']);
        $this->costo = Costo::find($costo['id']);
        $this->temporada = $temporada;
    }

    public function view(): View
    {
        return view('exports.razonsocial', [
            'razons' => $this->razons,
            'costo' => $this->costo,
            'temporada' => $this->temporada,
        ]);
    }

    public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {
            $spreadsheet = $event->sheet->getDelegate()->getParent(); // acceso al archivo completo
            $mainSheet = $event->sheet->getDelegate(); // hoja principal

            // === 1. Crear hoja "Opciones" con value => text ===
            $opcionesSheet = $spreadsheet->createSheet();
            $opcionesSheet->setTitle('Opciones');

            $opciones = $this->costo->condicionproductor->opcions;

            // Escribir encabezados
            $opcionesSheet->setCellValue('A1', 'Value');
            $opcionesSheet->setCellValue('B1', 'Text');

            // Escribir cada fila de opciones
            foreach ($opciones as $index => $opcion) {
                $row = $index + 2;
                $value = str_replace(',', '.', (string) $opcion->value);
                if (strpos((string)$value, '.') !== false) {
                    $opcionesSheet->setCellValueExplicit("A{$row}", $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                } else {
                    $opcionesSheet->setCellValue("A{$row}", $opcion->value);
                }
               
               
                $opcionesSheet->setCellValue("B{$row}", $opcion->text);
            }

            // Ocultar hoja de opciones
            //$opcionesSheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

            // === 2. Validaciones y fórmulas ===
            $values = $opciones->pluck('value')->toArray();
            $dropdownOptions = '"' . implode(',', $values) . '"';

            $startRow = 2;
            $endRow = $startRow + count($this->razons) - 1;

            for ($row = $startRow; $row <= $endRow; $row++) {
                $respuesta = $mainSheet->getCell("C{$row}")->getValue();

                if (trim($respuesta) === 'n/a') {
                    // === Dropdown en columna B ===
                    $validation = $mainSheet->getCell("B{$row}")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_STOP);
                    $validation->setAllowBlank(false);
                    $validation->setShowDropDown(true);
                    $validation->setFormula1($dropdownOptions);
                    $mainSheet->getCell("B{$row}")->setDataValidation($validation);

                    // === Fórmula BUSCARV en columna C ===
                    $formula = "=IF(B{$row}<>\"\", VLOOKUP(B{$row}, Opciones!A:B, 2, FALSE), \"n/a\")";
                    $mainSheet->setCellValue("C{$row}", $formula);
                }
            }
        },
    ];
}


}