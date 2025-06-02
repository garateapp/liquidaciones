<?php

namespace App\Imports;

use App\Models\Razonsocial;
use App\Models\Condicionproductor;
use App\Models\OpcionCondicion;
use App\Models\Respuestacondicion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RespuestasImport implements ToCollection
{
    protected $temporadaId;

    public function __construct($temporadaId)
    {
        $this->temporadaId = $temporadaId;
    }

    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) return;

        $headers = $rows->first();
      
        $condiciones = Condicionproductor::with('opcions')->get();
        $condicionMap = [];

        // Detectar columnas que coincidan con el nombre de alguna condición
        foreach ($headers as $index => $header) {
            $nombreLimpio = strtolower(trim($header));
            $condicion = $condiciones->first(fn($c) => strtolower(trim($c->name)) === $nombreLimpio);
            if ($condicion) {
                $condicionMap[$index] = $condicion->id;
            }
        }
       
        $condiciones = $condiciones->keyBy('id');

        // Precargar datos
        $razones = Razonsocial::all()->keyBy(fn($r) => strtolower(trim($r->name)));
        
        foreach ($rows->slice(1) as $row) {
            $nombre = strtolower(trim($row[0]));
           
            if (!$nombre || !$razones->has($nombre)) continue;


            $razon = $razones[$nombre];
          
            
            foreach ($condicionMap as $colIndex => $condicionId) {



                $valorTexto = trim($row[$colIndex]);
                 
                if (!$valorTexto || strtolower($valorTexto) === 'seleccione una opción') continue;
                
              
                $condicion = $condiciones->get($condicionId);

                
                
                if (!$condicion) continue;

                $opcion = $condicion->opcions->first(fn($op) =>
                    strtolower(trim($op->text)) === strtolower($valorTexto)
                );

                if (!$opcion) continue;

                    Respuestacondicion::updateOrCreate(
                        [
                            'razonsocial_id' => $razon->id,
                            'temporada_id' => $this->temporadaId,
                            'opcion_condicion_id' => $opcion->id,
                        ],
                        [
                            'value' => $valorTexto,
                        ]
                    );
            }
        }
    }
}
