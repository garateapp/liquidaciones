<?php

namespace App\Livewire;

use App\Models\Balancemasa;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Despacho;
use App\Models\Embarque;
use App\Models\Exportacion;
use App\Models\Familia;
use App\Models\Flete;
use App\Models\Fob;
use App\Models\Gasto;
use App\Models\Material;
use App\Models\Resumen;
use App\Models\Temporada;
use App\Models\Variedad;
use Livewire\Component;

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
                'fecha_produccion'
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
                'semana'                   => $despacho->semana ?? '',
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
                
            ]);
        }
        
        $masas=Balancemasa::where('temporada_id',$this->temporada->id)->get();
        foreach($masas as $masa){
            $variedad=Variedad::where('name',$masa->n_variedad)->where('temporada_id',$this->temporada->id)->first();
            if ($variedad){
                
            }else{
                Variedad::create(['name'=>$masa->n_variedad,
                                'temporada_id'=>$this->temporada->id]);
            }
       }

        return redirect()->route('temporada.balancemasa',$this->temporada)->with('info','Importación realizada con exito ('.$n.')');
       // return redirect()->back();
        
    }

    public function fobImport(){

        $embarquesall = Embarque::where('temporada_id', $this->temporada->id)->get();

        // Parte 1: Agregar la columna `etd` a los despachos
        $despachosConEtd = Despacho::where('temporada_id', $this->temporada->id)
            ->select([
                'c_etiqueta', 
                'n_variedad', 
                'c_calibre',
                'c_categoria',
                'c_embalaje', 
                'numero_g_despacho',
                'precio_unitario'
            ])
            ->get()
            ->map(function ($despacho) use ($embarquesall) {
                $embarque = $embarquesall->firstWhere('numero_g_despacho', $despacho->numero_g_despacho);
                $despacho->etd = $embarque->etd ?? null; // Agrega `etd` si existe en embarques
                return $despacho;
            });
        
        // Parte 2: Agrupar por combinación de FOB y calcular el promedio, excluyendo los registros nulos
        $despachosAgrupados = $despachosConEtd->filter(function ($despacho) {
            // Excluye despachos con valores nulos en cualquier columna clave
            return !is_null($despacho->c_etiqueta) &&
                   !is_null($despacho->n_variedad) &&
                   !is_null($despacho->c_calibre) &&
                   !is_null($despacho->c_categoria) &&
                   !is_null($despacho->c_embalaje);
        })->groupBy(function ($despacho) {
            return implode('|', [
                $despacho->c_etiqueta,
                $despacho->n_variedad,
                $despacho->c_calibre,
                $despacho->c_categoria,
                $despacho->c_embalaje
            ]);
        })->map(function ($grupo) {
            $promedio = $grupo->avg('precio_unitario'); // Calcula el promedio
            $primerDespacho = $grupo->first(); // Toma el primer despacho como referencia
        
            return [
                'etd' => $primerDespacho->etd,
                'semana' => $primerDespacho->etd ? date('W', strtotime($primerDespacho->etd)) : null,
                'c_etiqueta' => $primerDespacho->c_etiqueta,
                'n_variedad' => $primerDespacho->n_variedad,
                'c_calibre' => $primerDespacho->c_calibre,
                'c_categoria' => $primerDespacho->c_categoria,
                'c_embalaje' => $primerDespacho->c_embalaje,
                'precio_promedio' => $promedio
            ];
        });
        
        // Parte 3: Crear los registros de FOB
        $n=0;
        foreach ($despachosAgrupados as $agrupado) {
            $n+=1;

            if ($agrupado['c_calibre']=='4J' || $agrupado['c_calibre']=='4JD' || $agrupado['c_calibre']=='4JDD'){
            
                if ($agrupado['c_calibre']=='4JD' || $agrupado['c_calibre']=='4JDD'){
                    $color='Dark';
                }else{
                $color='Light';
                }
            }
            if ($agrupado['c_calibre']=='3J' || $agrupado['c_calibre']=='3JD' || $agrupado['c_calibre']=='3JDD'){
              

                if ($agrupado['c_calibre']=='3JD' || $agrupado['c_calibre']=='3JDD'){
                    $color='Dark';
                }else{
                $color='Light';
                }
            }
            if ($agrupado['c_calibre']=='2J' || $agrupado['c_calibre']=='2JD' || $agrupado['c_calibre']=='2JDD'){
             
                if ($agrupado['c_calibre']=='2JD' || $agrupado['c_calibre']=='2JDD'){
                        $color='Dark';
                
                }else{
                    $color='Light';
                }
            }
            if ($agrupado['c_calibre']=='J' || $agrupado['c_calibre']=='JD' || $agrupado['c_calibre']=='JDD'){
              
                if ($agrupado['c_calibre']=='JD' || $agrupado['c_calibre']=='JDD'){
                        $color='Dark';
                }else{
                    $color='Light';
                }
            }
            if ($agrupado['c_calibre']=='XL' || $agrupado['c_calibre']=='XLD' || $agrupado['c_calibre']=='XLDD'){
              
                if ($agrupado['c_calibre']=='XLD' || $agrupado['c_calibre']=='XLDD'){
                    $color='Dark';
                }else{
                $color='Light';
                }
            }

            Fob::create([
                'temporada_id' => $this->temporada->id,
                'semana' => $agrupado['semana'],        // Semana calculada
                'etiqueta' => $agrupado['c_etiqueta'],  // Etiqueta
                'n_variedad' => $agrupado['n_variedad'],// Variedad
                'n_calibre' => $agrupado['c_calibre'],  // Calibre
                'categoria' => $agrupado['c_categoria'],// Categoría
                'embalaje' => $agrupado['c_embalaje'],     // Embalaje
                'color'=> $color,
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
