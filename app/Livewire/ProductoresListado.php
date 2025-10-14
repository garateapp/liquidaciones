<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Balancemasa;
use App\Models\Razonsocial;
use Maatwebsite\Excel\Facades\Excel;

class ProductoresListado extends Component
{
    use WithPagination, WithFileUploads;

    public $temporada;                 // Modelo/obj con ->id
    public string $buscar = '';        // búsqueda por nombre
    public int $perPage = 25;          // por página
    public string $sortDirection = 'asc'; // asc|desc

    public $archivo; // UploadedFile para importar

    protected $paginationTheme = 'tailwind';

    public function updatingBuscar()  { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function toggleOrden()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->resetPage();
    }

    /**
     * Colección única de productores (c_productor) desde Balancemasa de esta temporada.
     */
    protected function uniqueProductores()
    {
        $masas = Balancemasa::select('c_productor')
            ->where('temporada_id', $this->temporada->id)
            ->whereIn('exportadora', ['Greenex SpA', '22'])
            ->get();

        return $masas->pluck('c_productor')->filter()->unique()->values();
    }

    /** Exportar plantilla Excel (reemplaza por tu Export real si lo tienes). */
    public function exportarExcel($modo = 'TODAS')
    {
        $rows = [[ 'csg', 'rut', 'name', 'condicion', 'valor', 'observacion' ]];

        return Excel::download(new class($rows)
            implements \Maatwebsite\Excel\Concerns\FromArray,
                       \Maatwebsite\Excel\Concerns\WithTitle {
            private $rows;
            public function __construct($rows){ $this->rows = $rows; }
            public function array(): array { return $this->rows; }
            public function title(): string { return 'Plantilla'; }
        }, 'plantilla_condiciones.xlsx');
    }

    /** Importar Excel (ajusta a tu Import real). */
    public function importar()
    {
        $this->validate([
            'archivo' => 'required|file|mimes:xlsx,xls|max:10240',
        ], [
            'archivo.required' => 'Selecciona un archivo Excel.',
            'archivo.mimes'    => 'Usa .xlsx o .xls',
        ]);

        try {
            // Excel::import(new \App\Imports\RespuestasImport($this->temporada->id), $this->archivo->getRealPath());
            session()->flash('success', 'Importación realizada correctamente.');
        } catch (\Throwable $e) {
            report($e);
            session()->flash('success', 'Hubo un problema al importar: '.$e->getMessage());
        }
    }

    public function render()
    {
        $unique_productores = $this->uniqueProductores();

        // Subquery: último id por RUT, acotado al universo de productores
        $sub = Razonsocial::query()
            ->when($this->buscar !== '', fn($q) =>
                $q->where('name', 'like', '%'.$this->buscar.'%'))
            ->whereIn('csg', $unique_productores)
            ->select('rut', DB::raw('MAX(id) as id'))
            ->groupBy('rut');

        $razons = Razonsocial::joinSub($sub, 'sub', function($join){
                $join->on('razonsocials.id', '=', 'sub.id');
            })
            ->select('razonsocials.*')
            ->orderBy('name', $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.productores-listado', [
            'razons'    => $razons,
            'temporada' => $this->temporada,
        ]);
    }
}
