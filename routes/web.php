<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CondicionproductorController;
use App\Http\Controllers\CostoController;
use App\Http\Controllers\CostomenuController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpcioncondicionController;
use App\Http\Controllers\RazonController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariedadController;
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

Route::get('production/refresh/{temporada}', [TemporadaController::class,'production_refresh'])->middleware('auth')->name('production.refresh');

Route::get('proceso/refresh/{temporada}', [TemporadaController::class,'proceso_refresh'])->middleware('auth')->name('proceso.refresh');

Route::get('listado/productores',[RazonController::class,'index'])->name('razonsocial.index');

Route::get('ficha/productor/{razonsocial}',[RazonController::class,'show2'])->name('razonsocial.show');

Route::get('productor/{razonsocial}/{temporada}',[RazonController::class,'show'])->middleware('auth')->name('razonsocial.temporada.show');

Route::get('razon/sync',[RazonController::class,'razonsync'])->name('razonsync');

Route::get('pdf/export/{razonsocial}/{temporada}',[TemporadaShow::class,'exportpdf'])->name('exportpdff');

Route::get('grafico/{razonsocial}/{temporada}/{variedad}',[TemporadaController::class,'graficogenerate'])->name('grafico.variedad');

Route::resource('temporada', TemporadaController::class)->middleware('auth')->names('temporadas');

Route::resource('familia', FamiliaController::class)->names('familias');

Route::resource('gasto', GastoController::class)->names('gastos');

Route::get('temporada/{temporada}/resumen',[TemporadaController::class,'resume'])->name('temporada.resume');

Route::get('temporada/{temporada}/nacional',[TemporadaController::class,'nacional'])->name('temporada.nacional');

Route::get('temporada/{temporada}/packing',[TemporadaController::class,'packing'])->name('temporada.packing');

Route::get('temporada/{temporada}/comision',[TemporadaController::class,'comision'])->name('temporada.comision');

Route::get('temporada/{temporada}/materiales',[TemporadaController::class,'materiales'])->name('temporada.materiales');

Route::get('temporada/{temporada}/exportacion',[TemporadaController::class,'exportacion'])->name('temporada.exportacion');

Route::get('temporada/{temporada}/flete',[TemporadaController::class,'flete'])->name('temporada.flete');

Route::get('balance/{temporada}/masa',[TemporadaController::class,'balancemasa'])->name('temporada.balancemasa');

Route::get('balance/{temporada}/factor',[TemporadaController::class,'factor'])->name('temporada.factor');

Route::get('balance/{temporada}/fob',[TemporadaController::class,'fob'])->name('temporada.fob');

Route::get('balance/{temporada}/fobtree',[TemporadaController::class,'fobtree'])->name('temporada.fobtree');

Route::get('balance/{temporada}/recepcion',[TemporadaController::class,'recepcion'])->name('temporada.recepcion');

Route::get('balance/{temporada}/procesos',[TemporadaController::class,'procesos'])->name('temporada.procesos');

Route::get('balance/{temporada}/despachos',[TemporadaController::class,'despachos'])->name('temporada.despachos');

Route::get('balance/{temporada}/embarques',[TemporadaController::class,'embarques'])->name('temporada.embarques');

Route::get('temporada/{temporada}/otrosgastos',[TemporadaController::class,'otrosgastos'])->name('temporada.otrosgastos');

Route::get('temporada/{temporada}/finanzas',[TemporadaController::class,'finanzas'])->name('temporada.finanzas');

Route::get('temporada/{temporada}/anticipos',[TemporadaController::class,'anticipos'])->name('temporada.anticipos');

Route::get('temporada/{temporada}/gastos',[TemporadaController::class,'gastos'])->name('temporada.gastos');

Route::post('data/import',[TemporadaController::class,'importdata'])->name('temporada.importData');

Route::post('costos/packing/import',[TemporadaController::class,'importCostosPacking'])->name('temporada.importCostosPacking');

Route::post('costos/materiales/import',[TemporadaController::class,'importMateriales'])->name('temporada.importMateriales');

Route::post('costos/packingcode/import',[TemporadaController::class,'importPackingcode'])->name('temporada.importPackingcode');

Route::get('edit/{exportacion}/{temporada}',[TemporadaController::class,'exportacionedit'])->name('exportacion.edit');

Route::get('edit/gasto/{gasto}/{temporada}',[TemporadaController::class,'gastoedit'])->name('gasto.edit');

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

Route::post('costos/fob/import',[TemporadaController::class,'importFob'])->name('temporada.importFob');

Route::post('costos/flete/import',[TemporadaController::class,'importFlete'])->name('temporada.importFlete');

Route::post('costos/embarque/import',[TemporadaController::class,'importEmbarque'])->name('temporada.importEmbarque');

Route::post('costos/gasto/import',[TemporadaController::class,'importGasto'])->name('temporada.importGasto');

Route::get('update/{temporada}',[TemporadaController::class,'variedadupdate'])->name('variedades.refresh');

Route::get('updatefob/{temporada}',[TemporadaController::class,'fobupdate'])->name('preciofob.refresh');

Route::get('createfob/{temporada}',[TemporadaController::class,'fobcreate'])->name('preciofob.create');

Route::get('download/razonsocial/{razonsocial}.pdf', [RazonController::class,'downloadpdf'])->name('informe.download');

Route::get('/fobsexport/{temporada}', [TemporadaController::class,'fobexport'])->name('fob.export');

Route::get('/docs', [HomeController::class,'documentacion'])->name('documentacion');

Route::get('/config', [HomeController::class,'configuracion'])->name('configuracion');

Route::resource('role', RoleController::class)->names('admin.roles');

Route::resource('costos', CostoController::class)->names('admin.costos');

Route::resource('costomenus', CostomenuController::class)->names('costomenus');

Route::get('temporada/{temporada}/costos/{costomenu}',[CostomenuController::class,'show'])->name('costomenus.temporada');

Route::resource('variedads', VariedadController::class)->names('admin.variedads');

Route::resource('especies', EspecieController::class)->names('admin.especies');

Route::resource('condicionproductors', CondicionproductorController::class)->names('admin.condicionproductors');

Route::resource('opcioncondicions', OpcioncondicionController::class)->names('admin.opcions');

Route::resource('categoria', CategoriaController::class)->names('admin.categorias');

Route::resource('users', UserController::class)->only(['index','edit','update','destroy'])->names('users');
