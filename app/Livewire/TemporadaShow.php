<?php

namespace App\Livewire;

use App\Models\CostoPacking;
use App\Models\Resumen;
use App\Models\Temporada;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TemporadaShow extends Component
{   use WithPagination;
    public $temporada,$vista;


    #[Url]
    public $filters=[
        'exportadora'=>'',
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
        return view('livewire.temporada-show',compact('resumes','CostosPackings'));
    }

    public function set_view($vista){
        $this->vista=$vista;
    }
}
