<?php

namespace App\Http\Controllers;

use App\Models\Balancemasa;
use App\Models\Balancemasados;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Exportacion;
use App\Models\Flete;
use App\Models\Fob;
use App\Models\Razonsocial;
use App\Models\Temporada;
use App\Models\Variedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class RazonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $razons=Razonsocial::all();
        return view('razonsocial.index',compact('razons'));
    }

    public function downloadpdf(Razonsocial $razonsocial) {

        return response()->file(storage_path('app/'.$razonsocial->informe));

      
    }

    
    public function razonsync(){
        $users= Http::post('https://apigarate.azurewebsites.net/api/v1.0/Productor/ObtenerProductor');

        $users = $users->json();
       
        foreach ($users as $user){
            $id=null;
            $nombre=null;
            $rut=null;
            $csg=null;
            $us=null;
            $predio=null;
            $comuna=null;
            $provincia=null;
            $direccion=null;
            
            $m=1;
            foreach ($user as $item){
                
                if($m==1){
                    $id=$item;
                }
                if($m==3){
                    $us=$item;
                }
                if($m==4){
                    $nombre=$item;
                }
                if($m==3){
                    $rut=$item;
                }
                if($m==2){
                    $csg=$item;
                }
                

                if($m==8){
                    $predio=$item;
                }
                if($m==10){
                    $comuna=$item;
                }
                if($m==12){
                    $provincia=$item;
                }
                if($m==9){
                    $direccion=$item;
                }
               
               
                if($m==14){
                    $cont=Razonsocial::where('csg',$csg)->first();
                    $search=['.','-'];
                    if($cont){
                         $cont->forceFill([
                            'name' => $nombre,
                            'csg' => $csg,
                            'rut' => $rut,
                           
                        ])->save();
                     
                    }else{
                        $user=Razonsocial::create([
                            'name' => $nombre,
                            'csg' => $csg,
                            'rut' => $rut,
                          
                        ]);
                       
                    }
                }
                $m+=1;
                
            } 
        }

     
        return redirect()->back();


        //return view('productors.index',compact('users'));
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
    public function show(Razonsocial $razonsocial,Temporada $temporada)
    {       
        $temporada=Temporada::find($temporada->id);
        $masas=Balancemasa::where('temporada_id',$temporada->id)->where('c_productor',$razonsocial->csg)->get();
       


        $masas2=Balancemasados::where('temporada_id',$temporada->id)->get();
        $fletes=Flete::where('temporada_id',$temporada->id)->get();
        $packings=CostoPacking::where('temporada_id',$temporada->id)->where('csg',$razonsocial->csg)->get();
        $comisions=Comision::where('temporada_id',$temporada->id)->where('productor',$razonsocial->name)->get();
        $unique_calibres = $masas->pluck('n_calibre')->unique()->sort();
        $unique_variedades = $masas->pluck('n_variedad')->unique()->sort();
        $variedades = Variedad::whereIn('name', $unique_variedades)->get();

        $unique_semanas = $masas->pluck('semana')->unique()->sort();
        $fobs = Fob::where('temporada_id',$temporada->id)->get();
        
        $exportacions=Exportacion::where('temporada_id',$temporada->id)->get();
        $fletestotal=Flete::all();

        return view('razonsocial.show',compact('fletestotal','exportacions','variedades','unique_semanas','fobs','unique_variedades','unique_calibres','razonsocial','temporada','masas','masas2','packings','comisions','fletes'));
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
