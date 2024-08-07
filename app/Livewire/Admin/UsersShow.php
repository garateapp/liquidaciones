<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersShow extends Component
{use WithPagination;

    public $search;

    public function render()
    {
        $users=User::where('name','LIKE','%'.$this->search.'%')
                ->orwhere('email','LIKE', '%'.$this->search.'%' )
                ->paginate(50);

        return view('livewire.admin.users-show',compact('users'));
    }

    public function limpiar_page(){
        $this->resetPage();
    }
}
