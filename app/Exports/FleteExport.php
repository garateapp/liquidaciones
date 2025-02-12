<?php

namespace App\Exports;

use App\Models\Flete;
use App\Models\Temporada;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FleteExport implements FromCollection, WithHeadings
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
        return Flete::where('temporada_id',$this->temporada->id)->get();
    }

    public function startCell(): string
    {
        return 'A1';
    }
    public function headings(): array
    {   
        return[
            'Condicion',
            'Productor',
            'CLP',
            'USD'
        ];
    }

    public function map($packingcode): array
    {
        return [
            $packingcode->condicion,
            $packingcode->productor,
            $packingcode->clp,
            $packingcode->usd,
           
        ];
    }

    public function columnFormats(): array
    {
        return [
           
        ];
    }
   
}
