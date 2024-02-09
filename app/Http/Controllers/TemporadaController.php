<?php

namespace App\Http\Controllers;

use App\Imports\ResumenImport;
use App\Models\Resumen;
use App\Models\Temporada;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class TemporadaController extends Controller
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
        return view('temporadas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $temporada = Temporada::create($request->all());

        return redirect()->route('dashboard')->with('info','Temporada creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Temporada $temporada)
    {
        return view('temporadas.show',compact('temporada'));
    }

    public function resume(Temporada $temporada)
    {   $resumes=Resumen::all();
        return view('temporadas.resume',compact('temporada','resumes'));
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
    {
        //
    }

    public function importdata(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        FacadesExcel::import(new ResumenImport,$file);

        return "Importacion Realizada con Exito";
    }

}
