<?php

namespace App\Imports;

use App\Models\Balancemasa;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BalanceImport implements ToCollection, WithStartRow
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
                Balancemasa::create([
                    'temporada_id' => $this->temporada,

                    'tipo_g_produccion'=>$row[0],
                    'numero_g_produccion' => $row[1],
                    'fecha_g_produccion_sh' =>  Carbon::instance(Date::excelToDateTimeObject($row[2])),
                    'folio' => $row[3],
                    'r_productor' => $row[4],
                    'c_productor' => $row[5],
                    'n_productor' => $row[6],
                    'n_especie' => $row[7],
                    'n_variedad' => $row[8],
                    'c_embalaje' => $row[9],
                    'n_embalaje' => $row[10],
                    'n_categoria' => $row[11],
                    't_categoria' => $row[12],
                    'n_categoria_st' => $row[13],
                    'n_calibre' => $row[14],
                    'n_etiqueta' => $row[15],
                    'cantidad' => intval($row[16]),
                    'peso_neto' => floatval($row[17]),
                    'tipo_transporte'=> $row[18],
                    'semana'=> $row[19],
                    'exportadora'=> $row[20],
                    'exportadora_embarque'=> $row[21]
                                      

                ]);
                
            }
        }
}
