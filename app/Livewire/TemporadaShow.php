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

       

        return view('livewire.temporada-show',compact('razonsallresult','unique_categorianac','unique_categoriasexp','procesosall','procesos','recepcionall','recepcions','detalles','unique_semanas','unique_materiales','unique_etiquetas','masastotalnacional','unique_calibres','familias','fobsall','embarques','embarquestotal','fletestotal','materialestotal','masastotal','fobs','anticipos','unique_especies','unique_variedades','resumes','CostosPackings','CostosPackingsall','materiales','exportacions','razons','comisions','fletes','masasbalances','razonsall'));
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
                $productions = Http::post("https://api.greenexweb.cl/api/productions?filter[fecha_g_produccion][gte]=".$date['start']."&filter[fecha_g_produccion][lte]=".$date['end']."&select=tipo_g_produccion, numero_g_produccion, fecha_g_produccion, tipo, id_productor_proceso, n_productor_proceso, c_productor, n_productor, t_categoria, c_categoria, c_embalaje, c_calibre, c_serie, c_etiqueta, cantidad, peso_neto, id_empresa, fecha_recepcion, folio, id_exportadora, id_especie, id_variedad, id_linea_proceso, numero_guia_recepcion, id_embalaje, n_tipo_proceso, n_variedad_rotulacion, peso_std_embalaje, creacion_tipo, notas, Estado, destruccion_tipo, n_especie&filter[n_especie][eq]=".$this->temporada->especie->name."&filter[id_exportadora][eq]=".$this->temporada->exportadora_id);
            } else {
                $productions = Http::post("https://api.greenexweb.cl/api/productions?filter[fecha_g_produccion][gte]=".$date['start']."&filter[fecha_g_produccion][lte]=".$date['end']."&select=tipo_g_produccion, numero_g_produccion, fecha_g_produccion, tipo, id_productor_proceso, n_productor_proceso, c_productor, n_productor, t_categoria, c_categoria, c_embalaje, c_calibre, c_serie, c_etiqueta, cantidad, peso_neto, id_empresa, fecha_recepcion, folio, id_exportadora, id_especie, id_variedad, id_linea_proceso, numero_guia_recepcion, id_embalaje, n_tipo_proceso, n_variedad_rotulacion, peso_std_embalaje, creacion_tipo, notas, Estado, destruccion_tipo, n_especie&filter[n_especie][eq]=".$this->temporada->especie->name."&filter[id_exportadora][eq]=22");
            }
            
           
            $productions = $productions->json(); 

            if (!IS_NULL($productions)) {
                foreach ($productions as $production) {
                    $tipo_g_produccion = $production['tipo_g_produccion'] ?? null;
                    $numero_g_produccion = $production['numero_g_produccion'] ?? null;
                    $fecha_g_produccion = $production['fecha_g_produccion'] ?? null;
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
                    $fecha_recepcion = $production['fecha_recepcion'] ?? null;
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
                    $creacion_tipo = $production['creacion_tipo'] ?? null;
                    $notas = $production['notas'] ?? null;
                    $estado = $production['estado'] ?? null;
                    $destruccion_tipo = $production['destruccion_tipo'] ?? null;
            
                    // Busca si ya existe el registro en la tabla `proceso` basado en `numero_g_produccion`, `temporada_id` y `folio`
                    $cont = Proceso::where('numero_g_produccion', $numero_g_produccion)
                        ->where('temporada_id', $this->temporada->id)
                        ->where('folio', $folio)
                        ->first();
            
                    if ($cont) {
                        // Si el registro existe, se actualiza
                        $cont->forceFill([
                            'tipo_g_produccion' => $tipo_g_produccion,
                            'numero_g_produccion' => $numero_g_produccion,
                            'fecha_g_produccion' => $fecha_g_produccion,
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
                            'fecha_recepcion' => $fecha_recepcion,
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
                            'creacion_tipo' => $creacion_tipo,
                            'notas' => $notas,
                            'estado' => $estado,
                            'destruccion_tipo' => $destruccion_tipo,
                        ])->save();
                    } else {
                        // Si no existe el registro, se crea uno nuevo
                        Proceso::create([
                            'tipo_g_produccion' => $tipo_g_produccion,
                            'numero_g_produccion' => $numero_g_produccion,
                            'fecha_g_produccion' => $fecha_g_produccion,
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
                            'fecha_recepcion' => $fecha_recepcion,
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
                            'creacion_tipo' => $creacion_tipo,
                            'notas' => $notas,
                            'estado' => $estado,
                            'destruccion_tipo' => $destruccion_tipo,
                            'temporada_id' => $this->temporada->id,
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
