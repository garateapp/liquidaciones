<div>
    <div class="pb-12 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <div class="flex justify-between mb-6">
                <div class="flex">
                    <select wire:model.live="ctd" class="max-w-xl  mx-2 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-6 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="25" class="text-left px-10">25 </option>
                        <option value="50" class="text-left px-10">50 </option>
                        <option value="100" class="text-left px-10">100 </option>
                        <option value="500" class="text-left px-10">500 </option>
                        
                    </select>
                
                    <div class="my-2 flex sm:flex-row flex-col">
                    
                        <div class="block relative">
                            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                    <path
                                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                    </path>
                                </svg>
                            </span>
                            <input  wire:model.live="search"  placeholder="Search" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        </div>
                        <div class="p-2 ml-4">
                            Cantidad: {{$razonsall->count()}} @if ($search)  //  Resultados: {{$razonsallresult->count()}} @endif
                        </div>
                    </div>
                   
                </div>

                <a href="{{route('razonsync')}}">
                    <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                        <p class="text-sm font-medium leading-none text-white">FX IMPORT</p>
                    </button>
                </a>

            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                          {{-- comment 
                            @php
                          
                             $etiquetas = [
                                  'comision_exportadora' => 'Comisión (Exportadora)',
                                  'beneficio_flete_huerto' => [
                                      'si' => 'Existe Beneficio Flete a Huerto (Sí)',
                                      'no' => 'Existe Beneficio Flete a Huerto (No)',
                                      '50' => 'Existe Beneficio Flete a Huerto (50%)'
                                  ],
                                  'minimo_garantizado' => 'Mínimo Garantizado',
                                  'rebate' => [
                                      'si_aplica' => 'Rebate (Sí Aplica)',
                                      'no_aplica' => 'Rebate (No Aplica)'
                                  ],
                                  'descuento_fruta_comercial' => [
                                      'si' => 'Descuento Fruta Comercial (Sí)',
                                      'no' => 'Descuento Fruta Comercial (No)',
                                      'porcentaje' => 'Descuento Fruta Comercial (%)'
                                  ],
                                  'liquidacion' => [
                                      'si' => 'Liquidación (Sí)',
                                      'no' => 'Liquidación (No)'
                                  ]
                              ];

                            @endphp
                               {!! Form::select('categoria', $etiquetas, null, ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'¿Condición?']) !!}
                          --}}
                          <table class="min-w-full">
                            <thead class="bg-white border-b">
                              <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  Condición
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  Rut
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  Número de Csg's
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($razons as $razon)
                                    <tr class="bg-gray-100 border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$razon->id}}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$razon->name}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                          <a href="{{Route('razonsocial.show',$razon)}}">
                                            <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                              <p class="text-sm font-medium leading-none text-white">Ver Ficha</p>
                                            </button>
                                          </a>
                                       
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$razon->rut}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$razon->csg_count}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                          
                          {{$razons->links()}}

                        </div>
                      </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
