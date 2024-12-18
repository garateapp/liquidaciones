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
            $query->where('n_variedad','like','%'.$variedad.'%');
        })->when($filters['etiqueta'] ?? null,function($query,$etiqueta){
            $query->where('etiqueta','like','%'.$etiqueta.'%');
        })->when($filters['calibre'] ?? null,function($query,$calibre){
            $query->where('n_calibre',$calibre);
        })->when($filters['semana'] ?? null,function($query,$semana){
            $query->where('semana',$semana);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->where('fob_kilo_salida','null');
            }
        });
    }
    
}
