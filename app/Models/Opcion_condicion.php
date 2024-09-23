<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion_condicion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function respuestas(){
        return $this->hasmany('App\Models\Respuestacondicion');
    }
}
