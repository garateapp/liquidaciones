<?php

namespace App\Livewire;

use App\Models\Especie;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\Temporada;
use App\Models\Variedad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

use function Termwind\render;

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

    public function production_refresh()
    {
        $productions=Http::post('https://api.greenexweb.cl/api/ObtenerRecepcion');
        $productions = $productions->json();
        $ri=Recepcion::all();
        $totali=$ri->count();

        foreach ($productions as $production){
            $id_g_recepcion=Null;//1
            $tipo_g_recepcion=Null;//2
            $numero_g_recepcion=Null;//3
            $fecha_g_recepcion=Null;//4
            $id_emisor=Null;//5
            $r_emisor=Null;//6
            //7
            $n_emisor=Null;//8
            $Codigo_Sag_emisor=Null;//9
            $tipo_documento_recepcion=Null;//10
            $numero_documento_recepcion=Null;//11
            $n_especie=Null;//12
            $n_variedad=Null;//13
            $cantidad=Null;//14
            $peso_neto=Null;//15
            $nota_calidad=Null;//16
            $n_estado=Null;//17
         
            $m=1;
            foreach ($production as $item){
                
               

                if($m==2){
                    $id_g_recepcion=$item;
                }
                if($m==3){
                    $tipo_g_recepcion=$item;
                }
                if($m==4){
                    $numero_g_recepcion=$item;
                }
                if($m==5){
                    $fecha_g_recepcion=$item;
                }
                if($m==6){
                    $id_emisor=$item;
                }
                if($m==7){
                    $r_emisor=$item;
                }
                if($m==8){
                    $Codigo_Sag_emisor=$item;
                }
                if($m==9){
                    $n_emisor=$item;
                }
                if($m==11){
                    $tipo_documento_recepcion=$item;
                }
                if($m==12){
                    $numero_documento_recepcion=$item;
                }
                if($m==13){
                    $n_especie=$item;

                }
                if($m==14){
                    $n_variedad=$item;
                }
                if($m==15){
                    $cantidad=$item;
                }
                if($m==16){
                    $peso_neto=$item;
                }
                if($m==17){
                    $nota_calidad=$item;
                }
               if($m==18){
                    $n_estado=$item;

                       
                    
                        $cont=Recepcion::where('id_g_recepcion',$id_g_recepcion)->first();
                        
                        if($cont){
                            
                            $cont->forceFill([
                                'id_g_recepcion' => $id_g_recepcion,//1
                                'tipo_g_recepcion' => $tipo_g_recepcion,//2
                                'numero_g_recepcion' => $numero_g_recepcion,//3
                                'fecha_g_recepcion' => $fecha_g_recepcion,//4
                                'id_emisor' => $id_emisor,//5
                                'r_emisor' => $r_emisor,//6
                                'n_emisor' => $n_emisor,//8
                                'Codigo_Sag_emisor' => $Codigo_Sag_emisor,//9
                                'tipo_documento_recepcion' => $tipo_documento_recepcion,//10
                                'numero_documento_recepcion' => $numero_documento_recepcion,//11
                                'n_especie' => $n_especie,//12
                                'n_variedad' => $n_variedad,
                                'cantidad' => $cantidad,
                                'peso_neto' => $peso_neto,
                                'nota_calidad' => $nota_calidad
                                
                            ])->save();
                          /*  if(IS_NULL($cont->calidad)){
                                Calidad::create([
                                    'recepcion_id'=>$cont->id
                                ]);
                            }*/
                            }
                        else{
                            
                                $rec=Recepcion::create([
                                    'id_g_recepcion' => $id_g_recepcion,//1
                                    'tipo_g_recepcion' => $tipo_g_recepcion,//2
                                    'numero_g_recepcion' => $numero_g_recepcion,//3
                                    'fecha_g_recepcion' => $fecha_g_recepcion,//4
                                    'id_emisor' => $id_emisor,//5
                                    'r_emisor' => $r_emisor,//6
                                    'n_emisor' => $n_emisor,//8
                                    'Codigo_Sag_emisor' => $Codigo_Sag_emisor,//9
                                    'tipo_documento_recepcion' => $tipo_documento_recepcion,//10
                                    'numero_documento_recepcion' => $numero_documento_recepcion,//11
                                    'n_especie' => $n_especie,//12
                                    'n_variedad' => $n_variedad,
                                    'cantidad' => $cantidad,
                                    'peso_neto' => $peso_neto,
                                    'nota_calidad' => $nota_calidad,
                                    'n_estado' => $n_estado,
                                    'temporada_id'=> $this->temporada_id
                                    
                                ]);
                            
                            
                        }
                    
                }
                $m+=1;
                
            } 
        }

        
        $rf=Recepcion::all();
        $total=$rf->count()-$ri->count();
        Sync::create([
            'tipo'=>'MANUAL',
            'entidad'=>'RECEPCIONES',
            'fecha'=>Carbon::now(),
            'cantidad'=>$total
        ]);

        return redirect()->back();
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

    public function recepcions_delete(){
        $allrecepcions=Recepcion::all();
        foreach($allrecepcions as $recepcion){
            $recepcion->delete();
        }

        $this->render();
    }
}