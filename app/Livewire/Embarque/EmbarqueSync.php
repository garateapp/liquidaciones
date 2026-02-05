<?php

namespace App\Livewire\Embarque;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

use App\Models\Temporada;
use App\Models\Sync;
use App\Models\Embarque;

class EmbarqueSync extends Component
{
    use WithPagination;

    public int $temporadaId;
    public bool $syncRunning = false;
    public ?string $cursorDay = null;

    public int $ctd = 25;
    public ?string $fechai = null;
    public ?string $fechaf = null;

    public array $progress = [
        'total_days'  => 0,
        'done_days'   => 0,
        'fetched'     => 0,
        'inserted'    => 0,
        'current_day' => null,
        'failed_days' => 0,
    ];

    public array $syncDebug = [];

    private ?array $embarquesColumns = null;

    public function mount(int $temporadaId): void
    {
        $this->temporadaId = $temporadaId;

        $t = Temporada::findOrFail($temporadaId);
        $this->fechai = $t->embarque_start ?? now()->subDays(7)->format('Y-m-d');
        $this->fechaf = $t->embarque_end   ?? now()->format('Y-m-d');
    }

    public function startSync(): void
    {
        $this->validate([
            'fechai' => ['required', 'date'],
            'fechaf' => ['required', 'date', 'after_or_equal:fechai'],
        ]);

        $t = Temporada::findOrFail($this->temporadaId);
        $t->update([
            'embarque_start' => $this->fechai,
            'embarque_end'   => $this->fechaf,
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

        $this->embarquesColumns = Schema::getColumnListing('embarques');
    }

    public function tickSync(): void
    {
        if (!$this->syncRunning || !$this->cursorDay) return;

        $day = $this->cursorDay;

        if (Carbon::parse($day)->gt(Carbon::parse($this->fechaf))) {
            $this->finishSync();
            return;
        }

        try {
            $items = $this->fetchEmbarques($day, $day);
        } catch (\Throwable $e) {
            $this->progress['failed_days']++;
            $this->syncDebug[] = ['day' => $day, 'error' => $e->getMessage()];
            $this->cursorDay = Carbon::parse($day)->addDay()->format('Y-m-d');
            return;
        }

        $this->progress['current_day'] = $day;
        $this->progress['fetched'] += count($items);

        $gte = $day . ' 00:00:00';
        $lte = $day . ' 23:59:59';

        DB::transaction(function () use ($items, $gte, $lte) {

            // ✅ reemplazo exacto del día por rango
            DB::table('embarques')
                ->where('temporada_id', $this->temporadaId)
                ->whereBetween('fecha_embarque', [$gte, $lte])
                ->delete();

            if (empty($items)) return;

            $now = now();
            $rows = [];

            foreach ($items as $s) {
                $row = [
                    'temporada_id' => $this->temporadaId,

                    'n_embarque'            => $s['n_embarque'] ?? null,
                    'fecha_embarque'        => $s['fecha_embarque'] ?? null,
                    'nave'                  => $s['nave'] ?? null,
                    'transporte'            => $s['transporte'] ?? null,
                    'fecha_despacho'        => $s['fecha_despacho'] ?? null,
                    'numero_g_despacho'     => $s['numero_g_despacho'] ?? null,
                    'numero_guia_produccion'=> $s['numero_guia_produccion'] ?? null,
                    'etd'                   => $s['etd'] ?? null,
                    'eta'                   => $s['eta'] ?? null,

                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                $rows[] = $this->onlyExistingEmbarqueColumns($row);
            }

            foreach (array_chunk($rows, 300) as $chunk) {
                DB::table('embarques')->insert($chunk);
                $this->progress['inserted'] += count($chunk);
            }
        });

        $this->progress['done_days']++;
        $this->cursorDay = Carbon::parse($day)->addDay()->format('Y-m-d');
    }

    private function finishSync(): void
    {
        $this->syncRunning = false;

        Sync::create([
            'tipo'     => 'MANUAL',
            'entidad'  => 'EMBARQUES',
            'fecha'    => now(),
            'cantidad' => $this->progress['fetched'] ?? 0,
        ]);

        session()->flash(
            'success',
            "✅ EMBARQUES OK | API: {$this->progress['fetched']} | Insertados: {$this->progress['inserted']} | Fallidos: {$this->progress['failed_days']}"
        );

        $this->resetPage();
    }

    private function fetchEmbarques(string $start, string $end): array
    {
        $endpoint = "https://api.greenexweb.cl/api/shipments";

        $payload = [
            'filter' => [
                'fecha_embarque' => [
                    'gte' => $start . ' 00:00:00',
                    'lte' => $end   . ' 23:59:59',
                ],
            ],
        ];

        $resp = Http::retry(3, 250)
            ->timeout(90)
            ->acceptJson()
            ->asJson()
            ->post($endpoint, $payload);

        if (!$resp->ok()) {
            logger()->warning('EmbarqueSync: API error', [
                'status' => $resp->status(),
                'body_snippet' => substr((string) $resp->body(), 0, 300),
                'payload' => $payload,
            ]);
            return [];
        }

        $json = $resp->json();
        return $this->extractItemsFromApiResponse($json);
    }

    private function extractItemsFromApiResponse($json): array
    {
        if (is_array($json)) {
            if (isset($json[0]) && is_array($json[0])) return $json;
            if (isset($json['data']) && is_array($json['data'])) return $json['data'];
            if (isset($json['shipments']) && is_array($json['shipments'])) return $json['shipments'];
            if (isset($json['results']) && is_array($json['results'])) return $json['results'];
        }
        return [];
    }

    private function onlyExistingEmbarqueColumns(array $row): array
    {
        if ($this->embarquesColumns === null) {
            $this->embarquesColumns = Schema::getColumnListing('embarques');
        }
        $allowed = array_flip($this->embarquesColumns);
        return array_intersect_key($row, $allowed);
    }

    public function detectarRangoUltimos3Anios(): void
    {
        $end = now()->startOfDay();
        $start = now()->subYears(3)->startOfDay();

        $firstMonth = $this->findFirstMonthWithData($start, $end);
        $lastMonth  = $this->findLastMonthWithData($start, $end);

        if (!$firstMonth || !$lastMonth) {
            session()->flash('info', "No se encontró data de EMBARQUES en los últimos 3 años.");
            return;
        }

        $firstDay = $this->findFirstDayWithDataBinary($firstMonth->copy()->startOfMonth(), $firstMonth->copy()->endOfMonth());
        $lastDay  = $this->findLastDayWithDataBinary($lastMonth->copy()->startOfMonth(), $lastMonth->copy()->endOfMonth());

        if (!$firstDay || !$lastDay) {
            session()->flash('info', "Se encontró mes con data, pero no se pudo resolver día exacto.");
            return;
        }

        $this->fechai = $firstDay->format('Y-m-d');
        $this->fechaf = $lastDay->format('Y-m-d');

        Temporada::whereKey($this->temporadaId)->update([
            'embarque_start' => $this->fechai,
            'embarque_end'   => $this->fechaf,
        ]);

        session()->flash('success', "✅ Rango EMBARQUES detectado {$this->fechai} → {$this->fechaf}.");
    }

    private function findFirstMonthWithData(Carbon $start, Carbon $end): ?Carbon
    {
        $cursor = $start->copy()->startOfMonth();
        while ($cursor <= $end) {
            if ($this->apiHasData($cursor->copy()->startOfMonth(), $cursor->copy()->endOfMonth())) return $cursor->copy();
            $cursor->addMonth();
        }
        return null;
    }

    private function findLastMonthWithData(Carbon $start, Carbon $end): ?Carbon
    {
        $cursor = $end->copy()->startOfMonth();
        while ($cursor >= $start) {
            if ($this->apiHasData($cursor->copy()->startOfMonth(), $cursor->copy()->endOfMonth())) return $cursor->copy();
            $cursor->subMonth();
        }
        return null;
    }

    private function findFirstDayWithDataBinary(Carbon $start, Carbon $end): ?Carbon
    {
        if (!$this->apiHasData($start, $end)) return null;

        $lo = $start->copy()->startOfDay();
        $hi = $end->copy()->startOfDay();

        while ($lo->lt($hi)) {
            $mid = $lo->copy()->addDays(intdiv($lo->diffInDays($hi), 2))->startOfDay();
            if ($this->apiHasData($lo, $mid)) $hi = $mid;
            else $lo = $mid->copy()->addDay();
        }

        return $lo;
    }

    private function findLastDayWithDataBinary(Carbon $start, Carbon $end): ?Carbon
    {
        if (!$this->apiHasData($start, $end)) return null;

        $lo = $start->copy()->startOfDay();
        $hi = $end->copy()->startOfDay();

        while ($lo->lt($hi)) {
            $mid = $lo->copy()->addDays((int) ceil($lo->diffInDays($hi) / 2))->startOfDay();
            if ($this->apiHasData($mid, $hi)) $lo = $mid;
            else $hi = $mid->copy()->subDay();
        }

        return $lo;
    }

    private function apiHasData(Carbon $start, Carbon $end): bool
    {
        $items = $this->fetchEmbarques($start->format('Y-m-d'), $end->format('Y-m-d'));
        return !empty($items);
    }

    public function getEmbarquesProperty()
    {
        return Embarque::query()
            ->where('temporada_id', $this->temporadaId)
            ->orderByDesc('fecha_embarque')
            ->orderByDesc('id')
            ->paginate($this->ctd);
    }

    public function getStatsProperty(): array
    {
        $base = Embarque::query()->where('temporada_id', $this->temporadaId);

        return [
            'embarques' => (clone $base)->distinct('n_embarque')->count('n_embarque'),
            'filas'     => (clone $base)->count(),
            'ultima'    => (clone $base)->latest('created_at')->value('created_at'),
        ];
    }

    public function eliminarTodo(): void
    {
        $deleted = Embarque::query()
            ->where('temporada_id', $this->temporadaId)
            ->delete();

        session()->flash('info', "Se eliminaron {$deleted} EMBARQUES.");
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.embarque.embarque-sync', [
            'embarques' => $this->embarques,
            'stats'     => $this->stats,
        ]);
    }
}
