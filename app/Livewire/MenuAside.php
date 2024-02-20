<?php

namespace App\Livewire;

use App\Models\Temporada;
use Livewire\Component;

class MenuAside extends Component
{   public $temporada;

    public function mount(Temporada $temporada){
        $this->temporada=$temporada;
    }
    public function render()
    {
        return view('livewire.menu-aside');
    }
}
