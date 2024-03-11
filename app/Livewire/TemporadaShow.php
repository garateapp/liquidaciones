<?php

namespace App\Livewire;

use App\Models\Balancemasa;
use App\Models\Balancemasados;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Exportacion;
use App\Models\Flete;
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
    public $temporada,$vista,$razonsocial,$type,$precio_usd, $etiqueta, $empresa, $exportacionedit_id, $valor, $ctd=5;


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
        $CostosPackings=CostoPacking::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);

        $CostosPackingsall=CostoPacking::where('temporada_id',$this->temporada->id)->get();
        $materiales=Material::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $fletes=Flete::where('temporada_id',$this->temporada->id)->paginate($this->ctd);

        $masasbalances=Balancemasa::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        
        $masastotal=Balancemasa::where('temporada_id',$this->temporada->id)->get();
        
        $unique_productores = $masastotal->pluck('c_productor')->unique();

        $masastotal2=Balancemasados::where('temporada_id',$this->temporada->id)->get();


        $unique_especies = $CostosPackingsall->pluck('especie')->unique()->sort();

        $unique_variedades = $masastotal2->pluck('n_variedad')->unique()->sort();
        
        $razons= Razonsocial::filter($this->filters)->whereIn('csg', $unique_productores)->paginate($this->ctd);

        $razonsall=Razonsocial::whereIn('csg', $unique_productores)->get();
       


        $comisions=Comision::all();

        return view('livewire.temporada-show',compact('unique_especies','unique_variedades','resumes','CostosPackings','CostosPackingsall','materiales','exportacions','razons','comisions','fletes','masasbalances','razonsall'));
    }

    public function set_view($vista){
        $this->vista=$vista;
    }

    public function exportpdf(Razonsocial $razonsocial, Temporada $temporada){
        
        $masas=Balancemasa::where('temporada_id',$temporada->id)->where('c_productor',$razonsocial->csg)->get();
        $packings=CostoPacking::where('temporada_id',$temporada->id)->where('csg',$razonsocial->csg)->get();
        $comisions=Comision::where('temporada_id',$temporada->id)->where('productor',$razonsocial->name)->get();

        $pdf = Pdf::loadView('pdf.liquidacion', ['razonsocial' => $razonsocial,
                                                        'masas' => $masas,
                                                        'packings'=>$packings,
                                                        'comisions'=>$comisions]);

        return $pdf->stream('Liq. '.$razonsocial->name.'.pdf');
        
    }

    public function set_exportacionedit_id($id){
        $this->exportacionedit_id=$id;
        
    }

    public function exportacion_destroy(Exportacion $exportacion){
        $exportacion->delete();
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
