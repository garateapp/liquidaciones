<?php

namespace App\Imports;

use App\Models\Costo;
use App\Models\Opcion_condicion;
use App\Models\Razonsocial;
use App\Models\Respuestacondicion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RazonCondicionImport implements ToCollection, WithStartRow
{   protected $temporada, $condicion;

    public function __construct($temporada,$costo)
    {
        $this->temporada = $temporada;
        $this->condicion = Costo::find($costo)->condicionproductor;
       // dd($temporada, $this->condicion);
    }
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function collection($rows)
    {  
        foreach($rows as $row){
            if($row[1]!="Seleccione una opción"){
                $razonsocial = Razonsocial::where('name', ($row[0]))->first();

                $text = isset($row[2]) ? $row[2] : null;
                
                $opcionId = Opcion_condicion::where('condicionproductor_id', $this->condicion->id)
                    ->where(function ($query) use ($row, $text) {
                        $query->where('value', $row[1]);
                        if ($text !== null) {
                            $query->orWhere('text', $text);
                        }
                    })
                    ->first();                
                
                if($razonsocial && !IS_NULL($opcionId)){
                    Respuestacondicion::updateOrCreate(
                        [
                            'razonsocial_id' => $razonsocial->id,
                            'opcion_condicion_id' => $opcionId->id,
                            'temporada_id' => $this->temporada,
                        ],
                        [
                            'value' => $opcionId->value,
                            'text' => $opcionId->text,
                        ]
                    );   
                    //dd($opcionId);
                }else{
                    //dd($row[1],$row[2], $this->condicion->id, $opcionId);
                }      
            }
      
        }
        session()->flash('mensaje', '¡Archivo importado con éxito!');
    }
}
