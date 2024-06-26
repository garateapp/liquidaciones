<?php

namespace App\Livewire;

use App\Models\Especie;
use App\Models\Proceso;
use App\Models\Sync;
use App\Models\Temporada;
use App\Models\Variedad;
use Livewire\Component;
use Livewire\WithPagination;

class ProcesoSearch extends Component
{   use WithPagination;

    public $search, $espec, $ctd=25, $especieid, $especiename, $varie, $variedadid, $titulo='Gráfico por Especies', $temporada,$temporada_id,$temp;

    public function mount($temporada_id){
        $this->temporada_id=$temporada_id;
        $this->temp=Temporada::find($temporada_id);
        $this->temporada='actual';
    }

    public function render()
    {   

        
        if($this->espec){
            if($this->varie){
                $procesos=Proceso::where('variedad','LIKE', $this->varie->name)
                            ->orderBy('n_proceso', 'asc') // Ordenar por ID de forma ascendente
                            ->paginate($this->ctd);
            }else{
                    $procesos=Proceso::where('especie',$this->espec->name)
                            ->orderBy('n_proceso', 'asc') // Ordenar por ID de forma ascendente
                            ->paginate($this->ctd);
            }

        }else{
            $procesos = Proceso::where(function($query) {
                            $query->where('agricola', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('n_proceso', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('especie', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('variedad', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('fecha', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('id_empresa', 'LIKE', '%' . $this->search . '%');
                        })
                        ->orderBy('n_proceso', 'desc')
                        ->paginate($this->ctd);
        
        }
        
        $procesosall = Proceso::where('temporada_id', $this->temporada_id)->get();

        
        $especies=Especie::where('id','>=',1)->latest('id')->get();
        $variedades=Variedad::all();

        $sync=Sync::where('entidad','PROCESOS')
        ->orderby('id','DESC')
        ->first();

        return view('livewire.proceso-search',compact('sync','procesosall','procesos','variedades','especies'));
    }

  

   

    public function set_especie($id){
        $this->especieid=$id;
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->espec=Especie::find($this->especieid);
        
        
    }

    public function set_varie($id){
        $this->variedadid=$id;
        $this->varie=Variedad::find($this->variedadid);
        
    }

    public function limpiar_page(){
        $this->resetPage();
    }

    public function espec_clean(){
        $this->especieid=NULL;
        $this->espec=NULL;
        $this->search=NULL;

    }
    public function varie_clean(){
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->search=$this->espec->name;

    }

    
}