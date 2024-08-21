<?php

namespace App\Http\Controllers;

use App\Models\Condicionproductor;
use App\Models\Opcion_condicion;
use App\Models\Superespecie;
use Illuminate\Http\Request;

class CondicionproductorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $condicions=Condicionproductor::all();
        return view('admin.condicion.index',compact('condicions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $especies = Superespecie::all();

        return view('admin.condicion.create',compact('especies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'opcions' => 'required|array|min:1',
            'opcions.*.text' => 'required|string',
            'opcions.*.value' => 'nullable|string',
        ], [
            'opcions.required' => 'Debe proporcionar al menos una opción.',
            'opcions.min' => 'Debe proporcionar al menos una opción.',
            'opcions.*.text.required' => 'El campo texto es obligatorio en cada opción.',
        ]);

        $condicion=Condicionproductor::create(['name'=>$request->name]);

        // Creación de las opciones asociadas a la condición
        foreach ($request->opcions as $opcion) {
            Opcion_condicion::create([
                'condicionproductor_id' => $condicion->id, // Asumiendo que tienes una relación en la tabla `opcion_condicion` que hace referencia a `condicion_id`
                'text' => $opcion['text'],
                'value' => $opcion['value'],
            ]);
        }

        // Redirección o respuesta según sea necesario
        return redirect()->route('admin.condicionproductors.index')->with('success', 'Condición y opciones creadas con éxito.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Condicionproductor $condicionproductor)
    {
        return view('admin.condicion.edit',compact('condicionproductor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   $request->validate([
            'name' => 'required',
            'opcions' => 'required|array|min:1',
            'opcions.*.text' => 'required|string',
            'opcions.*.value' => 'nullable|string',
        ], [
            'opcions.required' => 'Debe proporcionar al menos una opción.',
            'opcions.min' => 'Debe proporcionar al menos una opción.',
            'opcions.*.text.required' => 'El campo texto es obligatorio en cada opción.',
        ]);
        $condicion = Condicionproductor::findOrFail($id);
    
        // Actualizar la condición
        $condicion->update([
            'name' => $request->name,
        ]);
    
        // Eliminar opciones que no están en el request
        $existingOpcions = $condicion->opcions->pluck('id')->toArray();
        $newOpcions = array_column($request->opcions, 'id');
        $toDelete = array_diff($existingOpcions, $newOpcions);
        
        Opcion_condicion::whereIn('id', $toDelete)->delete();
    
        // Actualizar o crear nuevas opciones
        foreach ($request->opcions as $index => $opcion) {
            if (isset($opcion['id'])) {
                $opcionRecord = Opcion_condicion::find($opcion['id']);
                $opcionRecord->update([
                    'text' => $opcion['text'],
                    'value' => $opcion['value'],
                ]);
            } else {
                Opcion_condicion::create([
                    'condicionproductor_id' => $condicion->id,
                    'text' => $opcion['text'],
                    'value' => $opcion['value'],
                ]);
            }
        }
    
        return redirect()->route('admin.condicionproductors.edit',$condicion)->with('info', 'Condición actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   $condicion = Condicionproductor::findOrFail($id);

        // Eliminar las opciones asociadas
        $condicion->opcions()->delete();
    
        // Eliminar la condición
        $condicion->delete();
    
        return redirect()->route('admin.condicionproductors.index')->with('info', 'Condición y opciones eliminadas con éxito.');
    }
}
