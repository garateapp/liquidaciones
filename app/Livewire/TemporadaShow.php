<?php

namespace App\Livewire;

use App\Models\CostoPacking;
use App\Models\Exportacion;
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
    public $temporada,$vista;


    #[Url]
    public $filters=[
        'exportadora'=>'',
        'razonsocial'=>'',
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
    {   $resumes=Resumen::where('temporada_id',$this->temporada->id)->paginate(5);
        $CostosPackings=CostoPacking::where('temporada_id',$this->temporada->id)->paginate(5);
        $materiales=Material::where('temporada_id',$this->temporada->id)->paginate(5);
        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->paginate(5);
        $razons=Razonsocial::all();

        return view('livewire.temporada-show',compact('resumes','CostosPackings','materiales','exportacions','razons'));
    }

    public function set_view($vista){
        $this->vista=$vista;
    }

    public function exportpdf(){
        $razons=Razonsocial::all();
        $pdf = Pdf::loadView('pdf.liquidacion', ['razons' => $razons,
                                                'filters'=>$this->filters]);

        return $pdf->download('Archivo_liquidacion.pdf');
        
    }
}
