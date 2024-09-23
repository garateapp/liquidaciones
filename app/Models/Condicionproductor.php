<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condicionproductor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function opcions(){
        return $this->hasmany('App\Models\Opcion_condicion');
    }


}
