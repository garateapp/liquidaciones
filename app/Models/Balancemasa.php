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
    // Defaults seguros
    $exp = array_key_exists('exp', $filters) ? (bool)$filters['exp'] : true;
    $mi  = array_key_exists('mi',  $filters) ? (bool)$filters['mi']  : true;
    $com = array_key_exists('com', $filters) ? (bool)$filters['com'] : true;

    // Códigos por grupo
    $exportacionCodes    = Categoria::where('grupo', 'Exportacion')->pluck('nombre')->unique();
    $mercadoInternoCodes = Categoria::where('grupo', 'Mercado Interno')->pluck('nombre')->unique();
    $comercialCodes      = Categoria::where('grupo', 'Comercial')->pluck('nombre')->unique();

    // Si alguno está desmarcado, filtramos por los que quedaron marcados
    if (!$exp || !$mi || !$com) {
        $categorias = collect();
        if ($exp) $categorias = $categorias->merge($exportacionCodes);
        if ($mi)  $categorias = $categorias->merge($mercadoInternoCodes);
        if ($com) $categorias = $categorias->merge($comercialCodes);

        // Si ninguno quedó marcado => sin resultados
        if ($categorias->isEmpty()) {
            $query->whereRaw('1=0');
        } else {
            $query->whereIn('n_categoria', $categorias->unique()->values());
        }
    }

    $query
        ->when(($filters['razonsocial'] ?? null), function ($q, $serie) {
            $q->where('c_productor', 'like', "%{$serie}%");
        })
        ->when(($filters['variedad'] ?? null), fn($q, $v) => $q->where('n_variedad', $v))
        ->when(($filters['precioFob'] ?? null), function ($q, $precioFob) {
            if ($precioFob === 'fobcero') {
                $q->whereHas('fob', function ($qq) {
                    $qq->where(function($w){
                        $w->where('fob_kilo_salida', 0)->orWhereNull('fob_kilo_salida');
                    });
                });
            } elseif ($precioFob === 'null') {
                $q->whereNull('fob_id');
            } elseif ($precioFob === 'fob') {
                $q->where('fob_id', '>', 0);
            }
        })
        ->when(($filters['norma'] ?? null), function ($q, $norma) {
            if ($norma === 'dentro') {
                $q->where('n_categoria', 'Cat 1')
                  ->whereNotIn('n_calibre', ['L', 'LD'])
                  ->where('n_etiqueta', '!=', 'Loica');
            } elseif ($norma === 'fuera') {
                $q->where(function ($w) {
                    $w->where('n_calibre', 'L')
                      ->orWhere('n_categoria', 'Cat I')
                      ->orWhere('n_etiqueta', 'Loica');
                });
            }
        })
        ->when(($filters['calibre'] ?? null), fn($q, $v) => $q->where('n_calibre', $v))
        ->when(($filters['etiqueta'] ?? null), fn($q, $v) => $q->where('n_etiqueta', $v))
        ->when(($filters['etiquetas'] ?? null), function ($q, $arr) {
            if (!empty($arr)) $q->whereIn('n_etiqueta', $arr);
        })
        ->when(($filters['notfolios'] ?? null), function ($q, $arr) {
            if (!empty($arr)) $q->whereNotIn('folio', $arr);
        })
        ->when(($filters['material'] ?? null), fn($q, $v) => $q->where('c_embalaje', $v))
        ->when(($filters['semana'] ?? null),   fn($q, $v) => $q->where('semana', $v))
        ->when(($filters['fechanull'] ?? null), function ($q) {
            $q->where(function($w){
                $w->whereNull('etd')
                  ->orWhereNull('eta')
                  ->orWhereNull('semana');
            });
        })
        ->when(($filters['multiplicacion'] ?? null), fn($q) => $q->where('factor', '0'));
}

public function scopeFilter1($query, $filters)
{
    $exp = array_key_exists('exp', $filters) ? (bool)$filters['exp'] : true;
    $mi  = array_key_exists('mi',  $filters) ? (bool)$filters['mi']  : true;
    $com = array_key_exists('com', $filters) ? (bool)$filters['com'] : true;

    $exportacionCodes    = Categoria::where('grupo', 'Exportacion')->pluck('nombre')->unique();
    $mercadoInternoCodes = Categoria::where('grupo', 'Mercado Interno')->pluck('nombre')->unique();
    $comercialCodes      = Categoria::where('grupo', 'Comercial')->pluck('nombre')->unique();

    if (!$exp || !$mi || !$com) {
        $categorias = collect();
        if ($exp) $categorias = $categorias->merge($exportacionCodes);
        if ($mi)  $categorias = $categorias->merge($mercadoInternoCodes);
        if ($com) $categorias = $categorias->merge($comercialCodes);

        if ($categorias->isEmpty()) {
            $query->whereRaw('1=0');
        } else {
            $query->whereIn('n_categoria', $categorias->unique()->values());
        }
    }

    $query
        ->when(($filters['razonsocial'] ?? null), fn($q, $v) => $q->where('n_productor', 'like', "%{$v}%"))
        ->when(($filters['variedad'] ?? null), fn($q, $v) => $q->where('n_variedad', $v))
        ->when(($filters['precioFob'] ?? null), function ($q, $precioFob) {
            if ($precioFob === 'fobcero') {
                $q->whereHas('fob', function ($qq) {
                    $qq->where(function($w){
                        $w->where('fob_kilo_salida', 0)->orWhereNull('fob_kilo_salida');
                    });
                });
            } elseif ($precioFob === 'null') {
                $q->whereNull('fob_id');
            } elseif ($precioFob === 'fob') {
                $q->where('fob_id', '>', 0);
            }
        })
        ->when(($filters['norma'] ?? null), function ($q, $norma) {
            if ($norma === 'dentro') {
                $q->where('n_categoria', 'Cat 1')
                  ->whereNotIn('n_calibre', ['L', 'LD'])
                  ->where('n_etiqueta', '!=', 'Loica');
            } elseif ($norma === 'fuera') {
                $q->where(function ($w) {
                    $w->where('n_calibre', 'L')
                      ->orWhere('n_categoria', 'Cat I')
                      ->orWhere('n_etiqueta', 'Loica');
                });
            }
        })
        ->when(($filters['calibre'] ?? null), fn($q, $v) => $q->where('n_calibre', $v))
        ->when(($filters['etiquetas'] ?? null), function ($q, $arr) {
            if (!empty($arr)) $q->whereIn('n_etiqueta', $arr);
        })
        ->when(($filters['notfolios'] ?? null), function ($q, $arr) {
            if (!empty($arr)) $q->whereNotIn('folio', $arr);
        })
        ->when(($filters['etiqueta'] ?? null), fn($q, $v) => $q->where('n_etiqueta', $v))
        ->when(($filters['material'] ?? null), fn($q, $v) => $q->where('c_embalaje', $v))
        ->when(($filters['semana'] ?? null),   fn($q, $v) => $q->where('semana', $v))
        ->when(($filters['fechanull'] ?? null), function ($q) {
            $q->where(function($w){
                $w->whereNull('etd')
                  ->orWhereNull('eta')
                  ->orWhereNull('semana');
            });
        })
        ->when(($filters['multiplicacion'] ?? null), fn($q) => $q->where('factor', '0'));
}

public function scopeFilter2($query, $filters)
{
    $exp = array_key_exists('exp', $filters) ? (bool)$filters['exp'] : true;
    $mi  = array_key_exists('mi',  $filters) ? (bool)$filters['mi']  : true;
    $com = array_key_exists('com', $filters) ? (bool)$filters['com'] : true;

    $exportacionCodes    = Categoria::where('grupo', 'Exportacion')->pluck('nombre')->unique();
    $mercadoInternoCodes = Categoria::where('grupo', 'Mercado Interno')->pluck('nombre')->unique();
    $comercialCodes      = Categoria::where('grupo', 'Comercial')->pluck('nombre')->unique();

    if (!$exp || !$mi || !$com) {
        $categorias = collect();
        if ($exp) $categorias = $categorias->merge($exportacionCodes);
        if ($mi)  $categorias = $categorias->merge($mercadoInternoCodes);
        if ($com) $categorias = $categorias->merge($comercialCodes);

        if ($categorias->isEmpty()) {
            $query->whereRaw('1=0');
        } else {
            $query->whereIn('n_categoria', $categorias->unique()->values());
        }
    }

    $query
        ->where(function ($w) {
            $w->where('n_categoria', '!=', 'Cat 1')
              ->where('n_categoria', '!=', 'Cat I');
        })
        ->when(($filters['razonsocial'] ?? null), fn($q, $v) => $q->where('n_productor', 'like', "%{$v}%"))
        ->when(($filters['variedad'] ?? null), fn($q, $v) => $q->where('n_variedad', $v))
        ->when(($filters['precioFob'] ?? null), function ($q, $precioFob) {
            if ($precioFob === 'null') {
                $q->whereNull('fob_id');
            }
        })
        ->when(($filters['norma'] ?? null), function ($q, $norma) {
            if ($norma === 'dentro') {
                $q->where('n_categoria', 'Cat 1')
                  ->whereNotIn('n_calibre', ['L', 'LD'])
                  ->where('n_etiqueta', '!=', 'Loica');
            } elseif ($norma === 'fuera') {
                $q->where(function ($w) {
                    $w->where('n_calibre', 'L')
                      ->orWhere('n_categoria', 'Cat I')
                      ->orWhere('n_etiqueta', 'Loica');
                });
            }
        })
        ->when(($filters['calibre'] ?? null), fn($q, $v) => $q->where('n_calibre', $v))
        ->when(($filters['etiqueta'] ?? null), fn($q, $v) => $q->where('n_etiqueta', $v))
        ->when(($filters['etiquetas'] ?? null), function ($q, $arr) {
            if (!empty($arr)) $q->whereIn('n_etiqueta', $arr);
        })
        ->when(($filters['notfolios'] ?? null), function ($q, $arr) {
            if (!empty($arr)) $q->whereNotIn('folio', $arr);
        })
        ->when(($filters['material'] ?? null), fn($q, $v) => $q->where('c_embalaje', $v))
        ->when(($filters['semana'] ?? null),   fn($q, $v) => $q->where('semana', $v));
}

}
