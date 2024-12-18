<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function balancemasa()
    {
        return $this->hasMany(Balancemasa::class, 'numero_g_despacho', 'numero_g_despacho');
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('numero_g_despacho', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['semana'] ?? null, function ($query, $semana) {
            $query->where('semana', $semana);
        })->when($filters['calibre'] ?? null, function ($query, $calibre) {
            $query->where('c_calibre', $calibre);
        })->when($filters['p_unicos'] && !$filters['p_repetidos'], function ($query) {
            // Mostrar solo duplicado = 'no' si solo 'Únicos' está seleccionado
            $query->where('duplicado', 'no');
        })->when(!$filters['p_unicos'] && $filters['p_repetidos'], function ($query) {
            // Mostrar solo duplicado = 'si' si solo 'Repetidos' está seleccionado
            $query->where('duplicado', 'si');
        })->when($filters['fechanull'] ?? null, function($query) {
            $query->whereNull('etd')
                    ->orWhereNull('eta')
                    ->orWhereNull('semana');
        })->when(!$filters['p_unicos'] && !$filters['p_repetidos'], function ($query) {
            // No mostrar ningún registro si ninguno está seleccionado
            $query->whereRaw('1 = 0');
        });
    
        return $query;
    }
}
