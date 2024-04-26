<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Filtros') }}
        </h2>
    </x-slot>
    
    <div class="container pb-8 pt-2">
    
      <div class="card">
        <div class="px-2 md:px-6 py-4">
        

          <h1 class="text-2xl font-bold">Temporada {{$temporada->name}}</h1>
          <hr class="mt-2 mb-6">
          <div class="flex w-full bg-gray-300" x-data="{openMenu:2}" >
              
              @livewire('menu-aside',['temporada'=>$temporada->id])

              <div class="pb-12 pt-6 w-full">
                  <div class="mx-auto sm:px-6 lg:px-8">
                      <div class="flex justify-between mb-6">
                        <div class="items-center"> 
                          <h2 @click.on="openMenu = 1"  class="cursor-pointer text-xs text-blue-500 font-semibold mb-4"><-Abrir Menu</h2>
                        </div>

                        <a href="{{route('exportpdff',['razonsocial'=>$razonsocial,'temporada'=>$temporada])}}" target="_blank">
                          <x-button>
                            Generar
                          </x-button>
                        </a>
                  
                      </div>
                      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                          <div class="flex flex-col">
                              <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                  <div class="overflow-hidden">
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
                                            Rut
                                          </th>
                                          <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Csg
                                          </th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                              <tr class="bg-gray-100 border-b">
                                                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$razonsocial->id}}</td>
                                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                  {{$razonsocial->name}}
                                                  </td>
                                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                  {{$razonsocial->rut}}
                                                  </td>
                                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                  {{$razonsocial->csg}}
                                                  </td>
                                              </tr>
                                        
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="flex flex-col">
                            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                              <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                
                                <h1 class="mt-6">
                                  Total venta cerezas exportación temporada 2022-2023 (CAT 1)
                                </h1>
                                <h1 class="mt-2">
                                  Total venta cerezas exportación temporada 2022-2023 (CAT I)
                                </h1>

                                <h1 class="mt-2">
                                  EXPORTACION (CAT1 + CAT I)
                                  NACIONAL (TOTAL - EXPORTACIÓN)
                                </h1>
                                
                                <h1 class="mt-6">
                                  Gastos Frio Packing
                                </h1>
                                <table class="min-w-full leading-normal mt-4">
                                  <thead>
                                    <tr>
                                      <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Especie
                                      </th>
                                      <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nombre Productor
                                      </th>
                                      <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                      CSG
                                      </th>
                                      <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        KG
                                      </th>
                                      <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        TotalUSD
                                      </th>
                                      <th
                                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                      NETO
                                    </th>
                                  
                                  </tr>
                                  </thead>
                                  <tbody>
                                    
                                      @foreach ($packings as $packing)
                                        <tr>
                                          
                                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> {{$packing->especie}}</p>
                                          </td>
                                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                             
                                                <div class="ml-3">
                                                  <p class="text-gray-900 whitespace-no-wrap">
                                                    {{$packing->n_productor}}
                                                  </p>
                                                </div>
                                              </div>
                                          </td>
                                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> {{$packing->csg}}</p>
                                          </td>
                                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                              {{$packing->kg}}
                                            </p>
                                          </td>
                                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                            
                                              {{number_format($packing->total_usd,2)}}
                                            </p>
                                          </td>
              
                                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <span
                                                                  class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                                  <span aria-hidden
                                                                      class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Activo</span>
                                            </span>
                                          </td>
                                        </tr>
                                      @endforeach
                                  
                                  </tbody>
                                </table>

                                  <h1 class="mt-6">
                                  Comision
                                  </h1>
                                
                                 <table class="min-w-full leading-normal">
                                   <thead>
                                     <tr>
                                       <th
                                         class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                         Productor
                                       </th>
                                       <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Comisión
                                       </th>
                                       <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                         Acción
                                         </th>
                                     
                                   
                                   </tr>
                                   </thead>
                                   <tbody>
                                 
                                       @foreach ($comisions as $comision)
                                         <tr>
                                           <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                             <div class="flex items-center">
                                              
                                                 <div class="ml-3">
                                                   <p class="text-gray-900 whitespace-no-wrap">
                                                     {{$comision->productor}}
                                                   </p>
                                                 </div>
                                               </div>
                                           </td>
                                           <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                             <p class="text-gray-900 whitespace-no-wrap"> {{$comision->comision*100}}%</p>
                                           </td>
                                       
                                       
               
                                           <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                             <span
                                                                   class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                                   <span aria-hidden
                                                                       class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                             <span class="relative">Editar</span>
                                             </span>
                                           </td>
                                         </tr>
                                       @endforeach
                             
                                   </tbody>
                                 </table>

                                
                                  <h1 class="mt-6">
                                  Flete a Huerto
                                  </h1>
                                  <table class="min-w-full leading-normal">
                                    <thead>
                                      <tr>
                                        <th
                                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                          Etiqueta
                                        </th>
                                        <th
                                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Empresa
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                      Valor
                                      </th>
                                      <th
                                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    KGS
                                    </th>
                                    
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                          {{$razonsocial->name}}
                                          </th>
                                    
                                      
                                    
                                    </tr>
                                    </thead>
                                    <tbody>
                                  
                                        @foreach ($fletes as $flete)
                                          @php
                                              $total=0;
                                              $totalkgs=0;
                                          @endphp
                                          @foreach ($masas as $masa)
                                          
                                                @if ($flete->etiqueta==$masa->n_etiqueta)
                                                  @php
                                                      $total+=$flete->valor*$masa->peso_neto;
                                                      $totalkgs+=$masa->peso_neto;
                                                  @endphp
                                                @endif
                                          
                                          @endforeach
                                          <tr>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                              <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10 hidden">
                                                  <img class="w-full h-full rounded-full"
                                                                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                                            alt="" />
                                                                    </div>
                                                  <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                      {{$flete->etiqueta}}
                                                    </p>
                                                  </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->empresa}}</p>
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->valor}}</p>
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                              <p class="text-gray-900 whitespace-no-wrap"> {{$totalkgs}}</p>
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                              <p class="text-gray-900 whitespace-no-wrap"> {{$total}}usd</p>
                                            </td>
                                        
                                        
                
                                          
                                          </tr>
                                        @endforeach
                              
                                    </tbody>
                                  </table>

                                  <h1 class="mt-6">
                                    Gastos exportacion, pendiente (Tipo_nave)
                                  </h1>
                                  <table class="min-w-full leading-normal">
                                    <thead>
                                      <tr>
                                        <th
                                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                          TIPO/NAVE
                                        </th>
                                        <th
                                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        -
                                        </th>
                                        <th
                                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        -
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        -
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                          -
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        -
                                      </th>
                                    
                                    </tr>
                                    </thead>
                                    <tbody>
                                      
                                    </tbody>
                                  </table>
                               
                                  <h1 class="mt-6">
                                    Calcular CAT1 CAT
                                  </h1>
                                  @php
                                      $n=1;
                                  @endphp
                                  @foreach ($masas as $masa)
                                    @if ($n<6)
                                        
                                      {{$masa->id}}) - {{$masa->n_etiqueta}}-({{$masa->peso_neto}} Kgs) 
                                        @foreach ($fletes as $flete)
                                            @if ($flete->etiqueta==$masa->n_etiqueta)
                                              (+{{$flete->valor*$masa->peso_neto}}) 
                                            @endif
                                        @endforeach
                                      - {{$masa->n_vategoria}} - {{$masa->cantidad}} * PRECIO_UNITARIO
                                      <br>
                                      @php
                                          $n+=1;
                                      @endphp
                                      + {{$masas->count()-3}} Registros
                                    @endif
                                  @endforeach

                                  <h1 class="mt-6">
                                      Listado de Calibres
                                  </h1>
                                  @foreach ($unique_calibres as $calibre)
                                                                          
                                      {{$calibre}}<br>
                                   
                                  @endforeach

                                  <h1 class="mt-6">
                                    Listado de Variedades
                                  </h1>
                                  @foreach ($unique_variedades as $variedad)
                                                                          
                                      {{$variedad}}<br>
                                   
                                  @endforeach

                                  <h1 class="mt-6">
                                    Listado de Variedades real
                                  </h1>
                                  @foreach ($variedades as $variedad)
                                    <a href="{{Route('grafico.variedad',['razonsocial'=>$razonsocial,'temporada'=>$temporada,'variedad'=>$variedad] )}}" target="_blank">                     
                                      {{$variedad->name}}<br>
                                    </a>
                                  @endforeach

                                  

                                  
                               

                                  <h1 class="mt-6">
                                    Desglose semanas
                                  </h1>
                                  @foreach ($unique_semanas as $semana)
                                      {{$semana}}<br>
                                  @endforeach
                                  
                                  Precio <br>
                                  SEMANA 1 <br>
                                  Variedad Bing <br>
                                  Calibre 3j <br>

                                  @foreach ($fobs->where('n_variedad','Lapins')->where('semana','1') as $fob)
                                        @if (strpos($fob->n_calibre, "4J") !== false)

                                          {{$fob->semana}} - {{$fob->etiqueta}} - {{$fob->n_calibre}} - {{$fob->color}} - {{$fob->fob_kilo_salida}} (logrado) <br>

                                        @endif
                                  @endforeach

                                
                                  @foreach ($masas as $masa)
                                      

                                      @foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob)
                                        
                                          @if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD'))
                                            
                                              @if (strpos($fob->n_calibre, "4J") !== false)
                                                @if (strpos($fob->etiqueta, $masa->n_etiqueta) !== false)

                                                
                                                {{$masa->semana}} - {{$masa->n_variedad}} - {{$masa->n_etiqueta}} - {{$masa->n_calibre}} <br>
                                                 <b> PRECIO: {{$fob->fob_kilo_salida}} ({{$fob->fob_kilo_salida*$masa->peso_neto}}) </b> <br>

                                                @endif

                                              @endif
                                          @endif
                                          @if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD'))
                                            @if (strpos($fob->n_calibre, "3J") !== false)

                                              @if (strpos($fob->etiqueta, $masa->n_etiqueta) !== false)
                                              {{$masa->semana}} - {{$masa->n_variedad}} - {{$masa->n_etiqueta}} - {{$masa->n_calibre}} <br>
                                               <b> PRECIO: {{$fob->fob_kilo_salida}} ({{$fob->fob_kilo_salida*$masa->peso_neto}}) </b> <br>

                                              @endif
                                            @endif
                                          @endif
                                          @if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD'))
                                            @if (strpos($fob->n_calibre, "2J") !== false)

                                              @if (strpos($fob->etiqueta, $masa->n_etiqueta) !== false)
                                              {{$masa->semana}} - {{$masa->n_variedad}} - {{$masa->n_etiqueta}} - {{$masa->n_calibre}} <br>
                                               <b> PRECIO: {{$fob->fob_kilo_salida}} ({{$fob->fob_kilo_salida*$masa->peso_neto}}) </b> <br>

                                              @endif
                                            @endif
                                          @endif
                                          @if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD'))
                                            @if (strpos($fob->n_calibre, "J") !== false)

                                              @if (strpos($fob->etiqueta, $masa->n_etiqueta) !== false)
                                              {{$masa->semana}} - {{$masa->n_variedad}} - {{$masa->n_etiqueta}} - {{$masa->n_calibre}} <br>
                                               <b> PRECIO: {{$fob->fob_kilo_salida}} ({{$fob->fob_kilo_salida*$masa->peso_neto}}) </b> <br>

                                              @endif
                                            @endif
                                          @endif
                                          @if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD'))
                                            @if (strpos($fob->n_calibre, "XL") !== false)

                                              @if (strpos($fob->etiqueta, $masa->n_etiqueta) !== false)
                                              {{$masa->semana}} - {{$masa->n_variedad}} - {{$masa->n_etiqueta}} - {{$masa->n_calibre}} <br>
                                               <b> PRECIO: {{$fob->fob_kilo_salida}} ({{$fob->fob_kilo_salida*$masa->peso_neto}}) </b> <br>

                                              @endif
                                            @endif
                                          @endif
                                          @break
                                      @endforeach

                                  @endforeach
                                  

                                </div>
                              </div>
                            </div>
                      </div>
                  </div>
              </div>
          </div>

        </div>

      </div>
    </div>
    
</x-app-layout>
