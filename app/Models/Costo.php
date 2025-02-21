<?php

namespace App\Models;

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

      // relacion uno a muchos inversa
    public function menu(){
        return $this->BelongsTo('App\Models\Costomenu','costomenu_id');
    }

}
