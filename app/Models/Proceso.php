<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    
    public function temporada(){
        return $this->belongsTo('App\Models\Temporada');
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('numero_g_produccion', 'like', '%' . $serie . '%');
        })->when($filters['p_unicos'] && !$filters['p_repetidos'], function ($query) {
            // Mostrar solo duplicado = 'no' si solo 'Únicos' está seleccionado
            $query->where('duplicado', 'no');
        })->when($filters['tipo'] ?? null, function($query, $tipo) {
            $query->where('tipo_g_produccion', $tipo);
        })->when($filters['tipo2'] ?? null, function($query, $tipo2) {
            $query->where('tipo', $tipo2);
        })->when(!$filters['p_unicos'] && $filters['p_repetidos'], function ($query) {
            // Mostrar solo duplicado = 'si' si solo 'Repetidos' está seleccionado
            $query->where('duplicado', 'si');
        })->when(!$filters['p_unicos'] && !$filters['p_repetidos'], function ($query) {
            // No mostrar ningún registro si ninguno está seleccionado
            $query->whereRaw('1 = 0');
        });
    
        return $query;
    }

}
