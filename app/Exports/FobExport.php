<?php

namespace App\Exports;

use App\Models\Fob;
use App\Models\Temporada;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FobExport implements FromCollection, WithCustomStartCell, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{   use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $temporada;

    public function __construct($temporada_id) {
        $this->temporada = Temporada::find($temporada_id);
    }

    public function collection()
    {
        return Fob::where('temporada_id',$this->temporada->id)->latest('n_proceso')->get();
    }

    public function startCell(): string
    {
        return 'A1';
    }
    public function headings(): array
    {   
        return[
            'n_variedad',
            'Semana', 
            'Etiqueta',
            'N_calibre',
            'Color',
            'Categoria',
            'fob_kilo_salida'
           
        ];
    }

    public function map($fob): array
    {
        return [
            $fob->n_variedad,
            $fob->semana,
            $fob->n_calibre,
            $fob->color,
            $fob->categoria,
            $fob->fob_kilo_salida,
           
        ];
    }

    public function columnFormats(): array
    {
        return [
           
        ];
    }
   
}
