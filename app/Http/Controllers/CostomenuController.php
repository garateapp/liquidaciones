<?php

namespace App\Http\Controllers;

use App\Models\Costomenu;
use App\Models\Temporada;
use Illuminate\Http\Request;

class CostomenuController extends Controller
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
        return view('admin.costomenu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $temporada = Costomenu::create($request->all());

        return redirect()->route('admin.costos.index')->with('info','Menú creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Temporada $temporada, Costomenu $costomenu)
    {
        return view('temporadas.vistamenu',compact('temporada','costomenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Costomenu $costomenu)
    {
        return view('admin.costomenu.edit', compact('costomenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Costomenu $costomenu)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $costomenu->update($request->all());
        
        return redirect()->route('admin.costos.index')->with('info','El costo se ha actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
