<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function temporada(){
        return $this->belongsTo('App\Models\Temporada');
    }

    public function superespecie(){
        return $this->belongsTo('App\Models\Superespecie');
    }

    public function colorespecies(){
        return $this->hasmany('App\Models\Colorespecie');
    }
}
