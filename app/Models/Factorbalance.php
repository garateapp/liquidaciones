<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factorbalance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'temporada_id',
        'id_empresa',
        'numero_guia_produccion',
        'c_productor',
        'c_etiqueta',
        'id_variedad',
        'n_variedad',
        'c_calibre',
        'c_categoria',
        'c_embalaje',
        'total',
        'total_proceso',
        'type',
        'factor',
        'sync_control'
    ];

    public function temporada(){
        return $this->belongsTo('App\Models\Temporada');
    }
    
}
