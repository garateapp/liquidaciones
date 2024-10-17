<?php

namespace App\Livewire;

use App\Imports\CategoriaImport;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class AdministradorCategorias extends Component
{   public $file;

    use WithFileUploads;

    public function render()
    {   $categorias=Categoria::all();
        return view('livewire.administrador-categorias',compact('categorias'));
    }

    public function importExcel()
    {   $rules = [
            'file' => 'required|file|mimes:xlsx,xls'
        ];
        $this->validate($rules);
        //dd($this->file);
        // Importar el archivo Excel
        $trasnportes=Categoria::all();
        foreach($trasnportes as $trasporte){
            $trasporte->delete();
        }

        Excel::import(new CategoriaImport(), $this->file->store('temp'));
       
        session()->flash('message', 'Archivo subido e importado con éxito!');

        $this->reset('file');
    }
}
