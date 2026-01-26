<?php

namespace App\Livewire\Recepcion;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

use App\Models\Recepcion;
use App\Models\Temporada;
use App\Models\Sync;

class RecepcionSync extends Component
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

        $this->fechai = $temporada->recepcion_start ?: now()->subDays(7)->format('Y-m-d');
        $this->fechaf = $temporada->recepcion_end   ?: now()->format('Y-m-d');
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
                'entidad'  => 'RECEPCIONES',
                'fecha'    => Carbon::now(),
                'cantidad' => $this->progress['fetched'] ?? 0,
            ]);

            session()->flash('info', "Sync OK. {$especie}. API: {$this->progress['fetched']} | Insertados: {$this->progress['inserted']}.");
            $this->resetPage();
            return;
        }

        // 1) traer items del API para ese día
        $items = $this->fetchReceptions($day, $day, $especie);

        $this->syncDebug[] = [
            'start' => $day,
            'end' => $day,
            'count' => count($items),
            'first_fecha' => $items[0]['fecha_g_recepcion'] ?? null,
            'first_folio' => $items[0]['folio'] ?? null,
        ];

        $this->progress['current_day'] = $day;
        $this->progress['fetched'] += count($items);

        // 2) reemplazo por día (delete + insert)
        DB::transaction(function () use ($day, $items, $especie) {

            DB::table('recepcions')
                ->where('temporada_id', $this->temporadaId)
                ->where('n_especie', $especie)
                ->where('fecha_g_recepcion', 'like', $day . '%')
                ->delete();

            if (empty($items)) return;

            $rows = [];
            $now = now();

            foreach ($items as $p) {
                $rows[] = [
                    'temporada_id' => $this->temporadaId,
                    'n_especie' => $p['n_especie'] ?? $especie,
                    'fecha_g_recepcion' => $p['fecha_g_recepcion'] ?? null,
                    'numero_g_recepcion' => $p['numero_g_recepcion'] ?? null,
                    'folio' => $p['folio'] ?? null,
                    'peso_neto' => $p['total_peso_neto'] ?? ($p['peso_neto'] ?? null),
                    'cantidad' => $p['total_cantidad'] ?? ($p['cantidad'] ?? null),
                    'c_empresa' => $p['c_empresa'] ?? null,
                    'tipo_g_recepcion' => $p['tipo_g_recepcion'] ?? null,
                    // ... resto campos ...
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            foreach (array_chunk($rows, 200) as $chunk) {
                DB::table('recepcions')->insert($chunk);
                $this->progress['inserted'] += count($chunk);
            }
        });

        $this->progress['done_days']++;

        // avanzar al siguiente día
        $this->cursorDay = Carbon::parse($day)->addDay()->format('Y-m-d');
    }

    public function startSync(): void
    {
        $this->validate([
            'fechai' => ['required', 'date'],
            'fechaf' => ['required', 'date', 'after_or_equal:fechai'],
        ]);

        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);

        // guardar rango en DB (opcional pero recomendado)
        $temporada->update([
            'recepcion_start' => $this->fechai,
            'recepcion_end'   => $this->fechaf,
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

    public function getRecepcionsProperty()
    {
        return Recepcion::query()
            ->where('temporada_id', $this->temporadaId)
            ->orderByDesc('fecha_g_recepcion')
            ->orderByDesc('id')
            ->paginate($this->ctd);
    }

    public function getStatsProperty(): array
    {
        $base = Recepcion::query()->where('temporada_id', $this->temporadaId);

        return [
            'recepciones' => (clone $base)->distinct('numero_g_recepcion')->count('numero_g_recepcion'),
            'folios'      => (clone $base)->count(),
            'kilos'       => (clone $base)->sum('peso_neto'),
            'ultima'      => (clone $base)->latest('created_at')->value('created_at'),
        ];
    }

    public function eliminarTodo(): void
    {
        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $temporada->especie->name;

        $deleted = Recepcion::query()
            ->where('temporada_id', $this->temporadaId)
            ->where('n_especie', $especie)
            ->delete();

        session()->flash('info', "Se eliminaron {$deleted} registros ({$especie}).");
        $this->resetPage();
    }

    /**
     * ✅ Sync robusto sin clave única:
     * - Trae datos del API por rangos
     * - Agrupa por DÍA (Y-m-d)
     * - Por cada día: borra local ese día (temporada+especie) y luego inserta lo del API
     */
    public function sync(): void
    {
        $this->validate([
            'fechai' => ['required', 'date'],
            'fechaf' => ['required', 'date', 'after_or_equal:fechai'],
        ]);

        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);
        $especie = $temporada->especie->name;

        $this->syncDebug = [];

        $totalFetched = 0;
        $totalInserted = 0;
        $daysProcessed = 0;

        foreach ($this->buildRanges($this->fechai, $this->fechaf, 5) as $range) {

            $items = $this->fetchReceptions($range['start'], $range['end'], $especie);

            $this->syncDebug[] = [
                'start' => $range['start'],
                'end'   => $range['end'],
                'count' => count($items),
                'first_fecha' => $items[0]['fecha_g_recepcion'] ?? null,
                'first_folio' => $items[0]['folio'] ?? null,
            ];

            if (empty($items)) {
                continue;
            }

            $totalFetched += count($items);

            // ✅ ordenar por fecha (si el API no ordena)
            usort($items, function ($a, $b) {
                return strcmp((string)($a['fecha_g_recepcion'] ?? ''), (string)($b['fecha_g_recepcion'] ?? ''));
            });

            // ✅ agrupar por día
            $byDay = [];
            foreach ($items as $p) {
                $dt = $p['fecha_g_recepcion'] ?? null;
                if (!$dt) continue;

                try {
                    $day = Carbon::parse($dt)->format('Y-m-d');
                } catch (\Throwable $e) {
                    continue; // fecha inválida -> ignorar
                }

                $byDay[$day][] = $p;
            }

            foreach ($byDay as $day => $dayItems) {
                DB::transaction(function () use ($day, $dayItems, $especie, &$totalInserted, &$daysProcessed) {

                    // ✅ 1) borrar TODO ese día (como string)
                    DB::table('recepcions')
                        ->where('temporada_id', $this->temporadaId)
                        ->where('n_especie', $especie)
                        ->where('fecha_g_recepcion', 'like', $day . '%')
                        ->delete();

                    // ✅ 2) insertar lo del día
                    $now  = now();
                    $rows = [];

                    foreach ($dayItems as $p) {
                        $rows[] = [
                            'temporada_id' => $this->temporadaId,

                            'c_empresa'          => $p['c_empresa'] ?? null,
                            'tipo_g_recepcion'   => $p['tipo_g_recepcion'] ?? null,
                            'numero_g_recepcion' => $p['numero_g_recepcion'] ?? null,
                            'fecha_g_recepcion'  => $p['fecha_g_recepcion'] ?? null,
                            'n_transportista'    => $p['n_transportista'] ?? null,
                            'id_exportadora'     => $p['id_exportadora'] ?? null,
                            'folio'              => $p['folio'] ?? null,
                            'fecha_cosecha'      => $p['fecha_cosecha'] ?? null,
                            'n_grupo'            => $p['n_grupo'] ?? null,
                            'r_productor'        => $p['r_productor'] ?? null,
                            'c_productor'        => $p['c_productor'] ?? null,
                            'id_especie'         => $p['id_especie'] ?? null,
                            'n_especie'          => $p['n_especie'] ?? $especie,
                            'id_variedad'        => $p['id_variedad'] ?? null,
                            'c_envase'           => $p['c_envase'] ?? null,
                            'c_categoria'        => $p['c_categoria'] ?? null,
                            't_categoria'        => $p['t_categoria'] ?? null,
                            'c_calibre'          => $p['c_calibre'] ?? null,
                            'c_serie'            => $p['c_serie'] ?? null,

                            'cantidad'  => $p['total_cantidad'] ?? ($p['cantidad'] ?? null),
                            'peso_neto' => $p['total_peso_neto'] ?? ($p['peso_neto'] ?? null),

                            'destruccion_tipo'   => $p['destruccion_tipo'] ?? null,
                            'creacion_tipo'      => $p['creacion_tipo'] ?? null,
                            'Notas'              => $p['Notas'] ?? null,
                            'n_estado'           => $p['n_estado'] ?? null,
                            'N_tratamiento'      => $p['N_tratamiento'] ?? null,
                            'n_tipo_cobro'       => $p['n_tipo_cobro'] ?? null,
                            'N_productor_rotulado'   => $p['N_productor_rotulado'] ?? ($p['n_productor_rotulado'] ?? null),
                            'CSG_productor_rotulado' => $p['CSG_productor_rotulado'] ?? null,
                            'destruccion_id'     => $p['destruccion_id'] ?? null,

                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }

                    // ✅ Insert en chunks para evitar placeholders
                    $chunkSize = 200;
                    foreach (array_chunk($rows, $chunkSize) as $chunk) {
                        DB::table('recepcions')->insert($chunk);
                        $totalInserted += count($chunk);
                    }

                    $daysProcessed++;
                });
            }
        }

        // guardar rango usado en temporada
        $temporada->update([
            'recepcion_start' => $this->fechai,
            'recepcion_end'   => $this->fechaf,
        ]);

        // registrar sync
        Sync::create([
            'tipo'     => 'MANUAL',
            'entidad'  => 'RECEPCIONES',
            'fecha'    => Carbon::now(),
            'cantidad' => $totalFetched,
        ]);

        session()->flash(
            'info',
            "Sync OK. Especie: {$especie}. API trajo {$totalFetched} filas. Insertadas: {$totalInserted}. Días procesados: {$daysProcessed}."
        );

        $this->resetPage();
    }

    /**
     * Rango inclusivo real de N días.
     * intervalDays=5 => [1..5], [6..10], ...
     */
    private function buildRanges(string $start, string $end, int $intervalDays = 5): array
    {
        $ranges = [];

        $s = new DateTime($start);
        $e = new DateTime($end);

        while ($s <= $e) {
            $rangeEnd = (clone $s)->modify('+' . ($intervalDays - 1) . ' days');
            if ($rangeEnd > $e) $rangeEnd = $e;

            $ranges[] = [
                'start' => $s->format('Y-m-d'),
                'end'   => $rangeEnd->format('Y-m-d'),
            ];

            $s = (clone $rangeEnd)->modify('+1 day');
        }

        return $ranges;
    }

    /**
     * Fetch correcto: endpoint POST + filtros por querystring
     * - fecha_g_recepcion gte/lte (datetime completo)
     * - n_especie eq
     */
    private function fetchReceptions(string $start, string $end, string $especie): array
    {
        $gte = $start . ' 00:00:00';
        $lte = $end   . ' 23:59:59';

        $url = "https://api.greenexweb.cl/api/receptions"
            . "?filter[fecha_g_recepcion][gte]=" . urlencode($gte)
            . "&filter[fecha_g_recepcion][lte]=" . urlencode($lte)
            . "&filter[n_especie][eq]=" . urlencode($especie);

        $resp = Http::retry(3, 250)
            ->timeout(60)
            ->acceptJson()
            ->post($url);

        $json = $resp->json();
        $items = $this->extractItemsFromApiResponse($json);

        if (empty($items)) {
            logger()->warning('RecepcionSync: API returned 0 items', [
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
            if (isset($json['receptions']) && is_array($json['receptions'])) return $json['receptions'];
            if (isset($json['results']) && is_array($json['results'])) return $json['results'];
        }
        return [];
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
            session()->flash('info', "No se encontró data para {$especie} en los últimos 3 años.");
            return;
        }

        $firstDay = $this->findFirstDayWithData($firstMonth->copy()->startOfMonth(), $firstMonth->copy()->endOfMonth(), $especie);
        $lastDay  = $this->findLastDayWithData($lastMonth->copy()->startOfMonth(),  $lastMonth->copy()->endOfMonth(),  $especie);

        if (!$firstDay || !$lastDay) {
            session()->flash('info', "Se encontró mes con data, pero no se pudo resolver día exacto.");
            return;
        }

        $this->fechai = $firstDay->format('Y-m-d');
        $this->fechaf = $lastDay->format('Y-m-d');

        // ✅ guardar en DB
        $temporada->update([
            'recepcion_start' => $this->fechai,
            'recepcion_end'   => $this->fechaf,
        ]);

        session()->flash('info', "Rango detectado y guardado: {$this->fechai} → {$this->fechaf} ({$especie}).");

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
        $items = $this->fetchReceptions($start, $end, $especie);
        return !empty($items);
    }

    public function render()
    {
        return view('livewire.recepcion.recepcion-sync', [
            'recepcions' => $this->recepcions,
            'stats'      => $this->stats,
        ]);
    }
}
