<div>
  <h1 class="ml-10 mt-2">Categoria: Exportación</h1>

    

    
    <div x-data="{ open: @entangle('detalleOpen') }" class="grid grid-cols-12 gap-4">
      {{-- Columna izquierda: tu resumen existente --}}
      <div class="col-span-12 lg:col-span-8">
          <table class="divide-y divide-gray-200 border-2 ml-10 w-full max-w-5xl">
            <thead class="bg-white border-b">
              <tr>
                <th class="bg-gray-200 font-semibold px-3 py-2 w-40"></th>
                <th class="bg-gray-200 font-semibold px-3 py-2">Concepto</th>
                <th class="bg-gray-200 font-semibold px-3 py-2 text-right">Totales</th>
                <th class="bg-gray-200 font-semibold px-3 py-2 text-right">Valor Unitario</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td class="bg-gray-200 font-semibold px-3 py-2"></td>
                <td class="bg-gray-200 font-semibold px-3 py-2">Suma de Peso Neto</td>
                <td class="bg-white font-semibold px-3 py-2 text-right">
                  {{ number_format($total_kilos, 0, ',', '.') }} kg
                </td>
                <td class="bg-white font-semibold px-3 py-2 text-right">—</td>
              </tr>

              <tr>
                <td class="bg-gray-200 font-semibold px-3 py-2">Ingresos</td>
                <td class="bg-gray-200 font-semibold px-3 py-2">Σ(precio_unitario × peso_neto)</td>
                <td class="bg-white font-semibold px-3 py-2 text-right">
                  $ {{ number_format($ingresos_total, 0, ',', '.') }}
                </td>
                <td class="bg-white font-semibold px-3 py-2 text-right">
                  $ {{ number_format($vu_promedio, 2, ',', '.') }} /kg
                </td>
              </tr>

              @foreach($this->costosAgrupados as $grupo)
                <tr>
                  <td class="bg-gray-200 font-semibold px-3 py-2">Costos</td>
                  <td class="bg-gray-200 font-semibold px-3 py-2">{{ $grupo['menu'] }}</td>
                  <td class="bg-white font-semibold px-3 py-2"></td>
                  <td class="bg-white font-semibold px-3 py-2"></td>
                </tr>

                @foreach($grupo['items'] as $costo)
                  @php
                    $totalCosto = $this->calcularTotalCosto($costo);
                    $vuCosto    = $this->valorUnitarioParaMostrar($costo);
                    $isPorCaja  = strtoupper($costo->metodo ?? '') === 'POR_CAJA';
                  @endphp
                  <tr lass="hover:bg-gray-50 cursor-pointer @if($selectedCostoId===$costo->id) ring-2 ring-green-300 bg-green-50 @endif"
                      wire:click="mostrarDetalle({{ $costo->id }})">
                    <td class="bg-gray-100 px-3 py-2"></td>
                    <td class="bg-gray-100 px-3 py-2">
                      {{ $costo->name }}
                      @if($costo->metodo)
                        <span class="text-xs text-gray-500">({{ strtoupper($costo->metodo) }})</span>
                      @endif
                    </td>
                    <td class="bg-white px-3 py-2 text-right">
                      $ {{ number_format($totalCosto, 0, ',', '.') }}
                    </td>
                    <td class="bg-white px-3 py-2 text-right">
                      $ {{ number_format($vuCosto, 2, ',', '.') }} {{ $isPorCaja ? '/caja' : '/kg' }}
                    </td>
                  </tr>
                @endforeach
              @endforeach

              <tr class="border-t-2">
                <td class="bg-gray-200 font-bold px-3 py-2">Totales</td>
                <td class="bg-gray-200 font-bold px-3 py-2">Costos</td>
                <td class="bg-white font-bold px-3 py-2 text-right">
                  $ {{ number_format($totalCostos, 0, ',', '.') }}
                </td>
                <td class="bg-white font-bold px-3 py-2 text-right">
                  @if($total_kilos > 0)
                    $ {{ number_format($totalCostos / $total_kilos, 2, ',', '.') }} /kg
                  @else
                    —
                  @endif
                </td>
              </tr>

              <tr>
                <td class="bg-gray-200 font-bold px-3 py-2">Resultado</td>
                <td class="bg-gray-200 font-bold px-3 py-2">Ingresos - Costos</td>
                <td class="bg-white font-bold px-3 py-2 text-right">
                  $ {{ number_format($resultado, 0, ',', '.') }}
                </td>
                <td class="bg-white font-bold px-3 py-2 text-right">
                  $ {{ number_format($vu_resultado, 2, ',', '.') }} /kg
                </td>
              </tr>
            </tbody>
          </table>
      </div>

      {{-- Panel lateral derecho --}}
      <div class="col-span-12 lg:col-span-4 relative">
          <div 
            x-cloak
            x-show="open" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-4"
            class="sticky top-4 bg-white border rounded-xl shadow p-4 space-y-3"
          >
              <div class="flex items-start justify-between">
                  <div>
                      <h3 class="text-lg font-bold">
                          {{ $detalle['name'] ?? 'Detalle del costo' }}
                      </h3>
                      <p class="text-xs text-gray-500">
                          Método: {{ $detalle['metodo'] ?? '—' }} 
                          @if(!empty($detalle['regla'])) | Regla: {{ $detalle['regla'] }} @endif
                      </p>
                  </div>
                  <button class="text-gray-500 hover:text-gray-700" wire:click="cerrarDetalle">✕</button>
              </div>

              @if(!empty($detalle['explica']))
                  <p class="text-sm text-gray-700">{{ $detalle['explica'] }}</p>
              @endif

              {{-- Tabla resumen de partidas --}}
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

              {{-- Totales --}}
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

              {{-- Notas opcionales --}}
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
  
</div>
