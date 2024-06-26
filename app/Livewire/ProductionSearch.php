<?php

namespace App\Livewire;

use App\Models\Especie;
use App\Models\Recepcion;
use App\Models\Temporada;
use App\Models\Variedad;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionSearch extends Component
{   use WithPagination;
    public $search, $ctd=25, $espec, $especieid, $especiename, $varie, $variedadid, $temporada,$temporada_id,$temp;
    
    public function mount($temporada_id){
        $this->temporada_id=$temporada_id;
        $this->temp=Temporada::find($temporada_id);
        $this->temporada='actual';
    }

    public function render()
    {   
        $recepcions=Recepcion::where(function($query) {
                    $query->where('id_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('tipo_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('numero_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('fecha_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('id_emisor','LIKE','%'. $this->search .'%')
                        ->orwhere('r_emisor','LIKE','%'. $this->search .'%')
                        ->orwhere('n_emisor','LIKE','%'. $this->search .'%')
                        ->orwhere('Codigo_Sag_emisor','LIKE','%'. $this->search .'%')
                        ->orwhere('tipo_documento_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('numero_documento_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('n_especie','LIKE','%'. $this->search .'%')
                        ->orwhere('n_variedad','LIKE','%'. $this->search .'%')
                        ->orwhere('n_estado','LIKE','%'. $this->search .'%');
                })
                ->orderby('numero_g_recepcion','desc')
                ->paginate($this->ctd);

                $allsubrecepcions = Recepcion::where(function ($query) {
                    $query->where('id_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('tipo_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('numero_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('fecha_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('id_emisor','LIKE','%'. $this->search .'%')
                        ->orWhere('r_emisor','LIKE','%'. $this->search .'%')
                        ->orWhere('n_emisor','LIKE','%'. $this->search .'%')
                        ->orWhere('Codigo_Sag_emisor','LIKE','%'. $this->search .'%')
                        ->orWhere('tipo_documento_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('numero_documento_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('n_especie','LIKE','%'. $this->search .'%')
                        ->orWhere('n_variedad','LIKE','%'. $this->search .'%')
                        ->orWhere('n_estado','LIKE','%'. $this->search .'%');
                })
                ->latest('id')
                ->get();
            
        
        $allrecepcions=Recepcion::where('temporada_id', $this->temporada)->get();
        
        $especies=Especie::all();
        $variedades=Variedad::all();
        
        return view('livewire.production-search',compact('variedades','especies','recepcions','allrecepcions','allsubrecepcions'));
    }
    public function update_temporada(){
        if($this->temporada=='actual'){
            $this->temporada='anterior';
        }else{
            $this->temporada='actual';
        }
    }

    public function set_especie($id){
        $this->especieid=$id;
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->espec=Especie::find($this->especieid);
        $this->search=$this->espec->name;
        
    }

    public function set_varie($id){
        $this->variedadid=$id;
        $this->varie=Variedad::find($this->variedadid);
        $this->search=$this->varie->name;
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