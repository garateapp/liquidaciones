<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exportacion;
use App\Models\Costotarifacolor;
use App\Models\Costoembalajecode;
use App\Models\Costotarifacaja;
use App\Models\Costotarifakilo;
use App\Models\CostoCategoria;
use App\Models\Costoporcentajefob;
// …

class Temporada extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //protected $table = 'liquidacions';
    

    // relacion uno a muchos inversa
    public function user(){
        return $this->BelongsTo('App\Models\User');
    }

     // relacion uno a muchos inversa
     public function especie(){
        return $this->BelongsTo('App\Models\Especie');
    }

    // relacion uno a muchos inversa
    public function packings(){
        return $this->hasmany('App\Models\CostoPacking');
    }



    // relacion uno a muchos inversa
    public function packingcodes(){
        return $this->hasmany('App\Models\PackingCode');
    }

    public function materials(){
        return $this->hasmany('App\Models\Material');
    }

    public function anticipos(){
        return $this->hasmany('App\Models\Anticipo');
    }
    
      public function exportacions()
    {
        return $this->hasMany(Exportacion::class, 'temporada_id');
    }

    public function costotarifacolors()
    {
        return $this->hasMany(Costotarifacolor::class, 'temporada_id');
    }

    public function costoembalajecodes()
    {
        return $this->hasMany(Costoembalajecode::class, 'temporada_id');
    }

    public function costotarifacajas()
    {
        return $this->hasMany(Costotarifacaja::class, 'temporada_id');
    }

    public function costotarifakilos()
    {
        return $this->hasMany(Costotarifakilo::class, 'temporada_id');
    }

    public function costocategorias()
    {
        return $this->hasMany(CostoCategoria::class, 'temporada_id');
    }

    public function costoporcentajefobs()
    {
        return $this->hasMany(Costoporcentajefob::class, 'temporada_id');
    }

    public function flets(){
        return $this->hasmany('App\Models\Flete');
    }

    public function fobs(){
        return $this->hasmany('App\Models\Fob');
    }

    public function masas(){
        return $this->hasmany('App\Models\Balancemasa');
    }

    public function masasdos(){
        return $this->hasmany('App\Models\Balancemasados');
    }

    public function masatres(){
        return $this->hasmany('App\Models\Balancemasatres');
    }
   

    public function masascuatros(){
        return $this->hasmany('App\Models\Balancemasacuatro');
    }


    public function comisions(){
        return $this->hasmany('App\Models\Comision');
    }

    public function gastos(){
        return $this->hasmany('App\Models\Gasto');
    }

    public function detalles(){
        return $this->hasmany('App\Models\Detalle');
    }

    
}
