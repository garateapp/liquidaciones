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
            $query->where('c_productor', 'like', '%' . $serie . '%')
                ->orWhere('n_productor', 'like', '%' . $serie . '%')
                ->orWhere('r_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null,function($query,$variedad){
            $query->where('n_variedad',$variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob == 'null') {
                $query->whereNull('precio_fob');
            }
        })->when($filters['calibre'] ?? null,function($query,$calibre){
            $query->where('n_calibre',$calibre);
        })->when($filters['etiqueta'] ?? null,function($query,$etiqueta){
            $query->where('n_etiqueta',$etiqueta);
        })->when($filters['material'] ?? null,function($query,$material){
            $query->where('c_embalaje',$material);
        })->when($filters['exp']  || $filters['mie'] || $filters['mn'] || $filters['desc'] || $filters['mer'] || $filters['mi'], function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion');
                } elseif ($filters['exp'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['exp'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mie'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['mie'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp']) {
                    $query->where('n_categoria_st', 'Exportacion');
                } elseif ($filters['mie']) {
                    $query->where('n_categoria_st', 'Mercado Interno Exportacion');
                } elseif ($filters['mn']) {
                    $query->where('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['desc']) {
                    $query->where('n_categoria_st', 'Desecho');
                }
            });
        });
    }

    public function scopeFilter1($query,$filters){
        $query->where(function ($query) {
            $query->where('n_categoria', 'Cat 1')
                ->orWhere('n_categoria', 'Cat I');
        })->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('c_productor', 'like', '%' . $serie . '%')
                ->orWhere('n_productor', 'like', '%' . $serie . '%')
                ->orWhere('r_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->whereNull('precio_fob');
            }
        })->when($filters['calibre'] ?? null, function ($query, $calibre) {
            $query->where('n_calibre', $calibre);
        })->when($filters['etiqueta'] ?? null, function ($query, $etiqueta) {
            $query->where('n_etiqueta', $etiqueta);
        })->when($filters['material'] ?? null, function ($query, $material) {
            $query->where('c_embalaje', $material);
        })->when($filters['exp']  || $filters['mie'] || $filters['mn'] || $filters['desc'] || $filters['mer'] || $filters['mi'], function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion');
                } elseif ($filters['exp'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['exp'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mie'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['mie'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp']) {
                    $query->where('n_categoria_st', 'Exportacion');
                } elseif ($filters['mie']) {
                    $query->where('n_categoria_st', 'Mercado Interno Exportacion');
                } elseif ($filters['mn']) {
                    $query->where('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['desc']) {
                    $query->where('n_categoria_st', 'Desecho');
                }
            });
        });
    }

    public function scopeFilter2($query,$filters){
        $query->where(function ($query) {
            $query->where('n_categoria', '!=', 'Cat 1')
                ->where('n_categoria', '!=', 'Cat I');
        })->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('c_productor', 'like', '%' . $serie . '%')
                ->orWhere('n_productor', 'like', '%' . $serie . '%')
                ->orWhere('r_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->whereNull('precio_fob');
            }
        })->when($filters['calibre'] ?? null, function ($query, $calibre) {
            $query->where('n_calibre', $calibre);
        })->when($filters['etiqueta'] ?? null, function ($query, $etiqueta) {
            $query->where('n_etiqueta', $etiqueta);
        })->when($filters['material'] ?? null, function ($query, $material) {
            $query->where('c_embalaje', $material);
        })->when($filters['exp']  || $filters['mie'] || $filters['mn'] || $filters['desc'] || $filters['mer'] || $filters['mi'], function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie'] && $filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['exp'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mie'] && $filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['exp'] && $filters['mie']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Interno Exportacion');
                } elseif ($filters['exp'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['exp'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mie'] && $filters['mn']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['mie'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno Exportacion')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mn'] && $filters['desc']) {
                    $query->orWhere('n_categoria_st', 'Mercado Nacional')
                          ->orWhere('n_categoria_st', 'Desecho');
                } elseif ($filters['mer']) {
                    $query->orWhere('n_categoria_st', 'Merma');
                } elseif ($filters['mi']) {
                    $query->orWhere('n_categoria_st', 'Mercado Interno');
                } elseif ($filters['exp']) {
                    $query->where('n_categoria_st', 'Exportacion');
                } elseif ($filters['mie']) {
                    $query->where('n_categoria_st', 'Mercado Interno Exportacion');
                } elseif ($filters['mn']) {
                    $query->where('n_categoria_st', 'Mercado Nacional');
                } elseif ($filters['desc']) {
                    $query->where('n_categoria_st', 'Desecho');
                }
            });
        });
    }
    
}
