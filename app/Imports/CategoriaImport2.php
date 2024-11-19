<?php

namespace App\Imports;

use App\Models\Categoria;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CategoriaImport2 implements ToCollection, WithStartRow
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
                $categoria=Categoria::where('codigo',$row[1])->first();
                if($categoria){
                    $categoria->update([ 
                        'moneda'=> $row[5],
                        'unidad_multiplicadora'=> $row[6]
                    ]);
                }
            }
        }
}