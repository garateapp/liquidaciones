<?php

namespace App\Livewire\Proceso;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

use App\Models\Temporada;
use App\Models\Sync;
use App\Models\Proceso;

class ProcesoSync extends Component
{
    use WithPagination;

    public int $temporadaId;
    public bool $syncRunning = false;
    public ?string $cursorDay = null;

    public array $progress = [
        'total_days'   => 0,
        'done_days'    => 0,
        'fetched'      => 0,
        'inserted'     => 0,
        'current_day'  => null,
        'failed_days'  => 0,
    ];

    public int $ctd = 25;
    public ?string $fechai = null;
    public ?string $fechaf = null;

    public array $syncDebug = [];

    private ?array $procesosColumns = null;

    public function mount(int $temporadaId): void
    {
        $this->temporadaId = $temporadaId;

        $temporada = Temporada::findOrFail($this->temporadaId);

        $this->fechai = $temporada->proceso_start ?: now()->subDays(7)->format('Y-m-d');
        $this->fechaf = $temporada->proceso_end   ?: now()->format('Y-m-d');
    }

    public function startSync(): void
    {
        $this->validate([
            'fechai' => ['required', 'date'],
            'fechaf' => ['required', 'date', 'after_or_equal:fechai'],
        ]);

        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);

        $temporada->update([
            'proceso_start' => $this->fechai,
            'proceso_end'   => $this->fechaf,
        ]);

        $this->syncDebug = [];
        $this->syncRunning = true;

        $this->cursorDay = Carbon::parse($this->fechai)->format('Y-m-d');

        $totalDays = Carbon::parse($this->fechai)->diffInDays(Carbon::parse($this->fechaf)) + 1;

        $this->progress = [
            'total_days'   => $totalDays,
            'done_days'    => 0,
            'fetched'      => 0,
            'inserted'     => 0,
            'current_day'  => $this->cursorDay,
            'failed_days'  => 0,
        ];

        $this->procesosColumns = Schema::getColumnListing('procesos');
    }

    public function tickSync(): void
    {
        if (!$this->syncRunning || !$this->cursorDay) return;

        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $temporada->especie->name;

        $day = $this->cursorDay;

        if (Carbon::parse($day)->gt(Carbon::parse($this->fechaf))) {
            $this->syncRunning = false;

            Sync::create([
                'tipo'     => 'MANUAL',
                'entidad'  => 'PROCESOS',
                'fecha'    => Carbon::now(),
                'cantidad' => $this->progress['fetched'] ?? 0,
            ]);

            session()->flash(
                'info',
                "Sync OK. {$especie}. API: {$this->progress['fetched']} | Insertados: {$this->progress['inserted']} | Días fallidos: {$this->progress['failed_days']}."
            );

            $this->resetPage();
            return;
        }

        try {
            $items = $this->fetchProcesos($day, $day, $especie);
        } catch (\Throwable $e) {
            $this->progress['failed_days']++;
            $this->syncDebug[] = ['day' => $day, 'error' => $e->getMessage()];
            $this->cursorDay = Carbon::parse($day)->addDay()->format('Y-m-d');
            return;
        }

        $this->syncDebug[] = [
            'day' => $day,
            'count' => count($items),
            'first_fecha' => $items[0]['fecha_g_produccion'] ?? null,
            'first_folio' => $items[0]['folio'] ?? null,
            'first_num'   => $items[0]['numero_g_produccion'] ?? null,
        ];

        $this->progress['current_day'] = $day;
        $this->progress['fetched'] += count($items);

        // ✅ rangos exactos del día (igual que API)
        $gte = $day . ' 00:00:00';
        $lte = $day . ' 23:59:59';

        DB::transaction(function () use ($items, $especie, $gte, $lte) {

            // ✅ delete exacto por rango (NO like)
            DB::table('procesos')
                ->where('temporada_id', $this->temporadaId)
                ->where('n_especie', $especie)
                ->whereBetween('fecha_g_produccion', [$gte, $lte])
                ->delete();

            if (empty($items)) return;

            $rows = [];
            $now = now();

            foreach ($items as $p) {
                $row = [
                    'temporada_id' => $this->temporadaId,
                    'n_especie'    => $p['n_especie'] ?? ($p['n_especie_proceso'] ?? $especie),

                    'fecha_g_produccion'  => $p['fecha_g_produccion'] ?? null,
                    'numero_g_produccion' => $p['numero_g_produccion'] ?? null,
                    'tipo_g_produccion'   => $p['tipo_g_produccion'] ?? null,
                    'folio'               => $p['folio'] ?? null,

                    'peso_neto' => $p['total_peso_neto'] ?? ($p['peso_neto'] ?? null),
                    'cantidad'  => $p['total_cantidad'] ?? ($p['cantidad'] ?? null),

                    'c_empresa' => $p['c_empresa'] ?? null,

                    'id_g_produccion' => $p['id_g_produccion'] ?? null,
                    'id_productor'    => $p['id_productor'] ?? null,
                    'c_productor'     => $p['c_productor'] ?? null,
                    'n_productor'     => $p['n_productor'] ?? null,
                    'id_variedad'     => $p['id_variedad'] ?? null,
                    'n_variedad'      => $p['n_variedad'] ?? null,
                    'id_embalaje'     => $p['id_embalaje'] ?? null,
                    'c_embalaje'      => $p['c_embalaje'] ?? null,
                    'n_embalaje'      => $p['n_embalaje'] ?? null,
                    'id_calibre'      => $p['id_calibre'] ?? null,
                    'c_calibre'       => $p['c_calibre'] ?? null,
                    'n_calibre'       => $p['n_calibre'] ?? null,
                    'c_etiqueta'      => $p['c_etiqueta'] ?? null,
                    'n_etiqueta'      => $p['n_etiqueta'] ?? null,
                    't_categoria'     => $p['t_categoria'] ?? null,
                    'c_categoria'     => $p['c_categoria'] ?? null,
                    'n_categoria'     => $p['n_categoria'] ?? null,

                    // ✅ si existe columna raw, guardamos todo el payload
                    'raw' => $this->hasProcesoColumn('raw')
                        ? json_encode($p, JSON_UNESCAPED_UNICODE)
                        : null,

                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                $rows[] = $this->onlyExistingProcesoColumns($row);
            }

            foreach (array_chunk($rows, 200) as $chunk) {
                DB::table('procesos')->insert($chunk);
                $this->progress['inserted'] += count($chunk);
            }
        });

        $this->progress['done_days']++;
        $this->cursorDay = Carbon::parse($day)->addDay()->format('Y-m-d');
    }

    public function getProcesosProperty()
    {
        return Proceso::query()
            ->where('temporada_id', $this->temporadaId)
            ->orderByDesc('fecha_g_produccion')
            ->orderByDesc('id')
            ->paginate($this->ctd);
    }

    public function getStatsProperty(): array
    {
        $base = Proceso::query()->where('temporada_id', $this->temporadaId);

        return [
            'procesos' => (clone $base)->distinct('numero_g_produccion')->count('numero_g_produccion'),
            'folios'   => (clone $base)->count(),
            'kilos'    => (clone $base)->sum('peso_neto'),
            'ultima'   => (clone $base)->latest('created_at')->value('created_at'),
        ];
    }

    public function eliminarTodo(): void
    {
        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $temporada->especie->name;

        $deleted = Proceso::query()
            ->where('temporada_id', $this->temporadaId)
            ->where('n_especie', $especie)
            ->delete();

        session()->flash('info', "Se eliminaron {$deleted} registros ({$especie}).");
        $this->resetPage();
    }

    /**
     * ✅ POST: enviamos filters en JSON body (lo más típico si POST)
     * ✅ Fallback opcional: si tu API en verdad lee solo querystring, puedes activar $useQueryFallback=true
     */
    private function fetchProcesos(string $start, string $end, string $especie): array
    {
        $gte = $start . ' 00:00:00';
        $lte = $end   . ' 23:59:59';

        $endpoint = "https://api.greenexweb.cl/api/productions";

        $payload = [
            'filter' => [
                'fecha_g_produccion' => [
                    'gte' => $gte,
                    'lte' => $lte,
                ],
                'n_especie' => [
                    'eq' => $especie,
                ],
            ],
        ];

        $resp = Http::retry(3, 250)
            ->timeout(90)
            ->acceptJson()
            ->asJson()
            ->post($endpoint, $payload);

        // 🔁 fallback si el API SOLO filtra por querystring aunque sea POST
        if (!$resp->ok()) {
            $resp = Http::retry(3, 250)
                ->timeout(90)
                ->acceptJson()
                ->post($endpoint . '?' . http_build_query($payload));
        }

        if (!$resp->ok()) {
            logger()->warning('ProcesoSync: API error', [
                'status' => $resp->status(),
                'body_snippet' => substr((string) $resp->body(), 0, 300),
                'payload' => $payload,
            ]);
            return [];
        }

        return $this->extractItemsFromApiResponse($resp->json());
    }

    private function extractItemsFromApiResponse($json): array
    {
        if (is_array($json)) {
            if (isset($json[0]) && is_array($json[0])) return $json;
            if (isset($json['data']) && is_array($json['data'])) return $json['data'];
            if (isset($json['productions']) && is_array($json['productions'])) return $json['productions'];
            if (isset($json['results']) && is_array($json['results'])) return $json['results'];
        }
        return [];
    }

    private function hasProcesoColumn(string $col): bool
    {
        if ($this->procesosColumns === null) {
            $this->procesosColumns = Schema::getColumnListing('procesos');
        }
        return in_array($col, $this->procesosColumns, true);
    }

    private function onlyExistingProcesoColumns(array $row): array
    {
        if ($this->procesosColumns === null) {
            $this->procesosColumns = Schema::getColumnListing('procesos');
        }
        $allowed = array_flip($this->procesosColumns);
        return array_intersect_key($row, $allowed);
    }

    public function render()
    {
        return view('livewire.proceso.proceso-sync', [
            'procesos' => $this->procesos,
            'stats'    => $this->stats,
        ]);
    }

 

    // ---- tus helpers de detectar rango (los dejo igual, funcionan) ----

    public function detectarRangoUltimos3Anios(): void
    {
        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $temporada->especie->name;

        $end = now()->startOfDay();
        $start = now()->subYears(3)->startOfDay();

        $firstMonth = $this->findFirstMonthWithData($start, $end, $especie);
        $lastMonth  = $this->findLastMonthWithData($start, $end, $especie);

        if (!$firstMonth || !$lastMonth) {
            session()->flash('info', "No se encontró data de PROCESOS para {$especie} en los últimos 3 años.");
            return;
        }

        $firstDay = $this->findFirstDayWithDataBinary(
            $firstMonth->copy()->startOfMonth(),
            $firstMonth->copy()->endOfMonth(),
            $especie
        );

        $lastDay  = $this->findLastDayWithDataBinary(
            $lastMonth->copy()->startOfMonth(),
            $lastMonth->copy()->endOfMonth(),
            $especie
        );


        if (!$firstDay || !$lastDay) {
            session()->flash('info', "Se encontró mes con data, pero no se pudo resolver día exacto.");
            return;
        }

        $this->fechai = $firstDay->format('Y-m-d');
        $this->fechaf = $lastDay->format('Y-m-d');

        $temporada->update([
            'proceso_start' => $this->fechai,
            'proceso_end'   => $this->fechaf,
        ]);
        session()->flash('success', "✅ Listo: rango detectado {$this->fechai} → {$this->fechaf} ({$especie}).");

     }
private function findFirstDayWithDataBinary(Carbon $start, Carbon $end, string $especie): ?Carbon
{
    // si no hay data en todo el rango, chao
    if (!$this->apiHasData($start->format('Y-m-d'), $end->format('Y-m-d'), $especie)) {
        return null;
    }

    $lo = $start->copy()->startOfDay();
    $hi = $end->copy()->startOfDay();

    while ($lo->lt($hi)) {
        $mid = $lo->copy()->addDays(intdiv($lo->diffInDays($hi), 2))->startOfDay();

        if ($this->apiHasData($lo->format('Y-m-d'), $mid->format('Y-m-d'), $especie)) {
            $hi = $mid;
        } else {
            $lo = $mid->copy()->addDay();
        }
    }

    return $lo;
}

private function findLastDayWithDataBinary(Carbon $start, Carbon $end, string $especie): ?Carbon
{
    if (!$this->apiHasData($start->format('Y-m-d'), $end->format('Y-m-d'), $especie)) {
        return null;
    }

    $lo = $start->copy()->startOfDay();
    $hi = $end->copy()->startOfDay();

    while ($lo->lt($hi)) {
        // mid hacia arriba para evitar loop infinito
        $mid = $lo->copy()->addDays((int) ceil($lo->diffInDays($hi) / 2))->startOfDay();

        if ($this->apiHasData($mid->format('Y-m-d'), $hi->format('Y-m-d'), $especie)) {
            $lo = $mid;
        } else {
            $hi = $mid->copy()->subDay();
        }
    }

    return $lo;
}

    private function findFirstMonthWithData(Carbon $start, Carbon $end, string $especie): ?Carbon
    {
        $cursor = $start->copy()->startOfMonth();

        while ($cursor <= $end) {
            $monthStart = $cursor->copy()->startOfMonth()->format('Y-m-d');
            $monthEnd   = $cursor->copy()->endOfMonth()->format('Y-m-d');

            if ($this->apiHasData($monthStart, $monthEnd, $especie)) return $cursor->copy();

            $cursor->addMonth();
        }

        return null;
    }

    private function findLastMonthWithData(Carbon $start, Carbon $end, string $especie): ?Carbon
    {
        $cursor = $end->copy()->startOfMonth();

        while ($cursor >= $start) {
            $monthStart = $cursor->copy()->startOfMonth()->format('Y-m-d');
            $monthEnd   = $cursor->copy()->endOfMonth()->format('Y-m-d');

            if ($this->apiHasData($monthStart, $monthEnd, $especie)) return $cursor->copy();

            $cursor->subMonth();
        }

        return null;
    }

    private function findFirstDayWithData(Carbon $start, Carbon $end, string $especie): ?Carbon
    {
        $cursor = $start->copy()->startOfDay();

        while ($cursor <= $end) {
            $d = $cursor->format('Y-m-d');
            if ($this->apiHasData($d, $d, $especie)) return $cursor->copy();
            $cursor->addDay();
        }

        return null;
    }

    private function findLastDayWithData(Carbon $start, Carbon $end, string $especie): ?Carbon
    {
        $cursor = $end->copy()->startOfDay();

        while ($cursor >= $start) {
            $d = $cursor->format('Y-m-d');
            if ($this->apiHasData($d, $d, $especie)) return $cursor->copy();
            $cursor->subDay();
        }

        return null;
    }

    private function apiHasData(string $start, string $end, string $especie): bool
    {
        return !empty($this->fetchProcesos($start, $end, $especie));
    }
}
