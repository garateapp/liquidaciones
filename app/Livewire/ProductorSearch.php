<?php

namespace App\Livewire;

use App\Models\Razonsocial;
use Livewire\Component;
use Livewire\WithPagination;

class ProductorSearch extends Component
{   use WithPagination;
    public $ctd=25;
    public $search = ''; // Término de búsqueda

    public function render()
    {   $subQuery = Razonsocial::select('rut', \DB::raw('MAX(id) as id'), \DB::raw('COUNT(DISTINCT csg) as csg_count'))
        ->where('name', 'like', '%'.$this->search.'%')
        ->groupBy('rut');

        $razons = Razonsocial::joinSub($subQuery, 'sub', function($join) {
                    $join->on('razonsocials.id', '=', 'sub.id');
                })
                ->select('razonsocials.*', 'sub.csg_count') // Agrega la columna csg_count
                ->orderBy('sub.csg_count', 'desc') // Ordena por csg_count en orden descendente
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
}
