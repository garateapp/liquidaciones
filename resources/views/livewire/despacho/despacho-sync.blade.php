<div class="space-y-4">

    {{-- NOTIFICACIONES --}}
    @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-300 text-emerald-900 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-100 border border-blue-300 text-blue-900 px-4 py-3 rounded">
            {{ session('info') }}
        </div>
    @endif

    {{-- PROGRESO --}}
    @if($syncRunning)
        <div wire:poll.1s="tickSync" class="bg-white shadow rounded p-4 space-y-2">
            <div class="flex justify-between text-sm">
                <div>Día: <b>{{ $progress['current_day'] }}</b></div>
                <div>
                    @php
                        $pct = $progress['total_days'] > 0
                            ? round(($progress['done_days'] / $progress['total_days']) * 100)
                            : 0;
                    @endphp
                    <b>{{ $pct }}%</b>
                </div>
            </div>

            <div class="w-full bg-gray-200 rounded h-3 overflow-hidden">
                <div class="h-3 bg-blue-600 transition-all"
                     style="width: {{ $pct }}%"></div>
            </div>

            <div class="text-xs text-gray-600">
                {{ $progress['done_days'] }}/{{ $progress['total_days'] }} días |
                API: {{ number_format($progress['fetched']) }} |
                Insertados: {{ number_format($progress['inserted']) }} |
                Fallidos: {{ number_format($progress['failed_days']) }}
            </div>
        </div>
    @endif

    {{-- DEBUG --}}
    @if(!empty($syncDebug))
        <div class="bg-yellow-50 border border-yellow-200 rounded p-3 text-xs">
            <div class="font-bold mb-2">Debug Sync (por día)</div>
            <ul class="space-y-1">
                @foreach($syncDebug as $d)
                    <li>
                        Día: {{ $d['day'] ?? '—' }}
                        @if(isset($d['error']))
                            | ❌ {{ $d['error'] }}
                        @else
                            | count: <b>{{ $d['count'] ?? 0 }}</b>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <div class="text-2xl font-bold">{{ number_format($stats['despachos']) }}</div>
            <div class="text-sm text-gray-500">Despachos</div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 text-center">
            <div class="text-2xl font-bold">{{ number_format($stats['filas']) }}</div>
            <div class="text-sm text-gray-500">Filas</div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 text-center">
            <div class="text-2xl font-bold">{{ number_format($stats['kilos']) }}</div>
            <div class="text-sm text-gray-500">Kilos</div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 text-center">
            <div class="text-sm font-semibold">
                {{ $stats['ultima']
                    ? \Carbon\Carbon::parse($stats['ultima'])->format('d-m-Y H:i')
                    : '—' }}
            </div>
            <div class="text-sm text-gray-500">Último registro</div>
        </div>
    </div>

    {{-- CONTROLES --}}
    <div class="bg-white shadow rounded-lg p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

            <div>
                <label class="text-xs font-bold text-gray-700">FECHA INICIO</label>
                <input type="date" wire:model="fechai"
                       class="mt-1 w-full rounded border-gray-300 bg-gray-50">
                @error('fechai')
                    <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-xs font-bold text-gray-700">FECHA TÉRMINO</label>
                <input type="date" wire:model="fechaf"
                       class="mt-1 w-full rounded border-gray-300 bg-gray-50">
                @error('fechaf')
                    <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button
                    type="button"
                    wire:click="detectarRangoUltimos3Anios"
                    wire:loading.attr="disabled"
                    class="w-full rounded-lg bg-gray-700 hover:bg-gray-800 text-white px-4 py-3 font-semibold disabled:opacity-60">
                    <span wire:loading.remove>Detectar rango (3 años)</span>
                    <span wire:loading>Detectando…</span>
                </button>
            </div>

            <div class="flex gap-2">
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
                    wire:confirm="¿Seguro? Esto elimina TODOS los despachos sincronizados."
                    class="w-full rounded-lg bg-red-600 hover:bg-red-700 text-white px-4 py-3 font-semibold">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="bg-white shadow rounded-lg">
        <div class="p-3">
            {{ $despachos->links() }}
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 text-center">Empresa</th>
                        <th class="px-3 py-2 text-center">Despacho</th>
                        <th class="px-3 py-2 text-center">Fecha</th>
                        <th class="px-3 py-2 text-center">Folio</th>
                        <th class="px-3 py-2 text-center">Kilos</th>
                        <th class="px-3 py-2 text-center">Estado</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($despachos as $d)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 text-center">{{ $d->n_empresa ?? '—' }}</td>
                            <td class="px-3 py-2 text-center">{{ $d->numero_g_despacho }}</td>
                            <td class="px-3 py-2 text-center">
                                {{ \Carbon\Carbon::parse($d->fecha_g_despacho)->format('d-m-Y') }}
                            </td>
                            <td class="px-3 py-2 text-center">{{ $d->folio ?? '—' }}</td>
                            <td class="px-3 py-2 text-center">{{ number_format($d->peso_neto, 2) }}</td>
                            <td class="px-3 py-2 text-center">{{ $d->estado ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-10">
                                Sin datos
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $despachos->links() }}
        </div>
    </div>
</div>
