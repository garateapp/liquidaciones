<?php

namespace App\Imports;

use App\Models\PackingCode;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PackingCodeImport implements ToCollection, WithStartRow
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
            return 2;
        }

        public function collection($rows)
        {  
            foreach($rows as $row){
                 PackingCode::create([ 
                    'temporada_id'=>$this->temporada,
                    'c_embalaje'=> $row[0],
                    'costo_por_caja_usd'=> $row[1]
                ]);
            }
        }
}