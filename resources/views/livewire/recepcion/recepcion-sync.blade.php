<div class="space-y-4">

  @if(session('info'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
      {{ session('info') }}
    </div>
  @endif
@if(!empty($syncDebug))
  <div class="bg-yellow-50 border border-yellow-200 rounded p-3 text-xs">
    <div class="font-bold mb-2">Debug Sync (por rango)</div>
    <ul class="space-y-1">
      @foreach($syncDebug as $d)
        <li>
          {{ $d['start'] }} → {{ $d['end'] }} |
          count: <b>{{ $d['count'] }}</b> |
          first_fecha: {{ $d['first_fecha'] ?? '—' }} |
          first_folio: {{ $d['first_folio'] ?? '—' }}
        </li>
      @endforeach
    </ul>
  </div>
@endif

  {{-- CARDS --}}
  <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
    <div class="bg-white shadow rounded-lg p-4 text-center">
      <div class="text-2xl font-bold">{{ number_format($stats['recepciones']) }}</div>
      <div class="text-sm text-gray-500">Recepciones</div>
    </div>
    <div class="bg-white shadow rounded-lg p-4 text-center">
      <div class="text-2xl font-bold">{{ number_format($stats['folios']) }}</div>
      <div class="text-sm text-gray-500">Folios</div>
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

      <div class="flex items-end">
        {{-- ✅ BOTÓN SIEMPRE VISIBLE --}}
        <button
          type="button"
          wire:click="sync"
          wire:loading.attr="disabled"
          class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 font-semibold disabled:opacity-60">
          <span wire:loading.remove>Sincronizar recepciones</span>
          <span wire:loading>Sincronizando…</span>
        </button>
      </div>
    </div>
  </div>

  {{-- TABLA --}}
  <div class="bg-white shadow rounded-lg">
    <div class="p-3">
      {{ $recepcions->links() }}
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="text-center whitespace-nowrap px-3 py-2">Empresa</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Tipo</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Recepción</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Fecha</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Folio</th>
            <th class="text-center whitespace-nowrap px-3 py-2">Kilos</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @forelse($recepcions as $r)
            <tr class="hover:bg-gray-50">
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $r->c_empresa ?? 'N/A' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $r->tipo_g_recepcion ?? 'N/A' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $r->numero_g_recepcion ?? 'N/A' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">
                {{ $r->fecha_g_recepcion ? date('d M Y', strtotime($r->fecha_g_recepcion)) : 'N/A' }}
              </td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $r->folio ?? 'N/A' }}</td>
              <td class="text-center whitespace-nowrap px-3 py-2">{{ $r->peso_neto ?? 'N/A' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-gray-500 py-10">Sin datos</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="p-3">
      {{ $recepcions->links() }}
    </div>
  </div>
</div>
