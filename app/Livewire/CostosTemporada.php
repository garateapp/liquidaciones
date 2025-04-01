<?php

namespace App\Livewire;

use App\Imports\PackingCodeImport;
use App\Models\Balancemasa;
use App\Models\Costoembalajecode;
use App\Models\Costomenu;
use App\Models\Costotarifacolor;
use App\Models\Exception;
use App\Models\Exportacion;
use App\Models\Razonsocial;
use App\Models\Temporada;
use App\Models\Variedad;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CostosTemporada extends Component
{   public $temporada, $costomenu,$formcolor, $variedadpacking,$ctd=25; 
    public $sortBy = 'sub.csg_count'; // Columna por defecto para ordenar
    public $sortByProc = 'id'; // Columna por defecto para ordenar
    public $sortDirection = 'desc'; // Dirección por defecto (descendente)
    protected $listeners = ['tarifaActualizada' => '$refresh'];

    use WithFileUploads;

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

    

    public function mount(Temporada $temporada, Costomenu $costomenu){
        $this->temporada=$temporada;
        $this->costomenu=$costomenu;

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

        
        return view('livewire.costos-temporada',compact('costomenus','exportacions','unique_variedades','razons'));
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
    
}
