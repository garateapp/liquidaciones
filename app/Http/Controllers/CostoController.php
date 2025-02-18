<?php

namespace App\Http\Controllers;

use App\Models\Costo;
use App\Models\Costomenu;
use App\Models\Superespecie;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class CostoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costos=Costo::all();
        $superespecies=Superespecie::all();
        return view('admin.costos.index',compact('costos','superespecies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $especies = Superespecie::all();

        $opcionesmenu = Costomenu::all();

        return view('admin.costos.create',compact('especies','opcionesmenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $costo = Costo::create([
            'name' => $request->name,
            'exp'=>$request->exp,
            'mi'=>$request->mi,
            'com'=>$request->com
            // otros campos
        ]);
        
        $costo->superespecies()->sync($request->superespecies);

        return redirect()->route('admin.costos.index');
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
    public function edit(Costo $costo)
    {   
        $especies = Superespecie::all();

        $opcionesmenu = Costomenu::all();
        
        return view('admin.costos.edit',compact('costo','especies','opcionesmenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Costo $costo)
    {
        $request->validate([
            'name' => 'required',
            'superespecies' =>'required'
        ]);

        $costo->update([
            'name'=>$request->name,
            'metodo'=>$request->metodo,
            'costomenu_id'=>$request->costomenu_id,
            'exp'=>$request->exp,
            'mi'=>$request->mi,
            'com'=>$request->com
        ]);
        
        $costo->superespecies()->sync($request->superespecies);

        return redirect()->route('admin.costos.index')->with('info','El costo se ha actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Costo $costo)
    {
        $costo->delete();
        return redirect()->back();
    }
}
