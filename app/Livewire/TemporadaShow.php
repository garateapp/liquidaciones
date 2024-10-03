<?php

namespace App\Livewire;

use App\Models\Anticipo;
use App\Models\Balancemasa;
use App\Models\Balancemasados;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Despacho;
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
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TemporadaShow extends Component
{   use WithPagination;
    public $fechai, $fechaf, $first_recepcion, $last_recepcion, $variedadpacking, $productorid, $familia,$unidad, $item, $descuenta, $categoria, $masaid, $gastoid, $gastocant, $fobid, $preciomasa , $preciofob , $temporada,$vista,$razonsocial,$type,$precio_usd, $etiqueta, $empresa, $exportacionedit_id, $valor, $ctd=25;
    public $sortBy = 'sub.csg_count'; // Columna por defecto para ordenar
    public $sortByProc = 'id'; // Columna por defecto para ordenar
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
        'p_unicos'=>true,
        'p_repetidos'=>true
    ];

    #[Url]

   

    public function mount(Temporada $temporada, $vista){
        $this->temporada=$temporada;
        $this->vista=$vista;
        
        $masastotal2=Balancemasa::where('temporada_id',$this->temporada->id)->where('exportadora','Greenex SpA')->get();
        $this->filters['etiquetas'] = $masastotal2->pluck('n_etiqueta')->unique()->sort()->values()->all();

        if ($temporada->recepcion_start) {
            $this->fechai = $temporada->recepcion_start;
        } else {
            $this->fechai = Carbon::now()->startOfYear()->format('Y-m-d');
        }
         
        if ($temporada->recepcion_start) {
            $this->fechaf = $temporada->recepcion_end;
        }else{
            $this->fechaf = Carbon::now()->format('Y-m-d');
        }
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
        
        $procesosall=Proceso::filter($this->filters)->where('temporada_id',$this->temporada->id)->get();

        $procesos=Proceso::filter($this->filters)->where('temporada_id',$this->temporada->id)->orderBy($this->sortByProc, $this->sortDirection)->paginate($this->ctd);

        $despachosall=Despacho::filter($this->filters)->where('temporada_id',$this->temporada->id)->get();

        $despachos=Despacho::filter($this->filters)->where('temporada_id',$this->temporada->id)->orderBy($this->sortByProc, $this->sortDirection)->paginate($this->ctd);
        
        $embarquesall=Embarque::filter($this->filters)->where('temporada_id',$this->temporada->id)->get();

        $embarques=Embarque::filter($this->filters)->where('temporada_id',$this->temporada->id)->orderBy($this->sortByProc, $this->sortDirection)->paginate($this->ctd);
        

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

        $masastotal=Recepcion::where('temporada_id',$this->temporada->id)->get();

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

       

        return view('livewire.temporada-show',compact('embarquesall','embarques','despachos','despachosall','razonsallresult','unique_categorianac','unique_categoriasexp','procesosall','procesos','recepcionall','recepcions','detalles','unique_semanas','unique_materiales','unique_etiquetas','masastotalnacional','unique_calibres','familias','fobsall','embarques','embarquestotal','fletestotal','materialestotal','masastotal','fobs','anticipos','unique_especies','unique_variedades','resumes','CostosPackings','CostosPackingsall','materiales','exportacions','razons','comisions','fletes','masasbalances','razonsall'));
    }

    public function production_refresh()
    {    $ri=Recepcion::all();
        $totali=$ri->count();

        $dateRanges = [];
        $start = new DateTime($this->fechai);
        $end = new DateTime($this->fechaf);
        $intervalDays=10;
        
        while ($start <= $end) {
            $rangeEnd = (clone $start)->modify("+{$intervalDays} days");
            if ($rangeEnd > $end) {
                $rangeEnd = $end;
            }
            $dateRanges[] = [
                'start' => $start->format('Y-m-d'),
                'end' => $rangeEnd->format('Y-m-d')
            ];
            $start = (clone $rangeEnd)->modify("+1 day");
        }

        foreach($dateRanges as $date){

            if ($this->temporada->exportadora_id) {
                $productions = Http::post("https://api.greenexweb.cl/api/receptions?filter[fecha_g_recepcion][gte]=".$date['start']."&filter[fecha_g_recepcion][lte]=".$date['end']."&select=c_empresa,tipo_g_recepcion,numero_g_recepcion,fecha_g_recepcion,n_transportista,id_exportadora,folio,fecha_cosecha,n_grupo,r_productor,c_productor,id_especie,n_especie,id_variedad,c_envase,c_categoria,t_categoria,c_calibre,c_serie,cantidad,peso_neto,destruccion_tipo,creacion_tipo,Notas,n_estado,N_tratamiento,n_tipo_cobro,N_productor_rotulado,CSG_productor_rotulado,destruccion_id&filter[n_especie][eq]=".$this->temporada->especie->name."&filter[id_exportadora][eq]=".$this->temporada->exportadora_id);
            } else {
                $productions = Http::post("https://api.greenexweb.cl/api/receptions?filter[fecha_g_recepcion][gte]=".$date['start']."&filter[fecha_g_recepcion][lte]=".$date['end']."&select=c_empresa,tipo_g_recepcion,numero_g_recepcion,fecha_g_recepcion,n_transportista,id_exportadora,folio,fecha_cosecha,n_grupo,r_productor,c_productor,id_especie,n_especie,id_variedad,c_envase,c_categoria,t_categoria,c_calibre,c_serie,cantidad,peso_neto,destruccion_tipo,creacion_tipo,Notas,n_estado,N_tratamiento,n_tipo_cobro,N_productor_rotulado,CSG_productor_rotulado,destruccion_id&filter[n_especie][eq]=".$this->temporada->especie->name."&filter[id_exportadora][eq]=22");
            }
            
           
            $productions = $productions->json(); 

            if(!IS_NULL($productions)){
                foreach ($productions as $production) {
                    $c_empresa = $production['c_empresa'] ?? null;
                    $tipo_g_recepcion = $production['tipo_g_recepcion'] ?? null;
                    $numero_g_recepcion = $production['numero_g_recepcion'] ?? null;
                    $fecha_g_recepcion = $production['fecha_g_recepcion'] ?? null;
                    $n_transportista = $production['n_transportista'] ?? null;
                    $id_exportadora = $production['id_exportadora'] ?? null;
                    $folio = $production['folio'] ?? null;
                    $fecha_cosecha = $production['fecha_cosecha'] ?? null;
                    $n_grupo = $production['n_grupo'] ?? null;
                    $r_productor = $production['r_productor'] ?? null;
                    $c_productor = $production['c_productor'] ?? null;
                    $id_especie = $production['id_especie'] ?? null;
                    $n_especie = $production['n_especie'] ?? null;
                    $id_variedad = $production['id_variedad'] ?? null;
                    $c_envase = $production['c_envase'] ?? null;
                    $c_categoria = $production['c_categoria'] ?? null;
                    $t_categoria = $production['t_categoria'] ?? null;
                    $c_calibre = $production['c_calibre'] ?? null;
                    $c_serie = $production['c_serie'] ?? null;
                    $cantidad = $production['cantidad'] ?? null;
                    $peso_neto = $production['peso_neto'] ?? null;
                    $destruccion_tipo = $production['destruccion_tipo'] ?? null;
                    $creacion_tipo = $production['creacion_tipo'] ?? null;
                    $Notas = $production['Notas'] ?? null;
                    $n_estado = $production['n_estado'] ?? null;
                    $N_tratamiento = $production['N_tratamiento'] ?? null;
                    $n_tipo_cobro = $production['n_tipo_cobro'] ?? null;
                    $N_productor_rotulado = $production['N_productor_rotulado'] ?? null;
                    $CSG_productor_rotulado = $production['CSG_productor_rotulado'] ?? null;
                    $destruccion_id = $production['destruccion_id'] ?? null;
                
                    $cont = Recepcion::where('numero_g_recepcion', $numero_g_recepcion)
                        ->where('temporada_id', $this->temporada->id)
                        ->where('folio', $folio)
                        ->first();
                
                    if ($cont) {
                        $cont->forceFill([
                            'c_empresa' => $c_empresa,
                            'tipo_g_recepcion' => $tipo_g_recepcion,
                            'numero_g_recepcion' => $numero_g_recepcion,
                            'fecha_g_recepcion' => $fecha_g_recepcion,
                            'n_transportista' => $n_transportista,
                            'id_exportadora' => $id_exportadora,
                            'folio' => $folio,
                            'fecha_cosecha' => $fecha_cosecha,
                            'n_grupo' => $n_grupo,
                            'r_productor' => $r_productor,
                            'c_productor' => $c_productor,
                            'id_especie' => $id_especie,
                            'n_especie' => $n_especie,
                            'id_variedad' => $id_variedad,
                            'c_envase' => $c_envase,
                            'c_categoria' => $c_categoria,
                            't_categoria' => $t_categoria,
                            'c_calibre' => $c_calibre,
                            'c_serie' => $c_serie,
                            'cantidad' => $cantidad,
                            'peso_neto' => $peso_neto,
                            'destruccion_tipo' => $destruccion_tipo,
                            'creacion_tipo' => $creacion_tipo,
                            'Notas' => $Notas,
                            'n_estado' => $n_estado,
                            'N_tratamiento' => $N_tratamiento,
                            'n_tipo_cobro' => $n_tipo_cobro,
                            'N_productor_rotulado' => $N_productor_rotulado,
                            'CSG_productor_rotulado' => $CSG_productor_rotulado,
                            'destruccion_id' => $destruccion_id,
                        ])->save();
                    } else {
                        Recepcion::create([
                            'c_empresa' => $c_empresa,
                            'tipo_g_recepcion' => $tipo_g_recepcion,
                            'numero_g_recepcion' => $numero_g_recepcion,
                            'fecha_g_recepcion' => $fecha_g_recepcion,
                            'n_transportista' => $n_transportista,
                            'id_exportadora' => $id_exportadora,
                            'folio' => $folio,
                            'fecha_cosecha' => $fecha_cosecha,
                            'n_grupo' => $n_grupo,
                            'r_productor' => $r_productor,
                            'c_productor' => $c_productor,
                            'id_especie' => $id_especie,
                            'n_especie' => $n_especie,
                            'id_variedad' => $id_variedad,
                            'c_envase' => $c_envase,
                            'c_categoria' => $c_categoria,
                            't_categoria' => $t_categoria,
                            'c_calibre' => $c_calibre,
                            'c_serie' => $c_serie,
                            'cantidad' => $cantidad,
                            'peso_neto' => $peso_neto,
                            'destruccion_tipo' => $destruccion_tipo,
                            'creacion_tipo' => $creacion_tipo,
                            'Notas' => $Notas,
                            'n_estado' => $n_estado,
                            'N_tratamiento' => $N_tratamiento,
                            'n_tipo_cobro' => $n_tipo_cobro,
                            'N_productor_rotulado' => $N_productor_rotulado,
                            'CSG_productor_rotulado' => $CSG_productor_rotulado,
                            'destruccion_id' => $destruccion_id,
                            'temporada_id' => $this->temporada->id,
                        ]);
                    }
                }
            }
        }

        $this->temporada->update([  'recepcion_start'=>$this->fechai,
                                    'recepcion_end'=>$this->fechaf]);
        
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

    public function procesos_refresh()
    {    $ri=Proceso::all();
        $totali=$ri->count();

        $dateRanges = [];

        if($totali>0){
            $ultimo = Proceso::orderBy('fecha_g_produccion', 'desc')->first();
            $start = new DateTime($ultimo->fecha_g_produccion); // Usa la fecha más reciente
        }else{
            $start = new DateTime($this->fechai);
        }

        $end = new DateTime($this->fechaf);
        $intervalDays=10;

        while ($start <= $end) {
            $rangeEnd = (clone $start)->modify("+{$intervalDays} days");
            if ($rangeEnd > $end) {
                $rangeEnd = $end;
            }
            $dateRanges[] = [
                'start' => $start->format('Y-m-d'),
                'end' => $rangeEnd->format('Y-m-d')
            ];
            $start = (clone $rangeEnd)->modify("+1 day");
        }

   
      
        foreach($dateRanges as $date){

            if ($this->temporada->exportadora_id) {
                $productions = Http::timeout(60) // Aumenta el tiempo de espera a 60 segundos
                    ->retry(3, 1000) // Reintenta hasta 3 veces, con 1 segundo de espera entre intentos
                    ->post("https://api.greenexweb.cl/api/productions", [
                        'filter' => [
                            'fecha_g_produccion' => [
                                'gte' => $date['start'],
                                'lte' => $date['end'],
                            ],
                            'n_especie' => ['eq' => $this->temporada->especie->name],
                            'id_exportadora' => ['eq' => $this->temporada->exportadora_id],
                        ],
                        'select' => 'tipo_g_produccion, numero_g_produccion, fecha_g_produccion, fecha_produccion, tipo, id_productor_proceso, n_productor_proceso, c_productor, n_productor, t_categoria, c_categoria, c_embalaje, c_calibre, c_serie, c_etiqueta, cantidad, peso_neto, id_empresa, fecha_recepcion, folio, id_exportadora, id_especie, id_variedad, id_linea_proceso, numero_guia_recepcion, id_embalaje, n_tipo_proceso, n_variedad_rotulacion, peso_std_embalaje, peso_standard, creacion_tipo, notas, Estado, destruccion_tipo, n_especie'
                    ]);
            } else {
                $productions = Http::timeout(60) // Aumenta el tiempo de espera a 60 segundos
                    ->retry(3, 1000) // Reintenta hasta 3 veces, con 1 segundo de espera entre intentos
                    ->post("https://api.greenexweb.cl/api/productions", [
                        'filter' => [
                            'fecha_g_produccion' => [
                                'gte' => $date['start'],
                                'lte' => $date['end'],
                            ],
                            'n_especie' => ['eq' => $this->temporada->especie->name],
                            'id_exportadora' => ['eq' => 22],
                        ],
                        'select' => 'tipo_g_produccion, numero_g_produccion, fecha_g_produccion, fecha_produccion, tipo, id_productor_proceso, n_productor_proceso, c_productor, n_productor, t_categoria, c_categoria, c_embalaje, c_calibre, c_serie, c_etiqueta, cantidad, peso_neto, id_empresa, fecha_recepcion, folio, id_exportadora, id_especie, id_variedad, id_linea_proceso, numero_guia_recepcion, id_embalaje, n_tipo_proceso, n_variedad_rotulacion, peso_std_embalaje, peso_standard, creacion_tipo, notas, Estado, destruccion_tipo, n_especie'
                    ]);
            }
            
            
           
            $productions = $productions->json(); 

            //    dd($productions);

            if (!IS_NULL($productions)) {
                foreach ($productions as $production) {
                    $tipo_g_produccion = $production['tipo_g_produccion'] ?? null;
                    $numero_g_produccion = $production['numero_g_produccion'] ?? null;
                    $fecha_g_produccion = $production['fecha_g_produccion'] ?? null;
                    $fecha_produccion = $production['fecha_produccion'] ?? null;
                    $tipo = $production['tipo'] ?? null;
                    $id_productor_proceso = $production['id_productor_proceso'] ?? null;
                    $n_productor_proceso = $production['n_productor_proceso'] ?? null;
                    $c_productor = $production['c_productor'] ?? null;
                    $n_productor = $production['n_productor'] ?? null;
                    $t_categoria = $production['t_categoria'] ?? null;
                    $c_categoria = $production['c_categoria'] ?? null;
                    $c_embalaje = $production['c_embalaje'] ?? null;
                    $c_calibre = $production['c_calibre'] ?? null;
                    $c_serie = $production['c_serie'] ?? null;
                    $c_etiqueta = $production['c_etiqueta'] ?? null;
                    $cantidad = $production['cantidad'] ?? null;
                    $peso_neto = $production['peso_neto'] ?? null;
                    $id_empresa = $production['id_empresa'] ?? null;
                    $fecha_cosecha = $production['fecha_cosecha'] ?? null;
                    $folio = $production['folio'] ?? null;
                    $id_exportadora = $production['id_exportadora'] ?? null;
                    $id_especie = $production['id_especie'] ?? null;
                    $id_variedad = $production['id_variedad'] ?? null;
                    $id_linea_proceso = $production['id_linea_proceso'] ?? null;
                    $numero_guia_recepcion = $production['numero_guia_recepcion'] ?? null;
                    $id_embalaje = $production['id_embalaje'] ?? null;
                    $n_tipo_proceso = $production['n_tipo_proceso'] ?? null;
                    $n_variedad_rotulacion = $production['n_variedad_rotulacion'] ?? null;
                    $peso_std_embalaje = $production['peso_std_embalaje'] ?? null;
                    $peso_standard = $production['peso_standard'] ?? null;
                    $creacion_tipo = $production['creacion_tipo'] ?? null;
                    $notas = $production['Nota_Calidad'] ?? null;
                    $estado = $production['Estado'] ?? null;
                    $destruccion_tipo = $production['destruccion_tipo'] ?? null;
            
                    // Busca si ya existe el registro en la tabla `proceso` basado en `numero_g_produccion`, `temporada_id` y `folio`
                    $cont = Proceso::query()
                        ->when($numero_g_produccion, function ($query) use ($numero_g_produccion) {
                            return $query->where('numero_g_produccion', $numero_g_produccion);
                        })
                        ->when($this->temporada->id, function ($query) {
                            return $query->where('temporada_id', $this->temporada->id);
                        })
                        ->when($folio, function ($query) use ($folio) {
                            return $query->where('folio', $folio);
                        })
                        ->when($tipo_g_produccion, function ($query) use ($tipo_g_produccion) {
                            return $query->where('tipo_g_produccion', $tipo_g_produccion);
                        })
                        ->when($fecha_g_produccion, function ($query) use ($fecha_g_produccion) {
                            return $query->where('fecha_g_produccion', $fecha_g_produccion);
                        })
                        ->when($fecha_produccion, function ($query) use ($fecha_produccion) {
                            return $query->where('fecha_produccion', $fecha_produccion);
                        })
                        ->when($fecha_cosecha, function ($query) use ($fecha_cosecha) {
                            return $query->where('fecha_recepcion', $fecha_cosecha);
                        })
                        ->when($cantidad, function ($query) use ($cantidad) {
                            return $query->where('cantidad', $cantidad);
                        })
                        ->when($peso_neto, function ($query) use ($peso_neto) {
                            return $query->where('peso_neto', $peso_neto);
                        })
                        ->when($creacion_tipo, function ($query) use ($creacion_tipo) {
                            return $query->where('creacion_tipo', $creacion_tipo);
                        })
                        ->when($c_productor, function ($query) use ($c_productor) {
                            return $query->where('c_productor', $c_productor);
                        })
                        ->when($id_embalaje, function ($query) use ($id_embalaje) {
                            return $query->where('id_embalaje', $id_embalaje);
                        })
                        ->when($estado, function ($query) use ($estado) {
                            return $query->where('Estado', $estado);
                        })
                        ->when($tipo, function ($query) use ($tipo) {
                            return $query->where('tipo', $tipo);
                        })
                        ->when($id_productor_proceso, function ($query) use ($id_productor_proceso) {
                            return $query->where('id_productor_proceso', $id_productor_proceso);
                        })
                        ->when($n_productor_proceso, function ($query) use ($n_productor_proceso) {
                            return $query->where('n_productor_proceso', $n_productor_proceso);
                        })
                        ->when($n_productor, function ($query) use ($n_productor) {
                            return $query->where('n_productor', $n_productor);
                        })
                        ->when($t_categoria, function ($query) use ($t_categoria) {
                            return $query->where('t_categoria', $t_categoria);
                        })
                        ->when($c_categoria, function ($query) use ($c_categoria) {
                            return $query->where('c_categoria', $c_categoria);
                        })
                        ->when($c_embalaje, function ($query) use ($c_embalaje) {
                            return $query->where('c_embalaje', $c_embalaje);
                        })
                        ->when($c_calibre, function ($query) use ($c_calibre) {
                            return $query->where('c_calibre', $c_calibre);
                        })
                        ->when($c_serie, function ($query) use ($c_serie) {
                            return $query->where('c_serie', $c_serie);
                        })
                        ->when($c_etiqueta, function ($query) use ($c_etiqueta) {
                            return $query->where('c_etiqueta', $c_etiqueta);
                        })
                        ->when($id_empresa, function ($query) use ($id_empresa) {
                            return $query->where('id_empresa', $id_empresa);
                        })
                        ->when($id_exportadora, function ($query) use ($id_exportadora) {
                            return $query->where('id_exportadora', $id_exportadora);
                        })
                        ->when($id_especie, function ($query) use ($id_especie) {
                            return $query->where('id_especie', $id_especie);
                        })
                        ->when($id_variedad, function ($query) use ($id_variedad) {
                            return $query->where('id_variedad', $id_variedad);
                        })
                        ->when($id_linea_proceso, function ($query) use ($id_linea_proceso) {
                            return $query->where('id_linea_proceso', $id_linea_proceso);
                        })
                        ->when($numero_guia_recepcion, function ($query) use ($numero_guia_recepcion) {
                            return $query->where('numero_guia_recepcion', $numero_guia_recepcion);
                        })
                        ->when($n_tipo_proceso, function ($query) use ($n_tipo_proceso) {
                            return $query->where('n_tipo_proceso', $n_tipo_proceso);
                        })
                        ->when($n_variedad_rotulacion, function ($query) use ($n_variedad_rotulacion) {
                            return $query->where('n_variedad_rotulacion', $n_variedad_rotulacion);
                        })
                        ->when($peso_std_embalaje, function ($query) use ($peso_std_embalaje) {
                            return $query->where('peso_std_embalaje', $peso_std_embalaje);
                        })
                        ->when($peso_standard, function ($query) use ($peso_standard) {
                            return $query->where('peso_standard', $peso_standard);
                        })
                        ->when($notas, function ($query) use ($notas) {
                            return $query->where('notas', $notas);
                        })
                        ->when($destruccion_tipo, function ($query) use ($destruccion_tipo) {
                            return $query->where('destruccion_tipo', $destruccion_tipo);
                        })->first();
                
            
                    if ($cont) {
                        
                        Proceso::create([
                            'tipo_g_produccion' => $tipo_g_produccion,
                            'numero_g_produccion' => $numero_g_produccion,
                            'fecha_g_produccion' => $fecha_g_produccion,
                            'fecha_produccion' => $fecha_produccion,
                            'tipo' => $tipo,
                            'id_productor_proceso' => $id_productor_proceso,
                            'n_productor_proceso' => $n_productor_proceso,
                            'c_productor' => $c_productor,
                            'n_productor' => $n_productor,
                            't_categoria' => $t_categoria,
                            'c_categoria' => $c_categoria,
                            'c_embalaje' => $c_embalaje,
                            'c_calibre' => $c_calibre,
                            'c_serie' => $c_serie,
                            'c_etiqueta' => $c_etiqueta,
                            'cantidad' => $cantidad,
                            'peso_neto' => $peso_neto,
                            'id_empresa' => $id_empresa,
                            'fecha_recepcion' => $fecha_cosecha,
                            'folio' => $folio,
                            'id_exportadora' => $id_exportadora,
                            'id_especie' => $id_especie,
                            'id_variedad' => $id_variedad,
                            'id_linea_proceso' => $id_linea_proceso,
                            'numero_guia_recepcion' => $numero_guia_recepcion,
                            'id_embalaje' => $id_embalaje,
                            'n_tipo_proceso' => $n_tipo_proceso,
                            'n_variedad_rotulacion' => $n_variedad_rotulacion,
                            'peso_std_embalaje' => $peso_std_embalaje,
                            'peso_standard' => $peso_standard,
                            'creacion_tipo' => $creacion_tipo,
                            'notas' => $notas,
                            'Estado' => $estado,
                            'destruccion_tipo' => $destruccion_tipo,
                            'temporada_id' => $this->temporada->id,
                            'duplicado' => 'si',
                        ]);

                    } else {
                        // Si no existe el registro, se crea uno nuevo
                        Proceso::create([
                            'tipo_g_produccion' => $tipo_g_produccion,
                            'numero_g_produccion' => $numero_g_produccion,
                            'fecha_g_produccion' => $fecha_g_produccion,
                            'fecha_produccion' => $fecha_produccion,
                            'tipo' => $tipo,
                            'id_productor_proceso' => $id_productor_proceso,
                            'n_productor_proceso' => $n_productor_proceso,
                            'c_productor' => $c_productor,
                            'n_productor' => $n_productor,
                            't_categoria' => $t_categoria,
                            'c_categoria' => $c_categoria,
                            'c_embalaje' => $c_embalaje,
                            'c_calibre' => $c_calibre,
                            'c_serie' => $c_serie,
                            'c_etiqueta' => $c_etiqueta,
                            'cantidad' => $cantidad,
                            'peso_neto' => $peso_neto,
                            'id_empresa' => $id_empresa,
                            'fecha_recepcion' => $fecha_cosecha,
                            'folio' => $folio,
                            'id_exportadora' => $id_exportadora,
                            'id_especie' => $id_especie,
                            'id_variedad' => $id_variedad,
                            'id_linea_proceso' => $id_linea_proceso,
                            'numero_guia_recepcion' => $numero_guia_recepcion,
                            'id_embalaje' => $id_embalaje,
                            'n_tipo_proceso' => $n_tipo_proceso,
                            'n_variedad_rotulacion' => $n_variedad_rotulacion,
                            'peso_std_embalaje' => $peso_std_embalaje,
                            'peso_standard' => $peso_standard,
                            'creacion_tipo' => $creacion_tipo,
                            'notas' => $notas,
                            'Estado' => $estado,
                            'destruccion_tipo' => $destruccion_tipo,
                            'temporada_id' => $this->temporada->id,
                            'duplicado' => 'no',
                        ]);
                    }
                }
            }


            
        }

        $this->temporada->update([  'recepcion_start'=>$this->fechai,
                                    'recepcion_end'=>$this->fechaf]);
        
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

    public function despachos_refresh()
    {    $ri=Despacho::all();
        $totali=$ri->count();

        $dateRanges = [];

        if($totali>0){
            $ultimo = Despacho::orderBy('fecha_g_despacho', 'desc')->first();
            $start = new DateTime($ultimo->fecha_g_despacho); // Usa la fecha más reciente
        }else{
            $start = new DateTime($this->fechai);
        }

        $end = new DateTime($this->fechaf);
        $intervalDays=10;

        while ($start <= $end) {
            $rangeEnd = (clone $start)->modify("+{$intervalDays} days");
            if ($rangeEnd > $end) {
                $rangeEnd = $end;
            }
            $dateRanges[] = [
                'start' => $start->format('Y-m-d'),
                'end' => $rangeEnd->format('Y-m-d')
            ];
            $start = (clone $rangeEnd)->modify("+1 day");
        }
        
        //dd($dateRanges);

        foreach($dateRanges as $date){

            if ($this->temporada->exportadora_id) {
                $productions = Http::timeout(60) // Aumenta el tiempo de espera a 60 segundos
                    ->retry(3, 1000) // Reintenta hasta 3 veces, con 1 segundo de espera entre intentos
                    ->post("https://api.greenexweb.cl/api/dispatches", [
                        'filter' => [
                            'fecha_g_despacho' => [
                                'gte' => $date['start'],
                                'lte' => $date['end'],
                            ],
                            'n_especie' => ['eq' => $this->temporada->especie->name],
                            'id_exportadora' => ['eq' => $this->temporada->exportadora_id],
                        ],
                        'select' => 'tipo_g_despacho,numero_g_despacho,fecha_g_despacho,id_empresa,id_exportadora,id_exportadora_embarque,c_destinatario,n_destinatario,n_transportista,folio,numero_guia_produccion,c_productor,n_productor,id_especie,id_variedad,id_embalaje,c_embalaje,peso_std_embalaje,c_categoria,t_categoria,c_calibre,c_serie,c_etiqueta,cantidad,peso_neto,n_variedad_rotulacion,N_Pais_Destino,N_Puerto_Destino,contenedor,precio_unitario,tipo_interno,creacion_tipo,destruccion_tipo,Transporte,nota_calidad,n_nave,Numero_Embarque,N_Proceso,Estado'
                    ]);
                $productions = $productions->json(); 
            } else {
                $productions = Http::timeout(60) // Aumenta el tiempo de espera a 60 segundos
                    ->retry(3, 1000) // Reintenta hasta 3 veces, con 1 segundo de espera entre intentos
                    ->post("https://api.greenexweb.cl/api/dispatches", [
                        'filter' => [
                            'fecha_g_despacho' => [
                                'gte' => $date['start'],
                                'lte' => $date['end'],
                            ],
                            'n_especie' => ['eq' => $this->temporada->especie->name],
                            'id_exportadora' => ['eq' => 22],
                        ],
                        'select' => 'tipo_g_despacho,numero_g_despacho,fecha_g_despacho,id_empresa,id_exportadora,id_exportadora_embarque,c_destinatario,n_destinatario,n_transportista,folio,numero_guia_produccion,c_productor,n_productor,id_especie,id_variedad,id_embalaje,c_embalaje,peso_std_embalaje,c_categoria,t_categoria,c_calibre,c_serie,c_etiqueta,cantidad,peso_neto,n_variedad_rotulacion,N_Pais_Destino,N_Puerto_Destino,contenedor,precio_unitario,tipo_interno,creacion_tipo,destruccion_tipo,Transporte,nota_calidad,n_nave,Numero_Embarque,N_Proceso,Estado'
                    ]);
                    $productions = $productions->json(); 
            }
            
            
           
           

               

            $previousDespacho = null;

            if (!empty($productions)) {
                foreach ($productions as $despacho) {
                    $tipo_g_despacho = $despacho['tipo_g_despacho'] ?? null;
                    $numero_g_despacho = $despacho['numero_g_despacho'] ?? null;
                    $fecha_g_despacho = $despacho['fecha_g_despacho'] ?? null;
                    $id_empresa = $despacho['id_empresa'] ?? null;
                    $id_exportadora = $despacho['id_exportadora'] ?? null;
                    $id_exportadora_embarque = $despacho['id_exportadora_embarque'] ?? null;
                    $c_destinatario = $despacho['c_destinatario'] ?? null;
                    $n_destinatario = $despacho['n_destinatario'] ?? null;
                    $n_transportista = $despacho['n_transportista'] ?? null;
                    $folio = $despacho['folio'] ?? null;
                    $numero_guia_produccion = $despacho['numero_guia_produccion'] ?? null;
                    $c_productor = $despacho['c_productor'] ?? null;
                    $n_productor = $despacho['n_productor'] ?? null;
                    $id_especie = $despacho['id_especie'] ?? null;
                    $id_variedad = $despacho['id_variedad'] ?? null;
                    $id_embalaje = $despacho['id_embalaje'] ?? null;
                    $c_embalaje = $despacho['c_embalaje'] ?? null;
                    $peso_std_embalaje = $despacho['peso_std_embalaje'] ?? null;
                    $c_categoria = $despacho['c_categoria'] ?? null;
                    $t_categoria = $despacho['t_categoria'] ?? null;
                    $c_calibre = $despacho['c_calibre'] ?? null;
                    $c_serie = $despacho['c_serie'] ?? null;
                    $c_etiqueta = $despacho['c_etiqueta'] ?? null;
                    $cantidad = $despacho['cantidad'] ?? null;
                    $peso_neto = $despacho['peso_neto'] ?? null;
                    $n_variedad_rotulacion = $despacho['n_variedad_rotulacion'] ?? null;
                    $N_Pais_Destino = $despacho['N_Pais_Destino'] ?? null;
                    $N_Puerto_Destino = $despacho['N_Puerto_Destino'] ?? null;
                    $contenedor = $despacho['contenedor'] ?? null;
                    $precio_unitario = $despacho['precio_unitario'] ?? null;
                    $tipo_interno = $despacho['tipo_interno'] ?? null;
                    $creacion_tipo = $despacho['creacion_tipo'] ?? null;
                    $destruccion_tipo = $despacho['destruccion_tipo'] ?? null;
                    $Transporte = $despacho['Transporte'] ?? null;
                    $nota_calidad = $despacho['nota_calidad'] ?? null;
                    $n_nave = $despacho['n_nave'] ?? null;
                    $Numero_Embarque = $despacho['Numero_Embarque'] ?? null;
                    $N_Proceso = $despacho['N_Proceso'] ?? null;
                    $Estado = $despacho['Estado'] ?? null;
            
                    // Verificar si el despacho actual es igual al anterior
                    $isDuplicate = $previousDespacho &&
                                   $previousDespacho['numero_g_despacho'] === $numero_g_despacho &&
                                   $previousDespacho['tipo_g_despacho'] === $tipo_g_despacho &&
                                   $previousDespacho['folio'] === $folio &&
                                   $previousDespacho['fecha_g_despacho'] === $fecha_g_despacho &&
                                   $previousDespacho['peso_neto'] === $peso_neto &&
                                   $previousDespacho['creacion_tipo'] === $creacion_tipo &&
                                   $previousDespacho['c_productor'] === $c_productor &&
                                   $previousDespacho['id_embalaje'] === $id_embalaje &&
                                   $previousDespacho['Estado'] === $Estado;
            
                    // Si no es duplicado, guarda el nuevo registro
                    if (!$isDuplicate) {
                        Despacho::create([
                            'temporada_id'=>$this->temporada->id,
                            'tipo_g_despacho' => $tipo_g_despacho,
                            'numero_g_despacho' => $numero_g_despacho,
                            'fecha_g_despacho' => $fecha_g_despacho,
                            'id_empresa' => $id_empresa,
                            'id_exportadora' => $id_exportadora,
                            'id_exportadora_embarque' => $id_exportadora_embarque,
                            'c_destinatario' => $c_destinatario,
                            'n_destinatario' => $n_destinatario,
                            'n_transportista' => $n_transportista,
                            'folio' => $folio,
                            'numero_guia_produccion' => $numero_guia_produccion,
                            'c_productor' => $c_productor,
                            'n_productor' => $n_productor,
                            'id_especie' => $id_especie,
                            'id_variedad' => $id_variedad,
                            'id_embalaje' => $id_embalaje,
                            'c_embalaje' => $c_embalaje,
                            'peso_std_embalaje' => $peso_std_embalaje,
                            'c_categoria' => $c_categoria,
                            't_categoria' => $t_categoria,
                            'c_calibre' => $c_calibre,
                            'c_serie' => $c_serie,
                            'c_etiqueta' => $c_etiqueta,
                            'cantidad' => $cantidad,
                            'peso_neto' => $peso_neto,
                            'n_variedad_rotulacion' => $n_variedad_rotulacion,
                            'N_Pais_Destino' => $N_Pais_Destino,
                            'N_Puerto_Destino' => $N_Puerto_Destino,
                            'contenedor' => $contenedor,
                            'precio_unitario' => $precio_unitario,
                            'tipo_interno' => $tipo_interno,
                            'creacion_tipo' => $creacion_tipo,
                            'destruccion_tipo' => $destruccion_tipo,
                            'Transporte' => $Transporte,
                            'nota_calidad' => $nota_calidad,
                            'n_nave' => $n_nave,
                            'Numero_Embarque' => $Numero_Embarque,
                            'N_Proceso' => $N_Proceso,
                            'Estado' => $Estado,
                            'duplicado' => 'no',
                        ]);
                    }else{
                        Despacho::create([
                            'temporada_id'=>$this->temporada->id,
                            'tipo_g_despacho' => $tipo_g_despacho,
                            'numero_g_despacho' => $numero_g_despacho,
                            'fecha_g_despacho' => $fecha_g_despacho,
                            'id_empresa' => $id_empresa,
                            'id_exportadora' => $id_exportadora,
                            'id_exportadora_embarque' => $id_exportadora_embarque,
                            'c_destinatario' => $c_destinatario,
                            'n_destinatario' => $n_destinatario,
                            'n_transportista' => $n_transportista,
                            'folio' => $folio,
                            'numero_guia_produccion' => $numero_guia_produccion,
                            'c_productor' => $c_productor,
                            'n_productor' => $n_productor,
                            'id_especie' => $id_especie,
                            'id_variedad' => $id_variedad,
                            'id_embalaje' => $id_embalaje,
                            'c_embalaje' => $c_embalaje,
                            'peso_std_embalaje' => $peso_std_embalaje,
                            'c_categoria' => $c_categoria,
                            't_categoria' => $t_categoria,
                            'c_calibre' => $c_calibre,
                            'c_serie' => $c_serie,
                            'c_etiqueta' => $c_etiqueta,
                            'cantidad' => $cantidad,
                            'peso_neto' => $peso_neto,
                            'n_variedad_rotulacion' => $n_variedad_rotulacion,
                            'N_Pais_Destino' => $N_Pais_Destino,
                            'N_Puerto_Destino' => $N_Puerto_Destino,
                            'contenedor' => $contenedor,
                            'precio_unitario' => $precio_unitario,
                            'tipo_interno' => $tipo_interno,
                            'creacion_tipo' => $creacion_tipo,
                            'destruccion_tipo' => $destruccion_tipo,
                            'Transporte' => $Transporte,
                            'nota_calidad' => $nota_calidad,
                            'n_nave' => $n_nave,
                            'Numero_Embarque' => $Numero_Embarque,
                            'N_Proceso' => $N_Proceso,
                            'Estado' => $Estado,
                            'duplicado' => 'si',
                        ]);
                    }
            
                    // Actualizar el despacho anterior
                    $previousDespacho = $despacho;
                }
            }
            


            
        }

        $this->temporada->update([  'recepcion_start'=>$this->fechai,
                                    'recepcion_end'=>$this->fechaf]);
        
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

    public function recepcions_delete(){
        $recepcionall=Recepcion::where('temporada_id',$this->temporada->id)->get();
        foreach($recepcionall as $recepcion){
            $recepcion->delete();
        }

        $this->render();
    }

    public function procesos_delete(){
        $recepcionall=Proceso::where('temporada_id',$this->temporada->id)->get();
        foreach($recepcionall as $recepcion){
            $recepcion->delete();
        }

        $this->render();
    }

    public function despachos_delete(){
        $recepcionall=Despacho::where('temporada_id',$this->temporada->id)->get();
        foreach($recepcionall as $recepcion){
            $recepcion->delete();
        }

        $this->render();
    }

    public function embarques_delete(){
        $recepcionall=Embarque::where('temporada_id',$this->temporada->id)->get();
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
