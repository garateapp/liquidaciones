<?php

namespace App\Exports;

use App\Models\Proceso;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CodigoEmbalajeExport implements FromView
{
    protected $temporadaId;

    public function __construct($temporadaId)
    {
        $this->temporadaId = $temporadaId;
    }

    public function view(): View
    {
        $procesos = Proceso::where('temporada_id', $this->temporadaId)->get(['c_embalaje']);
        
        return view('exports.plantilla_codigos', [
            'procesos' => $procesos
        ]);
    }
}
