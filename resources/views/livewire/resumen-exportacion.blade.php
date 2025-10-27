<div>
   <div class="flex" style="width: 990px;">
                    <section class="w-3/5 border border-y-0 border-gray-800" style="max-width:600px;">
                       <div>
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
                    </section>


                    <aside class="w-2/5 h-12 position-relative">
                        <!--Aside menu (right side)-->
                                <div style="max-width:350px;">
                                    <div class="overflow-y-auto fixed  h-screen">




                                                <div class="relative text-gray-300 w-80 p-5">
                                    <button type="submit" class="absolute ml-4 mt-3 mr-4">
                                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path>
                                        </svg>
                                    </button>

                                    <input type="search" name="search" placeholder="Search Twitter" class=" bg-dim-700 h-10 px-10 pr-5 w-full rounded-full text-sm focus:outline-none bg-purple-white shadow rounded border-0">
                                </div>
                                        <!--trending tweet section-->
                                <div class="max-w-sm rounded-lg bg-dim-700 overflow-hidden shadow-lg m-4">
                                    <div class="flex">
                                        <div class="flex-1 m-2">
                                            <h2 class="px-4 py-2 text-xl w-48 font-semibold text-white">Germany trends</h2>
                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-white hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                    </path>
                                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>


                                    <hr class="border-gray-800">

                                    <!--first trending tweet-->
                                    <div class="flex">
                                        <div class="flex-1">
                                            <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">1 . Trending</p>
                                            <h2 class="px-4 ml-2 w-48 font-bold text-white">#Microsoft363</h2>
                                            <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">5,466 Tweets</p>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--second trending tweet-->

                                    <div class="flex">
                                        <div class="flex-1">
                                            <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">2 . Politics . Trending</p>
                                            <h2 class="px-4 ml-2 w-48 font-bold text-white">#HI-Fashion</h2>
                                            <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">8,464 Tweets</p>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--third trending tweet-->

                                    <div class="flex">
                                        <div class="flex-1">
                                            <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">3 . Rock . Trending</p>
                                            <h2 class="px-4 ml-2 w-48 font-bold text-white">#Ferrari</h2>
                                            <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">5,586 Tweets</p>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--forth trending tweet-->

                                    <div class="flex">
                                        <div class="flex-1">
                                            <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">4 . Auto Racing . Trending</p>
                                            <h2 class="px-4 ml-2 w-48 font-bold text-white">#vettel</h2>
                                            <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">9,416 Tweets</p>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--show more-->

                                    <div class="flex">
                                        <div class="flex-1 p-4">
                                            <h2 class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</h2>
                                        </div>
                                    </div>

                                </div>
                                        <!--people suggetion to follow section-->
                                <div class="max-w-sm rounded-lg  bg-dim-700 overflow-hidden shadow-lg m-4">
                                    <div class="flex">
                                        <div class="flex-1 m-2">
                                            <h2 class="px-4 py-2 text-xl w-48 font-semibold text-white">Who to follow</h2>
                                        </div>
                                    </div>


                                    <hr class="border-gray-800">

                                    <!--first person who to follow-->

                                    <div class="flex flex-shrink-0">
                                        <div class="flex-1 ">
                                            <div class="flex items-center w-48">
                                                <div>
                                                    <img class="inline-block h-10 w-auto rounded-full ml-4 mt-2" src="https://pbs.twimg.com/profile_images/1121328878142853120/e-rpjoJi_bigger.png" alt="">
                                                </div>
                                                <div class="ml-3 mt-3">
                                                    <p class="text-base leading-6 font-medium text-white">
                                                        Sonali Hirave
                                                    </p>
                                                    <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                                                        @ShonaDesign
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" float-right">
                                                <button class="bg-transparent hover:bg-gray-800 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded-full">
                                                    Follow
                                                </button>
                                            </a>

                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--second person who to follow-->

                                    <div class="flex flex-shrink-0">
                                        <div class="flex-1 ">
                                            <div class="flex items-center w-48">
                                                <div>
                                                    <img class="inline-block h-10 w-auto rounded-full ml-4 mt-2" src="https://pbs.twimg.com/profile_images/1121328878142853120/e-rpjoJi_bigger.png" alt="">
                                                </div>
                                                <div class="ml-3 mt-3">
                                                    <p class="text-base leading-6 font-medium text-white">
                                                        Sonali Hirave
                                                    </p>
                                                    <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                                                        @ShonaDesign
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" float-right">
                                                <button class="bg-transparent hover:bg-gray-800 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded-full">
                                                    Follow
                                                </button>
                                            </a>

                                        </div>
                                    </div>

                                    <hr class="border-gray-800">



                                    <!--show more-->

                                    <div class="flex">
                                        <div class="flex-1 p-4">
                                            <h2 class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</h2>
                                        </div>
                                    </div>

                                </div>




                            <div class="flow-root m-6 inline">
                                <div class="flex-1">
                                    <a href="#">
                                        <p class="text-sm leading-6 font-medium text-gray-500">Terms Privacy Policy Cookies Imprint Ads info
                                        </p>
                                    </a>
                                </div>
                                <div class="flex-2">
                                    <p class="text-sm leading-6 font-medium text-gray-600"> © 2020 Twitter, Inc.</p>
                                </div>
                            </div>
                        </div>
                            </div>  
                    </aside>
                </div>

  <h1 class="ml-10 mt-2">Categoria: Exportación</h1>
<div class="grid grid-cols-2">
  

    <div>
      <div x-data="{ open: @entangle('detalleOpen') }" class="grid grid-cols-12 gap-4">
      {{-- Columna izquierda: tu resumen existente --}}
      <div class="col-span-12 lg:col-span-8">
          {{-- ... TU TABLA DE RESUMEN AQUÍ ... --}}
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
