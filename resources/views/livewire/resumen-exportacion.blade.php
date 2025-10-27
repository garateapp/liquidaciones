<div class="mt-4 px-6"  x-data="{ open: @entangle('detalleOpen'), selected: @entangle('selectedCostoId') }">
  <h1 class="text-xl font-semibold mb-3 ml-4">Categoría: Exportación</h1>

  {{-- Contenedor general con flex --}}
  <div class="flex w-full items-start gap-6">

  {{-- IZQUIERDA --}}
  <section class="flex-1 min-w-[720px] max-w-[900px]">
    <div class="h-[calc(100vh-160px)] overflow-y-auto pr-4">
        <table class="w-full border border-gray-200 divide-y divide-gray-200 shadow-sm">
          <thead class="bg-gray-100 sticky top-0 z-10">
            <tr>
              <th class="w-40 px-3 py-2 text-left font-semibold text-sm text-gray-700 bg-gray-200"></th>
              <th class="px-3 py-2 text-left font-semibold text-sm text-gray-700 bg-gray-200">Concepto</th>
              <th class="px-3 py-2 text-right font-semibold text-sm text-gray-700 bg-gray-200">Totales</th>
              <th class="px-3 py-2 text-right font-semibold text-sm text-gray-700 bg-gray-200">Valor Unitario</th>
            </tr>
          </thead>

          <tbody class="bg-white">
            {{-- Ejemplo de filas base --}}
            <tr>
              <td class="bg-gray-100 font-semibold px-3 py-2"></td>
              <td class="bg-gray-100 font-semibold px-3 py-2">Suma de Peso Neto</td>
              <td class="text-right px-3 py-2 font-semibold">{{ number_format($total_kilos, 0, ',', '.') }} kg</td>
              <td class="text-right px-3 py-2 font-semibold">—</td>
            </tr>

            <tr>
              <td class="bg-gray-100 font-semibold px-3 py-2">Ingresos</td>
              <td class="bg-gray-100 font-semibold px-3 py-2">Σ(precio_unitario × peso_neto)</td>
              <td class="text-right px-3 py-2 font-semibold">$ {{ number_format($ingresos_total, 0, ',', '.') }}</td>
              <td class="text-right px-3 py-2 font-semibold">$ {{ number_format($vu_promedio, 2, ',', '.') }} /kg</td>
            </tr>

            {{-- Costos agrupados --}}
            @foreach($this->costosAgrupados as $grupo)
              <tr class="bg-gray-50 border-t">
                <td class="font-semibold text-gray-800 px-3 py-2">Costos</td>
                <td class="font-semibold text-gray-800 px-3 py-2">{{ $grupo['menu'] }}</td>
                <td></td>
                <td></td>
              </tr>

              @foreach($grupo['items'] as $costo)
                @php
                  $totalCosto = $this->calcularTotalCosto($costo);
                  $vuCosto    = $this->valorUnitarioParaMostrar($costo);
                  $isPorCaja  = strtoupper($costo->metodo ?? '') === 'POR_CAJA';
                @endphp
                <tr 
                  class="hover:bg-green-50 cursor-pointer transition-colors 
                        @if($selectedCostoId===$costo->id) ring-2 ring-green-400 bg-green-50 @endif"
                  wire:click="mostrarDetalle({{ $costo->id }})"
                >
                  <td class="bg-gray-50 px-3 py-2"></td>
                  <td class="px-3 py-2 font-medium text-gray-800">
                    {{ $costo->name }}
                    @if($costo->metodo)
                      <span class="text-xs text-gray-500 ml-1">({{ strtoupper($costo->metodo) }})</span>
                    @endif
                  </td>
                  <td class="px-3 py-2 text-right">$ {{ number_format($totalCosto, 0, ',', '.') }}</td>
                  <td class="px-3 py-2 text-right">
                    $ {{ number_format($vuCosto, 2, ',', '.') }} {{ $isPorCaja ? '/caja' : '/kg' }}
                  </td>
                </tr>
              @endforeach
            @endforeach

            {{-- Totales finales --}}
            <tr class="border-t-2 bg-gray-50">
              <td class="font-bold px-3 py-2">Totales</td>
              <td class="font-bold px-3 py-2">Costos</td>
              <td class="font-bold px-3 py-2 text-right">$ {{ number_format($totalCostos, 0, ',', '.') }}</td>
              <td class="font-bold px-3 py-2 text-right">
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
              <td class="font-bold px-3 py-2 text-right text-green-800">
                $ {{ number_format($resultado, 0, ',', '.') }}
              </td>
              <td class="font-bold px-3 py-2 text-right text-green-800">
                $ {{ number_format($vu_resultado, 2, ',', '.') }} /kg
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    
  {{-- DERECHA (DETALLE) --}}
  <aside class="w-[350px] shrink-0 self-start px-2">
    {{-- ¡OJO! Nada de fixed ni overflow en ancestros del sticky --}}
    <div class="fixed top-24"> {{-- ajusta top-24 si tu header es más alto (top-16, top-20, etc.) --}}
      <div 
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-x-4"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-4"
        class="bg-white border rounded-xl shadow-md p-5 space-y-4 max-h-[calc(100vh-9rem)] overflow-y-auto"
      >
        {{-- header --}}
        <div class="flex justify-between items-start">
          <div>
            <h3 class="text-lg font-bold">{{ $detalle['name'] ?? 'Detalle del costo' }}</h3>
            <p class="text-xs text-gray-500">
              Método: {{ $detalle['metodo'] ?? '—' }}
              @if(!empty($detalle['regla'])) | Regla: {{ $detalle['regla'] }} @endif
            </p>
          </div>
          @if(!empty($detalle['explica']))
               <button class="text-gray-500 hover:text-gray-700" wire:click="cerrarDetalle">✕</button>
          @endif
         
        </div>

        @if(!empty($detalle['explica']))
          <p class="text-sm text-gray-700 leading-relaxed">{{ $detalle['explica'] }}</p>
        @endif

        @if(!empty($detalle['resumen']))
          <div class="border rounded-lg overflow-hidden">
            <table class="w-full text-sm">
              <thead class="bg-gray-50 text-gray-600">
                <tr>
                  <th class="px-3 py-2 text-left">Item</th>
                  <th class="px-3 py-2 text-right">Cant.</th>
                  <th class="px-3 py-2 text-right">Tarifa</th>
                  <th class="px-3 py-2 text-right">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach($detalle['resumen'] as $r)
                  <tr class="border-t">
                    <td class="px-3 py-2">{{ $r['col1'] ?? '' }}</td>
                    <td class="px-3 py-2 text-right">{{ $r['col2'] ?? '' }}</td>
                    <td class="px-3 py-2 text-right">{{ $r['col3'] ?? '' }}</td>
                    <td class="px-3 py-2 text-right font-medium">{{ $r['col4'] ?? '' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

        @if(!empty($detalle['totales']))
          <div class="border rounded-lg p-3 bg-gray-50">
            @foreach($detalle['totales'] as $k => $v)
              <div class="flex justify-between text-sm py-0.5">
                <span class="text-gray-600">{{ $k }}</span>
                <span class="font-semibold">{{ $v }}</span>
              </div>
            @endforeach
          </div>
        @endif

        @if(!empty($detalle['notas']))
          <div class="text-xs text-gray-500">{{ $detalle['notas'] }}</div>
        @endif
      </div>
    </div>
  </aside>
</div>
</div>
