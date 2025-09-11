<?php

namespace App\Livewire;

use App\Exports\RazonsocialCondicionExport;
use App\Imports\RespuestasImport;
use App\Models\Anticipo;
use App\Models\Balancemasa;
use App\Models\Balancemasados;
use App\Models\Categoria;
use App\Models\Comision;
use App\Models\Costo;
use App\Models\Costomenu;
use App\Models\CostoPacking;
use App\Models\Despacho;
use App\Models\Detalle;
use App\Models\Embarque;
use App\Models\Especie;
use App\Models\Exception;
use App\Models\Exportacion;
use App\Models\Factorbalance;
use App\Models\Familia;
use App\Models\Flete;
use App\Models\Fob;
use App\Models\Gasto;
use App\Models\Material;
use App\Models\PackingCode;
use App\Models\Proceso;
use App\Models\Razonsocial;
use App\Models\Recepcion;
use App\Models\Resumen;
use App\Models\Superespecie;
use App\Models\Supervariedad;
use App\Models\Sync;
use App\Models\Temporada;
use App\Models\Variedad;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class TemporadaShow extends Component
{   use WithPagination;
    public $fechaetd, $syncfecha, $foliosexept, $syncfactor, $fechai, $fechaf, $first_recepcion, $last_recepcion, $variedadpacking, $tipo_procesos, $tipo_procesos2, $productorid, $familia,$unidad, $item, $descuenta, $categoria, $masaid, $gastoid, $gastocant, $fobid, $preciomasa , $preciofob2 , $preciofob3 , $temporada,$vista,$razonsocial,$type,$precio_usd, $etiqueta, $empresa, $exportacionedit_id, $valor, $ctd=25;
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
        'exp' => true,   // Inicia marcado
        'com' => true,   // Inicia marcado
        'mi'  => true,
        'mie'=>'',
        'mn'=>'',
        'desc'=>'',
        'color'=>'',
        'calibre'=>'',
        'etiqueta'=>'',
        'etiquetas'=>'[]',
        'notfolios'=>'[]',
        'material'=>'',
        'mer'=>'',
        'semana'=>'',
        'tipo'=>'',
        'tipo2'=>'',
        'norma'=>'',
        'p_unicos'=>true,
        'p_repetidos'=>true,
        'fechanull'=>'',
        'multiplicacion'=>''
    ];

    public $archivo;

    use WithFileUploads;
   
    public function importar()
    {
        $this->validate([
            'archivo' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new RespuestasImport($this->temporada->id), $this->archivo);

        $this->reset('archivo');

        session()->flash('success', 'Archivo importado correctamente.');
    }
   

    public function mount(Temporada $temporada, $vista){
        $this->temporada=$temporada;
        $this->vista=$vista;

        if($this->temporada->fecha_sync){
            $this->syncfecha=$this->temporada->fecha_sync;
        }else{
            $this->syncfecha="todos";
        }

        if($this->temporada->factor_sync){
            $this->syncfactor=$this->temporada->fecha_sync;
        }else{
            $this->syncfactor="todos";
        }
        
        $masastotal2=Balancemasa::where('temporada_id',$this->temporada->id)->whereIn('exportadora', ['Greenex SpA', '22'])->get();

        $this->filters['etiquetas'] = $masastotal2->pluck('n_etiqueta')->unique()->sort()->values()->all();

        $this->filters['notfolios'] = Exception::where('temporada_id',$this->temporada->id)->pluck('item')->unique()->sort()->values()->all();
       
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

        $procesosall=Proceso::where('temporada_id',$this->temporada->id)->get();
        $this->tipo_procesos = $procesosall->pluck('tipo_g_produccion')->unique()->sort();
        $this->tipo_procesos2 = $procesosall->pluck('tipo')->unique()->sort();
    }

    public function updatedFoliosexept($folio)
    {   
        if (($key = array_search($folio, $this->filters['notfolios'])) !== false) {
            $excepcion=Exception::where('temporada_id',$this->temporada->id)->where('item',$folio)->first();
            $excepcion->delete();
            unset($this->filters['notfolios'][$key]);
        } else {
            Exception::create(['temporada_id'=>$this->temporada->id,
                                'item'=>$folio]);
            $this->filters['notfolios'][] = $folio;

        }
        $this->filters['notfolios'] = array_values($this->filters['notfolios']); // reindexar el array
        $this->render();
    }

    public function checkfolio($folio)
    {   
        if (($key = array_search($folio, $this->filters['notfolios'])) !== false) {
            $excepcion=Exception::where('temporada_id',$this->temporada->id)->where('item',$folio)->first();
            if($excepcion){
                $excepcion->delete();
            }
            unset($this->filters['notfolios'][$key]);
        } else {
            Exception::create(['temporada_id'=>$this->temporada->id,
                                'item'=>$folio]);
            $this->filters['notfolios'][] = $folio;

        }
        $this->filters['notfolios'] = array_values($this->filters['notfolios']); // reindexar el array
        $this->render();
    }

    public function checkfobcategoria($categoria)
    {   
        if($this->filters['ncategoria'] == $categoria){
            $this->filters['ncategoria'] = ""; // reindexar el array
        }else{
            $this->filters['ncategoria'] = $categoria; // reindexar el array
        }
            

        $this->filters['variedad']="";
        $this->filters['etiqueta']="";
        $this->filters['calibre']="";
        $this->render();
    }

    public function checkfobvariedad($variedad){
        //$this->productorid=$razonsocial;
        $this->filters['variedad']=$variedad;
        $this->filters['etiqueta']="";
        $this->filters['calibre']="";
    }

    public function checkfobetiqueta($etiqueta){
        //$this->productorid=$razonsocial;
        $this->filters['etiqueta']=$etiqueta;
        $this->filters['material']="";
        $this->filters['calibre']="";
    }

    public function checkfobmaterial($material){
        //$this->productorid=$razonsocial;
        $this->filters['material']=$material;
    }

    public function checkfobcalibre($calibre){
        //$this->productorid=$razonsocial;
        $this->filters['calibre']=$calibre;
    }

    public function checkfobcolor($color){
        //$this->productorid=$razonsocial;
        $this->filters['color']=$color;
    }

    public function checkfolioreset()
    {   
      
        foreach($this->filters['notfolios']  as $folio){
            $excepcion=Exception::where('temporada_id',$this->temporada->id)->where('item',$folio)->first();
            $excepcion->delete();
        }
       
        $this->filters['notfolios'] = []; // reindexar el array
        $this->render();
    }

    public function filtrar_fechanull(){
        if ($this->filters['fechanull']==True) {
            $this->filters['fechanull']=False;
        } else {
            $this->filters['fechanull']=True;
        }
    }

    public function filtrar_multiplicacion(){
        if ($this->filters['multiplicacion']==True) {
            $this->filters['multiplicacion']=False;
        } else {
            $this->filters['multiplicacion']=True;
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
       $ordenMetodo = "'TPT','TPCL','TPE','TPC','TPK','MTC','MTE','MTEB','MTEmp','MTT','MPC','PSF','null'";

        $costos = Costo::paraEspecieTemporada($this->temporada)
            ->with(['superespecies', 'costomenu'])        // si tienes relación costomenu
            ->orderBy('costomenu_id')                     // primero por menú
            ->orderByRaw("FIELD(metodo, $ordenMetodo)")   // luego por método (orden personalizado en MySQL/MariaDB)
            ->orderBy('name')                              // finalmente por nombre
            ->get();
        
            // Paginamos los resultados de despachos y procesos (e.g., 15 elementos por página)
        if ($this->vista=="FACTOR") {
            $procesosall_group = Proceso::select( 
                    'id_empresa',
                    'numero_g_produccion',
                    'c_productor_proceso',
                    'c_etiqueta',
                    'id_variedad',
                    'c_calibre',
                    'c_categoria',
                    'c_embalaje',
                    DB::raw('MAX(id) as id'),  
                    DB::raw('SUM(peso_neto) as total')
                )
                ->where('temporada_id', $this->temporada->id)
                ->where('tipo_g_produccion', 'PRN')
                ->groupBy(
                    'id_empresa',
                    'numero_g_produccion',
                    'c_productor_proceso',
                    'c_etiqueta',
                    'id_variedad',
                    'c_calibre',
                    'c_categoria',
                    'c_embalaje'
                )
                ->get(); // No paginamos procesos porque solo se usará para referencia

            $despachosall_group = Despacho::select([
                'id_empresa', 
                'numero_guia_produccion', 
                'c_productor', 
                'c_etiqueta', 
                'id_variedad', 
                'c_calibre', 
                'c_categoria', 
                'c_embalaje',
                DB::raw('SUM(peso_neto) as total')  
            ])
            ->where('temporada_id', $this->temporada->id)
            ->groupBy([
                'id_empresa', 
                'numero_guia_produccion', 
                'c_productor', 
                'c_etiqueta', 
                'id_variedad', 
                'c_calibre', 
                'c_categoria', 
                'c_embalaje'
            ])
            ->get();
          
            
        } else {
            $procesosall_group=NULL;
            $despachosall_group=NULL;
        }

        $factores=Factorbalance::where('temporada_id',$this->temporada->id)->get();

        if ($this->vista=='Procesos') {
            $procesos=Proceso::filter($this->filters)->where('temporada_id',$this->temporada->id)->orderBy($this->sortByProc, $this->sortDirection)->paginate($this->ctd);
        }else{
            $procesos=null;
        }

        if ($this->vista=='Despachos' || $this->vista=='Procesos') {
            $despachosall=Despacho::filter($this->filters)->where('temporada_id',$this->temporada->id)->get();

            $despachos=Despacho::filter($this->filters)->where('temporada_id',$this->temporada->id)->orderBy($this->sortByProc, $this->sortDirection)->paginate($this->ctd);
        }else{
            $despachosall=null;
            $despachos=null;
        }

        if ($this->vista=="resumes") {
            $exportacionCodes = Categoria::where('grupo', 'Exportacion')->get()->pluck('nombre')->unique();
            $mercadoInternoCodes = Categoria::where('grupo', 'Mercado Interno')->get()->pluck('nombre')->unique();
            $comercialCodes = Categoria::where('grupo', 'Comercial')->get()->pluck('nombre')->unique();
        } else {
            $exportacionCodes = null;
            $mercadoInternoCodes = null;
            $comercialCodes = null;
        }
        
        
        if ($this->vista=="Embarques" || $this->vista=="Despachos") {
            $embarquesall=Embarque::filter($this->filters)->where('temporada_id',$this->temporada->id)->get();

            $embarques=Embarque::filter($this->filters)->where('temporada_id',$this->temporada->id)->orderBy($this->sortByProc, $this->sortDirection)->paginate($this->ctd);
            
        } else {
            
            $embarquesall=null;

            $embarques=null;
            
        }
       
        if ($this->vista=="Recepcion") {
                $recepcionall=Recepcion::where('temporada_id',$this->temporada->id)->get();

                $recepcions=Recepcion::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
                
            } else {
                $recepcionall=null;

                $recepcions=null;
            }

        $CostosPackingsall=CostoPacking::where('temporada_id',$this->temporada->id)->get();
        if ($this->vista=="MATERIALES") {
            $materiales=Material::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        } else {
            $materiales=null;
        }
        
        
        if ($this->vista=="Embarques") {
            $embarques=Embarque::where('temporada_id',$this->temporada->id)->paginate($this->ctd);
            $embarquestotal=Embarque::where('temporada_id',$this->temporada->id)->get();
        } else {
            $embarques=null;
            $embarquestotal=null;
        }
        
       


        $materialestotal=Material::where('temporada_id',$this->temporada->id)->get();


        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->paginate($this->ctd);

        $fletes=Flete::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);
        $fletestotal=Flete::where('temporada_id',$this->temporada->id)->get();
        
        $fobs=Fob::filter($this->filters)->where('temporada_id',$this->temporada->id)
                ->orderBy('fob_kilo_salida', 'asc')
                ->paginate($this->ctd);

        $fobsall=Fob::filter($this->filters)->where('temporada_id',$this->temporada->id)->get();

        $fobsall2=Fob::where('temporada_id',$this->temporada->id)->get();


        $color_fobs=$fobsall->pluck('color')->unique()->sort()->values()->all();

        $categoria_fobs=$fobsall->pluck('categoria')->unique()->sort()->values()->all();

        $etiqueta_fobs=$fobsall->pluck('etiqueta')->unique()->sort()->values()->all();

        $embalaje_fobs=$fobsall->pluck('embalaje')->unique()->sort()->values()->all();

        $calibre_fobs=$fobsall->pluck('n_calibre')->unique()->sort()->values()->all();

        $masasbalances = Balancemasa::filter($this->filters)
                ->where('temporada_id', $this->temporada->id)
                ->whereIn('exportadora', ['Greenex SpA', '22'])
                ->orderByDesc('updated_at')
                ->paginate($this->ctd);
                

            
        $masastotal = Balancemasa::select([
                                'n_variedad', 
                                'n_categoria', 
                                'cantidad', 
                                'peso_neto', 
                                'peso_neto2', 
                                'factor', 
                                'fob_id', 
                                'tipo_transporte', 
                                'c_embalaje', 
                                'c_productor',
                                'r_productor',
                                'etd',
                                'eta',
                                 'semana',
                                 'precio_unitario',
                                 'n_calibre',
                                 'peso_std_embalaje'
                            ])
                            ->filter1($this->filters)
                            ->where('temporada_id', $this->temporada->id)
                            ->whereIn('exportadora', ['Greenex SpA', '22'])
                            ->get();
                  
                

        //$masastotal=Recepcion::where('temporada_id',$this->temporada->id)->get();

        $unique_categoriasexp = $masastotal->pluck('n_categoria')->unique()->sort();

        $masastotalnacional=Balancemasa::filter2($this->filters)->where('temporada_id',$this->temporada->id)->whereIn('exportadora', ['Greenex SpA', '22'])->get();
        
        $unique_categorianac = $masastotalnacional->pluck('n_categoria')->unique()->sort();

        $unique_productores = $masastotal->pluck('c_productor')->unique();
        
        $masastotal2=Balancemasa::where('temporada_id',$this->temporada->id)->whereIn('exportadora', ['Greenex SpA', '22'])->get();

        $unique_etiquetas = $masastotal2->pluck('n_etiqueta')->unique()->sort();

        $unique_calibres = $masastotal2->pluck('c_calibre')->unique()->sort();       
        
        $unique_materiales = $masastotal2->pluck('c_embalaje')->unique()->sort();

        $unique_semanas = $masastotal2->pluck('semana')->unique()->sort();

        $unique_folios = $masastotal2->pluck('folio')->unique()->sort();

        $unique_especies = $CostosPackingsall->pluck('especie')->unique()->sort();

        $unique_variedades = Variedad::where('temporada_id',$this->temporada->id)->get();

        if ($this->vista=='show' || $this->vista=='resumes') {
           
        
                        
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
                            
        } else {
            $razons=null;
            $razonsall=null;
            $razonsallresult=null;
        }


        $comisions=Comision::all();

        $familias=Familia::where('status','active')->get();

        $detalles=Detalle::filter($this->filters)->where('temporada_id',$this->temporada->id)->paginate($this->ctd);

        $exportacionCodes = Categoria::where('grupo', 'Exportacion')->get()->pluck('nombre')->unique();
        $mercadoInternoCodes = Categoria::where('grupo', 'Mercado Interno')->get()->pluck('nombre')->unique();
        $comercialCodes = Categoria::where('grupo', 'Comercial')->get()->pluck('nombre')->unique();

        $PackingCodes=PackingCode::where('temporada_id',$this->temporada->id)->get();

        $costomenus=Costomenu::all();

        return view('livewire.temporada-show',compact('costomenus','materiales','PackingCodes','fobsall2','calibre_fobs','etiqueta_fobs','embalaje_fobs','categoria_fobs','color_fobs','unique_folios','materialestotal','despachosall_group','factores','procesosall_group','mercadoInternoCodes','comercialCodes','exportacionCodes','embarquesall','embarques','despachos','despachosall','razonsallresult','unique_categorianac','unique_categoriasexp','procesosall','procesos','recepcionall','recepcions','detalles','unique_semanas','unique_materiales','unique_etiquetas','masastotalnacional','unique_calibres','familias','fobsall','embarques','embarquestotal','fletestotal','masastotal','fobs','anticipos','unique_especies','unique_variedades','costos','resumes','CostosPackings','CostosPackingsall','exportacions','razons','comisions','fletes','masasbalances','razonsall'));
    }

    public function factores_create(){
        $despachosall_group = Despacho::select([
            'id_empresa', 
            'numero_guia_produccion', 
            'c_productor', 
            'c_etiqueta', 
           
            'n_variedad', 
            'c_calibre', 
            'c_categoria', 
            'c_embalaje',
            DB::raw('SUM(peso_neto) as total')  
        ])
        ->where('temporada_id', $this->temporada->id)
        ->groupBy([
            'id_empresa', 
            'numero_guia_produccion', 
            'c_productor', 
            'c_etiqueta', 
           
            'n_variedad', 
            'c_calibre', 
            'c_categoria', 
            'c_embalaje'
        ])
        ->get();

      

        foreach ($despachosall_group as $item){
            Factorbalance::create([
                'temporada_id'          => $this->temporada->id,
                'id_empresa'            => $item->id_empresa,
                'numero_guia_produccion' => $item->numero_guia_produccion,
                'c_productor'           => $item->c_productor,
                'c_etiqueta'            => $item->c_etiqueta,
              
                'n_variedad'           => $item->n_variedad,
                'c_calibre'             => $item->c_calibre,
                'c_categoria'           => $item->c_categoria,
                'c_embalaje'            => $item->c_embalaje,
                'total'                 => $item->total,
                // 'total_proceso' no se incluye ya que se calculará después
            ]);
        }
        //return redirect()->route('temporada.balancemasa',$this->temporada)->with('info','Importación realizada con exito');
    }

    public function factores_update(){

        if($this->syncfecha=="todos"){
            $masas=Balancemasa::where('temporada_id',$this->temporada->id)
                    ->get();
        }else{
            $masas=Balancemasa::where('temporada_id',$this->temporada->id)
                ->whereNull('factor')
                ->get();
        }

       
        //dd($masas);
        $factores = Factorbalance::where('temporada_id', $this->temporada->id)->get();

        foreach ($masas as $masa) {
            // Buscar el factor que coincida con los campos correspondientes
            $factor = $factores->firstWhere(function ($factor) use ($masa) {
                return $factor->id_empresa == $masa->id_empresa &&
                    $factor->numero_guia_produccion == $masa->numero_guia_produccion &&
                    $factor->c_productor == $masa->c_productor &&
                    $factor->c_etiqueta == $masa->c_etiqueta &&
                    $factor->n_variedad == $masa->n_variedad &&
                    $factor->c_calibre == $masa->c_calibre &&
                    $factor->c_categoria == $masa->c_categoria &&
                    $factor->c_embalaje == $masa->c_embalaje;
            });

            if ($factor) {
                // Si se encontró el factor correspondiente, actualiza las columnas
                $masa->factor = $factor->factor; // Asegúrate de tener el nombre correcto del campo 'factor' en Factorbalance
                $masa->peso_neto2 = $factor->factor*$masa->peso_neto; // Asegúrate de tener el nombre correcto del campo 'peso_neto2' en Factorbalance
                $masa->save();
            }
        }
    }

    public function factores_update2(){
       
        $factores_proceso = Factorbalance::where('temporada_id', $this->temporada->id)->where('type','proceso')->whereNull('sync_control')->get();

         // Iteramos sobre cada factor de proceso
        foreach ($factores_proceso as $factor) {
            // Buscar la fecha de producción del proceso correspondiente al numero_guia_produccion
                $proceso = Proceso::where('numero_g_produccion', $factor->numero_guia_produccion)->first();
                
                // Si se encuentra el proceso y tiene la fecha de producción, sumar 7 días
                if ($proceso && $proceso->fecha_g_produccion) {


                    // Convertir la fecha_produccion a un objeto Carbon y sumar 7 días
                    $fechacalculada =  date('d/m/Y', strtotime($proceso->fecha_g_produccion . ' +7 days'));
                    
                } else {
                    // Si no se encuentra el proceso o no tiene fecha_produccion, asignamos un valor por defecto
                    $fechacalculada = null; // o la fecha que prefieras
                }

                
                 // Verificar si ya existe un balance de masa con esta combinación
                    $existingBalance = Balancemasa::where('temporada_id', $this->temporada->id)
                        ->where('numero_guia_produccion', $factor->numero_guia_produccion)
                        ->where('id_empresa', $factor->id_empresa)
                        ->where('c_productor', $factor->c_productor)
                        ->where('c_etiqueta', $factor->c_etiqueta)
                        ->where('n_variedad', $factor->n_variedad)
                        ->where('c_calibre', $factor->c_calibre)
                        ->where('c_categoria', $factor->c_categoria)
                        ->where('c_embalaje', $factor->c_embalaje)
                        ->where('type', 'proceso')
                        ->first();

                // Si no existe el balance de masa, crear uno nuevo
                if (!$existingBalance) {
                    $embarquesall=Embarque::where('temporada_id',$this->temporada->id)->get();
                      
                        if ($embarquesall->where('numero_g_despacho',$proceso->numero_g_despacho)->count()>0) {
                          
                            foreach ($embarquesall->where('numero_g_despacho',$proceso->numero_g_despacho) as $embarque){
                                if($embarque->etd || $embarque->eta){
                                    $etd = $embarque->etd; // Supongamos que es una fecha en formato Y-m-d
                                    $eta = $embarque->eta;
                                    
                                    // Convertir las fechas a semanas del año
                                    $etdSemana = date('W', strtotime($etd));
                                    $etaSemana = date('W', strtotime($eta));
            
            
                                    $prodSemana = date('W', strtotime($fechacalculada));
            
                                    $etdSemana = date('W', strtotime($etd));
                                   
                                        if ($prodSemana>$etdSemana) {
                                            $diferenciadefechas=$etdSemana-$prodSemana+52;
                                        }else{
                                            $diferenciadefechas=$etdSemana-$prodSemana;
                                        }
                                    // Luego puedes guardar esas semanas en tu base de datos
                                   break;
                                }
                            }
                        } else {
            
                            $etdSemana = date('W', strtotime($fechacalculada));
                            $etd = $fechacalculada; // Supongamos que es una fecha en formato Y-m-d
                            $eta = $fechacalculada;
                            $etaSemana = date('W', strtotime($fechacalculada));

                            $prodSemana = date('W', strtotime($fechacalculada));
                           

                                if ($prodSemana>$etdSemana) {
                                    $diferenciadefechas=$etdSemana-$prodSemana+52;
                                }else{
                                    $diferenciadefechas=$etdSemana-$prodSemana;
                                }
                            
                          
                           
                        }
                   


                    Balancemasa::create([
                        'temporada_id'             => $this->temporada->id,
                        'id_empresa'               => $factor->id_empresa ?? '',
                        'numero_guia_produccion'   => $factor->numero_guia_produccion ?? '',
                        'c_productor'              => $factor->c_productor ?? '',
                        'c_etiqueta'               => $factor->c_etiqueta ?? '',
                        'n_etiqueta'               => strtoupper($proceso->n_etiqueta) ?? '',
                        'id_variedad'              => $factor->id_variedad ?? '',
                        'n_variedad'              => $factor->n_variedad ?? '',
                        'c_calibre'                => $factor->c_calibre ?? '',
                        'c_categoria'              => $factor->c_categoria ?? '',
                        'c_embalaje'               => $factor->c_embalaje ?? '',
                        'total'                    => $factor->total ?? 0, // Asumimos que 'total' es un campo de 'Factorbalance'
                        'peso_neto'               => $factor->total_proceso ?? 0, // Asumimos que 'total_proceso' es un campo de 'Factorbalance'
                        'factor'                   => $factor->factor ?? 0, // Asumimos que 'factor' es un campo de 'Factorbalance'
                        'peso_neto2'               => $factor->total_proceso ?? 0, // Asumimos que 'total_proceso' es un campo de 'Factorbalance'
                        'fecha_g_despacho'         => $fechacalculada,
                        'exportadora'              => $this->temporada->exportadora_id ?? '22',
                        'type'                     => 'proceso', // Fecha calculada (fecha_produccion + 7 días)
                        'color'                    => str_ends_with($factor->c_calibre ?? '', 'D') ? 'Dark' : 'Light',
                        'semana' => $etdSemana,  // Mantienes la fecha original si es necesario
                        'etd' => $etd,  // Mantienes la fecha original si es necesario
                        'etd_semana' => $etdSemana,  // Guardas la semana calculada
                          
                       

                    ]);
                }
            Cache::flush();
            
            $factor->update(['sync_control'=>'sincronizado']);
        }
      
    }

   
    public function factores_count() {
        // Obtén los procesos agrupados y calcula la suma de peso_neto en 'total'
        $procesosall_group = Proceso::select(
                'id_empresa',
                'numero_g_produccion',
                'c_productor_proceso',
                'c_etiqueta',
                'n_variedad_rotulacion as n_variedad',
                'c_calibre',
                'c_categoria',
                'c_embalaje',
                DB::raw('SUM(peso_neto) as total')
            )
            ->where('temporada_id', $this->temporada->id)
            ->where('tipo_g_produccion', 'PRN')
            ->groupBy(
                'id_empresa',
                'numero_g_produccion',
                'c_productor_proceso',
                'c_etiqueta',
                'n_variedad',
                'c_calibre',
                'c_categoria',
                'c_embalaje'
            )
            ->get();

            //dd($procesosall_group);
        
        // Obtén los factores existentes para la temporada
        $factores = Factorbalance::where('temporada_id', $this->temporada->id)->get();
        
        // Convierte los factores a un array de combinaciones clave para facilitar la comparación
        $factoresCombinaciones = $factores->mapWithKeys(function ($factor) {
            return [serialize([
                'id_empresa' => $factor->id_empresa,
                'numero_guia_produccion' => $factor->numero_guia_produccion,
                'c_productor' => $factor->c_productor,
                'c_etiqueta' => $factor->c_etiqueta,
                'n_variedad' => $factor->n_variedad,
                'c_calibre' => $factor->c_calibre,
                'c_categoria' => $factor->c_categoria,
                'c_embalaje' => $factor->c_embalaje,
            ]) => $factor];
        });
        
        // Filtra los procesos para obtener aquellos que no tienen un factor correspondiente y crea las combinaciones faltantes
        $procesosall_group->each(function ($proceso) use (&$factores, &$factoresCombinaciones) {
            $combinacionProceso = serialize([
                'id_empresa' => $proceso->id_empresa,
                'numero_guia_produccion' => $proceso->numero_g_produccion,
                'c_productor' => $proceso->c_productor_proceso,
                'c_etiqueta' => $proceso->c_etiqueta,
                'n_variedad' => $proceso->n_variedad,
                'c_calibre' => $proceso->c_calibre,
                'c_categoria' => $proceso->c_categoria,
                'c_embalaje' => $proceso->c_embalaje,
            ]);
        
            // Verifica si la combinación ya existe en los factores
            if (!isset($factoresCombinaciones[$combinacionProceso])) {
                // Crea un nuevo factor con la combinación y el total del proceso
                $nuevoFactor = new Factorbalance([
                    'temporada_id' => $this->temporada->id,
                    'id_empresa' => $proceso->id_empresa,
                    'numero_guia_produccion' => $proceso->numero_g_produccion,
                    'c_productor' => $proceso->c_productor_proceso,
                    'c_etiqueta' => $proceso->c_etiqueta,
                    'n_variedad' => $proceso->n_variedad,
                    'c_calibre' => $proceso->c_calibre,
                    'c_categoria' => $proceso->c_categoria,
                    'c_embalaje' => $proceso->c_embalaje,
                    'total' => $proceso->total,
                    'total_proceso' => $proceso->total, // Se inicializa igual que 'total'
                    'factor' => 1, // Inicializamos con 1 (total_proceso / total)
                    'type' => 'proceso' // Inicializamos con 1 (total_proceso / total)
                ]);
                $nuevoFactor->save(); // Guarda el nuevo factor en la base de datos
        
                // Agrega la nueva combinación a factoresCombinaciones para evitar duplicados
                $factoresCombinaciones[$combinacionProceso] = $nuevoFactor;
                $factores->push($nuevoFactor);
            }
        });
    
        // Recorre cada factor y actualiza solo los que tienen 'total_proceso' nulo o cero
        $factores->where('total_proceso', 0)->each(function ($factor) use ($procesosall_group) {
            // Encuentra el proceso correspondiente al factor
            $proceso = $procesosall_group->first(function ($proceso) use ($factor) {
                return $proceso->id_empresa == $factor->id_empresa &&
                       $proceso->numero_g_produccion == $factor->numero_guia_produccion &&
                       $proceso->c_productor_proceso == $factor->c_productor &&
                       $proceso->c_etiqueta == $factor->c_etiqueta &&
                       $proceso->id_variedad == $factor->id_variedad &&
                       $proceso->c_calibre == $factor->c_calibre &&
                       $proceso->c_categoria == $factor->c_categoria &&
                       $proceso->c_embalaje == $factor->c_embalaje;
            });
           
            // Actualiza el total_procesos en el factor
            $factor->total_proceso = $proceso ? $proceso->total : 0;
    
            // Actualiza el factor solo si 'total' es mayor a cero
            $factor->factor = $factor->total > 0 ? floatval($factor->total_proceso / $factor->total) : 0;
            
            $factor->save(); // Guarda el cambio en la base de datos
        });
    }
    
    public function updatedSyncfecha($value)
    {
        
        switch ($value) {
            case 'todos':
                $this->temporada->fecha_sync = 'todos'; // Cambia el valor según lo necesario
                break;
            case 'nulos':
                $this->temporada->fecha_sync = 'nulos'; // Establece el valor en nulo
                break;
        }
        
        $this->temporada->save(); // Guarda los cambios en la base de datos
    }

    public function updatedSyncfactor($value)
    {
        
        switch ($value) {
            case 'todos':
                $this->temporada->factor_sync = 'todos'; // Cambia el valor según lo necesario
                break;
            case 'nulos':
                $this->temporada->factor_sync = 'nulos'; // Establece el valor en nulo
                break;
        }
        
        $this->temporada->save(); // Guarda los cambios en la base de datos
    }

    public function delete_balancemasas(){
        $masas=Balancemasa::where('temporada_id',$this->temporada->id)->get();
        foreach ($masas as $masa){
            $masa->delete();
        }
        return redirect()->route('temporada.balancemasa',$this->temporada);
    }

    public function delete_fobs(){
        $masas=Fob::where('temporada_id',$this->temporada->id)->get();
        foreach ($masas as $masa){
            $masa->delete();
        }
        return redirect()->route('temporada.fob',$this->temporada)->with('info','Eliminación realizada con exito');
    }

    public function delete_balancemasasProceso(){
        $masas=Balancemasa::where('temporada_id',$this->temporada->id)->where('type','proceso')->get();
        foreach ($masas as $masa){
            $masa->delete();
        }
        $masas = Factorbalance::where('temporada_id', $this->temporada->id)->where('type','proceso')->get();
        foreach ($masas as $factor){
            $factor->update(['sync_control'=>null]);
        }
        
        
        Cache::flush();
        return redirect()->route('temporada.balancemasa',$this->temporada)->with('info','Registros eliminados con exito');
        
    }

    public function sync_fechas(){
        
        if($this->syncfecha=="todos"){
            $masas = Despacho::where('temporada_id', $this->temporada->id)->get();
        }else{
            $masas=Despacho::where('temporada_id', $this->temporada->id)
            ->where(function ($query) {
                $query->whereNull('semana')
                        ->orWhereNull('etd')
                        ->orWhereNull('eta');
            })
            ->get();
        }
        
       

        $embarquesall=Embarque::where('temporada_id',$this->temporada->id)->get();
        foreach($masas as $masa){
          
            if ($embarquesall->where('numero_g_despacho',$masa->numero_g_despacho)->count()>0) {
              
                foreach ($embarquesall->where('numero_g_despacho',$masa->numero_g_despacho) as $embarque){
                    if($embarque->etd || $embarque->eta){
                        $etd = $embarque->etd; // Supongamos que es una fecha en formato Y-m-d
                        $eta = $embarque->eta;
                        
                        // Convertir las fechas a semanas del año
                        $etdSemana = date('W', strtotime($etd));
                        $etaSemana = date('W', strtotime($eta));


                        $prodSemana = date('W', strtotime($masa->fecha_produccion));

                        $etdSemana = date('W', strtotime($etd));
                       
                            if ($prodSemana>$etdSemana) {
                                $diferenciadefechas=$etdSemana-$prodSemana+52;
                            }else{
                                $diferenciadefechas=$etdSemana-$prodSemana;
                            }
                        // Luego puedes guardar esas semanas en tu base de datos
                        $masa->update([
                            'semana' => $etdSemana,  // Mantienes la fecha original si es necesario
                            'etd' => $etd,  // Mantienes la fecha original si es necesario
                            'eta' => $eta,
                            'etd_semana' => $etdSemana,  // Guardas la semana calculada
                            'eta_semana' => $etaSemana,
                            'control_fechas'=>$diferenciadefechas
                        ]);

                                    break;
                    }
                }
            } else {

                $etdSemana = date('W', strtotime($masa->fecha_g_despacho));


                $prodSemana = date('W', strtotime($masa->fecha_produccion));
               
                    if ($prodSemana>$etdSemana) {
                        $diferenciadefechas=$etdSemana-$prodSemana+52;
                    }else{
                        $diferenciadefechas=$etdSemana-$prodSemana;
                    }
                
              

                $masa->update([
                    'etd' => $masa->fecha_g_despacho,  // Mantienes la fecha original si es necesario
                    'etd_semana' => $etdSemana,  // Guardas la semana calculada
                    'semana' => $etdSemana,
                    'control_fechas'=>$diferenciadefechas
                ]);
            }
        }

       

        $this->render();

    }
    public function production_refresh()
    {    $ri=Recepcion::all();
        $totali=$ri->count();

        $dateRanges = [];
        $start = new DateTime($this->fechai);
        $end = new DateTime($this->fechaf);
        $intervalDays=5;
        
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
                $productions = Http::post("https://api.greenexweb.cl/api/receptions?filter[fecha_g_recepcion][gte]=".$date['start']."&filter[fecha_g_recepcion][lte]=".$date['end']."&filter[n_especie][eq]=".$this->temporada->especie->name."&filter[id_exportadora][eq]=".$this->temporada->exportadora_id);
            } else {
                $productions = Http::post("https://api.greenexweb.cl/api/receptions?filter[fecha_g_recepcion][gte]=".$date['start']."&filter[fecha_g_recepcion][lte]=".$date['end']."&filter[n_especie][eq]=".$this->temporada->especie->name."&filter[id_exportadora][eq]=22");
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
                    $cantidad = $production['total_cantidad'] ?? null;
                    $peso_neto = $production['total_peso_neto'] ?? null;
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
        $intervalDays=2;

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
                $productions = Http::withToken('4|QcJlM0Cm8l5Csl81BNMykB93jMyFhG86CL0Uyj300801cbb8')
                    ->timeout(100) // Aumenta el tiempo de espera a 60 segundos
                    ->retry(3, 1000) // Reintenta hasta 3 veces, con 1 segundo de espera entre intentos
                    ->post("https://api.greenexweb.cl/api/productions/9", [
                        'filter' => [
                            'fecha_g_produccion' => [
                                'gte' => $date['start'],
                                'lte' => $date['end'],
                            ],
                            'n_especie' => ['eq' => $this->temporada->especie->name],
                            'id_exportadora' => ['eq' => $this->temporada->exportadora_id],
                        ]
                    ]);
            } else {
                $productions = Http::withToken('4|QcJlM0Cm8l5Csl81BNMykB93jMyFhG86CL0Uyj300801cbb8')
                    ->timeout(100) // Aumenta el tiempo de espera a 60 segundos
                    ->retry(3, 1000) // Reintenta hasta 3 veces, con 1 segundo de espera entre intentos
                    ->post("https://api.greenexweb.cl/api/productions/9", [
                        'filter' => [
                            'fecha_g_produccion' => [
                                'gte' => $date['start'],
                                'lte' => $date['end'],
                            ],
                            'n_especie' => ['eq' => $this->temporada->especie->name],
                            'id_exportadora' => ['eq' => 22],
                        ]
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
                    $c_productor_proceso = $production['c_productor_proceso'] ?? null;
                    $n_productor = $production['n_productor'] ?? null;
                    $t_categoria = $production['t_categoria'] ?? null;
                    $c_categoria = $production['c_categoria'] ?? null;
                    $c_embalaje = $production['c_embalaje'] ?? null;
                    $c_calibre = $production['c_calibre'] ?? null;
                    $c_serie = $production['c_serie'] ?? null;
                    $c_etiqueta = $production['c_etiqueta'] ?? null;
                    $n_etiqueta = $production['n_etiqueta'] ?? null;
                    $cantidad = $production['total_cantidad'] ?? null;
                    $peso_neto = $production['total_peso_neto'] ?? null;
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
                    $cont = Proceso::where('numero_g_produccion', $numero_g_produccion)
                        ->where('temporada_id', $this->temporada->id)
                        ->where('folio', $folio)
                        ->where('tipo_g_produccion', $tipo_g_produccion)
                        ->where('fecha_g_produccion', $fecha_g_produccion)
                        ->where('fecha_produccion', $fecha_produccion)
                        ->where('tipo', $tipo)
                        ->where('id_productor_proceso', $id_productor_proceso)
                        ->where('n_productor_proceso', $n_productor_proceso)
                        ->where('c_productor', $c_productor)
                        ->where('n_productor', $n_productor)
                        ->where('t_categoria', $t_categoria)
                        ->where('c_categoria', $c_categoria)
                        ->where('c_embalaje', $c_embalaje)
                        ->where('c_calibre', $c_calibre)
                        ->where('c_serie', $c_serie)
                        ->where('c_etiqueta', $c_etiqueta)
                        ->where('cantidad', $cantidad)
                        ->where('peso_neto', $peso_neto)
                        ->where('id_empresa', $id_empresa)
                        ->where('fecha_recepcion', $fecha_cosecha)
                        ->where('id_exportadora', $id_exportadora)
                        ->where('id_especie', $id_especie)
                        ->where('id_variedad', $id_variedad)
                        ->where('id_linea_proceso', $id_linea_proceso)
                        ->where('numero_guia_recepcion', $numero_guia_recepcion)
                        ->where('id_embalaje', $id_embalaje)
                        ->where('n_tipo_proceso', $n_tipo_proceso)
                        ->where('n_variedad_rotulacion', $n_variedad_rotulacion)
                        ->where('peso_std_embalaje', $peso_std_embalaje)
                        ->where('peso_standard', $peso_standard)
                        ->where('creacion_tipo', $creacion_tipo)
                        ->where('notas', $notas)
                        ->where('Estado', $estado)
                        ->where('destruccion_tipo', $destruccion_tipo)
                        ->first();
                
            
                    if ($cont) {
                        /*
                            Proceso::create([
                                'tipo_g_produccion' => $tipo_g_produccion,
                                'numero_g_produccion' => $numero_g_produccion,
                                'fecha_g_produccion' => $fecha_g_produccion,
                                'fecha_produccion' => $fecha_produccion,
                                'tipo' => $tipo,
                                'id_productor_proceso' => $id_productor_proceso,
                                'n_productor_proceso' => $n_productor_proceso,
                                'c_productor' => $c_productor,
                                'c_productor_proceso' => $c_productor_proceso,
                                'n_productor' => $n_productor,
                                't_categoria' => $t_categoria,
                                'c_categoria' => $c_categoria,
                                'c_embalaje' => $c_embalaje,
                                'c_calibre' => $c_calibre,
                                'c_serie' => $c_serie,
                                'c_etiqueta' => $c_etiqueta,
                                'n_etiqueta' => $n_etiqueta,
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
                        */
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
                            'c_productor_proceso' => $c_productor_proceso,
                            'n_productor' => $n_productor,
                            't_categoria' => $t_categoria,
                            'c_categoria' => $c_categoria,
                            'c_embalaje' => $c_embalaje,
                            'c_calibre' => $c_calibre,
                            'c_serie' => $c_serie,
                            'c_etiqueta' => $c_etiqueta,
                            'n_etiqueta' => $n_etiqueta,
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

            $this->temporada->update([  'proceso_end'=> $date['end']]);
            
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
        $intervalDays=3;

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
                        'select' => 'n_especie,fecha_produccion,r_productor,n_variedad,n_categoria,n_exportadora,id_exportadora_embarque,n_exportadora_embarque,id_pkg_stock_det,tipo_g_despacho,numero_g_despacho,fecha_g_despacho,id_empresa,id_exportadora,id_exportadora_embarque,c_destinatario,n_destinatario,n_transportista,folio,numero_guia_produccion,c_productor,n_productor,id_especie,id_variedad,id_embalaje,c_embalaje,n_embalaje,peso_std_embalaje,c_categoria,t_categoria,c_calibre,c_serie,c_etiqueta,cantidad,peso_neto,n_variedad_rotulacion,N_Pais_Destino,N_Puerto_Destino,contenedor,precio_unitario,tipo_interno,creacion_tipo,destruccion_tipo,Transporte,nota_calidad,n_nave,Numero_Embarque,N_Proceso,Estado'
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
                        'select' => 'n_especie,fecha_produccion,r_productor,n_variedad,n_categoria,n_exportadora,id_exportadora_embarque,n_exportadora_embarque,id_pkg_stock_det,tipo_g_despacho,numero_g_despacho,fecha_g_despacho,id_empresa,id_exportadora,id_exportadora_embarque,c_destinatario,n_destinatario,n_transportista,folio,numero_guia_produccion,c_productor,n_productor,id_especie,id_variedad,id_embalaje,c_embalaje,n_embalaje,peso_std_embalaje,c_categoria,t_categoria,c_calibre,c_serie,c_etiqueta,cantidad,peso_neto,n_variedad_rotulacion,N_Pais_Destino,N_Puerto_Destino,contenedor,precio_unitario,tipo_interno,creacion_tipo,destruccion_tipo,Transporte,nota_calidad,n_nave,Numero_Embarque,N_Proceso,Estado'
                    ]);
                    $productions = $productions->json(); 
            }
            
            
           
           

               

            $embarquesall=Embarque::where('temporada_id',$this->temporada->id)->get();

            if (!empty($productions)) {
                foreach ($productions as $despacho) {
                    
                    $id_pkg_stock_det = $despacho['id_pkg_stock_det'] ?? null;
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
                    $n_especie = $despacho['n_especie'] ?? null;
                    $id_variedad = $despacho['id_variedad'] ?? null;
                    $id_embalaje = $despacho['id_embalaje'] ?? null;
                    $c_embalaje = $despacho['c_embalaje'] ?? null;
                    $n_embalaje = $despacho['n_embalaje'] ?? null;
                    $peso_std_embalaje = $despacho['peso_std_embalaje'] ?? null;
                    $c_categoria = $despacho['c_categoria'] ?? null;
                    $t_categoria = $despacho['t_categoria'] ?? null;
                    $c_calibre = $despacho['c_calibre'] ?? null;
                    $n_calibre = $despacho['n_calibre'] ?? null;
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
                    $fecha_produccion = $despacho['fecha_produccion'] ?? null;
                    $r_productor = $despacho['r_productor'] ?? null;
                    $n_variedad = $despacho['n_variedad'] ?? null;
                    $n_categoria = $despacho['n_categoria'] ?? null;
                    $n_exportadora = $despacho['n_exportadora'] ?? null;
                    $id_exportadora_embarque = $despacho['id_exportadora_embarque'] ?? null;
                    $n_exportadora_embarque = $despacho['n_exportadora_embarque'] ?? null;

                    
            
                
                $existingDespacho = Despacho::where('id_pkg_stock_det', $id_pkg_stock_det)
                    ->where('numero_g_despacho', $numero_g_despacho)
                    ->where('tipo_g_despacho', $tipo_g_despacho)
                    ->where('folio', $folio)
                    ->where('fecha_g_despacho', $fecha_g_despacho)
                    ->where('peso_neto', $peso_neto)
                    ->where('creacion_tipo', $creacion_tipo)
                    ->where('c_productor', $c_productor)
                    ->where('id_embalaje', $id_embalaje)
                    ->where('Estado', $Estado)
                    ->first();

                if (!$existingDespacho) {
                        $masa=Despacho::create([
                            'temporada_id'=>$this->temporada->id,
                            'id_pkg_stock_det'=>$id_pkg_stock_det,
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
                            'n_especie' => $n_especie,
                            'id_variedad' => $id_variedad,
                            'id_embalaje' => $id_embalaje,
                            'c_embalaje' => $c_embalaje,
                            'n_embalaje' => $n_embalaje,
                            'peso_std_embalaje' => $peso_std_embalaje,
                            'c_categoria' => $c_categoria,
                            't_categoria' => $t_categoria,
                            'c_calibre' => $c_calibre,
                            'n_calibre' => $n_calibre,
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
                            'fecha_produccion' => $fecha_produccion,
                            'r_productor' => $r_productor,
                            'n_variedad' => $n_variedad,
                            'n_categoria' => $n_categoria,
                            'n_exportadora' => $n_exportadora,
                            'id_exportadora_embarque' => $id_exportadora_embarque,
                            'n_exportadora_embarque' => $n_exportadora_embarque,
                            'duplicado' => 'no',
                        ]);
                        /*
                            if ($embarquesall->where('numero_g_despacho',$masa->numero_g_despacho)->count()>0) {
                
                                foreach ($embarquesall->where('numero_g_despacho',$masa->numero_g_despacho) as $embarque){
                                    if($embarque->etd || $embarque->eta){
                                        $etd = $embarque->etd; // Supongamos que es una fecha en formato Y-m-d
                                        $eta = $embarque->eta;
                                        
                                        // Convertir las fechas a semanas del año
                                        $etdSemana = date('W', strtotime($etd));
                                        $etaSemana = date('W', strtotime($eta));
                
                
                                        $prodSemana = date('W', strtotime($masa->fecha_produccion));
                
                                        $etdSemana = date('W', strtotime($etd));
                                    
                                            if ($prodSemana>$etdSemana) {
                                                $diferenciadefechas=$etdSemana-$prodSemana+52;
                                            }else{
                                                $diferenciadefechas=$etdSemana-$prodSemana;
                                            }
                                        // Luego puedes guardar esas semanas en tu base de datos
                                        $masa->update([
                                            'semana' => $etdSemana,  // Mantienes la fecha original si es necesario
                                            'etd' => $etd,  // Mantienes la fecha original si es necesario
                                            'eta' => $eta,
                                            'etd_semana' => $etdSemana,  // Guardas la semana calculada
                                            'eta_semana' => $etaSemana,
                                            'control_fechas'=>$diferenciadefechas
                                        ]);
                
                                                    break;
                                    }
                                }
                            } else {
                
                                $etdSemana = date('W', strtotime($masa->fecha_g_despacho));
                
                
                                $prodSemana = date('W', strtotime($masa->fecha_produccion));
                            
                                    if ($prodSemana>$etdSemana) {
                                        $diferenciadefechas=$etdSemana-$prodSemana+52;
                                    }else{
                                        $diferenciadefechas=$etdSemana-$prodSemana;
                                    }
                                
                            
                
                                $masa->update([
                                    'etd' => $masa->fecha_g_despacho,  // Mantienes la fecha original si es necesario
                                    'etd_semana' => $etdSemana,  // Guardas la semana calculada
                                    'semana' => $etdSemana,
                                    'control_fechas'=>$diferenciadefechas
                                ]);
                            }
                        */
                    }else{
                        /*
                        $existingDespacho->update([
                            'temporada_id'=>$this->temporada->id,
                            'id_pkg_stock_det'=>$id_pkg_stock_det,
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
                            'n_especie' => $n_especie,
                            'id_variedad' => $id_variedad,
                            'id_embalaje' => $id_embalaje,
                            'c_embalaje' => $c_embalaje,
                            'peso_std_embalaje' => $peso_std_embalaje,
                            'c_categoria' => $c_categoria,
                            't_categoria' => $t_categoria,
                            'c_calibre' => $c_calibre,
                            'n_calibre' => $n_calibre,
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
                            'fecha_produccion' => $fecha_produccion,
                            'r_productor' => $r_productor,
                            'n_variedad' => $n_variedad,
                            'n_categoria' => $n_categoria,
                            'n_exportadora' => $n_exportadora,
                            'id_exportadora_embarque' => $id_exportadora_embarque,
                            'n_exportadora_embarque' => $n_exportadora_embarque,
                            'duplicado' => 'si',
                        ]);*/
                    }
            
                    
                }
            }
            


            
        }

        $this->temporada->update([  'recepcion_start'=> new DateTime($this->fechai),
                                    'recepcion_end'=> new DateTime($this->fechaf)]);
        
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

    public function exportarExcel($costo)
    {
        $masastotal = Balancemasa::select([
            'c_productor',
        ])
        ->filter1($this->filters)
        ->where('temporada_id', $this->temporada->id)
        ->whereIn('exportadora', ['Greenex SpA', '22'])
        ->get();
    
        $unique_productores = $masastotal->pluck('c_productor')->unique();
    
        $subQuery = Razonsocial::select('rut', \DB::raw('MAX(id) as id'), \DB::raw('COUNT(DISTINCT csg) as csg_count'))
            ->where('name', 'like', '%'.$this->filters['razonsocial'].'%')
            ->groupBy('rut')
            ->whereIn('csg', $unique_productores);
    
        $razons = Razonsocial::joinSub($subQuery, 'sub', function($join) {
                        $join->on('razonsocials.id', '=', 'sub.id');
                    })
                    ->select('razonsocials.*', 'sub.csg_count')
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->get(); // usamos ->get() en lugar de ->paginate() para exportar todo
               
        
        $temporada = $this->temporada;

        return Excel::download(new RazonsocialCondicionExport($razons, $costo, $temporada), 'RazonsocialCondicionExport.xlsx');
    }

    public function embarques_refresh()
    {    $ri=Embarque::all();
        $totali=$ri->count();

        $dateRanges = [];
        /*
        if($totali>0){
            $ultimo = Despacho::orderBy('fecha_g_despacho', 'desc')->first();
            $start = new DateTime($ultimo->fecha_g_despacho); // Usa la fecha más reciente
        }else{
            $start = new DateTime($this->fechai);
        }*/

        $start = new DateTime($this->fechai);
        $end = new DateTime($this->fechaf);
        $intervalDays=3;

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
                    ->post("https://api.greenexweb.cl/api/shipments", [
                        'filter' => [
                            'fecha_embarque' => [
                                'gte' => $date['start'],
                                'lte' => $date['end'],
                            ]
                        ]
                    ]);
                $productions = $productions->json(); 
            } else {
                $productions = Http::timeout(60) // Aumenta el tiempo de espera a 60 segundos
                    ->retry(3, 1000) // Reintenta hasta 3 veces, con 1 segundo de espera entre intentos
                    ->post("https://api.greenexweb.cl/api/shipments", [
                        'filter' => [
                            'fecha_embarque' => [
                                'gte' => $date['start'],
                                'lte' => $date['end'],
                            ]
                        ]
                    ]);
                    $productions = $productions->json(); 
            }
            
            
           
           

               

          
            if (!empty($productions)) {
                foreach ($productions as $embarque) {
                    // Nuevas columnas relacionadas con embarques
                    $n_embarque = $embarque['n_embarque'] ?? null;
                    $fecha_embarque = $embarque['fecha_embarque'] ?? null;
                    $nave = $embarque['nave'] ?? null;
                    $transporte = $embarque['transporte'] ?? null;
                    $fecha_despacho = $embarque['fecha_despacho'] ?? null;
                    $numero_g_despacho = $embarque['numero_g_despacho'] ?? null;
                    $numero_guia_produccion = $embarque['numero_guia_produccion'] ?? null;
                    $etd = $embarque['etd'] ?? null;
                    $eta = $embarque['eta'] ?? null;
                
                    // Buscar despacho existente con las nuevas columnas
                    $existingDespacho = Embarque::where('n_embarque', $n_embarque)
                        ->where( 'temporada_id',$this->temporada->id)
                        ->where('numero_g_despacho', $numero_g_despacho)
                        ->where('transporte', $transporte)
                        ->where('nave', $nave)
                        ->where('fecha_embarque', $fecha_embarque)
                        ->first();
                
                    if (!$existingDespacho) {
                        Embarque::create([
                            'temporada_id' =>$this->temporada->id,
                            'n_embarque' => $n_embarque,
                            'fecha_embarque' => $fecha_embarque,
                            'nave' => $nave,
                            'transporte' => $transporte,
                            'fecha_despacho' => $fecha_despacho,
                            'numero_g_despacho' => $numero_g_despacho,
                            'numero_guia_produccion' => $numero_guia_produccion,
                            'etd' => $etd,
                            'eta' => $eta,
                            'duplicado' => 'no',
                        ]);
                    } else {
                        /*
                        $existingDespacho->update([
                            'n_embarque' => $n_embarque,
                            'fecha_embarque' => $fecha_embarque,
                            'nave' => $nave,
                            'transporte' => $transporte,
                            'fecha_despacho' => $fecha_despacho,
                            'numero_g_despacho' => $numero_g_despacho,
                            'numero_guia_produccion' => $numero_guia_produccion,
                            'etd' => $etd,
                            'eta' => $eta,
                            'duplicado' => 'si',
                        ]);
                        */
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
        $variedad->bi_color='bicolor';
        $variedad->save();
        $this->reset('variedadpacking');
        $this->render();
    }

    public function redcolor_destroy($id){
       
        $variedad=Variedad::find($id);
        $variedad->bi_color="rojo";
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
        $this->fechaetd=Balancemasa::find($masaid)->etd_semana;
    }

    public function save_masaid(){
        $masa=Balancemasa::find($this->masaid);
        $masa->update(['precio_fob'=>$this->preciomasa,
                        'etd_semana'=>$this->fechaetd]);    
        $this->reset(['preciomasa','masaid','fechaetd']);
        
    }

    public function set_fobid($fobid){
        $this->fobid=$fobid;
        $this->preciofob2=Fob::find($fobid)->fob_kilo_salida2;
        $this->preciofob3=Fob::find($fobid)->fob_kilo_salida3;
    }

    public function save_fobid(){
        $fob=Fob::find($this->fobid);
        if($this->preciofob2 || $this->preciofob3){
            $fob->update(['fob_kilo_salida2'=>$this->preciofob2,
                  'fob_kilo_salida3'=>$this->preciofob3]);
        }
      
        $this->reset(['preciofob2','preciofob3','fobid']);
        
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

        $masastotal = Balancemasa::select([
                    'n_variedad', 
                    'n_categoria', 
                    'cantidad', 
                    'peso_neto', 
                    'peso_neto2', 
                    'factor', 
                    'fob_id', 
                    'tipo_transporte', 
                    'c_embalaje', 
                    'c_productor',
                    'r_productor',
                    'etd',
                    'eta',
                    'semana',
                    'precio_unitario',
                    'n_calibre',
                    'peso_std_embalaje'
                ])
                ->filter1($this->filters)
                ->where('temporada_id', $this->temporada->id)
                ->whereIn('exportadora', ['Greenex SpA', '22'])
                ->get();

       foreach($masastotal as $masa){
            $variedad=Variedad::where('name',$masa->n_variedad)->first();
            if ($variedad){

            }else{
                $superespecie=Especie::where('name',$this->temporada->especie->name)->first();
                
                $supervariedad = Supervariedad::firstOrCreate(['name' => $masa->n_variedad,
                                                            'superespecie_id'=>$superespecie->id]);
                Variedad::create(['name'=>$masa->n_variedad,
                                'temporada_id'=>$this->temporada->id,
                                'bi_color'=>$supervariedad->bi_color]);
            }
       }
        
    }

    public function exportacion_destroy(Exportacion $exportacion){
        $exportacion->delete();
    }

    public function flete_destroy(Flete $flete){
        $flete->delete();
    }

    public function exportacion_store($costo_id){
        $rules = [
            'type'=>'required',
            'precio_usd'=>'required'
            
            ];
      
        $this->validate ($rules);

        Exportacion::create([
            'temporada_id'=>$this->temporada->id,
            'type'=>$this->type,
            'precio_usd'=>$this->precio_usd,
            'costo_id'=>$costo_id   
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
