<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Costo;
use App\Models\Balancemasa;

use App\Models\Exportacion;
use App\Models\Costotarifacolor;
use App\Models\Costoembalajecode;
use App\Models\Costotarifacaja;
use App\Models\Costotarifakilo;
use App\Models\CostoCategoria;
use App\Models\Costoporcentajefob;

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

    // Totales base EXPORTACIÓN (USD)
    public float $total_kilos = 0.0;
    public float $total_cajas = 0.0;
    public float $ingresos_total = 0.0;   // en USD
    public float $vu_promedio = 0.0;      // USD/kg

    // Mercado interno + comercial (CLP)
    /** @var \Illuminate\Support\Collection */
    public Collection $masastotal_mi;
    public float $total_kilos_mi = 0.0;
    public float $total_cajas_mi = 0.0;
    public float $ingresos_total_mi = 0.0; // en CLP
    public float $vu_promedio_mi = 0.0;    // CLP/kg

    /** @var \Illuminate\Support\Collection<Costo> */
    public Collection $costos;

    // Subconjuntos de costos según flags exp/mi/com
    public Collection $costos_export;  // exp = 1
    public Collection $costos_mi_com;  // mi = 1 o com = 1

    // ===== Panel de detalle =====
    public ?int $selectedCostoId = null;
    public array $detalle = []; // aquí armamos toda la info para mostrar
    public bool $detalleOpen = false;

    public function mostrarDetalle(int $costoId): void
    {
        $costo = $this->costos->firstWhere('id', $costoId);
        if (!$costo) {
            $this->selectedCostoId = null;
            $this->detalle = [];
            $this->detalleOpen = false;
            return;
        }

        $metodo = strtoupper($costo->metodo ?? '');
        $this->selectedCostoId = $costoId;

        // Base común
        $base = [
            'id'        => $costo->id,
            'name'      => $costo->name,
            'metodo'    => $metodo,
            'regla'     => strtoupper($costo->regla ?? ''),
            'notas'     => $costo->descripcion ?? null,
            'resumen'   => [],   // filas detalle
            'totales'   => [],   // totales específicos
            'explica'   => '',   // explicación corta del método
        ];

        // Explicación por método (breve)
        $explica = [
            'TPT' => 'Tarifa por transporte: suma (kg por cada tipo de transporte × tarifa USD del tipo).',
            'TPCL'=> 'Tarifa por color: suma (kg del color × tarifa USD/kg del color).',
            'TPE' => 'Tarifa por código de embalaje: suma (cajas por código × costo USD/caja).',
            'TPC' => 'Tarifa única por caja: tarifa USD/caja × total de cajas.',
            'TPK' => 'Tarifa única por kilo: tarifa USD/kg × total de kilos.',
            'MTC' => 'Monto total por categoría: suma de los montos ingresados por categoría.',
            'PSF' => 'Porcentaje sobre FOB: (porcentaje ÷ 100) × base FOB (o ingresos si no hay FOB).',
            'POR_KG' => 'Valor unitario por kilo × total de kilos.',
            'POR_CAJA' => 'Valor unitario por caja × total de cajas.',
            'FIJO' => 'Monto fijo (no depende de cantidades).',
            'PORCENTAJE_INGRESO' => 'Porcentaje sobre ingresos totales: (porcentaje ÷ 100) × ingresos.',
        ];
        $base['explica'] = $explica[$metodo] ?? 'Método personalizado.';

        // Armar detalle según método
        switch ($metodo) {
            case 'TPT': {
                $filas = $this->exportacions->where('costo_id', $costo->id);
                $rows = [];
                $total = 0.0;

                foreach ($filas as $row) {
                    $type  = strtolower(trim($row->type ?? ''));
                    $label = ucfirst($type);
                    $price = (float) ($row->precio_usd ?? 0);

                    $kg = match ($type) {
                        'maritimo'  => (float)$this->masastotal
                            ->filter(fn($r)=>strtoupper($r['tipo_transporte'])==='MARITIMO')
                            ->sum('peso_neto'),
                        'aereo'     => (float)$this->masastotal
                            ->filter(fn($r)=>strtoupper($r['tipo_transporte'])==='AEREO')
                            ->sum('peso_neto'),
                        'terrestre' => (float)$this->masastotal
                            ->filter(fn($r)=>strtoupper($r['tipo_transporte'])==='TERRESTRE')
                            ->sum('peso_neto'),
                        default     => 0.0,
                    };

                    $sub = $kg * $price;
                    $total += $sub;
                    $rows[] = [
                        'col1' => $label,
                        'col2' => number_format($kg, 2, ',', '.').' kg',
                        'col3' => 'US$ '.number_format($price, 4, ',', '.').' /kg',
                        'col4' => 'US$ '.number_format($sub, 2, ',', '.'),
                    ];
                }

                $base['resumen'] = $rows;
                $base['totales'] = [
                    'Total costo'    => 'US$ '.number_format($total, 2, ',', '.'),
                    'Kilos totales'  => number_format($this->total_kilos, 2, ',', '.').' kg',
                    'VU equivalente' => $this->total_kilos>0
                        ? 'US$ '.number_format($total/$this->total_kilos, 4, ',', '.').' /kg'
                        : 'US$ 0',
                ];
                break;
            }

            case 'TPCL': {
                $filas = $this->costotarifacolors->where('costo_id', $costo->id);
                $rows = [];
                $total = 0.0;

                foreach ($filas as $row) {
                    $color  = (string) $row->color;
                    $tarifa = (float) $row->tarifa_kg;
                    $kg     = (float) $this->masastotal->where('color', $color)->sum('peso_neto');
                    $sub    = $kg * $tarifa;
                    $total += $sub;

                    $rows[] = [
                        'col1' => $color,
                        'col2' => number_format($kg, 2, ',', '.').' kg',
                        'col3' => 'US$ '.number_format($tarifa, 4, ',', '.').' /kg',
                        'col4' => 'US$ '.number_format($sub, 2, ',', '.'),
                    ];
                }

                $base['resumen'] = $rows;
                $base['totales'] = [
                    'Total costo'    => 'US$ '.number_format($total, 2, ',', '.'),
                    'Kilos totales'  => number_format($this->total_kilos, 2, ',', '.').' kg',
                    'VU equivalente' => $this->total_kilos>0
                        ? 'US$ '.number_format($total/$this->total_kilos, 4, ',', '.').' /kg'
                        : 'US$ 0',
                ];
                break;
            }

            case 'TPE': {
                $filas = $this->costoembalajecodes
                    ->where('costo_id', $costo->id)
                    ->keyBy('c_embalaje');
                $rows = [];
                $total = 0.0;

                // agrupa cajas por código desde masastotal
                $cajasPorCodigo = $this->masastotal
                    ->groupBy('c_embalaje')
                    ->map->sum('cantidad');

                foreach ($cajasPorCodigo as $codigo => $cajas) {
                    $t = $filas->get($codigo);
                    if (!$t) continue;

                    $valor = (float)$t->costo_por_caja;
                    $sub   = $valor * (float)$cajas;
                    $total += $sub;

                    $rows[] = [
                        'col1' => (string)$codigo,
                        'col2' => (int)$cajas.' cajas',
                        'col3' => 'US$ '.number_format($valor, 4, ',', '.').' /caja',
                        'col4' => 'US$ '.number_format($sub, 2, ',', '.'),
                    ];
                }

                $base['resumen'] = $rows;
                $base['totales'] = [
                    'Total costo'   => 'US$ '.number_format($total, 2, ',', '.'),
                    'Cajas totales' => number_format($this->total_cajas, 0, ',', '.'),
                    'VU/caja prom.' => $this->total_cajas>0
                        ? 'US$ '.number_format($total/$this->total_cajas, 4, ',', '.').' /caja'
                        : 'US$ 0',
                ];
                break;
            }

            case 'TPC': {
                $row    = $this->costotarifacajas->firstWhere('costo_id', $costo->id);
                $tarifa = $row?->tarifa_caja ?? (float)($costo->valor_unitario ?? 0);
                $sub    = $tarifa * $this->total_cajas;

                $base['resumen'] = [[
                    'col1' => 'Tarifa única',
                    'col2' => number_format($this->total_cajas, 0, ',', '.').' cajas',
                    'col3' => 'US$ '.number_format($tarifa, 4, ',', '.').' /caja',
                    'col4' => 'US$ '.number_format($sub, 2, ',', '.'),
                ]];
                $base['totales'] = [
                    'Total costo' => 'US$ '.number_format($sub, 2, ',', '.'),
                ];
                break;
            }

            case 'TPK': {
                $row    = $this->costotarifakilos->firstWhere('costo_id', $costo->id);
                $tarifa = $row?->tarifa_kg ?? (float)($costo->valor_unitario ?? 0);
                $sub    = $tarifa * $this->total_kilos;

                $base['resumen'] = [[
                    'col1' => 'Tarifa única',
                    'col2' => number_format($this->total_kilos, 2, ',', '.').' kg',
                    'col3' => 'US$ '.number_format($tarifa, 4, ',', '.').' /kg',
                    'col4' => 'US$ '.number_format($sub, 2, ',', '.'),
                ]];
                $base['totales'] = [
                    'Total costo' => 'US$ '.number_format($sub, 2, ',', '.'),
                ];
                break;
            }

            case 'MTC': {
                $filas = $this->costocategorias->where('costo_id', $costo->id);
                $rows = [];
                $total = 0.0;

                foreach ($filas as $cat) {
                    $monto = (float)($cat->monto_total ?? 0);
                    $total += $monto;
                    $rows[] = [
                        'col1' => $cat->categoria->nombre ?? ('Cat #'.$cat->categoria_id),
                        'col2' => number_format((float)$cat->total_kgs, 2, ',', '.').' kg',
                        'col3' => 'US$ '.number_format((float)$cat->costo_por_kg, 6, ',', '.').' /kg',
                        'col4' => 'US$ '.number_format($monto, 2, ',', '.'),
                    ];
                }

                $base['resumen'] = $rows;
                $base['totales'] = [
                    'Total costo' => 'US$ '.number_format($total, 2, ',', '.'),
                ];
                break;
            }

            case 'PSF': {
                $fila = $this->costoporcentajefobs->firstWhere('costo_id', $costo->id);
                $porc = $fila?->porcentaje ?? (float)($costo->porcentaje ?? 0);
                $baseMonto = $this->fob_total ?? $this->ingresos_total;
                $sub = ((float)$porc / 100.0) * (float)$baseMonto;

                $base['resumen'] = [[
                    'col1' => 'Porcentaje',
                    'col2' => number_format((float)$porc, 4, ',', '.').' %',
                    'col3' => 'Base',
                    'col4' => 'US$ '.number_format((float)$baseMonto, 2, ',', '.'),
                ]];
                $base['totales'] = [
                    'Total costo' => 'US$ '.number_format($sub, 2, ',', '.'),
                ];
                break;
            }

            default: {
                // Fallbacks genéricos (se asume USD por consistencia)
                $total = $this->calcularTotalCosto($costo);
                $base['resumen'] = [[
                    'col1' => 'Parámetros',
                    'col2' => '—',
                    'col3' => '—',
                    'col4' => 'US$ '.number_format($total, 2, ',', '.'),
                ]];
                $base['totales'] = [
                    'Total costo' => 'US$ '.number_format($total, 2, ',', '.'),
                ];
            }
        }

        $this->detalle = $base;
        $this->detalleOpen = true;
    }

    public function cerrarDetalle(): void
    {
        $this->selectedCostoId = null;
        $this->detalle = [];
        $this->detalleOpen = false;
    }

    public function mount($temporada, $filters = [])
    {
        $this->temporada = $temporada;
        $this->filters   = $filters;

        // === 1) Exportación (Greenex / 22) ===
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

        // Totales base EXPORTACIÓN
        $this->total_kilos = (float) $this->masastotal->sum('peso_neto2');
        $this->total_cajas = (float) $this->masastotal->sum('cantidad');

        // Tablas auxiliares (métodos TPT/TPCL/TPE/TPC/TPK/MTC/PSF)
        $this->exportacions       = $this->temporada->exportacions()->get();        // TPT
        $this->costotarifacolors  = $this->temporada->costotarifacolors()->get();   // TPCL
        $this->costoembalajecodes = $this->temporada->costoembalajecodes()->get();  // TPE
        $this->costotarifacajas   = $this->temporada->costotarifacajas()->get();    // TPC
        $this->costotarifakilos   = $this->temporada->costotarifakilos()->get();    // TPK
        $this->costocategorias    = $this->temporada->costocategorias()->get();     // MTC
        $this->costoporcentajefobs= $this->temporada->costoporcentajefobs()->get(); // PSF

        // Ingresos EXPORTACIÓN = Σ(precio_unitario * peso_neto2) (USD)
        $this->ingresos_total = (float) $this->masastotal->sum(function ($row) {
            $pu = (float) ($row['precio_unitario'] ?? 0);
            $kg = (float) ($row['peso_neto2'] ?? 0);
            return $pu * $kg;
        });

        $this->vu_promedio = $this->total_kilos > 0
            ? $this->ingresos_total / $this->total_kilos
            : 0.0;

        // === 2) Costos base (sin filtrar aún por exp/mi/com) ===
        $ordenMetodo = "'POR_KG','POR_CAJA','FIJO','PORCENTAJE_INGRESO'";
        $this->costos = Costo::paraEspecieTemporada($this->temporada)
            ->with(['superespecies', 'costomenu'])
            ->orderBy('costomenu_id')
            ->orderByRaw("FIELD(metodo, $ordenMetodo)")
            ->orderBy('name')
            ->get();

        // Subconjuntos por flags
        $this->costos_export = $this->costos->where('exp', 1);
        $this->costos_mi_com = $this->costos->filter(function ($c) {
            return ($c->mi == 1) || ($c->com == 1);
        });

        // === 3) MERCADO INTERNO + COMERCIAL (CLP) ===
        $this->masastotal_mi = Balancemasa::select([
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
            ->whereNotIn('exportadora', ['Greenex SpA', '22']) // Ajusta si MI/COM se define distinto
            ->get();

        // Totales base MI + COM
        $this->total_kilos_mi = (float) $this->masastotal_mi->sum('peso_neto2');
        $this->total_cajas_mi = (float) $this->masastotal_mi->sum('cantidad');

        // Ingresos MI + COM = Σ(precio_unitario * peso_neto2) en CLP
        $this->ingresos_total_mi = (float) $this->masastotal_mi->sum(function ($row) {
            $pu = (float) ($row['precio_unitario'] ?? 0);
            $kg = (float) ($row['peso_neto2'] ?? 0);
            return $pu * $kg;
        });

        // Valor unitario promedio MI ($/kg en CLP)
        $this->vu_promedio_mi = $this->total_kilos_mi > 0
            ? $this->ingresos_total_mi / $this->total_kilos_mi
            : 0.0;
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

            // ======== RESERVADOS / PENDIENTES ========
            'MTE'  => $this->calcularMTE($costo),
            'MTEB' => $this->calcularMTEB($costo),
            'MTEMP'=> $this->calcularMTEmp($costo),
            'MTT'  => $this->calcularMTT($costo),
            'MPC'  => $this->calcularMPC($costo),

            // ======== FALLBACKS BASE ========
            'POR_KG'             => ((float)($costo->valor_unitario ?? 0)) * $this->total_kilos,
            'POR_CAJA'           => ((float)($costo->valor_unitario ?? 0)) * $this->total_cajas,
            'FIJO'               => (float)($costo->monto_fijo ?? 0),
            'PORCENTAJE_INGRESO' => ((float)($costo->porcentaje ?? 0) / 100) * $this->ingresos_total,

            default => 0.0,
        };
    }

    // === TPT: tarifa por transporte (USD por kg) ===
    protected function calcularTPT(Costo $costo): float
    {
        $filas = $this->exportacions->where('costo_id', $costo->id);
        if ($filas->isEmpty()) return 0.0;

        $total = 0.0;

        foreach ($filas as $row) {
            $type  = strtolower(trim($row->type ?? ''));
            $price = (float) ($row->precio_usd ?? 0);

            $kgTipo = match ($type) {
                'maritimo'  => (float) $this->masastotal
                    ->filter(fn($r)=>strtoupper($r['tipo_transporte'])==='MARITIMO')
                    ->sum('peso_neto'),
                'aereo'     => (float) $this->masastotal
                    ->filter(fn($r)=>strtoupper($r['tipo_transporte'])==='AEREO')
                    ->sum('peso_neto'),
                'terrestre' => (float) $this->masastotal
                    ->filter(fn($r)=>strtoupper($r['tipo_transporte'])==='TERRESTRE')
                    ->sum('peso_neto'),
                default     => 0.0,
            };

            $total += $kgTipo * $price;
        }
        return $total;
    }

    // === TPCL: tarifa por color (USD por kg) ===
    protected function calcularTPCL(Costo $costo): float
    {
        $filas = $this->costotarifacolors->where('costo_id', $costo->id);
        if ($filas->isEmpty()) return 0.0;

        $total = 0.0;
        foreach ($filas as $row) {
            $color  = (string) $row->color;
            $tarifa = (float) $row->tarifa_kg;

            $kgColor = (float) $this->masastotal->where('color', $color)->sum('peso_neto');
            $total  += $kgColor * $tarifa;
        }
        return $total;
    }

    // === TPE: tarifa por código de embalaje (USD por caja) ===
    protected function calcularTPE(Costo $costo): float
    {
        $filas = $this->costoembalajecodes->where('costo_id', $costo->id);
        if ($filas->isEmpty()) return 0.0;

        $tarifas = $filas->keyBy('c_embalaje');
        $cajasPorCodigo = $this->masastotal
            ->groupBy('c_embalaje')
            ->map->sum('cantidad');

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
        $row    = $this->costotarifacajas->firstWhere('costo_id', $costo->id);
        $tarifa = $row ? (float)$row->tarifa_caja : (float)($costo->valor_unitario ?? 0);
        return $tarifa * $this->total_cajas;
    }

    // === TPK: tarifa única por kg ===
    protected function calcularTPK(Costo $costo): float
    {
        $row    = $this->costotarifakilos->firstWhere('costo_id', $costo->id);
        $tarifa = $row ? (float)$row->tarifa_kg : (float)($costo->valor_unitario ?? 0);
        return $tarifa * $this->total_kilos;
    }

    // === MTC: monto total por categoría ===
    protected function calcularMTC(Costo $costo): float
    {
        $filas = $this->costocategorias->where('costo_id', $costo->id);
        if ($filas->isEmpty()) return 0.0;

        $totalPorMonto = (float) $filas->sum('monto_total');
        if ($totalPorMonto > 0) return $totalPorMonto;

        return (float) $filas->sum(
            fn($r) => (float)$r->costo_por_kg * (float)$r->total_kgs
        );
    }

    // === PSF: porcentaje sobre FOB ===
    protected function calcularPSF(Costo $costo): float
    {
        $fila = $this->costoporcentajefobs->firstWhere('costo_id', $costo->id);
        $porc = $fila ? (float)$fila->porcentaje : (float)($costo->porcentaje ?? 0);

        $base = $this->fob_total ?? $this->ingresos_total;
        return ($porc / 100) * $base;
    }

    // ====== HOOKS PENDIENTES ======
    protected function calcularMTE(Costo $costo): float  { return 0.0; }
    protected function calcularMTEB(Costo $costo): float { return 0.0; }
    protected function calcularMTEmp(Costo $costo): float { return 0.0; }
    protected function calcularMTT(Costo $costo): float   { return 0.0; }
    protected function calcularMPC(Costo $costo): float   { return 0.0; }

    public function valorUnitarioParaMostrar(Costo $costo): float
    {
        $m = strtoupper($costo->metodo ?? '');

        return match ($m) {
            'TPK' => $this->total_kilos > 0
                ? $this->calcularTPK($costo) / $this->total_kilos
                : 0.0, // $/kg

            'TPCL' => $this->total_kilos > 0
                ? $this->calcularTPCL($costo) / $this->total_kilos
                : 0.0, // $/kg eq.

            'TPT' => $this->total_kilos > 0
                ? $this->calcularTPT($costo) / $this->total_kilos
                : 0.0, // $/kg

            'TPE' => $this->total_cajas > 0
                ? $this->calcularTPE($costo) / $this->total_cajas
                : 0.0, // $/caja promedio

            'TPC' => optional($this->costotarifacajas->firstWhere('costo_id',$costo->id))->tarifa_caja
                    ?? (float)($costo->valor_unitario ?? 0),

            'MTC' => $this->total_kilos > 0
                ? $this->calcularMTC($costo) / $this->total_kilos
                : 0.0, // $/kg eq.

            'PSF' => $this->total_kilos > 0
                ? $this->calcularPSF($costo) / $this->total_kilos
                : 0.0, // $/kg eq.

            // fallbacks
            'POR_KG'   => (float)($costo->valor_unitario ?? 0), // $/kg
            'POR_CAJA' => (float)($costo->valor_unitario ?? 0), // $/caja
            'FIJO'     => $this->total_kilos > 0
                ? ((float)($costo->monto_fijo ?? 0)) / $this->total_kilos
                : 0.0,
            'PORCENTAJE_INGRESO' => $this->total_kilos > 0
                ? (((float)($costo->porcentaje ?? 0) / 100) * $this->ingresos_total) / $this->total_kilos
                : 0.0,

            default => 0.0,
        };
    }

    // ===== Agrupaciones para la vista =====

    // Agrupación para Exportación (USD)
    public function getCostosAgrupadosExpProperty(): array
    {
        $out = [];
        foreach ($this->costos_export as $c) {
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

    // Agrupación para Mercado Interno + Comercial (CLP)
    public function getCostosAgrupadosMiComProperty(): array
    {
        $out = [];
        foreach ($this->costos_mi_com as $c) {
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
        // Exportación (USD)
        $totalCostosExp = 0.0;
        foreach ($this->costos_export as $c) {
            $totalCostosExp += $this->calcularTotalCosto($c);
        }

        $resultadoExp    = $this->ingresos_total - $totalCostosExp;
        $vu_resultadoExp = $this->total_kilos > 0
            ? $resultadoExp / $this->total_kilos
            : 0.0;

        // Mercado Interno + Comercial (CLP)
        $totalCostosMiCom = 0.0;
        foreach ($this->costos_mi_com as $c) {
            $totalCostosMiCom += $this->calcularTotalCosto($c);
        }

        $resultadoMiCom    = $this->ingresos_total_mi - $totalCostosMiCom;
        $vu_resultadoMiCom = $this->total_kilos_mi > 0
            ? $resultadoMiCom / $this->total_kilos_mi
            : 0.0;

        return view('livewire.resumen-exportacion', [
            // Exportación (mantengo nombres antiguos para no romper Blade actual)
            'totalCostos'      => $totalCostosExp,
            'resultado'        => $resultadoExp,
            'vu_resultado'     => $vu_resultadoExp,

            // Mercado Interno + Comercial
            'totalCostos_mi'   => $totalCostosMiCom,
            'resultado_mi'     => $resultadoMiCom,
            'vu_resultado_mi'  => $vu_resultadoMiCom,
        ]);
    }
}
