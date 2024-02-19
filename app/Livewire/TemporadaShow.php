<?php

namespace App\Livewire;

use App\Models\Resumen;
use App\Models\Temporada;
use Livewire\Attributes\Url;
use Livewire\Component;

class TemporadaShow extends Component
{   public $temporada;

    #[Url]
    public $filters=[
        'exportadora'=>'',
        'fromNumber'=>'',
        'toNumber'=>'',
        'fromDate'=>'',
        'toDate'=>'',
    ];

    #[Url]
    public $vista='detalle';

    public function mount(Temporada $temporada){
        $this->temporada=$temporada;
    }

    public function render()
    {    $resumes=Resumen::where('temporada_id',$this->temporada->id)->get();
        return view('livewire.temporada-show',compact('resumes'));
    }
}
