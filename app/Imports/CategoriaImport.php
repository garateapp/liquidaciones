<?php

namespace App\Imports;

use App\Models\Categoria;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CategoriaImport implements ToCollection, WithStartRow
    {   
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
                 Categoria::create([ 
                    'id_sistema'=> $row[0],
                    'codigo'=> $row[1],
                    'nombre'=> $row[2],
                    'tipo'=> $row[3],
                    'grupo'=> $row[4],
                    'cap'=> $row[5]
                    
                    /*'flete_huerto'=> $row[3],
                    'minimo_garantizado'=> $row[4],
                    'rebate'=> $row[5],
                    'tarifa_premium'=> $row[6],
                    'comparativa'=> $row[7],
                    'descuento_fruta_comercial'=> $row[8],
                    'cumplimiento'=> $row[9]*/
                ]);
            }
        }
}