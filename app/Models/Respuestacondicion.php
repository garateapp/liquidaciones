<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuestacondicion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relación con Razonsocial
    public function razonsocial(){
        return $this->belongsTo('App\Models\Razonsocial');
    }

    // Relación con Opcioncondicion
     public function opcion_condicion(){
        return $this->belongsTo('App\Models\Opcion_condicion');
    }

    // Relación con Temporada
    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }

}
