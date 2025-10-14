<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Costo;
use App\Models\Balancemasa;

class ResumenExportacion extends Component
{
    public ?object $temporada = null;
    public array $filters = [
    'exp' => true,
    'mi'  => true,
    'com' => true,
    ];

    /** @var \Illuminate\Support\Collection */
    public Collection $masastotal;

    // Totales base
    public float $total_kilos = 0.0;
    public float $total_cajas = 0.0;
    public float $ingresos_total = 0.0;
    public float $vu_promedio = 0.0; // $/kg

    /** @var \Illuminate\Support\Collection<Costo> */
    public Collection $costos;

    public function mount($temporada, $filters = [])
    {
        $this->temporada = $temporada;
        $this->filters   = $filters;

        // === 1) Traer la misma colección que ya usas ===
        $this->masastotal = Balancemasa::select([
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
                'peso_std_embalaje',
            ])
            ->filter1($this->filters)
            ->where('temporada_id', $this->temporada->id)
            ->whereIn('exportadora', ['Greenex SpA', '22'])
            ->get();

        // === 2) Agregados base desde la colección ===
        // Nota: usamos peso_neto para todos los cálculos principales.
        $this->total_kilos = (float) $this->masastotal->sum('peso_neto');
        $this->total_cajas = (float) $this->masastotal->sum('cantidad');

        // Ingresos = Σ(precio_unitario * peso_neto)
        $this->ingresos_total = (float) $this->masastotal->sum(function ($row) {
            $pu = (float) ($row['precio_unitario'] ?? 0);
            $kg = (float) ($row['peso_neto'] ?? 0);
            return $pu * $kg;
        });

        $this->vu_promedio = $this->total_kilos > 0
            ? $this->ingresos_total / $this->total_kilos
            : 0.0;

        // === 3) Costos (mismo orden que definiste) ===
        $ordenMetodo = "'POR_KG','POR_CAJA','FIJO','PORCENTAJE_INGRESO'";
        $this->costos = Costo::paraEspecieTemporada($this->temporada)
            ->with(['superespecies', 'costomenu'])
            ->orderBy('costomenu_id')
            ->orderByRaw("FIELD(metodo, $ordenMetodo)")
            ->orderBy('name')
            ->get();
    }

    public function calcularTotalCosto(Costo $costo): float
    {
        $metodo = strtoupper($costo->metodo ?? '');
        $valor  = (float) ($costo->valor_unitario ?? 0);
        $fijo   = (float) ($costo->monto_fijo ?? 0);
        $porc   = (float) ($costo->porcentaje ?? 0);

        return match ($metodo) {
            'POR_KG'               => $valor * $this->total_kilos,
            'POR_CAJA'             => $valor * $this->total_cajas,
            'FIJO'                 => $fijo,
            'PORCENTAJE_INGRESO'   => ($porc / 100) * $this->ingresos_total,
            default                => 0.0,
        };
    }

    public function valorUnitarioParaMostrar(Costo $costo): float
    {
        $metodo = strtoupper($costo->metodo ?? '');

        return match ($metodo) {
            'POR_KG'     => (float) ($costo->valor_unitario ?? 0), // $/kg directo
            'POR_CAJA'   => (float) ($costo->valor_unitario ?? 0), // $/caja
            'FIJO'       => $this->total_kilos > 0 ? ((float) ($costo->monto_fijo ?? 0)) / $this->total_kilos : 0.0, // $/kg equivalente
            'PORCENTAJE_INGRESO' => $this->total_kilos > 0
                ? (((float) ($costo->porcentaje ?? 0) / 100) * $this->ingresos_total) / $this->total_kilos
                : 0.0,
            default      => 0.0,
        };
    }

    public function getCostosAgrupadosProperty(): array
    {
        $out = [];
        foreach ($this->costos as $c) {
            $key = (string) ($c->costomenu_id ?? 'otros');
            if (!isset($out[$key])) {
                $out[$key] = [
                    'menu'  => optional($c->costomenu)->name ?? 'Otros',
                    'items' => collect(),
                ];
            }
            $out[$key]['items']->push($c);
        }
        return $out;
    }

    public function render()
    {
        $totalCostos = 0.0;
        foreach ($this->costos as $c) {
            $totalCostos += $this->calcularTotalCosto($c);
        }

        $resultado    = $this->ingresos_total - $totalCostos;
        $vu_resultado = $this->total_kilos > 0 ? $resultado / $this->total_kilos : 0;

        return view('livewire.resumen-exportacion', [
            'totalCostos'  => $totalCostos,
            'resultado'    => $resultado,
            'vu_resultado' => $vu_resultado,
        ]);
    }
}
