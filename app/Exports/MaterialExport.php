<?php

namespace App\Exports;

use App\Models\Material;
use App\Models\Temporada;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterialExport implements FromCollection, WithHeadings
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
        return Material::where('temporada_id',$this->temporada->id)->get();
    }

    public function startCell(): string
    {
        return 'A1';
    }
    public function headings(): array
    {   
        return[
            'c_embalaje',
            'Tarifa_Caja_Packing_USD'
        ];
    }

    public function map($packingcode): array
    {
        return [
            $packingcode->c_embalaje,
            $packingcode->costo_por_caja_usd,
           
        ];
    }

    public function columnFormats(): array
    {
        return [
           
        ];
    }
   
}
