<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superespecie extends Model
{
    use HasFactory;

    public function costos()
    {
        return $this->belongsToMany(Costo::class);
    }
}
