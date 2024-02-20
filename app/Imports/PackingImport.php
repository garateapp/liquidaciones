<?php

namespace App\Imports;

use App\Models\CostoPacking;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PackingImport implements ToCollection, WithStartRow
    {   protected $temporada;

        public function __construct($temporada)
        {
            $this->temporada = $temporada;
        }
        /**
         * @return int
         */
        public function startRow(): int
        {
            return 12;
        }

        public function collection($rows)
        {  
            foreach($rows as $row){
                 CostoPacking::create([ 
                    'temporada_id'=>$this->temporada,
                    'n_productor'=> $row[1],
                    'val_max_tarifa'=> $row[2],
                    'volumen'=> $row[3],
                    'kg'=> $row[4],
                    'total_usd'=> $row[5],
                    'neto'=> $row[6]
                ]);
          
            }
        }
}
