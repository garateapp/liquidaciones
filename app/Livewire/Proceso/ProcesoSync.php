<?php

namespace App\Livewire\Proceso;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

use App\Models\Temporada;
use App\Models\Sync;

// ✅ AJUSTA ESTE MODELO A TU TABLA LOCAL
use App\Models\Proceso;

class ProcesoSync extends Component
{
    use WithPagination;

    public int $temporadaId;
    public bool $syncRunning = false;
    public ?string $cursorDay = null;

    public array $progress = [
        'total_days' => 0,
        'done_days' => 0,
        'fetched' => 0,
        'inserted' => 0,
        'current_day' => null,
    ];

    public int $ctd = 25;
    public ?string $fechai = null;
    public ?string $fechaf = null;

    public array $syncDebug = [];

    public function mount(int $temporadaId): void
    {
        $this->temporadaId = $temporadaId;

        $temporada = Temporada::findOrFail($this->temporadaId);

        // ✅ usa columnas propias para procesos (recomendado)
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

        // ✅ guardar rango en DB
        $temporada->update([
            'proceso_start' => $this->fechai,
            'proceso_end'   => $this->fechaf,
        ]);

        $this->syncDebug = [];
        $this->syncRunning = true;

        $this->cursorDay = Carbon::parse($this->fechai)->format('Y-m-d');

        $totalDays = Carbon::parse($this->fechai)->diffInDays(Carbon::parse($this->fechaf)) + 1;

        $this->progress = [
            'total_days' => $totalDays,
            'done_days' => 0,
            'fetched' => 0,
            'inserted' => 0,
            'current_day' => $this->cursorDay,
        ];
    }

    public function tickSync(): void
    {
        if (!$this->syncRunning || !$this->cursorDay) return;

        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $temporada->especie->name;

        $day = $this->cursorDay;

        // cortar si ya pasamos el final
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
                "Sync OK. {$especie}. API: {$this->progress['fetched']} | Insertados: {$this->progress['inserted']}."
            );

            $this->resetPage();
            return;
        }

        // 1) traer items del API para ese día
        $items = $this->fetchProcesos($day, $day, $especie);

        $this->syncDebug[] = [
            'start' => $day,
            'end' => $day,
            'count' => count($items),
            'first_fecha' => $items[0]['fecha_g_produccion'] ?? null,
            'first_folio' => $items[0]['folio'] ?? null,
            'first_num'   => $items[0]['numero_g_produccion'] ?? null,
        ];

        $this->progress['current_day'] = $day;
        $this->progress['fetched'] += count($items);

        // 2) reemplazo por día (delete + insert)
        DB::transaction(function () use ($day, $items, $especie) {

            DB::table('procesos')
                ->where('temporada_id', $this->temporadaId)
                ->where('n_especie', $especie)
                ->where('fecha_g_produccion', 'like', $day . '%')
                ->delete();

            if (empty($items)) return;

            $rows = [];
            $now = now();

            foreach ($items as $p) {
                $rows[] = [
                    'temporada_id' => $this->temporadaId,
                    'n_especie' => $p['n_especie'] ?? ($p['n_especie_proceso'] ?? $especie),

                    'fecha_g_produccion'   => $p['fecha_g_produccion'] ?? null,
                    'numero_g_produccion'  => $p['numero_g_produccion'] ?? null,
                    'tipo_g_produccion'    => $p['tipo_g_produccion'] ?? null,
                    'folio'                => $p['folio'] ?? null,

                    // totales vienen como total_peso_neto / total_cantidad desde tu endpoint
                    'peso_neto' => $p['total_peso_neto'] ?? ($p['peso_neto'] ?? null),
                    'cantidad'  => $p['total_cantidad'] ?? ($p['cantidad'] ?? null),

                    'c_empresa' => $p['c_empresa'] ?? null,

                    // ---- Campos extra útiles (agrega los que tengas en tu tabla local) ----
                    'id_g_produccion'       => $p['id_g_produccion'] ?? null,
                    'id_productor'          => $p['id_productor'] ?? null,
                    'c_productor'           => $p['c_productor'] ?? null,
                    'n_productor'           => $p['n_productor'] ?? null,
                    'id_variedad'           => $p['id_variedad'] ?? null,
                    'n_variedad'            => $p['n_variedad'] ?? null,
                    'id_embalaje'           => $p['id_embalaje'] ?? null,
                    'c_embalaje'            => $p['c_embalaje'] ?? null,
                    'n_embalaje'            => $p['n_embalaje'] ?? null,
                    'id_calibre'            => $p['id_calibre'] ?? null,
                    'c_calibre'             => $p['c_calibre'] ?? null,
                    'n_calibre'             => $p['n_calibre'] ?? null,
                    'c_etiqueta'            => $p['c_etiqueta'] ?? null,
                    'n_etiqueta'            => $p['n_etiqueta'] ?? null,
                    't_categoria'           => $p['t_categoria'] ?? null,
                    'c_categoria'           => $p['c_categoria'] ?? null,
                    'n_categoria'           => $p['n_categoria'] ?? null,

                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            foreach (array_chunk($rows, 200) as $chunk) {
                DB::table('procesos')->insert($chunk);
                $this->progress['inserted'] += count($chunk);
            }
        });

        $this->progress['done_days']++;

        // avanzar al siguiente día
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

    private function fetchProcesos(string $start, string $end, string $especie): array
    {
        $gte = $start . ' 00:00:00';
        $lte = $end   . ' 23:59:59';

        $url = "https://api.greenexweb.cl/api/productions"
            . "?filter[fecha_g_produccion][gte]=" . urlencode($gte)
            . "&filter[fecha_g_produccion][lte]=" . urlencode($lte)
            . "&filter[n_especie][eq]=" . urlencode($especie);

        $resp = Http::retry(3, 250)
            ->timeout(90)
            ->acceptJson()
            ->post($url);

        $json = $resp->json();
        $items = $this->extractItemsFromApiResponse($json);

        if (empty($items)) {
            logger()->warning('ProcesoSync: API returned 0 items', [
                'status' => $resp->status(),
                'url' => $url,
                'body_snippet' => substr((string) $resp->body(), 0, 250),
            ]);
        }

        return $items;
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

    public function render()
    {
        return view('livewire.proceso.proceso-sync', [
            'procesos' => $this->procesos,
            'stats'    => $this->stats,
        ]);
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
        session()->flash('info', "No se encontró data de PROCESOS para {$especie} en los últimos 3 años.");
        return;
    }

    $firstDay = $this->findFirstDayWithData(
        $firstMonth->copy()->startOfMonth(),
        $firstMonth->copy()->endOfMonth(),
        $especie
    );

    $lastDay  = $this->findLastDayWithData(
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

    // ✅ guardar rango en DB
    $temporada->update([
        'proceso_start' => $this->fechai,
        'proceso_end'   => $this->fechaf,
    ]);

    session()->flash(
        'info',
        "Rango PROCESOS detectado y guardado: {$this->fechai} → {$this->fechaf} ({$especie})."
    );
}
private function findFirstMonthWithData(Carbon $start, Carbon $end, string $especie): ?Carbon
{
    $cursor = $start->copy()->startOfMonth();

    while ($cursor <= $end) {
        $monthStart = $cursor->copy()->startOfMonth()->format('Y-m-d');
        $monthEnd   = $cursor->copy()->endOfMonth()->format('Y-m-d');

        if ($this->apiHasData($monthStart, $monthEnd, $especie)) {
            return $cursor->copy();
        }

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

        if ($this->apiHasData($monthStart, $monthEnd, $especie)) {
            return $cursor->copy();
        }

        $cursor->subMonth();
    }

    return null;
}

private function findFirstDayWithData(Carbon $start, Carbon $end, string $especie): ?Carbon
{
    $cursor = $start->copy()->startOfDay();

    while ($cursor <= $end) {
        $d = $cursor->format('Y-m-d');
        if ($this->apiHasData($d, $d, $especie)) {
            return $cursor->copy();
        }
        $cursor->addDay();
    }

    return null;
}

private function findLastDayWithData(Carbon $start, Carbon $end, string $especie): ?Carbon
{
    $cursor = $end->copy()->startOfDay();

    while ($cursor >= $start) {
        $d = $cursor->format('Y-m-d');
        if ($this->apiHasData($d, $d, $especie)) {
            return $cursor->copy();
        }
        $cursor->subDay();
    }

    return null;
}
private function apiHasData(string $start, string $end, string $especie): bool
{
    $items = $this->fetchProcesos($start, $end, $especie);
    return !empty($items);
}

}
