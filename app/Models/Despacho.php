<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['p_unicos'] && !$filters['p_repetidos'], function ($query) {
            // Mostrar solo duplicado = 'no' si solo 'Únicos' está seleccionado
            $query->where('duplicado', 'no');
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
