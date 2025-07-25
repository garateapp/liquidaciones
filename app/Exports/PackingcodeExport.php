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
        // Obtener todos los c_embalaje únicos desde Proceso
        $codigos = Proceso::where('temporada_id', $this->temporadaId)
            ->select('c_embalaje')
            ->distinct()
            ->pluck('c_embalaje');

        // Obtener tarifas existentes
        $tarifas = Costoembalajecode::where('temporada_id', $this->temporadaId)
            ->where('costo_id', $this->costoId)
            ->pluck('costo_por_caja', 'c_embalaje'); // clave = c_embalaje

        // Mezclar datos
        $registros = $codigos->map(function ($codigo) use ($tarifas) {
            return (object)[
                'c_embalaje' => $codigo,
                'costo_por_caja' => $tarifas[$codigo] ?? null,
            ];
        });

        return view('exports.plantilla_codigos', [
            'registros' => $registros
        ]);
    }
}
