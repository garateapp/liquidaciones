<?php

namespace App\Http\Controllers;

use App\Models\Condicionproductor;
use App\Models\Opcion_condicion;
use Illuminate\Http\Request;

class OpcioncondicionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   $opcion = Opcion_condicion::findOrFail($id);
        $condicion=Condicionproductor::findOrFail($opcion->condicionproductor_id);
    
        // Eliminar la condición
        $opcion->delete();
    
        return redirect()->route('admin.condicionproductors.edit',$condicion)->with('success', 'Condición y opciones eliminadas con éxito.');
   
    }
}
