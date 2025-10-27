<div x-data="{ open: @entangle('detalleOpen') }" class="grid grid-cols-12 gap-4 px-2 md:px-4">
  <!-- IZQUIERDA -->
  <div class="col-span-7 xl:col-span-8 min-w-0">
    <h1 class="mt-2 text-xl font-semibold">Categoria: Exportación</h1>
    <div class="mt-3 pr-2 h-[calc(100vh-140px)] overflow-y-auto">
      <table class="w-full border-2 divide-y divide-gray-200">
        <thead class="bg-white border-b sticky top-0 z-10">
          <tr>
            <th class="bg-gray-200 font-semibold px-3 py-2 w-40"></th>
            <th class="bg-gray-200 font-semibold px-3 py-2">Concepto</th>
            <th class="bg-gray-200 font-semibold px-3 py-2 text-right">Totales</th>
            <th class="bg-gray-200 font-semibold px-3 py-2 text-right">Valor Unitario</th>
          </tr>
        </thead>

        <tbody class="bg-white">
          {{-- … TU TABLA (igual que ya tienes) … --}}
        </tbody>
      </table>
    </div>
  </div>

  {{-- DERECHA: PANEL RESUMEN (fijo / sticky) --}}
  <div class="col-span-5 xl:col-span-4">
    <div
      x-cloak
      x-show="open"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 translate-x-4"
      x-transition:enter-end="opacity-100 translate-x-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 translate-x-0"
      x-transition:leave-end="opacity-0 translate-x-4"
      class="sticky top-4 h-[calc(100vh-32px)] overflow-y-auto bg-white border rounded-xl shadow p-4 space-y-3"
    >
      <div class="flex items-start justify-between">
        <div>
          <h3 class="text-lg font-bold">{{ $detalle['name'] ?? 'Detalle del costo' }}</h3>
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
</div>
