<div 
  x-data="{ open: @entangle('detalleOpen'), selected: @entangle('selectedCostoId') }"
  class="grid grid-cols-12 gap-6 px-4"
>

  {{-- IZQUIERDA --}}
  <div class="col-span-7 xl:col-span-8 min-w-0">
    <h1 class="mt-2 text-xl font-bold text-gray-800">Categoría: <span class="text-green-600">Exportación</span></h1>

    {{-- Contenedor con scroll interno --}}
    <div class="mt-3 h-[calc(100vh-140px)] overflow-y-auto border rounded-lg shadow-sm">

      {{-- Header sticky (flex) --}}
      <div class="sticky top-0 z-10 bg-gray-100 border-b">
        <div class="flex items-center text-xs font-semibold text-gray-700 uppercase tracking-wide">
          <div class="w-40 shrink-0 px-3 py-2"> </div>           {{-- Col 1 (fija 160px) --}}
          <div class="flex-1 min-w-0 px-3 py-2">Concepto</div>   {{-- Col 2 (fluida) --}}
          <div class="w-48 shrink-0 px-3 py-2 text-right">Totales</div>        {{-- Col 3 (fija 192px) --}}
          <div class="w-48 shrink-0 px-3 py-2 text-right">Valor Unitario</div> {{-- Col 4 (fija 192px) --}}
        </div>
      </div>

      {{-- Fila helper --}}
      @php
        $rowBase = 'flex items-center border-b';
        $c1 = 'w-40 shrink-0 px-3 py-2 text-gray-600';
        $c2 = 'flex-1 min-w-0 px-3 py-2';
        $c3 = 'w-48 shrink-0 px-3 py-2 text-right';
        $c4 = 'w-48 shrink-0 px-3 py-2 text-right';
      @endphp

      {{-- Totales base --}}
      <div class="{{ $rowBase }} bg-white">
        <div class="{{ $c1 }}"> </div>
        <div class="{{ $c2 }} font-semibold text-gray-700">Suma de Peso Neto</div>
        <div class="{{ $c3 }} font-semibold">{{ number_format($total_kilos, 0, ',', '.') }} kg</div>
        <div class="{{ $c4 }} font-semibold">—</div>
      </div>

      <div class="{{ $rowBase }} bg-white">
        <div class="{{ $c1 }} font-semibold text-gray-700">Ingresos</div>
        <div class="{{ $c2 }} text-gray-700">Σ(precio_unitario × peso_neto)</div>
        <div class="{{ $c3 }} font-medium">$ {{ number_format($ingresos_total, 0, ',', '.') }}</div>
        <div class="{{ $c4 }} font-medium">$ {{ number_format($vu_promedio, 2, ',', '.') }} /kg</div>
      </div>

      {{-- Agrupación por menú --}}
      @foreach($this->costosAgrupados as $grupo)
        {{-- Título de grupo (ocupa col 2 completa) --}}
        <div class="bg-gray-50 border-y">
          <div class="flex items-center text-gray-800">
            <div class="{{ $c1 }} font-semibold">Costos</div>
            <div class="{{ $c2 }} font-semibold">{{ $grupo['menu'] }}</div>
            <div class="{{ $c3 }}"></div>
            <div class="{{ $c4 }}"></div>
          </div>
        </div>

        {{-- Filas de costos --}}
        @foreach($grupo['items'] as $costo)
          @php
            $totalCosto = $this->calcularTotalCosto($costo);
            $vuCosto    = $this->valorUnitarioParaMostrar($costo);
            $isPorCaja  = strtoupper($costo->metodo ?? '') === 'POR_CAJA';
            $isSel      = $selectedCostoId === $costo->id;
          @endphp

          <div
            class="{{ $rowBase }} transition cursor-pointer 
                   {{ $isSel ? 'bg-green-50 ring-2 ring-green-500' : 'bg-white hover:bg-green-100 hover:ring-2 hover:ring-green-300' }}"
            wire:mouseenter="previewDetalle({{ $costo->id }})"
            wire:click="mostrarDetalle({{ $costo->id }})"
          >
            <div class="{{ $c1 }} bg-gray-50"></div>
            <div class="{{ $c2 }}">
              <div class="flex items-baseline gap-2">
                <span class="font-medium text-gray-900 truncate">{{ $costo->name }}</span>
                @if($costo->metodo)
                  <span class="text-xs text-gray-500">({{ strtoupper($costo->metodo) }})</span>
                @endif
              </div>
            </div>
            <div class="{{ $c3 }} text-gray-800">$ {{ number_format($totalCosto, 0, ',', '.') }}</div>
            <div class="{{ $c4 }} text-gray-800">
              $ {{ number_format($vuCosto, 2, ',', '.') }} {{ $isPorCaja ? '/caja' : '/kg' }}
            </div>
          </div>
        @endforeach
      @endforeach

      {{-- Totales y resultado --}}
      <div class="{{ $rowBase }} bg-gray-50">
        <div class="{{ $c1 }} font-bold">Totales</div>
        <div class="{{ $c2 }} font-bold">Costos</div>
        <div class="{{ $c3 }} font-bold">$ {{ number_format($totalCostos, 0, ',', '.') }}</div>
        <div class="{{ $c4 }} font-bold">
          @if($total_kilos > 0)
            $ {{ number_format($totalCostos / $total_kilos, 2, ',', '.') }} /kg
          @else
            —
          @endif
        </div>
      </div>

      <div class="{{ $rowBase }} bg-green-50">
        <div class="{{ $c1 }} font-bold text-green-800">Resultado</div>
        <div class="{{ $c2 }} font-bold text-green-800">Ingresos - Costos</div>
        <div class="{{ $c3 }} font-bold text-green-800">$ {{ number_format($resultado, 0, ',', '.') }}</div>
        <div class="{{ $c4 }} font-bold text-green-800">$ {{ number_format($vu_resultado, 2, ',', '.') }} /kg</div>
      </div>
    </div>
  </div>

  {{-- DERECHA (STICKY) --}}
  <div class="col-span-5 xl:col-span-4">
    <div x-show="open" x-cloak class="sticky top-4">
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
          <div class="flex items-start justify-between">
            <div>
              <h3 class="text-lg font-bold text-gray-800">{{ $detalle['name'] ?? 'Detalle del costo' }}</h3>
              <p class="text-xs text-gray-500">
                Método: {{ $detalle['metodo'] ?? '—' }}
                @if(!empty($detalle['regla'])) | Regla: {{ $detalle['regla'] }} @endif
              </p>
            </div>
            <button class="text-gray-400 hover:text-gray-600" wire:click="cerrarDetalle">✕</button>
          </div>

          @if(!empty($detalle['explica']))
            <p class="text-sm text-gray-700 leading-relaxed">{{ $detalle['explica'] }}</p>
          @endif

          @if(!empty($detalle['resumen']))
            <div class="border rounded-lg overflow-hidden">
              <div class="flex bg-gray-50 text-gray-600 text-xs font-semibold sticky top-0">
                <div class="flex-1 px-3 py-2">Item</div>
                <div class="w-24 shrink-0 px-3 py-2 text-right">Cant.</div>
                <div class="w-28 shrink-0 px-3 py-2 text-right">Tarifa</div>
                <div class="w-32 shrink-0 px-3 py-2 text-right">Subtotal</div>
              </div>
              @foreach($detalle['resumen'] as $r)
                <div class="flex items-center border-t text-sm hover:bg-gray-50">
                  <div class="flex-1 px-3 py-2">{{ $r['col1'] ?? '' }}</div>
                  <div class="w-24 shrink-0 px-3 py-2 text-right">{{ $r['col2'] ?? '' }}</div>
                  <div class="w-28 shrink-0 px-3 py-2 text-right">{{ $r['col3'] ?? '' }}</div>
                  <div class="w-32 shrink-0 px-3 py-2 text-right font-medium text-gray-800">{{ $r['col4'] ?? '' }}</div>
                </div>
              @endforeach
            </div>
          @endif

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

          @if(!empty($detalle['notas']))
            <div class="text-xs text-gray-500">{{ $detalle['notas'] }}</div>
          @endif
        </div>
      </div>
    </div>
  </div>

</div>
