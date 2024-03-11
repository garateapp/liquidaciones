<?php

use App\Http\Controllers\RazonController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\UserController;
use App\Livewire\TemporadaShow;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('auth')->name('dashboard');
});


Route::get('lista/filtros',[RazonController::class,'index'])->name('razonsocial.index');

Route::get('productor/{razonsocial}/{temporada}',[RazonController::class,'show'])->name('razonsocial.show');

Route::get('razon/sync',[RazonController::class,'razonsync'])->name('razonsync');

Route::get('pdf/exporting',[RazonController::class,'exportpdf'])->name('exportpdf');

Route::get('pdf/export/{razonsocial}/{temporada}',[TemporadaShow::class,'exportpdf'])->name('exportpdff');

Route::resource('temporada', TemporadaController::class)->names('temporadas');

Route::get('temporada/{temporada}/resumen',[TemporadaController::class,'resume'])->name('temporada.resume');

Route::get('temporada/{temporada}/packing',[TemporadaController::class,'packing'])->name('temporada.packing');

Route::get('temporada/{temporada}/comision',[TemporadaController::class,'comision'])->name('temporada.comision');

Route::get('temporada/{temporada}/materiales',[TemporadaController::class,'materiales'])->name('temporada.materiales');

Route::get('temporada/{temporada}/exportacion',[TemporadaController::class,'exportacion'])->name('temporada.exportacion');

Route::get('temporada/{temporada}/flete',[TemporadaController::class,'flete'])->name('temporada.flete');

Route::get('balance/{temporada}/masa',[TemporadaController::class,'balancemasa'])->name('temporada.balancemasa');

Route::get('temporada/{temporada}/otrosgastos',[TemporadaController::class,'otrosgastos'])->name('temporada.otrosgastos');

Route::get('temporada/{temporada}/finanzas',[TemporadaController::class,'finanzas'])->name('temporada.finanzas');

Route::get('temporada/{temporada}/anticipos',[TemporadaController::class,'anticipos'])->name('temporada.anticipos');

Route::post('data/import',[TemporadaController::class,'importdata'])->name('temporada.importData');

Route::post('costos/packing/import',[TemporadaController::class,'importCostosPacking'])->name('temporada.importCostosPacking');

Route::post('costos/materiales/import',[TemporadaController::class,'importMateriales'])->name('temporada.importMateriales');

Route::get('edit/{exportacion}/{temporada}',[TemporadaController::class,'exportacionedit'])->name('exportacion.edit');

Route::post('update/{exportacion}',[TemporadaController::class,'exportacionupdate'])->name('exportacion.update');

Route::get('editflete/{flete}/{temporada}',[TemporadaController::class,'fleteedit'])->name('flete.edit');

Route::post('updateflete/{flete}',[TemporadaController::class,'fleteupdate'])->name('flete.update');

Route::get('editcomision/{comision}/{temporada}',[TemporadaController::class,'comisionedit'])->name('comision.edit');

Route::post('updatecomision/{comision}',[TemporadaController::class,'comisionupdate'])->name('comision.update');


Route::post('costos/exportacion/import',[TemporadaController::class,'importExportacion'])->name('temporada.importExportacion');

Route::post('costos/comision/import',[TemporadaController::class,'importComision'])->name('temporada.importComision');

Route::post('costos/balance/import',[TemporadaController::class,'importBalance'])->name('temporada.importBalance');

Route::post('costos/balancedos/import',[TemporadaController::class,'importBalance2'])->name('temporada.importBalance2');

Route::post('costos/balancetres/import',[TemporadaController::class,'importBalance3'])->name('temporada.importBalance3');

Route::post('costos/balancecuatro/import',[TemporadaController::class,'importBalance4'])->name('temporada.importBalance4');

Route::post('costos/anticipo/import',[TemporadaController::class,'importAnticipo'])->name('temporada.importAnticipo');