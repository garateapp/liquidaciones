<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function superespecies()
    {
        return $this->belongsToMany(Superespecie::class);
    }

     public function scopeParaEspecieTemporada(Builder $query, Temporada $temporada): Builder
    {
        $superId = optional($temporada->especie->superespecie)->id;

        return $query->with('superespecies')
            ->where(function ($q) use ($superId) {
                // costos sin superespecies (aplican a todas)
                $q->whereDoesntHave('superespecies');

                // o costos asociados a la superespecie de la temporada
                if ($superId) {
                    $q->orWhereHas('superespecies', function ($qq) use ($superId) {
                        $qq->where('superespecies.id', $superId);
                    });
                }
            });
    }

      // relacion uno a muchos inversa
    public function menu(){
        return $this->BelongsTo('App\Models\Costomenu','costomenu_id');
    }

      // relacion uno a muchos inversa
    public function condicionproductor(){
        return $this->BelongsTo('App\Models\Condicionproductor','condicionproductor_id');
    }

}
