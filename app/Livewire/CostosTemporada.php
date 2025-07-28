<?php

namespace App\Livewire;

use App\Exports\RazonsocialCondicionExport;
use App\Imports\PackingCodeImport;
use App\Imports\RazonCondicionImport;
use App\Models\Balancemasa;
use App\Models\Costo;
use App\Models\Costoembalajecode;
use App\Models\Costomenu;
use App\Models\Costotarifacaja;
use App\Models\Costotarifacolor;
use App\Models\Costotarifakilo;
use App\Models\Exception;
use App\Models\Exportacion;
use App\Models\Razonsocial;
use App\Models\Temporada;
use App\Models\Variedad;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CodigoEmbalajeExport;
use App\Exports\PackingcodeExport;
use App\Models\Categoria;
use App\Models\CostoCategoria;
use App\Models\Costoporcentajefob;
use App\Models\Proceso;

class CostosTemporada extends Component
{   public $temporada, $costomenu,$formcolor, $variedadpacking,$ctd=25, $type, $precio_usd; 
    public $sortBy = 'sub.csg_count'; // Columna por defecto para ordenar
    public $sortByProc = 'id'; // Columna por defecto para ordenar
    public $sortDirection = 'desc'; // Dirección por defecto (descendente)
    protected $listeners = ['tarifaActualizada' => '$refresh'];
    public $tarifa_caja_input = [];
    use WithFileUploads;
    public $edit_tarifa_id = null;
    public $edit_tarifa_value = [];
    public $archivo, $procesando = false;
    public $archivoCostoId = null;
    // NUEVAS PROPIEDADES
    public $tarifa_kg_input = [];
    public $edit_tarifa_kg_id = null;
    public $edit_tarifa_kg_value = [];
    public $nuevo_porcentaje;
    public $costoporcentajefobs;
    public $categoria_id, $costo_por_kg, $total_kgs, $monto_total;

    public function updatedArchivo()
    {
        $this->procesando = true;

        $this->validate([
            'archivo' => 'required|file|mimes:xlsx,xls,csv',
        ]);
        
        // Asegúrate de tener asignado el costo_id antes
        if ($this->archivoCostoId) {
          
            Excel::import(new RazonCondicionImport($this->temporada->id, $this->archivoCostoId), $this->archivo);

           
        } else {
            session()->flash('error', 'Debe seleccionarse un Costo válido.');
        }

        $this->reset(['archivo', 'archivoCostoId', 'procesando']);
    }


    public $tarifas = [];

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

    #[Url]

    public $file;

    

    public function mount(Temporada $temporada, Costomenu $costomenu){
        $this->temporada=$temporada;
        $this->costomenu=$costomenu;
        $this->cargarPorcentajesFob();
        $masastotal2=Balancemasa::select(['n_etiqueta'])->where('temporada_id',$this->temporada->id)->whereIn('exportadora', ['Greenex SpA', '22'])->get();

        $this->filters['etiquetas'] = $masastotal2->pluck('n_etiqueta')->unique()->sort()->values()->all();

        $this->filters['notfolios'] = Exception::where('temporada_id',$this->temporada->id)->pluck('item')->unique()->sort()->values()->all();
    
    }
    public function render()
    {   $costomenus=Costomenu::all();
        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->get();
        $unique_variedades = Variedad::where('temporada_id',$this->temporada->id)->get();
        
       

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

        $unique_productores = $masastotal->pluck('c_productor')->unique();

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

                $costotarifacajas = Costotarifacaja::where('temporada_id', $this->temporada->id ?? null)->get();
                $costotarifakilos = Costotarifakilo::where('temporada_id', $this->temporada->id ?? null)->get();
                $costocategorias = CostoCategoria::where('temporada_id', $this->temporada->id ?? null)->get();
        return view('livewire.costos-temporada',compact('costocategorias','costomenus','exportacions','unique_variedades','razons','costotarifacajas','costotarifakilos'));
    }

    public function importFile($costo_id)
    {
        // Validar el archivo
        $this->validate([
            'file' => 'required|mimes:csv,xlsx',  // Validación del archivo
        ]);

        // Eliminar los registros existentes para la combinación de temporada_id y costo_id
        Costoembalajecode::where('temporada_id', $this->temporada->id)
            ->where('costo_id', $costo_id)
            ->delete();

        // Importar el archivo
        Excel::import(new PackingCodeImport($this->temporada->id, $costo_id), $this->file);

        // Limpiar el archivo cargado después de la importación
        $this->reset('file');

        // Emitir evento para actualizar la vista
        $this->dispatch('fileImported');
    }

    public function agregarCostoCategoria($costoid)
    {
        $this->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'costo_por_kg' => 'required|numeric',
            'total_kgs' => 'required|numeric',
            'monto_total' => 'required|numeric',
        ]);
        //dd($this->costo_por_kg);
        CostoCategoria::create([
            'temporada_id' => $this->temporada->id ?? null,
            'costo_id' => $costoid,
            'categoria_id' => $this->categoria_id,
            'costo_por_kg' => $this->costo_por_kg,
            'total_kgs' => $this->total_kgs,
            'monto_total' => $this->monto_total,
        ]);

        $this->reset(['categoria_id', 'costo_por_kg', 'total_kgs', 'monto_total']);
    }

    public function getCategoriasProperty()
    {
        return Categoria::orderBy('nombre')->get();
    }

    public function eliminarCostoCategoria($id)
    {
        CostoCategoria::find($id)?->delete();
    }


    public function saveTarifa($color, $costo_id)
    {
        // Validar que haya un valor ingresado
        if (!isset($this->tarifas[$color]) || empty($this->tarifas[$color])) {
            session()->flash('error', 'Debe ingresar una tarifa.');
            return;
        }

        $tarifa_kg = $this->tarifas[$color];

        // Guardar en la base de datos
        Costotarifacolor::updateOrCreate(
            ['temporada_id'=>$this->temporada->id,
            'color' => $color, 
            'costo_id' => $costo_id],
            ['tarifa_kg' => $tarifa_kg]
        );

        // Limpiar input después de guardar
        unset($this->tarifas[$color]);

        // Emitir evento para actualizar la vista
        $this->dispatch('tarifaActualizada');

    }

    public function destroy_costotarifacolor(Costotarifacolor $costotarifacolor){
        $costotarifacolor->delete();
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
    
    public function cargarPorcentajesFob()
    {
        $this->costoporcentajefobs = Costoporcentajefob::all();
    }

    public function agregarCostoPorcentajeFob($costo_id)
    {
        Costoporcentajefob::create([
            'temporada_id' => $this->temporada->id ?? null,
            'costo_id' => $costo_id,
            'porcentaje' => $this->nuevo_porcentaje,
        ]);

        $this->nuevo_porcentaje = null;
        $this->cargarPorcentajesFob();
    }

    public function eliminarCostoPorcentajeFob($id)
    {
        Costoporcentajefob::find($id)?->delete();
        $this->cargarPorcentajesFob();
    }

    public function updatedCategoriaId()
    {
        if ($this->categoria_id) {
            $categoria = $this->categorias->firstWhere('id', $this->categoria_id);
            //dd($categoria);
            $this->total_kgs = Proceso::where('temporada_id', $this->temporada->id)
                ->where('c_categoria', $categoria?->codigo)
                ->sum('peso_neto');
        } else {
            $this->total_kgs = null;
        }
    }

    public function updatedMontoTotal()
    {
        if ($this->total_kgs > 0 && $this->monto_total) {
            $this->costo_por_kg = ($this->monto_total / $this->total_kgs);
        } else {
            $this->costo_por_kg = null;
        }
    }


    public function storeTarifaCaja($costoId)
    {
        $this->validate([
            "tarifa_caja_input.$costoId" => 'required|numeric|min:0',
        ]);

        Costotarifacaja::create([
            'costo_id' => $costoId,
            'temporada_id' => $this->temporada->id ?? null,
            'tarifa_caja' => $this->tarifa_caja_input[$costoId],
        ]);

        unset($this->tarifa_caja_input[$costoId]);
        $this->dispatch('alert', type: 'success', message: 'Tarifa agregada.');

    }

    public function destroyTarifaCaja($id)
    {
        Costotarifacaja::find($id)?->delete();
        $this->dispatch('alert', type: 'success', message: 'Tarifa eliminada.');

    }


    public function editTarifaCaja($id)
    {
        $caja = Costotarifacaja::findOrFail($id);
        $this->edit_tarifa_id = $caja->id;
        $this->edit_tarifa_value[$caja->id] = $caja->tarifa_caja;
    }

    public function updateTarifaCaja($id)
    {
        $this->validate([
            "edit_tarifa_value.$id" => 'required|numeric|min:0',
        ]);

        $caja = Costotarifacaja::findOrFail($id);
        $caja->tarifa_caja = $this->edit_tarifa_value[$id];
        $caja->save();

        $this->edit_tarifa_id = null;
        $this->dispatch('alert', type: 'success', message: 'Tarifa actualizada.');
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

    public function variedadcolor_add(){
        $rules = [
            'variedadpacking'=>'required',
            ];
        $this->validate ($rules);

        $variedad=Variedad::find($this->variedadpacking);
        $variedad->bi_color=$this->formcolor;
        $variedad->save();

        $this->reset('variedadpacking');
        $this->render();
    }

    public function redcolor_destroy($id){
       
        $variedad=Variedad::find($id);
        $variedad->bi_color=null;
        $variedad->save();
    }

    
    // GUARDAR
    public function storeTarifaKilo($costoId)
    {
        $this->validate([
            "tarifa_kg_input.$costoId" => 'required|numeric|min:0',
        ]);

        $existe = Costotarifakilo::where('costo_id', $costoId)
            ->where('temporada_id', $this->temporada->id ?? null)
            ->exists();

        if ($existe) {
            $this->dispatch('alert', type: 'warning', message: 'Ya existe una tarifa por kilo para esta temporada.');
            return;
        }

        Costotarifakilo::create([
            'costo_id' => $costoId,
            'temporada_id' => $this->temporada->id ?? null,
            'tarifa_kg' => $this->tarifa_kg_input[$costoId],
        ]);

        unset($this->tarifa_kg_input[$costoId]);

        $this->dispatch('alert', type: 'success', message: 'Tarifa por kilo agregada.');
    }



    public function descargarPlantilla($costoId)
    {
        $costo = Costo::findOrFail($costoId);

        return Excel::download(new PackingcodeExport($this->temporada->id, $costoId), 'plantilla_codigos_embalaje.xlsx');
    }
    // EDITAR
    public function editTarifaKilo($id)
    {
        $kilo = \App\Models\Costotarifakilo::findOrFail($id);
        $this->edit_tarifa_kg_id = $kilo->id;
        $this->edit_tarifa_kg_value[$id] = $kilo->tarifa_kg;
    }

    // ACTUALIZAR
    public function updateTarifaKilo($id)
    {
        $this->validate([
            "edit_tarifa_kg_value.$id" => 'required|numeric|min:0',
        ]);

        $kilo = \App\Models\Costotarifakilo::findOrFail($id);
        $kilo->tarifa_kg = $this->edit_tarifa_kg_value[$id];
        $kilo->save();

        $this->edit_tarifa_kg_id = null;

        $this->dispatch('alert', type: 'success', message: 'Tarifa actualizada.');
    }

    // ELIMINAR
    public function destroyTarifaKilo($id)
    {
        \App\Models\Costotarifakilo::find($id)?->delete();
        $this->dispatch('alert', type: 'success', message: 'Tarifa eliminada.');
    }

    
    public function exportacion_destroy(Exportacion $exportacion){
        $exportacion->delete();
    }
}
