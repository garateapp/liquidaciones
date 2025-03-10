<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fob extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function temporada(){
        return $this->belongsTo('App\Models\Temporada');
    }

   

    public function scopeFilter($query,$filters){
        $query->when($filters['variedad'] ?? null,function($query,$variedad){
            $query->where('n_variedad','like',$variedad);
        })->when($filters['etiqueta'] ?? null,function($query,$etiqueta){
            $query->where('etiqueta','like','%'.$etiqueta.'%');
        })->when($filters['ncategoria'] ?? null,function($query,$ncategoria){
            $query->where('categoria','like','%'.$ncategoria.'%');
        })->when($filters['norma'] ?? null, function ($query, $norma) {
            if ($norma === 'dentro') {
                $query->where('categoria', 'CAT1')
                    ->whereNotIn('n_calibre', ['L', 'LD'])
                    ->where('etiqueta', '!=', 'LOI');
            }
            if ($norma === 'fuera') {
                $query->where(function ($query) {
                    $query->orWhere('n_calibre', 'L')
                        ->orWhere('categoria', 'CAT I')
                        ->orWhere('etiqueta', 'LOI');
                });
            }
        })->when($filters['calibre'] ?? null,function($query,$calibre){
            $query->where('n_calibre',$calibre);
        })->when($filters['color'] ?? null,function($query,$color){
            $query->where('color',$color);
        })->when($filters['semana'] ?? null,function($query,$semana){
            $query->where('semana',$semana);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->where('fob_kilo_salida','null');
            }
        });
    }
    
}
