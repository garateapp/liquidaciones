<?php

namespace App\Livewire;

use App\Models\Balancemasa;
use App\Models\Razonsocial;
use App\Models\Recepcion;
use App\Models\Temporada;
use Livewire\Component;
use Livewire\WithPagination;

class ProductorSearch extends Component
{   use WithPagination;
    public $ctd=25, $temporadas,$selectedSeason;
    public $search = ''; // Término de búsqueda
    public $sortBy = 'sub.csg_count'; // Columna por defecto para ordenar
    public $sortDirection = 'desc'; // Dirección por defecto (descendente)

    public function mount()
    {
        // Cargar las temporadas disponibles
        $this->temporadas = Temporada::all(); // Asegúrate de tener un modelo Season
    }

    public function render()
    {   $subQuery = Razonsocial::select('rut', \DB::raw('MAX(id) as id'), \DB::raw('COUNT(DISTINCT csg) as csg_count'))
        ->where('name', 'like', '%'.$this->search.'%')
        ->groupBy('rut');
    
        if ($this->selectedSeason) {
            $masastotal = Recepcion::where('temporada_id', $this->selectedSeason)
                ->get();
        
            $unique_productores = $masastotal->pluck('c_productor')->unique();
            
            $subQuery->whereIn('csg', $unique_productores);
        }
        
        $razons = Razonsocial::joinSub($subQuery, 'sub', function($join) {
                    $join->on('razonsocials.id', '=', 'sub.id');
                })
                ->select('razonsocials.*', 'sub.csg_count')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->ctd);

        $subQuery2 = Razonsocial::select('rut', \DB::raw('MAX(id) as id'))
            ->groupBy('rut');

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

        return view('livewire.productor-search',compact('razons','razonsall','razonsallresult'));
    }

    public function updatedSearch()
    {
        $this->resetPage(); // Resetea la página actual a la primera página
    }

    // Función que se ejecuta cuando se selecciona una temporada
    public function updatedSelectedSeason($value)
    {
        $this->selectedSeason = $value;
        $this->resetPage(); // Reinicia la paginación si cambia el filtro
    }

}
