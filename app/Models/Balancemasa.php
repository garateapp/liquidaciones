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
            $query->where('c_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null,function($query,$variedad){
            $query->where('n_variedad',$variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob == 'null') {
                $query->whereNull('precio_fob');
            }
        })->when($filters['norma'] ?? null, function ($query, $norma) {
            if ($norma === 'dentro') {
                $query->where('n_categoria', 'Cat 1')
                      ->whereNotIn('n_calibre', ['L', 'LD'])
                      ->where('n_etiqueta', '!=', 'Loica');
            }
            if ($norma === 'fuera') {
                $query->where(function ($query) {
                    $query->orWhere('n_calibre', 'L')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_etiqueta', 'Loica');
                });
            }
        })->when($filters['calibre'] ?? null,function($query,$calibre){
            $query->where('n_calibre',$calibre);
        })->when($filters['etiqueta'] ?? null,function($query,$etiqueta){
            $query->where('n_etiqueta',$etiqueta);
        })->when($filters['material'] ?? null,function($query,$material){
            $query->where('c_embalaje',$material);
        })->when($filters['semana'] ?? null,function($query,$semana){
            $query->where('semana',$semana);
        })->when($filters['exp']  || $filters['mie'] || $filters['mn'] || $filters['desc'] || $filters['mer'] || $filters['mi'], function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho');
                } elseif ($filters['exp'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['exp'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp']) {
                    $query->where('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I');
                } elseif ($filters['desc']) {
                    $query->where('n_categoria', 'Desecho');
                } elseif ($filters['mer']) {
                    $query->where('n_categoria', 'Merma');
                } elseif ($filters['mi']) {
                    $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                }
            });
            
            
        });
    }

    public function scopeFilter1($query,$filters){
        $query->where(function ($query) {
            $query->where('n_categoria', 'Cat 1')
                ->orWhere('n_categoria', 'Cat I');
        })->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('n_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->whereNull('precio_fob');
            }
        })->when($filters['norma'] ?? null, function ($query, $norma) {
            if ($norma === 'dentro') {
                $query->where('n_categoria', 'Cat 1')
                      ->whereNotIn('n_calibre', ['L', 'LD'])
                      ->where('n_etiqueta', '!=', 'Loica');
            }
            if ($norma === 'fuera') {
                $query->where(function ($query) {
                    $query->orWhere('n_calibre', 'L')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_etiqueta', 'Loica');
                });
            }
        })->when($filters['calibre'] ?? null, function ($query, $calibre) {
            $query->where('n_calibre', $calibre);
        })->when($filters['etiqueta'] ?? null, function ($query, $etiqueta) {
            $query->where('n_etiqueta', $etiqueta);
        })->when($filters['material'] ?? null, function ($query, $material) {
            $query->where('c_embalaje', $material);
        })->when($filters['semana'] ?? null,function($query,$semana){
            $query->where('semana',$semana);
        })->when($filters['exp']  || $filters['mie'] || $filters['mn'] || $filters['desc'] || $filters['mer'] || $filters['mi'], function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho');
                } elseif ($filters['exp'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['exp'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp']) {
                    $query->where('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I');
                } elseif ($filters['desc']) {
                    $query->where('n_categoria', 'Desecho');
                } elseif ($filters['mer']) {
                    $query->where('n_categoria', 'Merma');
                } elseif ($filters['mi']) {
                    $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                }
            });
            
            
        });
    }

    public function scopeFilter2($query,$filters){
        $query->where(function ($query) {
            $query->where('n_categoria', '!=', 'Cat 1')
                ->where('n_categoria', '!=', 'Cat I');
        })->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('n_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->whereNull('precio_fob');
            }
        })->when($filters['norma'] ?? null, function ($query, $norma) {
            if ($norma === 'dentro') {
                $query->where('n_categoria', 'Cat 1')
                      ->whereNotIn('n_calibre', ['L', 'LD'])
                      ->where('n_etiqueta', '!=', 'Loica');
            }
            if ($norma === 'fuera') {
                $query->where(function ($query) {
                    $query->orWhere('n_calibre', 'L')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_etiqueta', 'Loica');
                });
            }
        })->when($filters['calibre'] ?? null, function ($query, $calibre) {
            $query->where('n_calibre', $calibre);
        })->when($filters['etiqueta'] ?? null, function ($query, $etiqueta) {
            $query->where('n_etiqueta', $etiqueta);
        })->when($filters['material'] ?? null, function ($query, $material) {
            $query->where('c_embalaje', $material);
        })->when($filters['semana'] ?? null,function($query,$semana){
            $query->where('semana',$semana);
        })->when($filters['exp']  || $filters['mie'] || $filters['mn'] || $filters['desc'] || $filters['mer'] || $filters['mi'], function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['exp'] && $filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['desc'] && $filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp'] && $filters['desc']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Desecho');
                } elseif ($filters['exp'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['exp'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['desc'] && $filters['mer']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere('n_categoria', 'Merma');
                } elseif ($filters['desc'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Desecho')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['mer'] && $filters['mi']) {
                    $query->orWhere('n_categoria', 'Merma')
                          ->orWhere(function ($query) {
                              $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                          });
                } elseif ($filters['exp']) {
                    $query->where('n_categoria', 'Cat 1')
                          ->orWhere('n_categoria', 'Cat I');
                } elseif ($filters['desc']) {
                    $query->where('n_categoria', 'Desecho');
                } elseif ($filters['mer']) {
                    $query->where('n_categoria', 'Merma');
                } elseif ($filters['mi']) {
                    $query->whereNotIn('n_categoria', ['Cat 1', 'Cat I', 'Desecho', 'Merma']);
                }
            });
            
            
        });
    }
    
}
