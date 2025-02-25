<?php

namespace App\Livewire;

use App\Exports\FleteExport;
use App\Exports\MaterialExport;
use App\Exports\PackingcodeExport;
use App\Models\Balancemasa;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Despacho;
use App\Models\Embarque;
use App\Models\Especie;
use App\Models\Exportacion;
use App\Models\Familia;
use App\Models\Flete;
use App\Models\Fob;
use App\Models\Gasto;
use App\Models\Material;
use App\Models\Resumen;
use App\Models\Superespecie;
use App\Models\Supervariedad;
use App\Models\Temporada;
use App\Models\Variedad;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class MainUpload extends Component
{   public $familia,$unidad, $item, $descuenta, $categoria, $temporada,$type,$precio_usd, $etiqueta, $empresa, $valor,$vista;

    public function mount(Temporada $temporada,$vista){
        $this->temporada=$temporada;
        $this->vista=$vista;
    }
    public function render()
    {   $materiales=Material::where('temporada_id',$this->temporada->id)->get();
        $resumes=Resumen::where('temporada_id',$this->temporada->id)->get();
        $CostosPackings=CostoPacking::where('temporada_id',$this->temporada->id)->get();
        $exportacions=Exportacion::where('temporada_id',$this->temporada->id)->get();
        $fletes=Flete::where('temporada_id',$this->temporada->id)->get();
        $comisions=Comision::where('temporada_id',$this->temporada->id)->get();
        $familias=Familia::where('status','active')->get();
       
        return view('livewire.main-upload',compact('familias','materiales','resumes','CostosPackings','exportacions','fletes','comisions'));
    }

    public function packingcode_export(Temporada $temporada)
    {   
        return Excel::download(new PackingcodeExport($temporada->id),'Packing_Code.xlsx');
    }

    public function material_export(Temporada $temporada)
    {   
        return Excel::download(new MaterialExport($temporada->id),'Codigo_Materiales.xlsx');
    }

    public function flete_export(Temporada $temporada)
    {   
        return Excel::download(new FleteExport($temporada->id),'Flete_a_huerto.xlsx');
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

    public function despachoImport(){
        $despachos = Despacho::where('temporada_id', $this->temporada->id)
            ->select([
                'tipo_g_despacho', 
                'numero_g_despacho', 
                'fecha_g_despacho', 
                'folio', 
                'r_productor', 
                'c_productor', 
                'n_productor', 
                'n_especie', 
                'n_variedad', 
                'c_embalaje', 
                'n_embalaje', 
                'n_categoria', 
                't_categoria', 
                'n_calibre', 
                'c_etiqueta', 
                'cantidad', 
                'peso_neto', 
                'Transporte', 
                'n_exportadora', 
                'n_exportadora_embarque',
                'id_empresa',
                'c_etiqueta',
                'id_variedad',
                'c_calibre',
                'c_categoria',
                'numero_guia_produccion',
                'fecha_produccion',
                'peso_std_embalaje',
                'semana',
                'etd',
                'eta',
                'etd_semana',
                'eta_semana',
                'control_fechas',
                'precio_unitario'
            ])
            ->get();
        $n=0;
        foreach($despachos as $despacho) {
            $n+=1;
            Balancemasa::create([
                'temporada_id'             => $this->temporada->id,
                'tipo_g_despacho'        => $despacho->tipo_g_despacho ?? '',
                'numero_g_despacho'      => $despacho->numero_g_despacho ?? '',
                'fecha_g_despacho'    => $despacho->fecha_g_despacho ?? '',
                'semana'                   => $despacho->semana ?? null,
                'folio'                    => $despacho->folio ?? '',
                'r_productor'              => $despacho->r_productor ?? '',
                'c_productor'              => $despacho->c_productor ?? '',
                'n_productor'              => $despacho->n_productor ?? '',
                'n_especie'                => $despacho->n_especie ?? '',
                'n_variedad'               => $despacho->n_variedad ?? '',
                'c_embalaje'               => $despacho->c_embalaje ?? '',
                'n_embalaje'               => $despacho->n_embalaje ?? '',
                'n_categoria'              => $despacho->n_categoria ?? '',
                't_categoria'              => $despacho->t_categoria ?? '',
                'n_calibre'                => $despacho->n_calibre ?? '',
                'n_etiqueta'               => $despacho->c_etiqueta ?? '',
                'cantidad'                 => $despacho->cantidad ?? '',
                'peso_neto'                => $despacho->peso_neto ?? '',
                'tipo_transporte'          => $despacho->Transporte ?? '',
                'exportadora'              => $despacho->n_exportadora ?? '',
                'exportadora_embarque'     => $despacho->n_exportadora_embarque ?? '',

                'id_empresa'               => $despacho->id_empresa ?? '',
                'c_etiqueta'               => $despacho->c_etiqueta ?? '',
                'id_variedad'              => $despacho->id_variedad ?? '',
                'c_calibre'                => $despacho->c_calibre ?? '',
                'c_categoria'              => $despacho->c_categoria ?? '',
                'numero_guia_produccion'   => $despacho->numero_guia_produccion ?? '',
                'fecha_produccion'         => $despacho->fecha_produccion ?? '',
                'peso_std_embalaje'        => $despacho->peso_std_embalaje ?? '',
                'etd'                      => $despacho->etd ?? null,
                'eta'                      => $despacho->eta ?? null,
                'etd_semana'               => $despacho->etd_semana ?? '',   
                'eta_semana'               => $despacho->eta_semana ?? '',
                'control_fechas'          => $despacho->control_fechas ?? '',
                'precio_unitario'          => $despacho->precio_unitario ?? '',
                'color'                    => str_ends_with($despacho->c_calibre ?? '', 'D') ? 'Dark' : 'Light',
                
            ]);
        }
        
        $masas=Balancemasa::where('temporada_id',$this->temporada->id)->get();
        foreach($masas as $masa){
            $variedad=Variedad::where('name',$masa->n_variedad)->where('temporada_id',$this->temporada->id)->first();
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

        return redirect()->route('temporada.balancemasa',$this->temporada)->with('info','Importación realizada con exito ('.$n.')');
       // return redirect()->back();
        
    }

    public function fobImport(){

       
        // Parte 1: Agregar la columna `etd` a los despachos
        $despachos =  Despacho::where('temporada_id', $this->temporada->id)
            ->whereNotNull('c_calibre') // Asegura que c_calibre no sea nulo
            ->select([
                'semana',
                'c_etiqueta', 
                'n_variedad', 
                'c_calibre',
                'c_categoria',
                'c_embalaje',
                DB::raw('AVG(precio_unitario) as precio_promedio'),
               
            ])
            ->groupBy([
                'semana',
                'c_etiqueta',
                'n_variedad',
                'c_calibre',
                'c_categoria',
                'c_embalaje'
            ])
            ->get();
        

        $despachos = $despachos->map(function ($despacho) {
                $despacho->color = str_ends_with($despacho->c_calibre, 'D') ? 'Dark' : 'Light';
                return $despacho;
            });

                
        
        // Parte 3: Crear los registros de FOB
        $n=0;
        foreach ($despachos as $agrupado) {
            
            $n+=1;
            
            if($agrupado['c_etiqueta']!=""){
                $etiqueta=$agrupado['c_etiqueta'];
            }else{
                $etiqueta="vacia";
            }
                
                Fob::create([
                    'temporada_id' => $this->temporada->id,
                    'semana' => $agrupado['semana'],        // Semana calculada
                    'etiqueta' => $etiqueta,  // Etiqueta
                    'n_variedad' => $agrupado['n_variedad'],// Variedad
                    'n_calibre' => $agrupado['c_calibre'],  // Calibre
                    'categoria' => $agrupado['c_categoria'],// Categoría
                    'embalaje' => $agrupado['c_embalaje'],     // Embalaje
                    'color'=> $agrupado['color'],
                    'fob_kilo_salida' => $agrupado['precio_promedio'], // Precio promedio
                ]);
                
           
        }
                

        return redirect()->route('temporada.fob',$this->temporada)->with('info','Importación realizada con exito ('.$n.')');
       // return redirect()->back();
        
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
