<?php

namespace App\Livewire;

use App\Models\Temporada;
use Livewire\Component;
use Livewire\Attributes\Url;

class TemporadasIndex extends Component
{   public $search="Hola mundo";

    public function render()
    {   $temporadas = Temporada::orderBy('name', 'desc')->get();
        return view('livewire.temporadas-index',compact('temporadas'));
    }



}
