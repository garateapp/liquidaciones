<?php

namespace App\Livewire\Despacho;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

use App\Models\Temporada;
use App\Models\Sync;
use App\Models\Despacho;

class DespachoSync extends Component
{
    use WithPagination;

    public int $temporadaId;
    public bool $syncRunning = false;
    public ?string $cursorDay = null;

    public array $progress = [
        'total_days'  => 0,
        'done_days'   => 0,
        'fetched'     => 0,
        'inserted'    => 0,
        'current_day' => null,
        'failed_days' => 0,
    ];

    public int $ctd = 25;
    public ?string $fechai = null;
    public ?string $fechaf = null;

    public array $syncDebug = [];

    // ✅ solo UNA cache de columnas
    private ?array $despachosColumns = null;

    public function mount(int $temporadaId): void
    {
        $this->temporadaId = $temporadaId;

        $t = Temporada::findOrFail($temporadaId);

        // defaults decentes si vienen null
        $this->fechai = $t->despacho_start ?: now()->subDays(7)->format('Y-m-d');
        $this->fechaf = $t->despacho_end   ?: now()->format('Y-m-d');
    }

    public function startSync(): void
    {
        $this->validate([
            'fechai' => ['required', 'date'],
            'fechaf' => ['required', 'date', 'after_or_equal:fechai'],
        ]);

        $t = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $t->especie->name;

        $t->update([
            'despacho_start' => $this->fechai,
            'despacho_end'   => $this->fechaf,
        ]);

        $this->syncRunning = true;
        $this->syncDebug = [];

        $this->cursorDay = Carbon::parse($this->fechai)->format('Y-m-d');

        $totalDays = Carbon::parse($this->fechai)->diffInDays(Carbon::parse($this->fechaf)) + 1;

        $this->progress = [
            'total_days'  => $totalDays,
            'done_days'   => 0,
            'fetched'     => 0,
            'inserted'    => 0,
            'current_day' => $this->cursorDay,
            'failed_days' => 0,
        ];

        // ✅ precarga columnas (como ProcesoSync)
        $this->despachosColumns = Schema::getColumnListing('despachos');

        session()->flash('success', "✅ Sync de DESPACHOS iniciado ({$especie}).");
    }

    public function tickSync(): void
    {
        if (!$this->syncRunning || !$this->cursorDay) return;

        $t = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $t->especie->name;

        $day = $this->cursorDay;

        if (Carbon::parse($day)->gt(Carbon::parse($this->fechaf))) {
            $this->finishSync($especie);
            return;
        }

        try {
            $items = $this->fetchDespachos($day, $day, $especie);
        } catch (\Throwable $e) {
            $this->progress['failed_days']++;
            $this->syncDebug[] = ['day' => $day, 'error' => $e->getMessage()];
            $this->cursorDay = Carbon::parse($day)->addDay()->format('Y-m-d');
            return;
        }

        $this->syncDebug[] = [
            'day' => $day,
            'count' => count($items),
            'first_fecha' => $items[0]['fecha_g_despacho'] ?? null,
            'first_folio' => $items[0]['folio'] ?? null,
            'first_num'   => $items[0]['numero_g_despacho'] ?? null,
        ];

        $this->progress['current_day'] = $day;
        $this->progress['fetched'] += count($items);

        $gte = $day . ' 00:00:00';
        $lte = $day . ' 23:59:59';

        DB::transaction(function () use ($items, $especie, $gte, $lte) {

            DB::table('despachos')
                ->where('temporada_id', $this->temporadaId)
                ->where('n_especie', $especie)
                ->whereBetween('fecha_g_despacho', [$gte, $lte])
                ->delete();

            if (empty($items)) return;

            $now = now();
            $rows = [];

            foreach ($items as $d) {
                $row = [
                    'temporada_id'      => $this->temporadaId,
                    'n_especie'         => $d['n_especie'] ?? $especie,

                    'id_pkg_stock_det'  => $d['id_pkg_stock_det'] ?? null,
                    'tipo_g_despacho'   => $d['tipo_g_despacho'] ?? null,
                    'numero_g_despacho' => $d['numero_g_despacho'] ?? null,
                    'fecha_g_despacho'  => $d['fecha_g_despacho'] ?? null,

                    'folio'    => $d['folio'] ?? null,
                    'cantidad' => $d['cantidad'] ?? null,
                    'peso_neto' => $d['peso_neto'] ?? null,
                    'estado'   => $d['estado'] ?? null,

                    'id_empresa' => $d['id_empresa'] ?? null,
                    'n_empresa'  => $d['n_empresa'] ?? null,

                    // raw opcional si existe columna
                    'raw' => $this->hasDespachoColumn('raw')
                        ? json_encode($d, JSON_UNESCAPED_UNICODE)
                        : null,

                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                // ✅ aquí está el fix real (no array_flip($this->columns))
                $rows[] = $this->onlyExistingDespachoColumns($row);
            }

            foreach (array_chunk($rows, 200) as $chunk) {
                DB::table('despachos')->insert($chunk);
                $this->progress['inserted'] += count($chunk);
            }
        });

        $this->progress['done_days']++;
        $this->cursorDay = Carbon::parse($day)->addDay()->format('Y-m-d');
    }

    private function finishSync(string $especie): void
    {
        $this->syncRunning = false;

        Sync::create([
            'tipo'     => 'MANUAL',
            'entidad'  => 'DESPACHOS',
            'fecha'    => now(),
            'cantidad' => $this->progress['fetched'] ?? 0,
        ]);

        session()->flash(
            'success',
            "✅ DESPACHOS OK {$especie} | API: {$this->progress['fetched']} | Insertados: {$this->progress['inserted']} | Fallidos: {$this->progress['failed_days']}"
        );

        $this->resetPage();
    }

    private function fetchDespachos(string $start, string $end, string $especie): array
    {
        $gte = $start . ' 00:00:00';
        $lte = $end   . ' 23:59:59';

        $endpoint = "https://api.greenexweb.cl/api/dispatches";

        $payload = [
            'filter' => [
                'fecha_g_despacho' => ['gte' => $gte, 'lte' => $lte],
                'n_especie' => ['eq' => $especie],
            ],
        ];

        $resp = Http::retry(3, 250)
            ->timeout(180) // despachos a veces es pesado
            ->acceptJson()
            ->asJson()
            ->post($endpoint, $payload);

        if (!$resp->ok()) {
            logger()->warning('DespachoSync: API error', [
                'status' => $resp->status(),
                'body_snippet' => substr((string) $resp->body(), 0, 300),
                'payload' => $payload,
            ]);
            return [];
        }

        $json = $resp->json();

        // ✅ soporta array directo o data/results
        if (is_array($json)) {
            if (isset($json[0]) && is_array($json[0])) return $json;
            if (isset($json['data']) && is_array($json['data'])) return $json['data'];
            if (isset($json['results']) && is_array($json['results'])) return $json['results'];
        }

        return [];
    }

    private function hasDespachoColumn(string $col): bool
    {
        if ($this->despachosColumns === null) {
            $this->despachosColumns = Schema::getColumnListing('despachos');
        }
        return in_array($col, $this->despachosColumns, true);
    }

    private function onlyExistingDespachoColumns(array $row): array
    {
        if ($this->despachosColumns === null) {
            $this->despachosColumns = Schema::getColumnListing('despachos');
        }

        $allowed = array_flip($this->despachosColumns ?: []);
        return array_intersect_key($row, $allowed);
    }

    public function detectarRangoUltimos3Anios(): void
    {
        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $temporada->especie->name;

        $end = now()->startOfDay();
        $start = now()->subYears(3)->startOfDay();

        $firstMonth = $this->findFirstMonthWithData($start, $end, $especie);
        $lastMonth  = $this->findLastMonthWithData($start, $end, $especie);

        if (!$firstMonth || !$lastMonth) {
            session()->flash('info', "No se encontró data de DESPACHOS para {$especie} en los últimos 3 años.");
            return;
        }

        $firstDay = $this->findFirstDayWithDataBinary(
            $firstMonth->copy()->startOfMonth(),
            $firstMonth->copy()->endOfMonth(),
            $especie
        );

        $lastDay = $this->findLastDayWithDataBinary(
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
            'despacho_start' => $this->fechai,
            'despacho_end'   => $this->fechaf,
        ]);

        session()->flash('success', "✅ Listo: rango DESPACHOS detectado {$this->fechai} → {$this->fechaf} ({$especie}).");
    }

    private function findFirstDayWithDataBinary(Carbon $start, Carbon $end, string $especie): ?Carbon
    {
        if (!$this->apiHasData($start->format('Y-m-d'), $end->format('Y-m-d'), $especie)) return null;

        $lo = $start->copy()->startOfDay();
        $hi = $end->copy()->startOfDay();

        while ($lo->lt($hi)) {
            $mid = $lo->copy()->addDays(intdiv($lo->diffInDays($hi), 2))->startOfDay();

            if ($this->apiHasData($lo->format('Y-m-d'), $mid->format('Y-m-d'), $especie)) $hi = $mid;
            else $lo = $mid->copy()->addDay();
        }

        return $lo;
    }

    private function findLastDayWithDataBinary(Carbon $start, Carbon $end, string $especie): ?Carbon
    {
        if (!$this->apiHasData($start->format('Y-m-d'), $end->format('Y-m-d'), $especie)) return null;

        $lo = $start->copy()->startOfDay();
        $hi = $end->copy()->startOfDay();

        while ($lo->lt($hi)) {
            $mid = $lo->copy()->addDays((int) ceil($lo->diffInDays($hi) / 2))->startOfDay();

            if ($this->apiHasData($mid->format('Y-m-d'), $hi->format('Y-m-d'), $especie)) $lo = $mid;
            else $hi = $mid->copy()->subDay();
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

    private function apiHasData(string $start, string $end, string $especie): bool
    {
        return !empty($this->fetchDespachos($start, $end, $especie));
    }

    public function getDespachosProperty()
    {
        return Despacho::where('temporada_id', $this->temporadaId)
            ->orderByDesc('fecha_g_despacho')
            ->orderByDesc('id')
            ->paginate($this->ctd);
    }

    public function getStatsProperty(): array
    {
        $base = Despacho::where('temporada_id', $this->temporadaId);

        return [
            'despachos' => (clone $base)->distinct('numero_g_despacho')->count('numero_g_despacho'),
            'filas'     => (clone $base)->count(),
            'kilos'     => (clone $base)->sum('peso_neto'),
            'ultima'    => (clone $base)->latest('created_at')->value('created_at'),
        ];
    }

    public function eliminarTodo(): void
    {
        $t = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $t->especie->name;

        $deleted = Despacho::where('temporada_id', $this->temporadaId)
            ->where('n_especie', $especie)
            ->delete();

        session()->flash('info', "Se eliminaron {$deleted} DESPACHOS ({$especie}).");
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.despacho.despacho-sync', [
            'despachos' => $this->despachos,
            'stats'     => $this->stats,
        ]);
    }
}
