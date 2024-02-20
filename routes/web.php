<?php

use App\Http\Controllers\TemporadaController;
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
    })->name('dashboard');
});


Route::resource('temporada', TemporadaController::class)->names('temporadas');

Route::get('temporada/{temporada}/resumen',[TemporadaController::class,'resume'])->name('temporada.resume');

Route::get('temporada/{temporada}/packing',[TemporadaController::class,'packing'])->name('temporada.packing');

Route::get('temporada/{temporada}/comision',[TemporadaController::class,'comision'])->name('temporada.comision');

Route::get('temporada/{temporada}/materiales',[TemporadaController::class,'materiales'])->name('temporada.materiales');

Route::get('temporada/{temporada}/exportacion',[TemporadaController::class,'exportacion'])->name('temporada.exportacion');

Route::get('temporada/{temporada}/flete',[TemporadaController::class,'flete'])->name('temporada.flete');

Route::post('data/import',[TemporadaController::class,'importdata'])->name('temporada.importData');

Route::post('costos/packing/import',[TemporadaController::class,'importCostosPacking'])->name('temporada.importCostosPacking');