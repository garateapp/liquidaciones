<?php

namespace App\Livewire;

use App\Models\Anticipo;
use App\Models\Balancemasa;
use App\Models\Balancemasados;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Embarque;
use App\Models\Exportacion;
use App\Models\Flete;
use App\Models\Fob;
use App\Models\Material;
use App\Models\Razonsocial;
use App\Models\Resumen;
use App\Models\Temporada;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TemporadaShow extends Component
{   use WithPagination;
    public $temporada,$vista,$razonsocial,$type,$precio_usd, $etiqueta, $empresa, $exportacionedit_id, $valor, $ctd=25;


    #[Url]
    public $filters=[
        'exportadora'=>'',
        'razonsocial'=>'',
        'especie'=>'',
        'fromNumber'=>'',
        'toNumber'=>'',
        'fromDate'=>'',
        'toDate'=>'',
    ];

    #[Url]

   

    public function mount(Temporada $temporada, $vista){
        $this->temporada=$temporada;
        $this->vista=$vista;
    }

    public function render()
    {   $resumes=Resumen::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $anticipos=Anticipo::where('temporada_id',$this->temporada->id)->orderBy('grupo', 'desc')->paginate($this->ctd);
        $CostosPackings=CostoPacking::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $CostosPackingsall=CostoPacking::where('temporada_id',$this->temporada->id)->get();
        $materiales=Material::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $embarques=Embarque::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $embarquestotal=Embarque::where('temporada_id',$this->temporada->id)->get();


        $materialestotal=Material::filter($this->filters)->where('temporada_id',$this->temporada->id)->get();


        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $fletes=Flete::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $fletestotal=Flete::where('temporada_id',$this->temporada->id)->get();
        
        $fobs=Fob::where('temporada_id',$this->temporada->id)->paginate($this->ctd);

        $masasbalances=Balancemasa::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        
        $masastotal=Balancemasa::where('temporada_id',$this->temporada->id)->get();
        
        $unique_productores = $masastotal->pluck('c_productor')->unique();

        $masastotal2=Balancemasados::where('temporada_id',$this->temporada->id)->get();

        $unique_especies = $CostosPackingsall->pluck('especie')->unique()->sort();

        $unique_variedades = $masastotal2->pluck('n_variedad')->unique()->sort();
        
        $razons= Razonsocial::filter($this->filters)->whereIn('csg', $unique_productores)->paginate($this->ctd);

        $razonsall=Razonsocial::whereIn('csg', $unique_productores)->get();

        $comisions=Comision::all();

        return view('livewire.temporada-show',compact('embarques','embarquestotal','fletestotal','materialestotal','masastotal','fobs','anticipos','unique_especies','unique_variedades','resumes','CostosPackings','CostosPackingsall','materiales','exportacions','razons','comisions','fletes','masasbalances','razonsall'));
    }

    public function set_view($vista){
        $this->vista=$vista;
    }

    public function exportpdf(Razonsocial $razonsocial, Temporada $temporada){
        
        $masas=Balancemasa::where('temporada_id',$temporada->id)->where('c_productor',$razonsocial->csg)->get();
        $packings=CostoPacking::where('temporada_id',$temporada->id)->where('csg',$razonsocial->csg)->get();
        $comisions=Comision::where('temporada_id',$temporada->id)->where('productor',$razonsocial->name)->get();
        $unique_calibres = $masas->pluck('n_calibre')->unique()->sort();
        $unique_semanas = $masas->pluck('semana')->unique()->sort();
        $fobs = Fob::where('temporada_id',$temporada->id)->get();

        $unique_variedades = $masas->pluck('n_variedad')->unique()->sort();

        $pdf = Pdf::loadView('pdf.liquidacion', ['razonsocial' => $razonsocial,
                                                        'masas' => $masas,
                                                        'packings'=>$packings,
                                                        'comisions'=>$comisions,
                                                        'unique_variedades'=>$unique_variedades,
                                                        'unique_calibres'=>$unique_calibres,
                                                    'unique_semanas'=>$unique_semanas,
                                                'fobs'=>$fobs]);

        return $pdf->stream('Liq. '.$razonsocial->name.'.pdf');
        
    }

    public function set_exportacionedit_id($id){
        $this->exportacionedit_id=$id;
        
    }

    public function exportacion_destroy(Exportacion $exportacion){
        $exportacion->delete();
    }

    public function flete_destroy(Flete $flete){
        $flete->delete();
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
