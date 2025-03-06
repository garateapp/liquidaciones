<?php

namespace App\Imports;

use App\Models\Costoembalajecode;
use App\Models\PackingCode;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PackingCodeImport implements ToCollection, WithStartRow
    {   protected $temporada,$costo;

        public function __construct($temporada,$costo)
        {
            $this->temporada = $temporada;
            $this->costo = $costo;
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
                if($row[0] && $row[1]){
                    Costoembalajecode::create([ 
                        'temporada_id'=>$this->temporada,
                        'costo_id'=>$this->costo,
                        'c_embalaje'=> $row[0],
                        'costo_por_caja'=> $row[1]
                    ]);
                }
            }
        }
}