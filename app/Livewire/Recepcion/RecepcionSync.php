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
public array $syncDebug = [];

    public int $ctd = 25;
    public ?string $fechai = null;
    public ?string $fechaf = null;

    public function mount(int $temporadaId): void
    {
        $this->temporadaId = $temporadaId;

        $temporada = Temporada::findOrFail($this->temporadaId);

        $this->fechai = $temporada->recepcion_start ?: now()->subDays(7)->format('Y-m-d');
        $this->fechaf = $temporada->recepcion_end   ?: now()->format('Y-m-d');
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

    public function sync(): void
    {
        $this->validate([
            'fechai' => ['required', 'date'],
            'fechaf' => ['required', 'date', 'after_or_equal:fechai'],
        ]);

        $temporada = Temporada::with('especie')->findOrFail($this->temporadaId);

        $before = Recepcion::where('temporada_id', $this->temporadaId)->count();

            $this->syncDebug = []; // limpiar

            foreach ($this->buildRanges($this->fechai, $this->fechaf, 5) as $range) {
                $items = $this->fetchReceptionsSmart($range['start'], $range['end']);

                $this->syncDebug[] = [
                    'start' => $range['start'],
                    'end' => $range['end'],
                    'count' => count($items),
                    'first_fecha' => $items[0]['fecha_g_recepcion'] ?? null,
                    'first_folio' => $items[0]['folio'] ?? null,
                ];

                if (empty($items)) {
                    continue;
                }

                $now  = now();
                $rows = [];

                foreach ($items as $p) {
                    $rows[] = [
                        'temporada_id' => $this->temporadaId,

                        'c_empresa'        => $p['c_empresa'] ?? null,
                        'tipo_g_recepcion' => $p['tipo_g_recepcion'] ?? null,
                        'numero_g_recepcion' => $p['numero_g_recepcion'] ?? null,
                        'fecha_g_recepcion'  => $p['fecha_g_recepcion'] ?? null,
                        'n_transportista'  => $p['n_transportista'] ?? null,
                        'id_exportadora'   => $p['id_exportadora'] ?? null,
                        'folio'            => $p['folio'] ?? null,
                        'fecha_cosecha'    => $p['fecha_cosecha'] ?? null,
                        'n_grupo'          => $p['n_grupo'] ?? null,
                        'r_productor'      => $p['r_productor'] ?? null,
                        'c_productor'      => $p['c_productor'] ?? null,
                        'id_especie'       => $p['id_especie'] ?? null,
                        'n_especie'        => $p['n_especie'] ?? null,
                        'id_variedad'      => $p['id_variedad'] ?? null,
                        'c_envase'         => $p['c_envase'] ?? null,
                        'c_categoria'      => $p['c_categoria'] ?? null,
                        't_categoria'      => $p['t_categoria'] ?? null,
                        'c_calibre'        => $p['c_calibre'] ?? null,
                        'c_serie'          => $p['c_serie'] ?? null,

                        'cantidad' => $p['total_cantidad'] ?? ($p['cantidad'] ?? null),
                        'peso_neto' => $p['total_peso_neto'] ?? ($p['peso_neto'] ?? null),

                        'destruccion_tipo' => $p['destruccion_tipo'] ?? null,
                        'creacion_tipo'    => $p['creacion_tipo'] ?? null,
                        'Notas'            => $p['Notas'] ?? null,
                        'n_estado'         => $p['n_estado'] ?? null,
                        'N_tratamiento'    => $p['N_tratamiento'] ?? null,
                        'n_tipo_cobro'     => $p['n_tipo_cobro'] ?? null,
                        'N_productor_rotulado' => $p['N_productor_rotulado'] ?? ($p['n_productor_rotulado'] ?? null),
                        'CSG_productor_rotulado' => $p['CSG_productor_rotulado'] ?? null,
                        'destruccion_id'   => $p['destruccion_id'] ?? null,

                        'updated_at' => $now,
                        'created_at' => $now,
                    ];
                }

                // ✅ por ahora tu clave actual (luego la afinamos con id_productor/id_categoria/etc)
                DB::table('recepcions')->upsert(
                    $rows,
                    ['temporada_id', 'numero_g_recepcion', 'folio'],
                    [
                        'c_empresa','tipo_g_recepcion','fecha_g_recepcion','n_transportista','id_exportadora',
                        'fecha_cosecha','n_grupo','r_productor','c_productor','id_especie','n_especie',
                        'id_variedad','c_envase','c_categoria','t_categoria','c_calibre','c_serie',
                        'cantidad','peso_neto','destruccion_tipo','creacion_tipo','Notas','n_estado',
                        'N_tratamiento','n_tipo_cobro','N_productor_rotulado','CSG_productor_rotulado',
                        'destruccion_id','updated_at'
                    ]
                );
            }

        $temporada->update([
            'recepcion_start' => $this->fechai,
            'recepcion_end'   => $this->fechaf,
        ]);

        $after = Recepcion::where('temporada_id', $this->temporadaId)->count();
        $inserted = max(0, $after - $before);

        Sync::create([
            'tipo'    => 'MANUAL',
            'entidad' => 'RECEPCIONES',
            'fecha'   => Carbon::now(),
            'cantidad'=> $inserted,
        ]);

        session()->flash('info', "Sincronización OK. Nuevos: {$inserted}");
        $this->resetPage();
    }

    private function buildRanges(string $start, string $end, int $intervalDays = 5): array
    {
        $ranges = [];
        $s = new DateTime($start);
        $e = new DateTime($end);

        while ($s <= $e) {
            $rangeEnd = (clone $s)->modify("+{$intervalDays} days");
            if ($rangeEnd > $e) $rangeEnd = $e;

            $ranges[] = [
                'start' => $s->format('Y-m-d'),
                'end'   => $rangeEnd->format('Y-m-d'),
            ];

            $s = (clone $rangeEnd)->modify("+1 day");
        }

        return $ranges;
    }

   private function fetchReceptionsSmart(string $start, string $end): array
{
    $temporada = \App\Models\Temporada::with('especie')->findOrFail($this->temporadaId);
    $exportadora = $temporada->exportadora_id ?: 22;
    $especie = $temporada->especie->name;

    // Variantes de fecha: algunas APIs aceptan solo YYYY-MM-DD, otras necesitan datetime
    $variants = [
        // 1) solo fecha
        ['gte' => $start, 'lte' => $end],
        // 2) datetime completo
        ['gte' => $start.' 00:00:00', 'lte' => $end.' 23:59:59'],
        // 3) ISO (por si acaso)
        ['gte' => $start.'T00:00:00', 'lte' => $end.'T23:59:59'],
    ];

    // Variantes de filtros: si el API no filtra por especie/exportadora, probamos sin ellos
    $filterCombos = [
        ['use_especie' => true,  'use_exportadora' => true],
        ['use_especie' => true,  'use_exportadora' => false],
        ['use_especie' => false, 'use_exportadora' => true],
        ['use_especie' => false, 'use_exportadora' => false],
    ];

    foreach ($variants as $v) {
        foreach ($filterCombos as $combo) {

            $url = "https://api.greenexweb.cl/api/receptions"
                . "?filter[fecha_g_recepcion][gte]=" . urlencode($v['gte'])
                . "&filter[fecha_g_recepcion][lte]=" . urlencode($v['lte']);

            if ($combo['use_especie']) {
                $url .= "&filter[n_especie][eq]=" . urlencode($especie);
            }
            if ($combo['use_exportadora']) {
                $url .= "&filter[id_exportadora][eq]=" . urlencode((string)$exportadora);
            }

            // OJO: como tu API es POST, respetamos POST.
            $resp = \Illuminate\Support\Facades\Http::retry(2, 200)
                ->timeout(60)
                ->acceptJson()
                ->post($url);

            $json = $resp->json();
            $items = $this->extractItemsFromApiResponse($json);

            // Si trae items, devolvemos al tiro
            if (!empty($items)) {
                return $items;
            }

            // Si no trae nada, dejamos log de diagnóstico para ver qué variante falló
            logger()->warning('RecepcionSync: API returned 0 items for variant', [
                'status' => $resp->status(),
                'url' => $url,
                'body_snippet' => substr((string) $resp->body(), 0, 250),
            ]);
        }
    }

    return [];
}

/**
 * Acepta respuestas tipo:
 * - [ {...}, {...} ]
 * - { "data": [ ... ] }
 * - { "receptions": [ ... ] }
 */
private function extractItemsFromApiResponse($json): array
{
    if (is_array($json)) {
        // caso: array directo de items
        if (isset($json[0]) && is_array($json[0])) return $json;

        // caso: objeto convertido a array con data
        if (isset($json['data']) && is_array($json['data'])) return $json['data'];
        if (isset($json['receptions']) && is_array($json['receptions'])) return $json['receptions'];
        if (isset($json['results']) && is_array($json['results'])) return $json['results'];
    }

    return [];
}


    public function render()
    {
        return view('livewire.recepcion.recepcion-sync', [
            'recepcions' => $this->recepcions,
            'stats' => $this->stats,
        ]);
    }
}
