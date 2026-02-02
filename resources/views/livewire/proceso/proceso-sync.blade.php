<div class="space-y-4">

  @if(session('info'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
      {{ session('info') }}
    </div>
  @endif
@if(session('success'))
  <div class="bg-emerald-100 border border-emerald-300 text-emerald-900 px-4 py-3 rounded">
    {{ session('success') }}
  </div>
@endif

  @if($syncRunning)
    <div wire:poll.1s="tickSync" class="bg-white shadow rounded p-4 space-y-2">
      <div class="flex justify-between text-sm">
        <div>Día: <b>{{ $progress['current_day'] }}</b></div>
        <div>
          @php
            $pct = $progress['total_days'] > 0 ? round(($progress['done_days'] / $progress['total_days']) * 100) : 0;
          @endphp
          <b>{{ $pct }}%</b>
        </div>
      </div>

      <div class="w-full bg-gray-200 rounded h-3 overflow-hidden">
        <div class="h-3 bg-blue-600" style="width: {{ $pct }}%"></div>
      </div>

      <div class="text-xs text-gray-600">
        {{ $progress['done_days'] }}/{{ $progress['total_days'] }} días |
        API: {{ number_format($progress['fetched']) }} |
        Insertados: {{ number_format($progress['inserted']) }}
      </div>
    </div>
  @endif

  @if(!empty($syncDebug))
    <div class="bg-yellow-50 border border-yellow-200 rounded p-3 text-xs">
      <div class="font-bold mb-2">Debug Sync (por día)</div>
      <ul class="space-y-1">
        @foreach($syncDebug as $d)
          <li>
            {{ $d['start'] ?? '—' }} → {{ $d['end'] ?? '—' }} |
            count: <b>{{ $d['count'] ?? 0 }}</b> |
            first_fecha: {{ $d['first_fecha'] ?? '—' }} |
            first_folio: {{ $d['first_folio'] ?? '—' }} |
            first_num: {{ $d['first_num'] ?? '—' }}
          </li>

        @endforeach
      </ul>
    </div>
  @endif

  {{-- CARDS --}}
  <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
    <div class="bg-white shadow rounded-lg p-4 text-center">
      <div class="text-2xl font-bold">{{ number_format($stats['procesos']) }}</div>
      <div class="text-sm text-gray-500">Procesos</div>
    </div>
    <div class="bg-white shadow rounded-lg p-4 text-center">
      <div class="text-2xl font-bold">{{ number_format($stats['folios']) }}</div>
      <div class="text-sm text-gray-500">Filas</div>
    </div>
    <div class="bg-white shadow rounded-lg p-4 text-center">
      <div class="text-2xl font-bold">{{ number_format($stats['kilos']) }}</div>
      <div class="text-sm text-gray-500">Kilos Totales</div>
    </div>
    <div class="bg-white shadow rounded-lg p-4 text-center">
      <div class="text-sm font-semibold">
        {{ $stats['ultima'] ? \Carbon\Carbon::parse($stats['ultima'])->format('d-m-Y H:i') : '—' }}
      </div>
      <div class="text-sm text-gray-500">Último registro</div>
    </div>
  </div>

  {{-- CONTROLES --}}
  <div class="bg-white shadow rounded-lg p-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="text-xs font-bold text-gray-700">FECHA I</label>
        <input type="date" wire:model="fechai" class="mt-1 w-full rounded border-gray-300 bg-gray-50" />
        @error('fechai') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
      </div>

      <div>
        <label class="text-xs font-bold text-gray-700">FECHA F</label>
        <input type="date" wire:model="fechaf" class="mt-1 w-full rounded border-gray-300 bg-gray-50" />
        @error('fechaf') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="flex items-end gap-2">
        <button
            type="button"
            wire:click="detectarRangoUltimos3Anios"
            wire:loading.attr="disabled"
            class="w-full rounded-lg bg-gray-700 hover:bg-gray-800 text-white px-4 py-3 font-semibold disabled:opacity-60">
            <span wire:loading.remove>Detectar rango (últimos 3 años)</span>
            <span wire:loading>Detectando…</span>
        </button>

        <button
          type="button"
          wire:click="startSync"
          wire:loading.attr="disabled"
          class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 font-semibold disabled:opacity-60">
          <span wire:loading.remove>Sincronizar procesos</span>
          <span wire:loading>Sincronizando…</span>
        </button>

        <button
          type="button"
          wire:click="eliminarTodo"
          wire:confirm="¿Seguro? Esto elimina TODOS los registros sincronizados de esta temporada/especie."
          class="w-full rounded-lg bg-red-600 hover:bg-red-700 text-white px-4 py-3 font-semibold">
          Eliminar todo
        </button>
      </div>
    </div>
  </div>

  {{-- TABLA --}}
  <div class="bg-white shadow rounded-lg">
    <div class="p-3">
      {{ $procesos->links() }}
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="text-center whitespace-nowrap px-3 py-2">Empresa</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Producción</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Fecha</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Folio</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Kilos</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @forelse($procesos as $p)
            <tr class="hover:bg-gray-50">
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $p->c_empresa ?? 'N/A' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $p->numero_g_produccion ?? 'N/A' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">
                {{ $p->fecha_g_produccion ? date('d M Y', strtotime($p->fecha_g_produccion)) : 'N/A' }}
              </td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $p->folio ?? 'N/A' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $p->peso_neto ?? 'N/A' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-gray-500 py-10">Sin datos</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="p-3">
      {{ $procesos->links() }}
    </div>
  </div>
</div>
