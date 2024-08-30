<?php

namespace App\Livewire;

use App\Models\Anticipo;
use App\Models\Balancemasa;
use App\Models\Balancemasados;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Detalle;
use App\Models\Embarque;
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
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TemporadaShow extends Component
{   use WithPagination;
    public $variedadpacking, $productorid, $familia,$unidad, $item, $descuenta, $categoria, $masaid, $gastoid, $gastocant, $fobid, $preciomasa , $preciofob , $temporada,$vista,$razonsocial,$type,$precio_usd, $etiqueta, $empresa, $exportacionedit_id, $valor, $ctd=25;
    public $sortBy = 'sub.csg_count'; // Columna por defecto para ordenar
    public $sortDirection = 'desc'; // Dirección por defecto (descendente)


    #[Url]
    public $filters=[
        'exportadora'=>'',
        'razonsocial'=>'',
        'especie'=>'',
        'variedad'=>'',
        'fromNumber'=>'',
        'toNumber'=>'',
        'fromDate'=>'',
        'toDate'=>'',
        'precioFob'=>'',
        'ncategoria'=>'',
        'exp'=>'',
        'mie'=>'',
        'mn'=>'',
        'desc'=>'',
        'calibre'=>'',
        'etiqueta'=>'',
        'etiquetas'=>'[]',
        'material'=>'',
        'mer'=>'',
        'mi'=>'',
        'semana'=>'',
        'norma'=>'',
    ];

    #[Url]

   

    public function mount(Temporada $temporada, $vista){
        $this->temporada=$temporada;
        $this->vista=$vista;
        
        $masastotal2=Balancemasa::where('temporada_id',$this->temporada->id)->where('exportadora','Greenex SpA')->get();
        $this->filters['etiquetas'] = $masastotal2->pluck('n_etiqueta')->unique()->sort()->values()->all();
        
    }

    public function checkEtiqueta($etiqueta)
    {
        if (($key = array_search($etiqueta, $this->filters['etiquetas'])) !== false) {
            unset($this->filters['etiquetas'][$key]);
        } else {
            $this->filters['etiquetas'][] = $etiqueta;
        }

        $this->filters['etiquetas'] = array_values($this->filters['etiquetas']); // reindexar el array
    }

    public function render()
    {   $resumes=Resumen::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $anticipos=Anticipo::filter($this->filters)->where('temporada_id',$this->temporada->id)->orderBy('grupo', 'desc')->paginate($this->ctd);
        $CostosPackings=CostoPacking::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        
        $procesosall=Proceso::where('temporada_id',$this->temporada->id)->get();

        $procesos=Proceso::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        
        $recepcionall=Recepcion::where('temporada_id',$this->temporada->id)->get();

        $recepcions=Recepcion::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        
        $CostosPackingsall=CostoPacking::where('temporada_id',$this->temporada->id)->get();
        
        $materiales=Material::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $embarques=Embarque::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $embarquestotal=Embarque::where('temporada_id',$this->temporada->id)->get();


        $materialestotal=Material::where('temporada_id',$this->temporada->id)->get();


        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->paginate($this->ctd);

        $fletes=Flete::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $fletestotal=Flete::where('temporada_id',$this->temporada->id)->get();
        
        $fobs=Fob::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $fobsall=Fob::filter($this->filters)->where('temporada_id',$this->temporada->id)->get();

        $masasbalances=Balancemasa::filter($this->filters)
            ->where('temporada_id', $this->temporada->id)
            ->where('exportadora','Greenex SpA')
            ->orderByDesc('updated_at') // Ordenar por precio_fob descendente
            ->paginate($this->ctd);

            
//        $masastotal=Recepcion::filter1($this->filters)->where('temporada_id',$this->temporada->id)->where('exportadora','Greenex SpA')->get();

        $masastotal=Recepcion::where('temporada_id',$this->temporada->id)->where('exportadora','Greenex SpA')->get();

        $unique_categoriasexp = $masastotal->pluck('n_categoria')->unique()->sort();

     

        $masastotalnacional=Balancemasa::filter2($this->filters)->where('temporada_id',$this->temporada->id)->where('exportadora','Greenex SpA')->get();
        
        $unique_categorianac = $masastotalnacional->pluck('n_categoria')->unique()->sort();

        $unique_productores = $masastotal->pluck('c_productor')->unique();

        
        $masastotal2=Balancemasa::where('temporada_id',$this->temporada->id)->where('exportadora','Greenex SpA')->get();
        $unique_etiquetas = $masastotal2->pluck('n_etiqueta')->unique()->sort();

        $unique_calibres = $masastotal2->pluck('n_calibre')->unique()->sort();       
        
        $unique_materiales = $masastotal2->pluck('c_embalaje')->unique()->sort();

        $unique_semanas = $masastotal2->pluck('semana')->unique()->sort();

        $unique_especies = $CostosPackingsall->pluck('especie')->unique()->sort();

        $unique_variedades = Variedad::where('temporada_id',$this->temporada->id)->get();

        $subQuery = Razonsocial::select('rut', \DB::raw('MAX(id) as id'), \DB::raw('COUNT(DISTINCT csg) as csg_count'))
            ->where('name', 'like', '%'.$this->filters['razonsocial'].'%')
            ->groupBy('rut');
            
        $subQuery->whereIn('csg', $unique_productores);
        
        $razons = Razonsocial::joinSub($subQuery, 'sub', function($join) {
                        $join->on('razonsocials.id', '=', 'sub.id');
                    })
                    ->select('razonsocials.*', 'sub.csg_count')
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->ctd);
                    
        
        $subQuery2 = Razonsocial::select('rut', \DB::raw('MAX(id) as id'))
                    ->groupBy('rut');
        
        $subQuery2->whereIn('csg', $unique_productores);
        
        $razonsall = Razonsocial::joinSub($subQuery2, 'sub', function($join) {
                        $join->on('razonsocials.id', '=', 'sub.id');
                    })
                    ->select('razonsocials.*')
                    ->get();

        $razonsallresult = Razonsocial::joinSub($subQuery, 'sub', function($join) {
                        $join->on('razonsocials.id', '=', 'sub.id');
                    })
                    ->select('razonsocials.*')
                    ->get();


        $comisions=Comision::all();

        $familias=Familia::where('status','active')->get();

        $detalles=Detalle::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);

       

        return view('livewire.temporada-show',compact('razonsallresult','unique_categorianac','unique_categoriasexp','procesosall','procesos','recepcionall','recepcions','detalles','unique_semanas','unique_materiales','unique_etiquetas','masastotalnacional','unique_calibres','familias','fobsall','embarques','embarquestotal','fletestotal','materialestotal','masastotal','fobs','anticipos','unique_especies','unique_variedades','resumes','CostosPackings','CostosPackingsall','materiales','exportacions','razons','comisions','fletes','masasbalances','razonsall'));
    }

    public function production_refresh()
    {
        $productions=Http::post('https://api.greenexweb.cl/api/ObtenerRecepcion');
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
                if($m==11){
                    $tipo_documento_recepcion=$item;
                }
                if($m==12){
                    $numero_documento_recepcion=$item;
                }
                if($m==13){
                    $n_especie=$item;

                }
                if($m==14){
                    $n_variedad=$item;
                }
                if($m==15){
                    $cantidad=$item;
                }
                if($m==16){
                    $peso_neto=$item;
                }
                if($m==17){
                    $nota_calidad=$item;
                }
               if($m==18){
                    $n_estado=$item;

                       
                    
                        $cont=Recepcion::where('id_g_recepcion',$id_g_recepcion)->where('temporada_id',$this->temporada->id)->first();
                        
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
                                'nota_calidad' => $nota_calidad
                                
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
                                    'temporada_id'=> $this->temporada->id
                                    
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

    public function recepcions_delete(){
        $recepcionall=Recepcion::where('temporada_id',$this->temporada->id)->get();
        foreach($recepcionall as $recepcion){
            $recepcion->delete();
        }

        $this->render();
    }

    public function getUsersProperty(){
        return  Razonsocial::filter($this->filters)->paginate(3);
    }

    public function set_productorid(Razonsocial $razonsocial){
        //$this->productorid=$razonsocial;
        $this->filters['razonsocial']=$razonsocial->csg;
    }

    public function set_gastoid($detalle_id){
        $this->gastoid=$detalle_id;
        $detalle=Detalle::find($detalle_id);
        $this->gastocant= $detalle->cantidad;
    }

    public function save_gastoid(){
        $detalle=Detalle::find($this->gastoid);
        $detalle->update(['cantidad'=>$this->gastocant]);    
        $this->reset(['gastocant','gastoid']);
        
    }

    public function redcolor_add(){
        $rules = [
            'variedadpacking'=>'required',
            ];
        $this->validate ($rules);

        $variedad=Variedad::find($this->variedadpacking);
        $variedad->red_color='True';
        $variedad->save();
        $this->reset('variedadpacking');
    }

    public function redcolor_destroy($id){
       
        $variedad=Variedad::find($id);
        $variedad->red_color=Null;
        $variedad->save();
    }

    public function set_view($vista){
        $this->vista=$vista;
    }

    public function gasto_store(){
        $rules = [
            'item'=>'required',
            'descuenta'=>'required'
            
            ];
      
        $this->validate ($rules);

        Gasto::create([
            'temporada_id'=>$this->temporada->id,
            'item'=>$this->item,
            'categoria'=>$this->categoria,
            'familia_id'=>$this->familia,
            'descuenta'=>$this->descuenta, 
            'unidad'=>$this->unidad
        ]);
        
        $this->reset(['item','categoria','familia','descuenta','unidad']);
        $this->temporada = Temporada::find($this->temporada->id);
    }

    public function set_masaid($masaid){
        $this->masaid=$masaid;
        $this->preciomasa=Balancemasa::find($masaid)->precio_fob;
    }

    public function save_masaid(){
        $masa=Balancemasa::find($this->masaid);
        $masa->update(['precio_fob'=>$this->preciomasa]);    
        $this->reset(['preciomasa','masaid']);
        
    }

    public function set_fobid($fobid){
        $this->fobid=$fobid;
        $this->preciofob=Fob::find($fobid)->fob_kilo_salida;
    }

    public function save_fobid(){
        $fob=Fob::find($this->fobid);
        $fob->update(['fob_kilo_salida'=>$this->preciofob]);    
        $this->reset(['preciofob','fobid']);
        
    }
    

    public function exportpdf(Razonsocial $razonsocial, Temporada $temporada){
        
        $masas=Balancemasa::where('temporada_id',$temporada->id)->where('c_productor',$razonsocial->csg)->get();
        $unique_variedades = $masas->pluck('n_variedad')->unique()->sort();

        $packings=CostoPacking::where('temporada_id',$temporada->id)->where('csg',$razonsocial->csg)->get();

        $comisions=Comision::where('temporada_id',$temporada->id)->where('productor',$razonsocial->name)->get();

        $anticipos=Anticipo::where('temporada_id',$temporada->id)->where('rut',$razonsocial->rut)->get();
        $detalles=Detalle::where('temporada_id',$temporada->id)->where('rut',$razonsocial->rut)->get();

        $unique_calibres = $masas->pluck('n_calibre')->unique()->sort();

        $unique_semanas = $masas->pluck('semana')->unique()->sort();
        $unique_categorias = $masas->pluck('n_categoria')->unique()->sort();
        $fobs = Fob::where('temporada_id',$temporada->id)->get();
        $gastos = Gasto::where('temporada_id',$temporada->id)->get();
        $exportacions=Exportacion::where('temporada_id',$temporada->id)->get();
        
        $materialestotal=Material::where('temporada_id',$temporada->id)->get();
        $fletestotal=Flete::where('temporada_id',$temporada->id)->get();
        

        $variedades = Variedad::whereIn('name', $unique_variedades)->get();
        $graficos=[];
        foreach ($variedades->reverse() as $variedad){
            $graficos[]='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://greenexweb.cl/grafico/'.$razonsocial->id.'/'.$temporada->id.'/'.$variedad->id.'.html&viewport=1400x600';
        }
        $pdf = Pdf::loadView('pdf.liquidacion', [   'razonsocial' => $razonsocial,
                                                    'masas' => $masas,
                                                    'packings'=>$packings,
                                                    'comisions'=>$comisions,
                                                    'unique_variedades'=>$unique_variedades,
                                                    'unique_calibres'=>$unique_calibres,
                                                    'unique_semanas'=>$unique_semanas,
                                                    'fobs'=>$fobs,
                                                    'graficos'=>$graficos,
                                                    'unique_categorias'=>$unique_categorias,
                                                    'anticipos'=>$anticipos,
                                                    'detalles'=>$detalles,
                                                    'gastos'=>$gastos,
                                                    'exportacions'=>$exportacions,
                                                    'materialestotal'=>$materialestotal,
                                                    'fletestotal'=>$fletestotal,
                                                    'temporada'=>$temporada]);

        $pdfContent = $pdf->output();
        $filename = 'Liquidacion '.$razonsocial->name.'.pdf';
                                                    
        Storage::put('pdf-liquidaciones/' . $filename, $pdfContent);

        $razonsocial->update([
            'informe'=>'pdf-liquidaciones/'.$filename
        ]);

        return $pdf->stream('Liq. '.$razonsocial->name.'.pdf');
        
    }

    public function set_exportacionedit_id($id){
        $this->exportacionedit_id=$id;
        
    }

    public function updatevariedades(){

       foreach($this->masastotal as $masa){
            $variedad=Variedad::where('name',$masa->n_variedad)->first();
            if ($variedad){

            }else{
                Variedad::create(['name'=>$masa->n_variedad]);
            }
       }
        
    }

    public function exportacion_destroy(Exportacion $exportacion){
        $exportacion->delete();
    }

    public function flete_destroy(Flete $flete){
        $flete->delete();
    }

    public function exportacion_store(){
        $rules = [
            'type'=>'required',
            'precio_usd'=>'required'
            
            ];
      
        $this->validate ($rules);

        Exportacion::create([
            'temporada_id'=>$this->temporada->id,
            'type'=>$this->type,
            'precio_usd'=>$this->precio_usd            
        ]);
        
        $this->reset(['type','precio_usd']);
        $this->temporada = Temporada::find($this->temporada->id);
    }

    public function flete_store(){
        $rules = [
            'etiqueta'=>'required',
            'empresa'=>'required',
            'valor'=>'required'
            
            ];
      
        $this->validate ($rules);

        Flete::create([
            'temporada_id'=>$this->temporada->id,
            'etiqueta'=>$this->etiqueta,
            'empresa'=>$this->empresa,
            'valor'=>$this->valor
        ]);
        
        $this->reset(['etiqueta','empresa','valor']);
        $this->temporada = Temporada::find($this->temporada->id);
    }
}
