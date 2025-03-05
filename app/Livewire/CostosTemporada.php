<?php

namespace App\Livewire;

use App\Models\Costomenu;
use App\Models\Exportacion;
use App\Models\Temporada;
use App\Models\Variedad;
use Livewire\Component;

class CostosTemporada extends Component
{   public $temporada, $costomenu,$formcolor, $variedadpacking; 

    public function mount(Temporada $temporada, Costomenu $costomenu){
        $this->temporada=$temporada;
        $this->costomenu=$costomenu;
    }
    public function render()
    {   $costomenus=Costomenu::all();
        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->get();
        $unique_variedades = Variedad::where('temporada_id',$this->temporada->id)->get();
        
        return view('livewire.costos-temporada',compact('costomenus','exportacions','unique_variedades'));
    }

    public function variedadcolor_add(){
        $rules = [
            'variedadpacking'=>'required',
            ];
        $this->validate ($rules);

        $variedad=Variedad::find($this->variedadpacking);
        $variedad->bi_color=$this->formcolor;
        $variedad->save();

        $this->reset('variedadpacking');
        $this->render();
    }
    
}
