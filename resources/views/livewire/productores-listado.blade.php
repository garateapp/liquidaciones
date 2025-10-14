<div class="space-y-4">
  {{-- Buscador + Orden + Per-page --}}
  <div class="flex w-full flex-wrap items-center gap-2">
    <input
      type="text"
      wire:model.debounce.500ms="buscar"
      placeholder="Buscar productor por nombre…"
      class="border rounded px-3 py-2 w-72"
    />

    <button wire:click="toggleOrden"
      class="px-3 py-2 rounded border bg-white hover:bg-gray-50">
      Orden: <span class="font-semibold uppercase">{{ $sortDirection }}</span>
    </button>

    <label class="text-sm text-gray-600 ml-2">Por página</label>
    <select wire:model="perPage" class="border rounded px-2 py-2">
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </select>
  </div>

  {{-- Export / Import --}}
  <div class="flex justify-center mt-2">
    <div>
      <p class="text-center mb-2">
        ¿Aún no tienes la plantilla de Excel para subir las condiciones del productor?
      </p>

      <div class="flex gap-x-2 items-center justify-center">
        <button wire:click="exportarExcel('TODAS')"
          class="bg-gray-300 hover:bg-gray-200 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center">
          <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
          <span>Download</span>
        </button>

        {{-- Input oculto --}}
        <input type="file" id="archivo_importacion" wire:model="archivo" class="hidden" accept=".xlsx,.xls" />
        {{-- Abrir selector --}}
        <button type="button"
          onclick="document.getElementById('archivo_importacion').click()"
          class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded inline-flex items-center">
          <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
          </svg>
          <span>Seleccionar archivo</span>
        </button>

        @if ($archivo)
          <button wire:click="importar"
            class="bg-green-500 hover:bg-green-400 text-white font-semibold py-2 px-4 rounded">
            Importar ahora
          </button>
        @endif
      </div>

      @if (session()->has('success'))
        <div class="mt-2 text-green-600 text-sm text-center">
          {{ session('success') }}
        </div>
      @endif
      @error('archivo')
        <div class="mt-2 text-red-600 text-sm text-center">{{ $message }}</div>
      @enderror
    </div>
  </div>

  {{-- Tabla --}}
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-white border-b">
              <tr>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">#</th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Name</th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Rut</th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Acción</th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Informe</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($razons as $razon)
                <tr class="bg-gray-100 border-b">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $razon->id }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    @if ($razon && $temporada)
                      <a href="{{ route('razonsocial.temporada.show', ['razonsocial' => $razon, 'temporada' => $temporada]) }}"
                         target="_blank">{{ $razon->name }}</a>
                    @endif
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $razon->rut }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-2 py-4 whitespace-nowrap">
                    <a href="{{ route('exportpdff', ['razonsocial' => $razon, 'temporada' => $temporada]) }}" target="_blank">
                      <x-button>Generar</x-button>
                    </a>
                  </td>
                  <td class="text-sm text-gray-900 font-light py-4 text-center">
                    @if ($razon->informe)
                      <a href="{{ route('informe.download', $razon) }}" target="_blank" class="h-10 mr-2 inline-flex items-center">
                        <img class="h-10 ml-4 pl-2 object-contain" src="{{ asset('image/pdf_icon2.png') }}" title="Descargar" alt="">
                      </a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="px-4 py-3">
            {{ $razons->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
