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


    // Colecciones que usa tu UI:
    public Collection $exportacions;        // TPT: [{id,costo_id,type,precio_usd}]
    public Collection $costotarifacolors;   // TPCL: [{id,costo_id,color,tarifa_kg}]
    public Collection $costoembalajecodes;  // TPE: [{id,costo_id,c_embalaje,costo_por_caja}]
    public Collection $costotarifacajas;    // TPC: [{id,costo_id,tarifa_caja}]
    public Collection $costotarifakilos;    // TPK: [{id,costo_id,tarifa_kg}]
    public Collection $costocategorias;     // MTC: [{id,costo_id,categoria_id,total_kgs,costo_por_kg,monto_total}]
    public Collection $costoporcentajefobs; // PSF: [{id,costo_id,porcentaje}]

    // Si tienes FOB total real, puedes setearlo; si no, queda null y cae a ingresos_total.
    public ?float $fob_total = null;

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
        $this->total_kilos = (float) $this->masastotal->sum('peso_neto2');
        $this->total_cajas = (float) $this->masastotal->sum('cantidad');
    // Precarga colecciones que tu Blade usa (ajusta relaciones según tu modelo):
        $this->exportacions       = $this->temporada->exportacions()->get();        // TPT
        $this->costotarifacolors  = $this->temporada->costotarifacolors()->get();   // TPCL
        $this->costoembalajecodes = $this->temporada->costoembalajecodes()->get();  // TPE
        $this->costotarifacajas   = $this->temporada->costotarifacajas()->get();    // TPC
        $this->costotarifakilos   = $this->temporada->costotarifakilos()->get();    // TPK
        $this->costocategorias    = $this->temporada->costocategorias()->get();     // MTC
        $this->costoporcentajefobs= $this->temporada->costoporcentajefobs()->get(); // PSF

        // Ingresos = Σ(precio_unitario * peso_neto)
        $this->ingresos_total = (float) $this->masastotal->sum(function ($row) {
            $pu = (float) ($row['precio_unitario'] ?? 0);
            $kg = (float) ($row['peso_neto2'] ?? 0);
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

        return match ($metodo) {
            // ======== TARIFAS ESPECÍFICAS ========

            'TPT' => $this->calcularTPT($costo),   // por transporte
            'TPCL'=> $this->calcularTPCL($costo),  // por color
            'TPE' => $this->calcularTPE($costo),   // por código de embalaje
            'TPC' => $this->calcularTPC($costo),   // tarifa única por caja
            'TPK' => $this->calcularTPK($costo),   // tarifa única por kilo

            // ======== MONTO POR CATEGORÍA ========

            'MTC' => $this->calcularMTC($costo),

            // ======== PORCENTAJE SOBRE FOB ========

            'PSF' => $this->calcularPSF($costo),

            // ======== RESERVADOS / PENDIENTES (completa cuando definas la tabla y UI) ========

            'MTE'  => $this->calcularMTE($costo),   // TODO: define regla
            'MTEB' => $this->calcularMTEB($costo),  // TODO: define regla
            'MTEMP'=> $this->calcularMTEmp($costo), // TODO: define regla
            'MTT'  => $this->calcularMTT($costo),   // TODO: define regla
            'MPC'  => $this->calcularMPC($costo),   // TODO: si hay costo por productor

            // ======== FALLBACKS BASE ========

            'POR_KG'             => ((float)($costo->valor_unitario ?? 0)) * $this->total_kilos,
            'POR_CAJA'           => ((float)($costo->valor_unitario ?? 0)) * $this->total_cajas,
            'FIJO'               => (float)($costo->monto_fijo ?? 0),
            'PORCENTAJE_INGRESO' => ((float)($costo->porcentaje ?? 0) / 100) * $this->ingresos_total,

            default => 0.0,
        };
    }


    // === TPT: tarifa por transporte (USD por kg) ===
    // Usa $exportacions (type: maritimo/aereo/terrestre, precio_usd)
    protected function calcularTPT(Costo $costo): float
    {
        $filas = $this->exportacions->where('costo_id', $costo->id);
        if ($filas->isEmpty()) return 0.0;

        $total = 0.0;

        // suma por tipo definido en tu tabla exportacions
        foreach ($filas as $row) {
            $type  = strtolower(trim($row->type ?? ''));
            $price = (float) ($row->precio_usd ?? 0);

            $kgTipo = match ($type) {
                'maritimo'  => (float) $this->masastotal->where('tipo_transporte', 'MARITIMO')->sum('peso_neto'),
                'aereo'     => (float) $this->masastotal->where('tipo_transporte', 'AEREO')->sum('peso_neto'),
                'terrestre' => (float) $this->masastotal->where('tipo_transporte', 'TERRESTRE')->sum('peso_neto'),
                default     => 0.0,
            };

            $total += $kgTipo * $price;
        }
        return $total;
    }

    // === TPCL: tarifa por color (USD por kg) ===
    // Usa $costotarifacolors (color, tarifa_kg) y suma kg por color desde masastotal.
    // Asumo que cada fila de Balancemasa está mapeable a un color (por n_variedad -> bi_color).
    protected function calcularTPCL(Costo $costo): float
    {
        $filas = $this->costotarifacolors->where('costo_id', $costo->id);
        if ($filas->isEmpty()) return 0.0;

        // Mapa variedad->color (según tu dominio). Si ya tienes el color en $masastotal (columna `color`), usa eso.
        // Aquí intento usar $masastotal->where('color', $color).
        $total = 0.0;
        foreach ($filas as $row) {
            $color = (string) $row->color;
            $tarifa = (float) $row->tarifa_kg;

            $kgColor = (float) $this->masastotal->where('color', $color)->sum('peso_neto');
            $total += $kgColor * $tarifa;
        }
        return $total;
    }

    // === TPE: tarifa por código de embalaje (USD por caja) ===
    // Usa $costoembalajecodes (c_embalaje, costo_por_caja) y suma cajas por código.
    protected function calcularTPE(Costo $costo): float
    {
        $filas = $this->costoembalajecodes->where('costo_id', $costo->id);
        if ($filas->isEmpty()) return 0.0;

        // indexar por c_embalaje
        $tarifas = $filas->keyBy('c_embalaje');
        $cajasPorCodigo = $this->masastotal->groupBy('c_embalaje')->map->sum('cantidad');

        $total = 0.0;
        foreach ($cajasPorCodigo as $codigo => $cajas) {
            $t = $tarifas->get($codigo);
            if ($t) {
                $total += ((float)$t->costo_por_caja) * (float)$cajas;
            }
        }
        return $total;
    }

    // === TPC: tarifa única por caja ===
    protected function calcularTPC(Costo $costo): float
    {
        $row = $this->costotarifacajas->firstWhere('costo_id', $costo->id);
        $tarifa = $row ? (float)$row->tarifa_caja : (float)($costo->valor_unitario ?? 0);
        return $tarifa * $this->total_cajas;
    }

    // === TPK: tarifa única por kg ===
    protected function calcularTPK(Costo $costo): float
    {
        $row = $this->costotarifakilos->firstWhere('costo_id', $costo->id);
        $tarifa = $row ? (float)$row->tarifa_kg : (float)($costo->valor_unitario ?? 0);
        return $tarifa * $this->total_kilos;
    }

    // === MTC: monto total por categoría ===
    // Usa $costocategorias y suma 'monto_total'. (Opcional: si no hay, usa costo_por_kg*total_kgs)
    protected function calcularMTC(Costo $costo): float
    {
        $filas = $this->costocategorias->where('costo_id', $costo->id);
        if ($filas->isEmpty()) return 0.0;

        $totalPorMonto = (float) $filas->sum('monto_total');
        if ($totalPorMonto > 0) return $totalPorMonto;

        // fallback si solo hay costo_por_kg y total_kgs
        return (float) $filas->sum(fn($r) => (float)$r->costo_por_kg * (float)$r->total_kgs);
    }

    // === PSF: porcentaje sobre FOB ===
    // Si tienes FOB total real => usa ese; si no => fallback a ingresos_total
    protected function calcularPSF(Costo $costo): float
    {
        $fila = $this->costoporcentajefobs->firstWhere('costo_id', $costo->id);
        $porc = $fila ? (float)$fila->porcentaje : (float)($costo->porcentaje ?? 0);

        $base = $this->fob_total ?? $this->ingresos_total;
        return ($porc / 100) * $base;
    }

    // ====== HOOKS PENDIENTES (completa cuando tengas UI/tabla) ======

    protected function calcularMTE(Costo $costo): float  { return 0.0; }
    protected function calcularMTEB(Costo $costo): float { return 0.0; }
    protected function calcularMTEmp(Costo $costo): float { return 0.0; }
    protected function calcularMTT(Costo $costo): float   { return 0.0; }
    protected function calcularMPC(Costo $costo): float   { return 0.0; } // si alguna condición de productor genera costo



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
