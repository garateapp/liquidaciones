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

    public function scopeFilter($query,$filters){
        $query->when($filters['razonsocial'] ?? null,function($query,$serie){
            $query->where('c_embalaje','like','%'.$serie.'%')->orwhere('n_productor','like','%'.$serie.'%')
            ->orwhere('r_productor','like','%'.$serie.'%');
        });
    }
    
}
