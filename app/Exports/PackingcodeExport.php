<?php

namespace App\Exports;

use App\Models\Costoembalajecode;
use App\Models\Proceso;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PackingCodeExport implements FromView
{
    protected $temporadaId;
    protected $costoId;

    public function __construct($temporadaId, $costoId)
    {
        $this->temporadaId = $temporadaId;
        $this->costoId = $costoId;
    }

    public function view(): View
    {
        // Buscar si ya hay registros existentes
        $registros = Costoembalajecode::where('temporada_id', $this->temporadaId)
            ->where('costo_id', $this->costoId)
            ->get();

        // Si no hay, preparar plantilla desde Procesos
        if ($registros->isEmpty()) {
            $registros = Proceso::where('temporada_id', $this->temporadaId)
                ->select('c_embalaje')
                ->distinct()
                ->get()
                ->map(function ($item) {
                    return (object)[
                        'c_embalaje' => $item->c_embalaje,
                        'costo_por_caja' => null,
                    ];
                });
        }

        return view('exports.plantilla_codigos', [
            'registros' => $registros
        ]);
    }
}
