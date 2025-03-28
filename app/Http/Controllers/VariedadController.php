<?php

namespace App\Http\Controllers;

use App\Models\Costo;
use App\Models\Superespecie;
use Illuminate\Http\Request;

class VariedadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {     $costos=Costo::all();
        $superespecies=Superespecie::all();

        return view('admin.variedad.index',compact('costos','superespecies'));
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
    {
        //
    }
}
