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

    public function fob(){
        return $this->belongsTo('App\Models\Fob');
    }
    public function despacho()
    {
        return $this->belongsTo(Despacho::class, 'numero_g_despacho', 'numero_g_despacho');
    }
    public function infocategoria()
    {
        return $this->belongsTo(Categoria::class, 'n_categoria', 'nombre');
    }
    

    public function scopeFilter($query, $filters)
    {
        // Obtener los códigos de categorías para los tres grupos
        $exportacionCodes = Categoria::where('grupo', 'Exportacion')->get()->pluck('nombre')->unique();
        $mercadoInternoCodes = Categoria::where('grupo', 'Mercado Interno')->get()->pluck('nombre')->unique();
        $comercialCodes = Categoria::where('grupo', 'Comercial')->get()->pluck('nombre')->unique();

        // Filtrar según los valores seleccionados en los checkboxes
        $query->when($filters['exp'] === false || $filters['com'] === false || $filters['mi'] === false, function($query) use ($filters, $exportacionCodes, $mercadoInternoCodes, $comercialCodes) {
            $categorias = collect();

            // Si está seleccionado, incluir las categorías correspondientes
            if ($filters['exp']) {
                $categorias = $categorias->merge($exportacionCodes);
            }
            if ($filters['mi']) {
                $categorias = $categorias->merge($mercadoInternoCodes);
            }
            if ($filters['com']) {
                $categorias = $categorias->merge($comercialCodes);
            }

            // Aplicar el filtro de categorías
            $query->whereIn('n_categoria', $categorias->unique());
        });

        // Otros filtros como antes
        $query->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('c_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob == 'fobcero') {
                $query->where(function ($query) {
                    $query->whereHas('fob', function ($query) {
                        $query->where('fob_kilo_salida', 0)
                              ->orWhere('fob_kilo_salida', null);
                    });
                });
            }
            if ($precioFob == 'null') {
                $query->WhereNull('fob_id');
            }
            if ($precioFob == 'fob') {
                $query->where('fob_id','>',0);
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
        })->when($filters['calibre'] ?? null, function($query, $calibre) {
            $query->where('n_calibre', $calibre);
        })->when($filters['etiqueta'] ?? null, function($query, $etiqueta) {
            $query->where('n_etiqueta', $etiqueta);
        })->when($filters['etiquetas'] ?? null, function($query, $etiquetas) {
            if (!empty($etiquetas)) {
                $query->whereIn('n_etiqueta', $etiquetas);
            }
        })->when($filters['material'] ?? null, function($query, $material) {
            $query->where('c_embalaje', $material);
        })->when($filters['semana'] ?? null, function($query, $semana) {
            $query->where('semana', $semana);
        })->when($filters['fechanull'] ?? null, function($query, $fechanull) {
            $query->whereNull('etd')
                    ->orWhereNull('eta')
                    ->orWhereNull('semana');
        })->when($filters['multiplicacion'] ?? null, function($query, $fechanull) {
            $query->where('factor','0');
        });
    }


    public function scopeFilter1($query,$filters){

         // Obtener los códigos de categorías para los tres grupos
         $exportacionCodes = Categoria::where('grupo', 'Exportacion')->get()->pluck('nombre')->unique();
         $mercadoInternoCodes = Categoria::where('grupo', 'Mercado Interno')->get()->pluck('nombre')->unique();
         $comercialCodes = Categoria::where('grupo', 'Comercial')->get()->pluck('nombre')->unique();
 
         // Filtrar según los valores seleccionados en los checkboxes
         $query->when($filters['exp'] === false || $filters['com'] === false || $filters['mi'] === false, function($query) use ($filters, $exportacionCodes, $mercadoInternoCodes, $comercialCodes) {
             $categorias = collect();
 
             // Si está seleccionado, incluir las categorías correspondientes
             if ($filters['exp']) {
                 $categorias = $categorias->merge($exportacionCodes);
             }
             if ($filters['mi']) {
                 $categorias = $categorias->merge($mercadoInternoCodes);
             }
             if ($filters['com']) {
                 $categorias = $categorias->merge($comercialCodes);
             }
 
             // Aplicar el filtro de categorías
             $query->whereIn('n_categoria', $categorias->unique());
         });

        $query->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('n_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob == 'fobcero') {
                $query->where(function ($query) {
                    $query->whereHas('fob', function ($query) {
                        $query->where('fob_kilo_salida', 0)
                              ->orWhere('fob_kilo_salida', null);
                    });
                });
            }
            if ($precioFob == 'null') {
                $query->WhereNull('fob_id');
            }
            if ($precioFob == 'fob') {
                $query->where('fob_id','>',0);
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
        })->when($filters['etiquetas'] ?? null, function ($query, $etiquetas) {
            if (!empty($etiquetas)) {
                $query->whereIn('n_etiqueta', $etiquetas);
            }
        })->when($filters['etiqueta'] ?? null, function ($query, $etiqueta) {
            $query->where('n_etiqueta', $etiqueta);
        })->when($filters['material'] ?? null, function ($query, $material) {
            $query->where('c_embalaje', $material);
        })->when($filters['semana'] ?? null,function($query,$semana){
            $query->where('semana',$semana);
        })->when($filters['fechanull'] ?? null, function($query, $fechanull) {
            $query->whereNull('etd')
                    ->orWhereNull('eta')
                    ->orWhereNull('semana');
        })->when($filters['multiplicacion'] ?? null, function($query, $fechanull) {
            $query->where('factor','0');
        });
    }

    public function scopeFilter2($query,$filters){
         // Obtener los códigos de categorías para los tres grupos
         $exportacionCodes = Categoria::where('grupo', 'Exportacion')->get()->pluck('nombre')->unique();
         $mercadoInternoCodes = Categoria::where('grupo', 'Mercado Interno')->get()->pluck('nombre')->unique();
         $comercialCodes = Categoria::where('grupo', 'Comercial')->get()->pluck('nombre')->unique();
 
         // Filtrar según los valores seleccionados en los checkboxes
         $query->when($filters['exp'] === false || $filters['com'] === false || $filters['mi'] === false, function($query) use ($filters, $exportacionCodes, $mercadoInternoCodes, $comercialCodes) {
             $categorias = collect();
 
             // Si está seleccionado, incluir las categorías correspondientes
             if ($filters['exp']) {
                 $categorias = $categorias->merge($exportacionCodes);
             }
             if ($filters['mi']) {
                 $categorias = $categorias->merge($mercadoInternoCodes);
             }
             if ($filters['com']) {
                 $categorias = $categorias->merge($comercialCodes);
             }
 
             // Aplicar el filtro de categorías
             $query->whereIn('n_categoria', $categorias->unique());
         });

        $query->where(function ($query) {
            $query->where('n_categoria', '!=', 'Cat 1')
                ->where('n_categoria', '!=', 'Cat I');
        })->when($filters['razonsocial'] ?? null, function ($query, $serie) {
            $query->where('n_productor', 'like', '%' . $serie . '%');
        })->when($filters['variedad'] ?? null, function ($query, $variedad) {
            $query->where('n_variedad', $variedad);
        })->when($filters['precioFob'] ?? null, function ($query, $precioFob) {
            if ($precioFob === 'null') {
                $query->whereNull('fob_id');
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
        })->when($filters['etiquetas'] ?? null, function ($query, $etiquetas) {
            if (!empty($etiquetas)) {
                $query->whereIn('n_etiqueta', $etiquetas);
            }
        })->when($filters['material'] ?? null, function ($query, $material) {
            $query->where('c_embalaje', $material);
        })->when($filters['semana'] ?? null,function($query,$semana){
            $query->where('semana',$semana);
        });
    }
    
}
