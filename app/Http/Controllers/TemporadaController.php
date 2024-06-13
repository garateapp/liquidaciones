<?php

namespace App\Http\Controllers;

use App\Exports\FobExport;
use App\Imports\AnticipoImport;
use App\Imports\Balance2Import;
use App\Imports\Balance3Import;
use App\Imports\Balance4Import;
use App\Imports\BalanceImport;
use App\Imports\ComisionImport;
use App\Imports\EmbarqueImport;
use App\Imports\ExportacionImport;
use App\Imports\FleteImport;
use App\Imports\FobImport;
use App\Imports\GastoImport;
use App\Imports\MaterialImport;
use App\Imports\PackingImport;
use App\Imports\ResumenImport;
use App\Models\Anticipo;
use App\Models\Balancemasa;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Detalle;
use App\Models\Embarque;
use App\Models\Especie;
use App\Models\Exportacion;
use App\Models\Familia;
use App\Models\Flete;
use App\Models\Fob;
use App\Models\Gasto;
use App\Models\Material;
use App\Models\Proceso;
use App\Models\Razonsocial;
use App\Models\Recepcion;
use App\Models\Resumen;
use App\Models\Sync;
use App\Models\Temporada;
use App\Models\Variedad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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

    
    public function proceso_refresh(Temporada $temporada)
    {
        $procesos=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Produccion/ObtenerProduccionTemporadaPasadas?IdTemporadaPasada=9');
        $procesos = $procesos->json();

        $ri=Proceso::all();
        $totali=$ri->count();

        foreach ($procesos as $proceso){
            $agricola=Null;//1
            $n_proceso=Null;//2
            $especie=Null;//3
            $variedad=Null;//4
            $kilos_netos=Null;//5
            $categoria=Null;//6
            //7
            $id_empresa=Null;//8
            $c_productor=Null;
            
            $m=1;
            foreach ($proceso as $item){
                
                if($m==1){
                    $agricola=$item;
                }
                if($m==2){
                    $n_proceso=$item;
                }
                if($m==3){
                    $especie=$item;
                }
                if($m==4){
                    $variedad=$item;
                }
                if($m==5){
                    $fecha=$item;
                }
                if($m==6){
                    $kilos_netos=$item;
                }
                if($m==7){
                    $categoria=$item;
                }
                if($m==8){
                    $id_empresa=$item;
                }
                if($m==9){
                    $c_productor=$item;
                }
                
               if($m==9){

                        $cont=Proceso::where('n_proceso',$n_proceso)->where('temporada_id',$temporada->id)->first();
                        if($cont){
                            if($categoria=='Sin Procesar'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'kilos_netos' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                     'temporada_id' =>$temporada->id,//9,
                                     'c_productor'=>$c_productor
                                ])->save();
                            }elseif($categoria=='Exportacion'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'exp' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                     'temporada_id' =>$temporada->id,//9,
                                     'c_productor'=>$c_productor
                                ])->save();
                            }elseif($categoria=='Mercado Interno'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'comercial' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                     'temporada_id' =>$temporada->id,//9,
                                     'c_productor'=>$c_productor
                                ])->save();
                            }elseif($categoria=='Desecho'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'desecho' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                     'temporada_id' =>$temporada->id,//9,
                                     'c_productor'=>$c_productor
                                ])->save();
                            }
                            
                        }else{
                            

                                if($kilos_netos>0){
                                    if($categoria=='Sin Procesar'){
                                        $rec=Proceso::create([
                                            'agricola' => $agricola,//1
                                            'n_proceso' => $n_proceso,//2
                                            'especie' => $especie,//3
                                            'variedad' => $variedad,//4
                                            'fecha' => $fecha,//5
                                            'kilos_netos' => $kilos_netos,//6
                                            'exp' => 0,//6
                                            'comercial' => 0,//6
                                            'desecho' => 0,//6
                                            'merma' => 0,//6
                                            'id_empresa' => $id_empresa,//8
                                             'temporada_id' =>$temporada->id,//9,
                                             'c_productor'=>$c_productor
                                        ]);
                                    }elseif($categoria=='Exportacion'){
                                        $rec=Proceso::create([
                                            'agricola' => $agricola,//1
                                            'n_proceso' => $n_proceso,//2
                                            'especie' => $especie,//3
                                            'variedad' => $variedad,//4
                                            'fecha' => $fecha,//5
                                            'kilos_netos' => 0,//6
                                            'exp' => $kilos_netos,//6
                                            'comercial' => 0,//6
                                            'desecho' => 0,//6
                                            'merma' => 0,//6
                                            'id_empresa' => $id_empresa,//8
                                             'temporada_id' =>$temporada->id,//9,
                                             'c_productor'=>$c_productor
                                        ]);
                                    }elseif($categoria=='Mercado Interno'){
                                        $rec=Proceso::create([
                                            'agricola' => $agricola,//1
                                            'n_proceso' => $n_proceso,//2
                                            'especie' => $especie,//3
                                            'variedad' => $variedad,//4
                                            'fecha' => $fecha,//5
                                            'kilos_netos' => 0,//6
                                            'exp' => 0,
                                            'comercial' => $kilos_netos,//6
                                            'desecho' => 0,//6
                                            'merma' => 0,//6
                                            'id_empresa' => $id_empresa,//8
                                             'temporada_id' =>$temporada->id,//9,
                                             'c_productor'=>$c_productor
                                        ]);
                                    }elseif($categoria=='Desecho'){
                                            
                                            $rec=Proceso::create([
                                                'agricola' => $agricola,//1
                                                'n_proceso' => $n_proceso,//2
                                                'especie' => $especie,//3
                                                'variedad' => $variedad,//4
                                                'fecha' => $fecha,//5
                                                'kilos_netos' => 0,//6
                                                'exp' => 0,
                                                'comercial' => 0,//6
                                                'desecho' => $kilos_netos,//6
                                                'merma' => 0,//6
                                                'id_empresa' => $id_empresa,//8
                                                 'temporada_id' =>$temporada->id,//9,
                                                 'c_productor'=>$c_productor
                                            ]);
                                            
                                    }	
                                }
                          
                        }
                    
                }
                $m+=1;
                
            } 
        }

        
        $rf=Proceso::all();
        $total=$rf->count()-$ri->count();
        Sync::create([
            'tipo'=>'MANUAL',
            'entidad'=>'PROCESOS',
            'fecha'=>Carbon::now(),
            'cantidad'=>$total
        ]);

        return redirect()->back();
    }

    public function production_refresh(Temporada $temporada)
    {
        $productions=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Recepcion/ObtenerRecepcion');
        $productions = $productions->json();
        $ri=Recepcion::all();
        $totali=$ri->count();

        foreach ($productions as $production){
            $id_g_recepcion=Null;//1
            $tipo_g_recepcion=Null;//2
            $numero_g_recepcion=Null;//3
            $fecha_g_recepcion=Null;//4
            $id_emisor=Null;//5
            $r_emisor=Null;//6
            //7
            $n_emisor=Null;//8
            $Codigo_Sag_emisor=Null;//9
            $tipo_documento_recepcion=Null;//10
            $numero_documento_recepcion=Null;//11
            $n_especie=Null;//12
            $n_variedad=Null;//13
            $cantidad=Null;//14
            $peso_neto=Null;//15
            $nota_calidad=Null;//16
            $n_estado=Null;//17
         
            $m=1;
            foreach ($production as $item){
                
               

                if($m==2){
                    $id_g_recepcion=$item;
                }
                if($m==3){
                    $tipo_g_recepcion=$item;
                }
                if($m==4){
                    $numero_g_recepcion=$item;
                }
                if($m==5){
                    $fecha_g_recepcion=$item;
                }
                if($m==6){
                    $id_emisor=$item;
                }
                if($m==7){
                    $r_emisor=$item;
                }
                if($m==8){
                    $Codigo_Sag_emisor=$item;
                }
                if($m==9){
                    $n_emisor=$item;
                }
                if($m==10){
                    $tipo_documento_recepcion=$item;
                }
                if($m==11){
                    $numero_documento_recepcion=$item;
                }
                if($m==12){
                    $n_especie=$item;

                }
                if($m==13){
                    $n_variedad=$item;
                }
                if($m==14){
                    $cantidad=$item;
                }
                if($m==15){
                    $peso_neto=$item;
                }
                if($m==16){
                    $nota_calidad=$item;
                }
               if($m==17){
                    $n_estado=$item;

                        $espec=Especie::where('name',$n_especie)->first();
                        if($espec){
                            $espec->forceFill([
                                'name'=> $n_especie
                            ]);

                            
                            $varie=Variedad::where('name',$n_variedad)->first();
                            if($varie){
                                $varie->forceFill([
                                    'name'=> $n_variedad,
                                    'especie_id='=> $espec->id
                                ]);

                            }else{
                                $varie=Variedad::create([
                                    'name'=> $n_variedad,
                                    'especie_id'=>$espec->id
                                ]);

                            }

                           

                        }else{
                            $especie=Especie::create([
                            'name'=> $n_especie
                            ]);
                           
                            $varie=Variedad::where('name',$n_variedad)->first();
                            if($varie){
                                $varie->forceFill([
                                    'name'=> $n_variedad,
                                    'especie_id='=> $especie->id
                                ]);
                            }else{
                                $varie=Variedad::create([
                                    'name'=> $n_variedad,
                                    'especie_id'=>$especie->id
                                ]);
                            }

                         
                        }
                    
                        $cont=Recepcion::where('id_g_recepcion',$id_g_recepcion)->where('temporada_id',$temporada->id)->first();
                        
                        if($cont){
                            
                            $cont->forceFill([
                                'id_g_recepcion' => $id_g_recepcion,//1
                                'tipo_g_recepcion' => $tipo_g_recepcion,//2
                                'numero_g_recepcion' => $numero_g_recepcion,//3
                                'fecha_g_recepcion' => $fecha_g_recepcion,//4
                                'id_emisor' => $id_emisor,//5
                                'r_emisor' => $r_emisor,//6
                                'n_emisor' => $n_emisor,//8
                                'Codigo_Sag_emisor' => $Codigo_Sag_emisor,//9
                                'tipo_documento_recepcion' => $tipo_documento_recepcion,//10
                                'numero_documento_recepcion' => $numero_documento_recepcion,//11
                                'n_especie' => $n_especie,//12
                                'n_variedad' => $n_variedad,
                                'cantidad' => $cantidad,
                                'peso_neto' => $peso_neto,
                                'nota_calidad' => $nota_calidad,
                                'temporada_id'=>$temporada->id
                                
                            ])->save();
                          /*  if(IS_NULL($cont->calidad)){
                                Calidad::create([
                                    'recepcion_id'=>$cont->id
                                ]);
                            }*/
                            }
                        else{
                            
                                $rec=Recepcion::create([
                                    'id_g_recepcion' => $id_g_recepcion,//1
                                    'tipo_g_recepcion' => $tipo_g_recepcion,//2
                                    'numero_g_recepcion' => $numero_g_recepcion,//3
                                    'fecha_g_recepcion' => $fecha_g_recepcion,//4
                                    'id_emisor' => $id_emisor,//5
                                    'r_emisor' => $r_emisor,//6
                                    'n_emisor' => $n_emisor,//8
                                    'Codigo_Sag_emisor' => $Codigo_Sag_emisor,//9
                                    'tipo_documento_recepcion' => $tipo_documento_recepcion,//10
                                    'numero_documento_recepcion' => $numero_documento_recepcion,//11
                                    'n_especie' => $n_especie,//12
                                    'n_variedad' => $n_variedad,
                                    'cantidad' => $cantidad,
                                    'peso_neto' => $peso_neto,
                                    'nota_calidad' => $nota_calidad,
                                    'n_estado' => $n_estado,
                                    'temporada_id'=>$temporada->id
                                    
                                ]);
                             
                            
                        }
                    
                }
                $m+=1;
                
            } 
        }

        
        $rf=Recepcion::all();
        $total=$rf->count()-$ri->count();
        Sync::create([
            'tipo'=>'MANUAL',
            'entidad'=>'RECEPCIONES',
            'fecha'=>Carbon::now(),
            'cantidad'=>$total
        ]);

        return redirect()->back();
    }

    public function fobexport(Temporada $temporada)
    {   
        return FacadesExcel::download(new FobExport($temporada->id),'Fobs.xlsx');
    }

    public function graficogenerate(Razonsocial $razonsocial, Temporada $temporada, Variedad $variedad)
    {   
        $masas=Balancemasa::where('temporada_id',$temporada->id)->where('c_productor',$razonsocial->csg)->get();
        $unique_variedades = $masas->pluck('n_variedad')->unique()->sort();
        $fobs = Fob::where('temporada_id',$temporada->id)->get();
        $unique_calibres = $masas->pluck('n_calibre')->unique()->sort();

        $unique_variedades = $masas->where('n_variedad', $variedad->name)->pluck('n_variedad')->unique()->sort();

        return view('grafico.variedad',compact('unique_calibres','unique_variedades','razonsocial','temporada','variedad','unique_variedades','masas','fobs'));
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
    {   $resumes=Resumen::where('temporada_id',$temporada->id)->get();
        $CostosPackings=CostoPacking::where('temporada_id',$temporada->id)->get();

        $masitas=Balancemasa::where('temporada_id',$temporada->id)->paginate(3);
        if ($masitas->count()>0) {
            return view('temporadas.show',compact('temporada','resumes','CostosPackings'));
        } else {
            return view('temporadas.balancemasa',compact('temporada','masitas'));
        }
    }

    public function nacional(Temporada $temporada)
    {   $resumes=Resumen::where('temporada_id',$temporada->id)->get();
        $CostosPackings=CostoPacking::where('temporada_id',$temporada->id)->get();

        $masitas=Balancemasa::where('temporada_id',$temporada->id)->paginate(3);
        if ($masitas->count()>0) {
            return view('temporadas.shownacional',compact('temporada','resumes','CostosPackings'));
        } else {
            return view('temporadas.balancemasa',compact('temporada','masitas'));
        }
    }

    public function resume(Temporada $temporada)
    {   $resumes=Resumen::where('temporada_id',$temporada->id)->get();
        return view('temporadas.resume',compact('temporada','resumes'));
    }

    public function comision(Temporada $temporada)
    {   $comisions=Comision::where('temporada_id',$temporada->id)->get();
        return view('temporadas.comision',compact('temporada','comisions'));
    }

    public function materiales(Temporada $temporada)
    {   $materiales=Material::where('temporada_id',$temporada->id)->paginate(5);
         return view('temporadas.materiales',compact('temporada','materiales'));
    }

    public function packing(Temporada $temporada)
    {   $resumes=Resumen::where('temporada_id',$temporada->id)->get();
        $CostosPackings=CostoPacking::where('temporada_id',$temporada->id)->get();
        return view('temporadas.packing',compact('temporada','CostosPackings','resumes'));
    }

    public function exportacion(Temporada $temporada)
    {   $exportacions= Exportacion::where('temporada_id',$temporada->id)->get();
        return view('temporadas.exportacion',compact('temporada','exportacions'));
    }
    public function flete(Temporada $temporada)
    {   $fletes=Flete::where('temporada_id',$temporada->id)->get();
        return view('temporadas.flete',compact('temporada','fletes'));
    }

    public function balancemasa(Temporada $temporada)
    {  
        $masitas=Balancemasa::where('temporada_id',$temporada->id)->paginate(3);

        return view('temporadas.balancemasa',compact('temporada','masitas'));
    }

    public function fob(Temporada $temporada)
    {  
        $fob=Fob::where('temporada_id',$temporada->id)->paginate(3);

        return view('temporadas.fob',compact('temporada','fob'));
    }

    public function recepcion(Temporada $temporada)
    {  
        return view('temporadas.recepcion',compact('temporada'));
    }

    public function procesos(Temporada $temporada)
    {  
        return view('temporadas.procesos',compact('temporada'));
    }

    public function otrosgastos(Temporada $temporada)
    {  
        $otrosgastos=Balancemasa::where('temporada_id',$temporada->id)->paginate(3);

        return view('temporadas.otrosgastos',compact('temporada','otrosgastos'));
    }

    public function finanzas(Temporada $temporada)
    {  
        $finanzas=Balancemasa::where('temporada_id',$temporada->id)->paginate(3);

        return view('temporadas.finanzas',compact('temporada','finanzas'));
    }
    
    public function anticipos(Temporada $temporada)
    {  
        $anticipos=Anticipo::where('temporada_id',$temporada->id)->paginate(3);

        return view('temporadas.anticipos',compact('temporada','anticipos'));
    }

    public function gastos(Temporada $temporada)
    {  
        $gastos=Gasto::where('temporada_id',$temporada->id)->paginate(3);

        return view('temporadas.gastos',compact('temporada','gastos'));
    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Temporada $temporada)
    {
        return view('temporadas.edit',compact('temporada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Temporada $temporada)
    {
        $temporada->update($request->all());

        return redirect()->route('dashboard')->with('info','Temporada actualizada con éxito.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Temporada $temporada)
    {
        $temporada->delete();
        return redirect()->back();
    }
    

    public function importdata(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        FacadesExcel::import(new ResumenImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);
        return redirect()->route('temporada.resume',$temporada)->with('info','Importación realizada con exito');
    }

    public function importCostosPacking(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $masas=CostoPacking::where('temporada_id',$request->temporada)->get();
        
        foreach ($masas as $masa){
            $masa->delete();
        }

        FacadesExcel::import(new PackingImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.packing',$temporada)->with('info','Importación realizada con exito');
    }

    public function importMateriales(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $masas=Material::where('temporada_id',$request->temporada)->get();
        
        foreach ($masas as $masa){
            $masa->delete();
        }

        FacadesExcel::import(new MaterialImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.materiales',$temporada)->with('info','Importación realizada con exito');
    }
    public function exportacionedit(Exportacion $exportacion,Temporada $temporada)
    {   
        return view('exportacion.edit',compact('exportacion','temporada'));
    }

    public function gastoedit(Gasto $gasto,Temporada $temporada)
    {   $familias=Familia::pluck('name','id');
        return view('gastos.edit',compact('gasto','temporada','familias'));
    }

    public function exportacionupdate(Request $request,Exportacion $exportacion)
    {   
        $exportacion->update($request->all());
        return redirect(route('temporada.exportacion',$exportacion->temporada)."/#informacion");

    }

    public function fleteedit(Flete $flete,Temporada $temporada)
    {   
        return view('flete.edit',compact('flete','temporada'));
    }

    public function fleteupdate(Request $request,Flete $flete)
    {   
        $flete->update($request->all());
        return redirect(route('temporada.flete',$flete->temporada)."/#informacion");

    }

    public function comisionedit(Comision $comision,Temporada $temporada)
    {   
        return view('comision.edit',compact('comision','temporada'));
    }

    public function variedadupdate(Temporada $temporada)
    {   $masas=Balancemasa::where('temporada_id',$temporada->id)->get();
        foreach($masas as $masa){
            $variedad=Variedad::where('name',$masa->n_variedad)->where('temporada_id',$temporada->id)->first();
            if ($variedad){

            }else{
                Variedad::create(['name'=>$masa->n_variedad,
                                'temporada_id'=>$temporada->id]);
            }
       }
        return redirect()->back();
    }

    public function fobupdate(Temporada $temporada)
    {   $masascat1=Balancemasa::where('temporada_id',$temporada->id)->where('n_categoria','Cat 1')->where('exportadora','Greenex SpA')->whereNull('precio_fob')->paginate(5000);
        $masascati=Balancemasa::where('temporada_id',$temporada->id)->where('n_categoria','Cat I')->where('exportadora','Greenex SpA')->whereNull('precio_fob')->paginate(5000);
        $fobscat1=Fob::where('temporada_id',$temporada->id)->where('categoria','CAT1')->get();
        $fobscati=Fob::where('temporada_id',$temporada->id)->where('categoria','CAT I')->get();
        $nro1=0;
        $nro2=0;
        $nro3=0;
        $cali=0;
        $col=0;
        $etiqueta=0;
        $categoria=0;
        $etiq=[];
        $suma=0;
        
        
            foreach($masascat1 as $masa){
                    if ($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='4J';
                        }
                        
                        

                        if ($masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='3J';
                        }
                    

                        if ($masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='2J';
                        }
                        if ($masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'){
                                $color='Dark';
                        
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='J';
                        }
                        if ($masa->n_calibre=='JD' || $masa->n_calibre=='JDD'){
                                $color='Dark';
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='XL';
                        }
                    if ($masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    $nro2+=1; 

                    
                    foreach ($fobscat1 as $fob){
                            if ((str_replace(' ', '', $fob->n_variedad)==str_replace(' ', '', $masa->n_variedad)) && $fob->semana==$masa->semana && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->n_calibre))==preg_replace('/[\.\-\s]+/', '', strtolower($calibre))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->etiqueta))==preg_replace('/[\.\-\s]+/', '', strtolower($masa->n_etiqueta))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->color))==preg_replace('/[\.\-\s]+/', '', strtolower($color)))){
                            
                                if($fob->fob_kilo_salida!='null'){
                                    $masa->update(['precio_fob'=>$fob->fob_kilo_salida]);
                                    $nro1+=1; 
                                    break;
                                }
                            }
                          
                    }
            }
        
            foreach($masascati as $masa){
                    if ($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='4J';
                        }
                        
                        

                        if ($masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'){
                            $color='Dark';
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='3J';
                        }
                    

                        if ($masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='2J';
                        }
                        if ($masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'){
                                $color='Dark';
                        
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='J';
                        }
                        if ($masa->n_calibre=='JD' || $masa->n_calibre=='JDD'){
                                $color='Dark';
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='XL';
                        }
                    if ($masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    $nro2+=1; 

                  

                    foreach ($fobscati as $fob){
                            if ((str_replace(' ', '', $fob->n_variedad)==str_replace(' ', '', $masa->n_variedad)) && $fob->semana==$masa->semana && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->n_calibre))==preg_replace('/[\.\-\s]+/', '', strtolower($calibre))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->etiqueta))==preg_replace('/[\.\-\s]+/', '', strtolower($masa->n_etiqueta))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->color))==preg_replace('/[\.\-\s]+/', '', strtolower($color)))){
                                if($fob->fob_kilo_salida!='null'){
                                    $masa->update(['precio_fob'=>$fob->fob_kilo_salida]);
                                    $nro1+=1; 
                                    break;
                                }
                            }
                          
                    }
            }
        
       // dd($etiq);
        return redirect()->back()->with('info',$nro1.'/'.$nro2.' Actualizados con Éxito.');
    }

    public function fobcreate(Temporada $temporada)
    {   $masascat1=Balancemasa::where('temporada_id',$temporada->id)->where('n_categoria','Cat 1')->whereNull('precio_fob')->paginate(5000);
        
        $fobscat1=Fob::where('temporada_id',$temporada->id)->where('categoria','CAT1')->get();
        $fobscati=Fob::where('temporada_id',$temporada->id)->where('categoria','CAT I')->get();

        $nro1=0;
        $nro2=0;
        $nro3=0;
        $cali=0;
        $col=0;
        $etiqueta=0;
        $categoria=0;
        $etiq=[];
        $suma=0;
        
        
            foreach($masascat1 as $masa){
                $color=null;
                $calibre=null;
                    if ($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='4J';
                        }
                        
                        

                        if ($masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'){
                            $color='Dark';
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='3J';
                        }
                    

                        if ($masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='2J';
                        }
                        if ($masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'){
                                $color='Dark';
                        
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='J';
                        }
                        if ($masa->n_calibre=='JD' || $masa->n_calibre=='JDD'){
                                $color='Dark';
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='XL';
                        }
                        if ($masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'){
                            $color='Dark';
                        }else{
                            $color='Light';
                        }
                    }
                    $nro2+=1; 

                    /*
                    if($masa->id==71991){
                        $etiq[]=$masa->n_calibre.'-'.$color.'-'.$masa->semana.'-E.MASA'.$masa->n_etiqueta;
                    }*/
                    if($color && $calibre){
                        foreach ($fobscat1 as $fob){
                                if ((str_replace(' ', '', $fob->n_variedad)==str_replace(' ', '', $masa->n_variedad)) && $fob->semana==$masa->semana && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->n_calibre))==preg_replace('/[\.\-\s]+/', '', strtolower($calibre))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->etiqueta))==preg_replace('/[\.\-\s]+/', '', strtolower($masa->n_etiqueta))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->color))==preg_replace('/[\.\-\s]+/', '', strtolower($color))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->categoria))==preg_replace('/[\.\-\s]+/', '', strtolower($masa->n_categoria)))){
                                
                                }else{

                                    $test=Fob::where('temporada_id',$masa->temporada_id)->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana)->where('etiqueta',$masa->n_etiqueta)->where('n_calibre',$calibre)->where('color',$color)->where('categoria',$masa->n_categoria)->first();
                                    if ($test) {
                                    
                                    } else {
                                        Fob::create([ 
                                            'temporada_id'=>$masa->temporada_id,
                        
                                            'n_variedad'=> $masa->n_variedad,
                                            'semana'=> $masa->semana,
                                            'etiqueta'=> $masa->n_etiqueta,
                                            'n_calibre'=> $calibre,
                                            'color'=> $color,
                                            'categoria'=> $masa->n_categoria,
                                            'fob_kilo_salida'=> 'null'
                                        
                                        ]);
                                        $nro3+=1;
                                        break;
                                    }

                                }
                        }
                    }
            }

        $masascati=Balancemasa::where('temporada_id',$temporada->id)->where('n_categoria','Cat I')->whereNull('precio_fob')->paginate(5000);
            foreach($masascati as $masa){
                $color=null;
                $calibre=null;
                    if ($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='4J';
                        }
                        
                        

                        if ($masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='3J';
                        }
                    

                        if ($masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='2J';
                        }
                        if ($masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'){
                                $color='Dark';
                        
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='J';
                        }
                        if ($masa->n_calibre=='JD' || $masa->n_calibre=='JDD'){
                                $color='Dark';
                        }else{
                            $color='Light';
                        }
                    }
                    if ($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'){
                        if ($masa->n_etiqueta=='Alsu') {
                            $calibre=$masa->n_calibre;
                        } else {
                            $calibre='XL';
                        }
                        if ($masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'){
                            $color='Dark';
                        }else{
                        $color='Light';
                        }
                    }
                    $nro2+=1; 

                    /*
                    if($masa->id==71991){
                        $etiq[]=$masa->n_calibre.'-'.$color.'-'.$masa->semana.'-E.MASA'.$masa->n_etiqueta;
                    }*/
                    if($color && $calibre){
                        foreach ($fobscati as $fob){
                                if ((str_replace(' ', '', $fob->n_variedad)==str_replace(' ', '', $masa->n_variedad)) && $fob->semana==$masa->semana && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->n_calibre))==preg_replace('/[\.\-\s]+/', '', strtolower($calibre))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->etiqueta))==preg_replace('/[\.\-\s]+/', '', strtolower($masa->n_etiqueta))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->color))==preg_replace('/[\.\-\s]+/', '', strtolower($color))) && (preg_replace('/[\.\-\s]+/', '', strtolower($fob->categoria))==preg_replace('/[\.\-\s]+/', '', strtolower($masa->n_categoria)))){
                                }else{
                                    $test=Fob::where('temporada_id',$masa->temporada_id)->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana)->where('etiqueta',$masa->n_etiqueta)->where('n_calibre',$calibre)->where('color',$color)->where('categoria',$masa->n_categoria)->first();
                                    if ($test) {
                                    
                                    } else {
                                        Fob::create([ 
                                            'temporada_id'=>$masa->temporada_id,
                        
                                            'n_variedad'=> $masa->n_variedad,
                                            'semana'=> $masa->semana,
                                            'etiqueta'=> $masa->n_etiqueta,
                                            'n_calibre'=> $calibre,
                                            'color'=> $color,
                                            'categoria'=> $masa->n_categoria,
                                            'fob_kilo_salida'=> 'null'
                                        
                                        ]);
                                        $nro3+=1;
                                        break;
                                    }
                                }
                        }
                    }
            }
        
       // dd($etiq);
        return redirect()->back()->with('info',$nro3.' fobs creados con Éxito.');
    }

    public function comisionupdate(Request $request,Comision $comision)
    {   
        $comision->update($request->all());
        return redirect(route('temporada.comision',$comision->temporada)."/#informacion");

    }

    public function importExportacion(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        FacadesExcel::import(new ExportacionImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.exportacion',$temporada)->with('info','Importación realizada con exito');
    }

    public function importComision(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        FacadesExcel::import(new ComisionImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.comision',$temporada)->with('info','Importación realizada con exito');
    }

    public function importBalance(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $masas=Balancemasa::where('temporada_id',$request->temporada)->get();

        foreach ($masas as $masa){
            $masa->delete();
        }


        FacadesExcel::import(new BalanceImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.balancemasa',$temporada)->with('info','Importación realizada con exito');
    }

    public function importAnticipo(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $masas=Anticipo::where('temporada_id',$request->temporada)->get();

        foreach ($masas as $masa){
            $masa->delete();
        }

        FacadesExcel::import(new AnticipoImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.anticipos',$temporada)->with('info','Importación realizada con exito');
    }

    
    public function importFob(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $masas=Fob::where('temporada_id',$request->temporada)->get();

        foreach ($masas as $masa){
            $masa->delete();
        }

        FacadesExcel::import(new FobImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.fob',$temporada)->with('info','Importación realizada con exito');
    }

    public function importFlete(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $masas=Flete::where('temporada_id',$request->temporada)->get();

        foreach ($masas as $masa){
            $masa->delete();
        }

        FacadesExcel::import(new FleteImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.flete',$temporada)->with('info','Importación realizada con exito');
    }

    public function importEmbarque(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $masas=Embarque::where('temporada_id',$request->temporada)->get();

        foreach ($masas as $masa){
            $masa->delete();
        }

        FacadesExcel::import(new EmbarqueImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.exportacion',$temporada)->with('info','Importación realizada con exito');
    }

    public function importGasto(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $masas=Detalle::where('temporada_id',$request->temporada)->get();

        foreach ($masas as $masa){
            $masa->delete();
        }

        FacadesExcel::import(new GastoImport($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.gastos',$temporada)->with('info','Importación realizada con exito');
    }

    public function importBalance2(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        FacadesExcel::import(new Balance2Import($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.balancemasa',$temporada)->with('info','Importación realizada con exito');
    }

    public function importBalance3(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        FacadesExcel::import(new Balance3Import($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.balancemasa',$temporada)->with('info','Importación realizada con exito');
    }

    public function importBalance4(Request $request)
    {    $request->validate([
            'file'=>'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        FacadesExcel::import(new Balance4Import($request->temporada),$file);

        $temporada=Temporada::find($request->temporada);

        return redirect()->route('temporada.balancemasa',$temporada)->with('info','Importación realizada con exito');
    }

}
