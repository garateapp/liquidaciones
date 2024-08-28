<?php

namespace App\Livewire;

use App\Models\Especie;
use App\Models\Superespecie;
use Livewire\Component;

class AdminEspecies extends Component
{   public $selectedespecie, $selectedsubespecie, $selectedsubespeciefam;

    public function mount(){
        $this->selectedespecie=Superespecie::all()->first();
    }

    public function render()
    {   $superespecies=Superespecie::all();
        $especies=Especie::where('superespecie_id',$this->selectedespecie->id)->get();
        $especiesnull=Especie::where('superespecie_id',null)->get();
        return view('livewire.admin-especies',compact('superespecies','especies','especiesnull'));
    }

    public function updateespecie(Superespecie $item){
        $this->selectedespecie=$item;
        $this->selectedsubespecie=null;
    }

    public function updatesubespecie(Especie $item){
        $this->selectedsubespecie=$item;
        $this->selectedsubespeciefam=$item->superespecie_id;
    }
    
    public function updatesubespecietype(Especie $item){
        $this->selectedsubespecie->update(['superespecie_id'=>$this->selectedsubespeciefam]);
    }
}
