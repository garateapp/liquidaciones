<div 
    x-data="{ 
        open: @entangle('detalleOpen'), 
        selected: @entangle('selectedCostoId') 
    }"
    class="grid grid-cols-12 gap-6 overflow-visible px-4"
>
    {{-- IZQUIERDA: TABLA PRINCIPAL --}}
    <div class="col-span-7 xl:col-span-8 min-w-0">
        <h1 class="mt-2 text-xl font-bold text-gray-800 ml-4">
            Categoría: <span class="text-green-600">Exportación</span>
        </h1>

        {{-- Contenedor scrollable --}}
        <div class="mt-3 pr-3 h-[calc(100vh-140px)] overflow-y-auto">
            <table class="w-full border-2 divide-y divide-gray-200 shadow-sm rounded-lg">
                <thead class="bg-white border-b sticky top-0 z-10">
                    <tr>
                        <th class="bg-gray-200 font-semibold px-3 py-2 w-40"></th>
                        <th class="bg-gray-200 font-semibold px-3 py-2">Concepto</th>
                        <th class="bg-gray-200 font-semibold px-3 py-2 text-right">Totales</th>
                        <th class="bg-gray-200 font-semibold px-3 py-2 text-right">Valor Unitario</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    {{-- Totales base --}}
                    <tr>
                        <td class="bg-gray-100 font-semibold px-3 py-2"></td>
                        <td class="bg-gray-100 font-semibold px-3 py-2">Suma de Peso Neto</td>
                        <td class="font-semibold px-3 py-2 text-right">
                            {{ number_format($total_kilos, 0, ',', '.') }} kg
                        </td>
                        <td class="font-semibold px-3 py-2 text-right">—</td>
                    </tr>

                    <tr>
                        <td class="bg-gray-100 font-semibold px-3 py-2">Ingresos</td>
                        <td class="bg-gray-100 font-semibold px-3 py-2">Σ(precio_unitario × peso_neto)</td>
                        <td class="px-3 py-2 text-right">
                            $ {{ number_format($ingresos_total, 0, ',', '.') }}
                        </td>
                        <td class="px-3 py-2 text-right">
                            $ {{ number_format($vu_promedio, 2, ',', '.') }} /kg
                        </td>
                    </tr>

                    {{-- Costos agrupados --}}
                    @foreach($this->costosAgrupados as $grupo)
                        <tr class="bg-gray-200 text-gray-800">
                            <td class="font-semibold px-3 py-2">Costos</td>
                            <td class="font-semibold px-3 py-2">{{ $grupo['menu'] }}</td>
                            <td class="px-3 py-2"></td>
                            <td class="px-3 py-2"></td>
                        </tr>

                        @foreach($grupo['items'] as $costo)
                            @php
                                $totalCosto = $this->calcularTotalCosto($costo);
                                $vuCosto    = $this->valorUnitarioParaMostrar($costo);
                                $isPorCaja  = strtoupper($costo->metodo ?? '') === 'POR_CAJA';
                            @endphp

                            <tr 
                                class="transition-all duration-200 cursor-pointer
                                       hover:bg-green-100 hover:ring-2 hover:ring-green-300
                                       @if($selectedCostoId === $costo->id) bg-green-50 ring-2 ring-green-500 @endif"
                                wire:mouseenter="previewDetalle({{ $costo->id }})"
                                wire:click="mostrarDetalle({{ $costo->id }})"
                            >
                                <td class="px-3 py-2 bg-gray-50"></td>
                                <td class="px-3 py-2">
                                    <span class="font-medium text-gray-800">{{ $costo->name }}</span>
                                    @if($costo->metodo)
                                        <span class="text-xs text-gray-500 ml-1">
                                            ({{ strtoupper($costo->metodo) }})
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-right text-gray-700">
                                    $ {{ number_format($totalCosto, 0, ',', '.') }}
                                </td>
                                <td class="px-3 py-2 text-right text-gray-700">
                                    $ {{ number_format($vuCosto, 2, ',', '.') }} {{ $isPorCaja ? '/caja' : '/kg' }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach

                    {{-- Totales y resultados --}}
                    <tr class="border-t-2 bg-gray-100">
                        <td class="font-bold px-3 py-2">Totales</td>
                        <td class="font-bold px-3 py-2">Costos</td>
                        <td class="px-3 py-2 text-right font-bold">
                            $ {{ number_format($totalCostos, 0, ',', '.') }}
                        </td>
                        <td class="px-3 py-2 text-right font-bold">
                            @if($total_kilos > 0)
                                $ {{ number_format($totalCostos / $total_kilos, 2, ',', '.') }} /kg
                            @else
                                —
                            @endif
                        </td>
                    </tr>

                    <tr class="bg-green-50 border-t-2">
                        <td class="font-bold px-3 py-2 text-green-800">Resultado</td>
                        <td class="font-bold px-3 py-2 text-green-800">Ingresos - Costos</td>
                        <td class="px-3 py-2 text-right font-bold text-green-800">
                            $ {{ number_format($resultado, 0, ',', '.') }}
                        </td>
                        <td class="px-3 py-2 text-right font-bold text-green-800">
                            $ {{ number_format($vu_resultado, 2, ',', '.') }} /kg
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- DERECHA: PANEL STICKY DE DETALLE --}}
    <div class="col-span-5 xl:col-span-4">
        <div x-show="open" x-cloak class="sticky top-4 z-10">
            <div class="h-[calc(100vh-32px)] overflow-y-auto flex justify-center">
                <div
                    class="w-full max-w-[560px] bg-white border border-gray-200 rounded-xl shadow-lg p-5 space-y-4"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-6"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 translate-x-6"
                >
                    {{-- Header --}}
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $detalle['name'] ?? 'Detalle del costo' }}
                            </h3>
                            <p class="text-xs text-gray-500">
                                Método: {{ $detalle['metodo'] ?? '—' }}
                                @if(!empty($detalle['regla'])) | Regla: {{ $detalle['regla'] }} @endif
                            </p>
                        </div>
                        <button 
                            class="text-gray-400 hover:text-gray-600 transition"
                            wire:click="cerrarDetalle"
                            title="Cerrar detalle"
                        >✕</button>
                    </div>

                    {{-- Explicación --}}
                    @if(!empty($detalle['explica']))
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $detalle['explica'] }}</p>
                    @endif

                    {{-- Resumen --}}
                    @if(!empty($detalle['resumen']))
                        <div class="border rounded-lg overflow-hidden">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 text-gray-600 sticky top-0">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Item</th>
                                        <th class="px-3 py-2 text-right">Cant.</th>
                                        <th class="px-3 py-2 text-right">Tarifa</th>
                                        <th class="px-3 py-2 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach($detalle['resumen'] as $r)
                                        <tr class="border-t hover:bg-gray-50">
                                            <td class="px-3 py-2">{{ $r['col1'] ?? '' }}</td>
                                            <td class="px-3 py-2 text-right">{{ $r['col2'] ?? '' }}</td>
                                            <td class="px-3 py-2 text-right">{{ $r['col3'] ?? '' }}</td>
                                            <td class="px-3 py-2 text-right font-medium text-gray-800">{{ $r['col4'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    {{-- Totales --}}
                    @if(!empty($detalle['totales']))
                        <div class="border rounded-lg p-3 bg-gray-50">
                            @foreach($detalle['totales'] as $k => $v)
                                <div class="flex justify-between text-sm py-0.5">
                                    <span class="text-gray-600">{{ $k }}</span>
                                    <span class="font-semibold text-gray-800">{{ $v }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Notas --}}
                    @if(!empty($detalle['notas']))
                        <div class="text-xs text-gray-500">
                            {{ $detalle['notas'] }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
