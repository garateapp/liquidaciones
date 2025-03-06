<?php

namespace App\Livewire;

use App\Imports\PackingCodeImport;
use App\Models\Costoembalajecode;
use App\Models\Costomenu;
use App\Models\Costotarifacolor;
use App\Models\Exportacion;
use App\Models\Temporada;
use App\Models\Variedad;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CostosTemporada extends Component
{   public $temporada, $costomenu,$formcolor, $variedadpacking; 

    protected $listeners = ['tarifaActualizada' => '$refresh'];

    use WithFileUploads;

    public $tarifas = [];

    public $file;

    public function importFile($costo_id)
    {
        // Validar el archivo
        $this->validate([
            'file' => 'required|mimes:csv,xlsx',  // Validación del archivo
        ]);

        // Eliminar los registros existentes para la combinación de temporada_id y costo_id
        Costoembalajecode::where('temporada_id', $this->temporada->id)
            ->where('costo_id', $costo_id)
            ->delete();

        // Importar el archivo
        Excel::import(new PackingCodeImport($this->temporada->id, $costo_id), $this->file);

        // Limpiar el archivo cargado después de la importación
        $this->file = null;

        // Emitir evento para actualizar la vista
        $this->dispatch('fileImported');
        session()->flash('message', 'Importación realizada con éxito');
    }


    public function saveTarifa($color, $costo_id)
    {
        // Validar que haya un valor ingresado
        if (!isset($this->tarifas[$color]) || empty($this->tarifas[$color])) {
            session()->flash('error', 'Debe ingresar una tarifa.');
            return;
        }

        $tarifa_kg = $this->tarifas[$color];

        // Guardar en la base de datos
        Costotarifacolor::updateOrCreate(
            ['temporada_id'=>$this->temporada->id,
            'color' => $color, 
            'costo_id' => $costo_id],
            ['tarifa_kg' => $tarifa_kg]
        );

        // Limpiar input después de guardar
        unset($this->tarifas[$color]);

        // Emitir evento para actualizar la vista
        $this->dispatch('tarifaActualizada');

    }

    public function destroy_costotarifacolor(Costotarifacolor $costotarifacolor){
        $costotarifacolor->delete();
    }

    

    public function mount(Temporada $temporada, Costomenu $costomenu){
        $this->temporada=$temporada;
        $this->costomenu=$costomenu;
    }
    public function render()
    {   $costomenus=Costomenu::all();
        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->get();
        $unique_variedades = Variedad::where('temporada_id',$this->temporada->id)->get();
        
        return view('livewire.costos-temporada',compact('costomenus','exportacions','unique_variedades'));
    }

    

    public function variedadcolor_add(){
        $rules = [
            'variedadpacking'=>'required',
            ];
        $this->validate ($rules);

        $variedad=Variedad::find($this->variedadpacking);
        $variedad->bi_color=$this->formcolor;
        $variedad->save();

        $this->reset('variedadpacking');
        $this->render();
    }

    public function redcolor_destroy($id){
       
        $variedad=Variedad::find($id);
        $variedad->bi_color=null;
        $variedad->save();
    }
    
}
