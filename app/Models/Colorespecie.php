<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colorespecie extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function especie(){
        return $this->belongsTo('App\Models\Especie');
    }
}
