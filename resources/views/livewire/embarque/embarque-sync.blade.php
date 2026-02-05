<div class="space-y-4">

  @if(session('success'))
    <div class="bg-emerald-100 border border-emerald-300 text-emerald-900 px-4 py-3 rounded">
      {{ session('success') }}
    </div>
  @endif

  @if(session('info'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
      {{ session('info') }}
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
        Insertados: {{ number_format($progress['inserted']) }} |
        Fallidos: {{ number_format($progress['failed_days']) }}
      </div>
    </div>
  @endif

  {{-- CARDS --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
    <div class="bg-white shadow rounded-lg p-4 text-center">
      <div class="text-2xl font-bold">{{ number_format($stats['embarques']) }}</div>
      <div class="text-sm text-gray-500">Embarques</div>
    </div>
    <div class="bg-white shadow rounded-lg p-4 text-center">
      <div class="text-2xl font-bold">{{ number_format($stats['filas']) }}</div>
      <div class="text-sm text-gray-500">Filas</div>
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
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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

      <div class="flex items-end">
        <button
          type="button"
          wire:click="detectarRangoUltimos3Anios"
          class="w-full rounded-lg bg-slate-800 hover:bg-slate-900 text-white px-4 py-3 font-semibold">
          Detectar (3 años)
        </button>
      </div>

      <div class="flex items-end gap-2">
        <button
          type="button"
          wire:click="startSync"
          wire:loading.attr="disabled"
          class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 font-semibold disabled:opacity-60">
          <span wire:loading.remove>Sincronizar</span>
          <span wire:loading>Sincronizando…</span>
        </button>

        <button
          type="button"
          wire:click="eliminarTodo"
          wire:confirm="¿Seguro? Esto elimina TODOS los embarques sincronizados de esta temporada."
          class="w-full rounded-lg bg-red-600 hover:bg-red-700 text-white px-4 py-3 font-semibold">
          Eliminar todo
        </button>
      </div>
    </div>
  </div>

  {{-- TABLA --}}
  <div class="bg-white shadow rounded-lg">
    <div class="p-3">
      {{ $embarques->links() }}
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="text-center whitespace-nowrap px-3 py-2">Embarque</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Fecha</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Nave</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Transporte</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Despacho</th>
            <th class="text-center whitespace-nowrap px-3 py-2">ETD</th>
            <th class="text-center whitespace-nowrap px-3 py-2">ETA</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @forelse($embarques as $e)
            <tr class="hover:bg-gray-50">
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $e->n_embarque ?? '—' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $e->fecha_embarque ?? '—' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $e->nave ?? '—' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $e->transporte ?? '—' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $e->numero_g_despacho ?? '—' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $e->etd ?? '—' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $e->eta ?? '—' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-gray-500 py-10">Sin datos</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="p-3">
      {{ $embarques->links() }}
    </div>
  </div>

</div>
