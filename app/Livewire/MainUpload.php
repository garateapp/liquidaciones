<?php

namespace App\Livewire;

use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Exportacion;
use App\Models\Flete;
use App\Models\Material;
use App\Models\Resumen;
use App\Models\Temporada;
use Livewire\Component;

class MainUpload extends Component
{   public $temporada,$type,$precio_usd, $etiqueta, $empresa, $valor;

    public function mount(Temporada $temporada){
        $this->temporada=$temporada;
    }
    public function render()
    {   $materiales=Material::where('temporada_id',$this->temporada->id)->get();
        $resumes=Resumen::where('temporada_id',$this->temporada->id)->get();
        $CostosPackings=CostoPacking::where('temporada_id',$this->temporada->id)->get();
        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->get();
        $fletes=Flete::where('temporada_id',$this->temporada->id)->get();
        $comisions=Comision::where('temporada_id',$this->temporada->id)->get();
       
        return view('livewire.main-upload',compact('materiales','resumes','CostosPackings','exportacions','fletes','comisions'));
    }

    public function exportacion_store(){
        $rules = [
            'type'=>'required',
            'precio_usd'=>'required'
            
            ];
      
        $this->validate ($rules);

        Exportacion::create([
            'temporada_id'=>$this->temporada->id,
            'type'=>$this->type,
            'precio_usd'=>$this->precio_usd            
        ]);
        
        $this->reset(['type','precio_usd']);
        $this->temporada = Temporada::find($this->temporada->id);
    }

    public function flete_store(){
        $rules = [
            'etiqueta'=>'required',
            'empresa'=>'required',
            'valor'=>'required'
            
            ];
      
        $this->validate ($rules);

        Flete::create([
            'temporada_id'=>$this->temporada->id,
            'etiqueta'=>$this->etiqueta,
            'empresa'=>$this->empresa,
            'valor'=>$this->valor
        ]);
        
        $this->reset(['etiqueta','empresa','valor']);
        $this->temporada = Temporada::find($this->temporada->id);
    }
}
