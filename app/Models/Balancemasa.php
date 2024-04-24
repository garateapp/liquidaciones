<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balancemasa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     // relacion uno a muchos inversa
    public function tabla2(){
        return $this->hasone('App\Models\Balancemasados','id_check','id_check');
    }

    public function costomaterial(){
        return $this->hasone('App\Models\Material','c_embalaje','c_embalaje');
    }

    public function scopeFilter($query,$filters){
        $query->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('c_embalaje', 'like', '%' . $serie . '%')
                ->orWhere('n_productor', 'like', '%' . $serie . '%')
                ->orWhere('r_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null,function($query,$variedad){
            $query->where('n_variedad',$variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob == 'null') {
                $query->whereNull('precio_fob');
            }
        })->when(($filters['exp'] ?? null) || ($filters['mie'] ?? null) || ($filters['mn'] ?? null) || ($filters['desc'] ?? null), function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] ?? null) {
                    $query->orWhere('n_categoria', 'Exportacion');
                }
                if ($filters['mie'] ?? null) {
                    $query->orWhere('n_categoria', 'Mercado Interno Exportacion');
                }
                if ($filters['mn'] ?? null) {
                    $query->orWhere('n_categoria', 'Mercado Nacional');
                }
                if ($filters['desc'] ?? null) {
                    $query->orWhere('n_categoria', 'Desecho');
                }
            });
        })->when($filters['calibre'] ?? null,function($query,$calibre){
            $query->where('n_calibre',$calibre);
        })->when($filters['etiqueta'] ?? null,function($query,$etiqueta){
            $query->where('n_etiqueta',$etiqueta);
        })->when($filters['material'] ?? null,function($query,$material){
            $query->where('c_embalaje',$material);
        });
    }

    public function scopeFilter1($query,$filters){
        $query->where(function ($query) {
            $query->where('n_categoria', 'Cat 1')
                ->orWhere('n_categoria', 'Cat I');
        })->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('c_embalaje', 'like', '%' . $serie . '%')
                ->orWhere('n_productor', 'like', '%' . $serie . '%')
                ->orWhere('r_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->whereNull('precio_fob');
            }
        })->when(($filters['exp'] ?? null) || ($filters['mie'] ?? null) || ($filters['mn'] ?? null) || ($filters['desc'] ?? null), function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] ?? null) {
                    $query->orWhere('n_categoria', 'Exportacion');
                }
                if ($filters['mie'] ?? null) {
                    $query->orWhere('n_categoria', 'Mercado Interno Exportacion');
                }
                if ($filters['mn'] ?? null) {
                    $query->orWhere('n_categoria', 'Mercado Nacional');
                }
                if ($filters['desc'] ?? null) {
                    $query->orWhere('n_categoria', 'Desecho');
                }
            });
        })->when($filters['calibre'] ?? null, function ($query, $calibre) {
            $query->where('n_calibre', $calibre);
        })->when($filters['etiqueta'] ?? null, function ($query, $etiqueta) {
            $query->where('n_etiqueta', $etiqueta);
        })->when($filters['material'] ?? null, function ($query, $material) {
            $query->where('c_embalaje', $material);
        });
    }

    public function scopeFilter2($query,$filters){
        $query->where(function ($query) {
            $query->where('n_categoria', '!=', 'Cat 1')
                ->where('n_categoria', '!=', 'Cat I');
        })->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('c_embalaje', 'like', '%' . $serie . '%')
                ->orWhere('n_productor', 'like', '%' . $serie . '%')
                ->orWhere('r_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->whereNull('precio_fob');
            }
        })->when(($filters['exp'] ?? null) || ($filters['mie'] ?? null) || ($filters['mn'] ?? null) || ($filters['desc'] ?? null), function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] ?? null) {
                    $query->orWhere('n_categoria', 'Exportacion');
                }
                if ($filters['mie'] ?? null) {
                    $query->orWhere('n_categoria', 'Mercado Interno Exportacion');
                }
                if ($filters['mn'] ?? null) {
                    $query->orWhere('n_categoria', 'Mercado Nacional');
                }
                if ($filters['desc'] ?? null) {
                    $query->orWhere('n_categoria', 'Desecho');
                }
            });
        })->when($filters['calibre'] ?? null, function ($query, $calibre) {
            $query->where('n_calibre', $calibre);
        })->when($filters['etiqueta'] ?? null, function ($query, $etiqueta) {
            $query->where('n_etiqueta', $etiqueta);
        })->when($filters['material'] ?? null, function ($query, $material) {
            $query->where('c_embalaje', $material);
        });
        
    }
    
}
