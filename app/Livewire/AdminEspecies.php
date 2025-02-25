<?php

namespace App\Livewire;

use App\Models\Especie;
use App\Models\Superespecie;
use App\Models\Supervariedad;
use App\Models\Variedad;
use Livewire\Component;

class AdminEspecies extends Component
{   public $selectedespecie, $selectedsubespecie, $selectedsubespeciefam, $selectedvariedad, $selectedsubvariedad,$selectedsubvariedadfam;

    public function mount(){
        $this->selectedespecie=Superespecie::all()->first();
    }

    public function render()
    {   $superespecies=Superespecie::all();
        $especies=Especie::where('superespecie_id',$this->selectedespecie->id)->get();
        $variedades=Supervariedad::where('superespecie_id',$this->selectedespecie->id)->get();

        $especiesnull=Especie::where('superespecie_id',null)->get();
        $variedadsnull=Supervariedad::where('superespecie_id',null)->get();
        return view('livewire.admin-especies',compact('superespecies','especies','especiesnull','variedades','variedadsnull'));
    }

    public function updateespecie(Superespecie $item){
        $this->selectedespecie=$item;
        $this->selectedsubespecie=null;
    }

    public function updatesubespecie(Especie $item){
        $this->selectedsubespecie=$item;
        $this->selectedsubespeciefam=$item->superespecie_id;
    }

    public function updatesubvariedad(Supervariedad $item){
        $this->selectedsubvariedad=$item;
        $this->selectedsubvariedadfam=$item->bi_color;
    }
    
    public function updatesubespecietype(){
        $this->selectedsubespecie->update(['superespecie_id'=>$this->selectedsubespeciefam]);
    }

    public function updatesubvariedadtype(){
        $this->selectedsubvariedad->update(['bi_color'=>$this->selectedsubvariedadfam]);
    }
}
