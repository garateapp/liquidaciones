<?php

namespace App\Livewire;

use App\Models\Condicionproductor;
use App\Models\Razonsocial;
use App\Models\Respuestacondicion;
use App\Models\Temporada;
use Livewire\Component;

class Respuestacondiciones extends Component
{   public $razonsocial;
    public $temporada;

    public function mount(Razonsocial $razonsocial,Temporada $temporada)
    {
        $this->razonsocial = $razonsocial;
        $this->temporada = $temporada;
    }

    // Función para registrar la respuesta de una condición
    public function registrarRespuesta($opcionId)
    {
        // Puedes obtener los datos adicionales si los necesitas (e.g., value)
        // En este ejemplo, se está registrando la respuesta sin 'value'
        Respuestacondicion::create([
            'razonsocial_id' => $this->razonsocial->id,
            'opcion_condicion_id' => $opcionId,
            'temporada_id' => $this->temporada->id,
            'value' => null, // O el valor si tienes alguno
        ]);

        // Enviar un mensaje o actualizar visualmente que la respuesta fue guardada
        session()->flash('message', 'Respuesta registrada correctamente');
    }

    // Función para registrar la respuesta de una condición
    public function eliminarRespuesta($opcionId)
    {
        // Puedes obtener los datos adicionales si los necesitas (e.g., value)
        // En este ejemplo, se está registrando la respuesta sin 'value'
        
        $respuesta=Respuestacondicion::where([ 'razonsocial_id' => $this->razonsocial->id,
            'opcion_condicion_id' => $opcionId,
            'temporada_id' => $this->temporada->id])->first();

        // Enviar un mensaje o actualizar visualmente que la respuesta fue guardada
        $respuesta->delete();

        session()->flash('message2', 'Respuesta eliminada correctamente');
    }
    

    public function render()
    {   $condicions = Condicionproductor::with('opcions')->get();
        return view('livewire.respuestacondiciones',compact('condicions'));
    }
}
