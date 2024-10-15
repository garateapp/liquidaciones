<?php

namespace App\Livewire;

use App\Models\Balancemasa;
use App\Models\Comision;
use App\Models\CostoPacking;
use App\Models\Despacho;
use App\Models\Exportacion;
use App\Models\Familia;
use App\Models\Flete;
use App\Models\Gasto;
use App\Models\Material;
use App\Models\Resumen;
use App\Models\Temporada;
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
                'semana', 
                'folio', 
                'r_productor', 
                'c_productor', 
                'n_productor', 
                'n_especie', 
                'n_variedad', 
                'c_embalaje', 
                'id_embalaje', 
                'n_categoria', 
                't_categoria', 
                'n_calibre', 
                'c_etiqueta', 
                'cantidad', 
                'peso_neto', 
                'Transporte', 
                'n_exportadora', 
                'n_exportadora_embarque'
            ])
            ->get();
        $n=0;
        foreach($despachos as $despacho) {
            $n+=1;
            Balancemasa::create([
                'temporada_id'             => $this->temporada->id,
                'tipo_g_produccion'        => $despacho->tipo_g_despacho ?? '',
                'numero_g_produccion'      => $despacho->numero_g_despacho ?? '',
                'fecha_g_produccion_sh'    => $despacho->fecha_g_despacho ?? '',
                'semana'                   => $despacho->semana ?? '',
                'folio'                    => $despacho->folio ?? '',
                'r_productor'              => $despacho->r_productor ?? '',
                'c_productor'              => $despacho->c_productor ?? '',
                'n_productor'              => $despacho->n_productor ?? '',
                'n_especie'                => $despacho->n_especie ?? '',
                'n_variedad'               => $despacho->n_variedad ?? '',
                'c_embalaje'               => $despacho->c_embalaje ?? '',
                'n_embalaje'               => $despacho->id_embalaje ?? '',
                'n_categoria'              => $despacho->n_categoria ?? '',
                't_categoria'              => $despacho->t_categoria ?? '',
                'n_calibre'                => $despacho->n_calibre ?? '',
                'n_etiqueta'               => $despacho->c_etiqueta ?? '',
                'cantidad'                 => $despacho->cantidad ?? '',
                'peso_neto'                => $despacho->peso_neto ?? '',
                'tipo_transporte'          => $despacho->Transporte ?? '',
                'exportadora'              => $despacho->n_exportadora ?? '',
                'exportadora_embarque'     => $despacho->n_exportadora_embarque ?? '',
            ]);
        }
    

        return redirect()->route('temporada.balancemasa',$this->temporada)->with('info','Importación realizada con exito ('.$n.')');
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
