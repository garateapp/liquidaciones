<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Filtros') }}
        </h2>
    </x-slot>
    
    <div class="pb-8 pt-2">
    
      <div class="">
        <div class="px-2 md:px-2 py-4">
        

          <h1 class="text-2xl font-bold">Temporada {{$temporada->name}}</h1>
          <hr class="mt-2 mb-6">
          <div class="flex w-full bg-gray-300" x-data="{openMenu:2}" >
         {{-- comment     
              @livewire('menu-aside',['temporada'=>$temporada->id])
 --}}
              <div class="pb-12 pt-6 w-full">
                  <div class="mx-auto sm:px-6 lg:px-2">
                      <div class="flex justify-between mb-6">
                        <div class="items-center hidden"> 
                          <h2 @click.on="openMenu = 1"  class="cursor-pointer text-xs text-blue-500 font-semibold mb-4"><-Abrir Menu</h2>
                        </div>

                        <a href="{{route('exportpdff',['razonsocial'=>$razonsocial,'temporada'=>$temporada])}}" target="_blank">
                          <x-button>
                            Generar
                          </x-button>
                        </a>
                  
                      </div>
                      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                        
                          <div>
                            <div class="md:grid grid-cols-4  bg-white gap-2 p-4 rounded-xl">
                                 <div class="md:col-span-1 h-54 shadow-xl ">
                                         <div class="flex w-full h-full relative">
                                             <img src="https://res.cloudinary.com/dboafhu31/image/upload/v1625318266/imagen_2021-07-03_091743_vtbkf8.png" class="w-44 h-44 m-auto" alt="">
                         
                                         </div>
                                 </div>
                                 <div class="md:col-span-3 h-54 shadow-xl p-4 space-y-2 p-3">
                                         <div class="flex ">
                                             <span
                                                 class="text-sm border bg-blue-50 font-bold uppercase border-2 rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6">Name:</span>
                                             <input 
                                                 class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
                                                 type="text" value="{{$razonsocial->name}}"  readonly/>
                                         </div>
                                         <div class="flex ">
                                            <span
                                                class="text-sm border bg-blue-50 font-bold uppercase border-2 rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6">ID:</span>
                                            <input 
                                                class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
                                                type="text" value="{{$razonsocial->id}}"  readonly/>
                                        </div>
                                        <div class="flex ">
                                          <span
                                              class="text-sm border bg-blue-50 font-bold uppercase border-2 rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6">Rut:</span>
                                          <input 
                                              class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
                                              type="text" value="{{$razonsocial->rut}}"  readonly/>
                                        </div>
                                         <div class="flex ">
                                             <span
                                                 class="text-sm border bg-blue-50 font-bold uppercase border-2 rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6">Email:</span>
                                             <input 
                                                 class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
                                                 type="text" value="myemail@server.com"  readonly/>
                                         </div>
                                         
                                 </div>
                            </div>
                            <h1 class="text-center mt-4 mb-2 font-bold text-2xl">Condiciones del Productor</h1>
                            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mt-2 mx-2 mb-2">
                              @foreach ($condicions as $condicion)
                                <div>
                                    <div class="p-7 rounded-xl bg-amber-100 dark:bg-neutral-700/70">
                                        <h3 class="text-xl font-semibold mb-7">{{$condicion->name}}</h3>
                                        <p class="font-medium leading-7 text-gray-500 mb-6 dark:text-gray-400">Selecciona una alternativa.</p>
                                        @foreach ($condicion->opcions as $item)
                                          @if ($item->value)
                                            <a href="#" class="py-3 flex items-center mb-2 justify-center w-full font-semibold rounded-md bg-white hover:bg-purple-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                              {{$item->text}}
                                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                                  <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                              </svg>
                                            </a>
                                          @else
                                          
                                          <input 
                                          class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
                                          type="text" value=""  readonly/>

                                          @endif
                                            

                                        @endforeach
                                       
                                    </div>
                                </div>
                              @endforeach
                                {{-- comment
                                <div>
                                    <div class="p-7 rounded-xl bg-emerald-100 dark:bg-neutral-700/70">
                                        <h3 class="text-xl font-semibold mb-7">Finance and Banking</h3>
                                        <p class="font-medium leading-7 text-gray-500 mb-6 dark:text-gray-400">The ability to independentiy value an enterprise is an essential tool for marking business and strategic decisions.</p>
                                        <a href="#" class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-white hover:bg-purple-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">Get Started
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                
                                <div>
                                    <div class="p-7 rounded-xl bg-red-100 dark:bg-neutral-700/70">
                                        <h3 class="text-xl font-semibold mb-7">Strategic Business Leader</h3>
                                        <p class="font-medium leading-7 text-gray-500 mb-6 dark:text-gray-400">Strategic Business Leader is a trainig course from the Strategic Professional level.</p>
                                        <a href="#" class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-white hover:bg-purple-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">Get Started
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                
                                <div>
                                    <div class="p-7 rounded-xl bg-red-100 dark:bg-neutral-700/70">
                                        <h3 class="text-xl font-semibold mb-7">Preparatory Course</h3>
                                        <p class="font-medium leading-7 text-gray-500 mb-6 dark:text-gray-400">The ability to independently value an enterprise is an essential tool for making business and strategic decisions.</p>
                                        <a href="#" class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-white hover:bg-purple-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">Get Started
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                
                                <div>
                                    <div class="p-7 rounded-xl bg-amber-100 dark:bg-neutral-700/70">
                                        <h3 class="text-xl font-semibold mb-7">Business English Writing Skills</h3>
                                        <p class="font-medium leading-7 text-gray-500 mb-6 dark:text-gray-400">A unique opportunity to gain guidance and feedback from our expert.</p>
                                        <a href="#" class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-white hover:bg-purple-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">Get Started
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                
                                <div>
                                    <div class="p-7 rounded-xl bg-emerald-100 dark:bg-neutral-700/70">
                                        <h3 class="text-xl font-semibold mb-7">Strategic Business Reporting</h3>
                                        <p class="font-medium leading-7 text-gray-500 mb-6 dark:text-gray-400">Strategic Business Reporting is a Professional level training course. It covers topics related to advanced financial reporting, inccluding leasing.</p>
                                        <a href="#" class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-white hover:bg-purple-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">Get Started
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                               --}}
                          </div>
                         </div>

                          <div class="flex flex-col hidden">
                            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                              <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">

                         
                                
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
                                        Variedad
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
                                    @if ($packings->count()>0)
                                      @foreach ($packings as $packing)
                                        <tr>
                                          
                                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> {{$packing->especie}}</p>
                                          </td>
                                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> {{$packing->variedad}}</p>
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
                                    @endif
                                  </tbody>
                                </table>
  
                                <h1 class="mt-6 font-bold text-center">
                                  Dentro de Norma
                                </h1>
                                  <table id="balance" style="width:100%; border-collapse: collapse; margin-top: 20px;">
                                    <thead>
                                      <tr>
                                      <th>Especie</th>
                                      <th>Variedad</th>
                                      <th>Categoría</th>
                                      <th>Serie</th>
                                      <th>% Curva<br>
                                        Calibre </th>
                                      <th>Cajas</th>
                                      <th>Peso Neto</th>
                                      <th class="bg-green-100">Ingresos</th>
                                      <th class="bg-red-100">Comision</th>
                                      <th class="bg-red-100">Frio<br>Packing</th>
                                      <th class="bg-red-100">Exportacion</th>
                                      <th class="bg-red-100">Flete a <br> Huerto</th>
                                      <th class="bg-red-100">Materiales</th>
                                      <th class="bg-yellow-100">Retorno Neto<br> Total</th>
                                      <th class="bg-yellow-100">Retorno Kilo</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @php
                                        $variedadcount=1;
                                        $cantidadtotal=0;
                                        $pesonetototal=0;
                                        $retornototal=0;
                                        $exportaciontotal=0;
                                        $totalcostopacking=0;
                                        $totalmateriales=0;
                                        $globalfletehuerto=0;
                                        $kgsglobmas=0;

                                      @endphp
                                      @if ($unique_variedades->count()>0)
                                        @foreach ($unique_variedades as $variedad)
                                          @php
                                            $calibrecount=1;
                                            
                                            $cantidad4j=0;
                                            $cantidad3j=0;
                                            $cantidad2j=0;
                                            $cantidadj=0;
                                            $cantidadxl=0;

                                            $exportacion4j=0;
                                            $exportacion3j=0;
                                            $exportacion2j=0;
                                            $exportacionj=0;
                                            $exportacionxl=0;

                                            $material4j=0;
                                            $material3j=0;
                                            $material2j=0;
                                            $materialj=0;
                                            $materialxl=0;

                                            $flete4j=0;
                                            $flete3j=0;
                                            $flete2j=0;
                                            $fletej=0;
                                            $fletexl=0;

                                            $pesoneto4j=0;
                                            $pesoneto3j=0;
                                            $pesoneto2j=0;
                                            $pesonetoj=0;
                                            $pesonetoxl=0;
                                            $pesonetol=0;
                                            $retorno4j=0;
                                            $retorno3j=0;
                                            $retorno2j=0;
                                            $retornoj=0;
                                            $retornoxl=0;
                                            $costopacking=0;

                                            $fletehuerto=0;
                                          
                                            $kgstotmas=0;
                                          @endphp

                                          @foreach ($masas as $masa)
                                            @if ($masa->n_etiqueta!='Loica' && $masa->n_categoria=='Cat 1')
                                              @if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad)
                                                  @php
                                                    $cantidad4j+=$masa->cantidad;
                                                    $pesoneto4j+=$masa->peso_neto;
                                                      $retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                      $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $cantidadtotal+=$masa->cantidad;
                                                    $pesonetototal+=$masa->peso_neto;
                                                    if ($masa->tipo_transporte=='AEREO') {
                                                          if ($exportacions->where('type','aereo')->count()>0) {
                                                            $exportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                            $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          }
                                                      }
                                                    if ($masa->tipo_transporte=='MARITIMO') {
                                                        if ($exportacions->where('type','maritimo')->count()>0) {
                                                          $exportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        }
                                                      }
                                                      foreach ($materialestotal as $material) {
                                                        if ($material->c_embalaje==$masa->c_embalaje) {
                                                          $material4j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                          $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        }  
                                                      }
                                                      foreach ($fletestotal as $flete) {
                                                          if ($flete->rut==$masa->r_productor) {
                                                            $flete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          }  
                                                        }
                                                  @endphp	
                                                  
                                              @endif
                                              @if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad)
                                                  @php
                                                    $cantidad3j+=$masa->cantidad;
                                                    $pesoneto3j+=$masa->peso_neto;
                                                      $retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                      $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $cantidadtotal+=$masa->cantidad;
                                                    $pesonetototal+=$masa->peso_neto;
                                                    if ($masa->tipo_transporte=='AEREO') {
                                                          if ($exportacions->where('type','aereo')->count()>0) {
                                                            $exportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                            $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          }
                                                      }
                                                    if ($masa->tipo_transporte=='MARITIMO') {
                                                        if ($exportacions->where('type','maritimo')->count()>0) {
                                                          $exportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        }
                                                      }
                                                      foreach ($materialestotal as $material) {
                                                        if ($material->c_embalaje==$masa->c_embalaje) {
                                                          $material3j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                          $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        }  
                                                      }
                                                      foreach ($fletestotal as $flete) {
                                                          if ($flete->rut==$masa->r_productor) {
                                                            $flete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          }  
                                                        }
                                                  @endphp	
                                              @endif
                                              @if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad)
                                                  @php
                                                    $cantidad2j+=$masa->cantidad;
                                                    $pesoneto2j+=$masa->peso_neto;
                                                      $retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                      $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $cantidadtotal+=$masa->cantidad;
                                                    $pesonetototal+=$masa->peso_neto;
                                                    if ($masa->tipo_transporte=='AEREO') {
                                                          if ($exportacions->where('type','aereo')->count()>0) {
                                                            $exportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                            $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          }
                                                      }
                                                    if ($masa->tipo_transporte=='MARITIMO') {
                                                        if ($exportacions->where('type','maritimo')->count()>0) {
                                                          $exportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        }
                                                      }
                                                      foreach ($materialestotal as $material) {
                                                        if ($material->c_embalaje==$masa->c_embalaje) {
                                                          $material2j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                          $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        }  
                                                      }
                                                      foreach ($fletestotal as $flete) {
                                                          if ($flete->rut==$masa->r_productor) {
                                                            $flete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          }  
                                                        }
                                                  @endphp	
                                              @endif
                                              @if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad)
                                                  @php
                                                    $cantidadj+=$masa->cantidad;
                                                      $pesonetoj+=$masa->peso_neto;
                                                        $retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                        $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                      $cantidadtotal+=$masa->cantidad;
                                                    $pesonetototal+=$masa->peso_neto;
                                                    if ($masa->tipo_transporte=='AEREO') {
                                                          if ($exportacions->where('type','aereo')->count()>0) {
                                                            $exportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                            $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          }
                                                      }
                                                    if ($masa->tipo_transporte=='MARITIMO') {
                                                        if ($exportacions->where('type','maritimo')->count()>0) {
                                                          $exportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        }
                                                      }
                                                      foreach ($materialestotal as $material) {
                                                        if ($material->c_embalaje==$masa->c_embalaje) {
                                                          $materialj+=$masa->cantidad*$material->costo_por_caja_usd;
                                                          $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        }  
                                                      }
                                                      foreach ($fletestotal as $flete) {
                                                          if ($flete->rut==$masa->r_productor) {
                                                            $fletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          }  
                                                        }
                                                  @endphp	
                                              @endif
                                              @if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad)
                                                  @php
                                                    $cantidadxl+=$masa->cantidad;
                                                    $pesonetoxl+=$masa->peso_neto;
                                                      $retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                      $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $cantidadtotal+=$masa->cantidad;
                                                    $pesonetototal+=$masa->peso_neto;
                                                    if ($masa->tipo_transporte=='AEREO') {
                                                          if ($exportacions->where('type','aereo')->count()>0) {
                                                            $exportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                            $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          }
                                                      }
                                                    if ($masa->tipo_transporte=='MARITIMO') {
                                                        if ($exportacions->where('type','maritimo')->count()>0) {
                                                          $exportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        }
                                                      }
                                                      foreach ($materialestotal as $material) {
                                                        if ($material->c_embalaje==$masa->c_embalaje) {
                                                          $materialxl+=$masa->cantidad*$material->costo_por_caja_usd;
                                                          $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        }  
                                                      }
                                                    
                                                      foreach ($fletestotal as $flete) {
                                                          if ($flete->rut==$masa->r_productor) {
                                                            $fletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          }  
                                                        }
                                          
                                                  @endphp	
                                              @endif
                                              
                                            @endif
                                          @endforeach
                                          @foreach ($masas as $masa)
                                            @php
                                              if ($masa->n_variedad==$variedad) {
                                                  $kgstotmas+=$masa->peso_neto;
                                                  $kgsglobmas+=$masa->peso_neto;
                                              }
                                            @endphp
                                          @endforeach
                                          @php
                                            foreach ($packings as $costo) {
                                              if ($costo->variedad==$variedad) {
                                                $costopacking+=$costo->total_usd;
                                              }  
                                            }
                                            $totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas;
                                          
                                          @endphp
                                
                                            @if ($unique_calibres->contains('4J') || $unique_calibres->contains('4JD') || $unique_calibres->contains('4JDD'))
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                  <td>Cherries</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>{{$variedad}}</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>Cat 1</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                
                                                
                                                
                                                <td>4J</td>
                                                <td>{{number_format($cantidad4j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                <td>{{$cantidad4j}}</td>
                                                <td>{{$pesoneto4j}} KGS</td>
                                                <td>{{number_format($retorno4j,2,',','.')}} USD</td>
                                                <td>{{number_format($retorno4j*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesoneto4j))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacion4j,2,',','.')}} USD</td>
                                                <td>{{number_format($flete4j,2,',','.')}} USD</td>
                                                <td>{{number_format($material4j,2,',','.')}} USD</td>
                                                {{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
                                                <td>{{number_format($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j,2,',','.')}} USD</td>
                                                <td>
                                                  @if ($pesoneto4j)
                                                    {{number_format(($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j)/$pesoneto4j,2)}} USD/kg
                                                  @else
                                                    0 USD/kg
                                                  @endif
                                                </td>
                                                
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                              @endphp
                                            @endif
                                            @if ($unique_calibres->contains('3J') || $unique_calibres->contains('3JD') || $unique_calibres->contains('3JDD'))
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                  <td>Cherries</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>{{$variedad}}</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>Cat 1</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                
                                                
                                                <td>3J</td>
                                                <td>{{number_format($cantidad3j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                
                                                <td>{{$cantidad3j}}</td>
                                                <td>{{$pesoneto3j}} KGS</td>
                                                <td>{{number_format($retorno3j,2,',','.')}} USD</td>
                                                <td>{{number_format($retorno3j*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesoneto3j))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacion3j,2,',','.')}} USD</td>
                                                <td>{{number_format($flete3j,2,',','.')}} USD</td>
                                                <td>{{number_format($material3j,2,',','.')}} USD</td>
                                                {{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
                                                <td>{{number_format($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j+$flete3j,2,',','.')}} USD</td>
                                                <td>
                                                  @if ($pesoneto3j)
                                                    {{number_format(($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j+$flete3j)/$pesoneto3j,2)}} USD/kg
                                                  @else
                                                    0 USD/kg
                                                  @endif
                                                </td>
                                                
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                              @endphp
                                            @endif
                                            @if ($unique_calibres->contains('2J') || $unique_calibres->contains('2JD') || $unique_calibres->contains('2JDD'))
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                  <td>Cherries</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>{{$variedad}}</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>Cat 1</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                
                                                
                                                <td>2J</td>
                                                <td>{{number_format($cantidad2j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                
                                                <td>{{$cantidad2j}}</td>
                                                <td>{{$pesoneto2j}} KGS</td>
                                                <td>{{number_format($retorno2j,2,',','.')}} USD</td>
                                                <td>{{number_format($retorno2j*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesoneto2j))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacion2j,2,',','.')}} USD</td>
                                                <td>{{number_format($flete2j,2,',','.')}} USD</td>
                                                <td>{{number_format($material2j,2,',','.')}} USD</td>
                                                {{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
                                                <td>{{number_format($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j,2,',','.')}} USD</td>
                                                <td>
                                                  @if ($pesoneto2j)
                                                    {{number_format(($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j)/$pesoneto2j,2)}} USD/kg
                                                  @else
                                                    0 USD/kg
                                                  @endif
                                                </td>
                                                
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                              @endphp
                                            @endif
                                            @if ($unique_calibres->contains('J') || $unique_calibres->contains('JD') || $unique_calibres->contains('JDD'))
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                  <td>Cherries</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>{{$variedad}}</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>Cat 1</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                
                                                
                                                
                                                <td>J</td>
                                                <td>{{number_format($cantidadj*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                <td>{{$cantidadj}}</td>
                                                <td>{{$pesonetoj}} KGS</td>
                                                <td>{{number_format($retornoj,2,',','.')}} USD</td>
                                                <td>{{number_format($retornoj*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesonetoj))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacionj,2,',','.')}} USD</td>
                                                <td>{{number_format($fletej,2,',','.')}} USD</td>
                                                <td>{{number_format($materialj,2,',','.')}} USD</td>
                                                {{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
                                                <td>{{number_format($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej,2,',','.')}} USD</td>
                                                <td>
                                                  @if ($pesonetoj)
                                                    {{number_format(($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej)/$pesonetoj,2)}} USD/kg
                                                  @else
                                                    0 USD/kg
                                                  @endif
                                                </td>
                                  
                                                
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                              @endphp
                                            @endif
                                            @if ($unique_calibres->contains('XL') || $unique_calibres->contains('XLD') || $unique_calibres->contains('XLDD'))
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                  <td>Cherries</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>{{$variedad}}</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                  <td>Cat 1</td>
                                                @else
                                                  <td> </td>
                                                @endif
                                                
                                                
                                                
                                                <td>XL</td>
                                                <td>{{number_format($cantidadxl*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                <td>{{$cantidadxl}}</td>
                                                <td>{{$pesonetoxl}} KGS</td>
                                                <td>{{number_format($retornoxl,2,',','.')}} USD</td>
                                                <td>{{number_format($retornoxl*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesonetoxl))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacionxl,2,',','.')}} USD</td>
                                                <td>{{number_format($fletexl,2,',','.')}} USD</td>
                                                <td>{{number_format($materialxl,2,',','.')}} USD</td>
                                                {{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
                                                <td>{{number_format($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl,2,',','.')}} USD</td>
                                                  <td>
                                                  @if ($pesonetoxl)
                                                    {{number_format(($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl)/$pesonetoxl,2)}} USD/kg
                                                  @else
                                                    0 USD/kg
                                                  @endif
                                                </td>
                                                
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                              @endphp
                                            @endif
                                
                                            <tr>
                                              
                                                <td> </td>
                                            
                                            
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
                                              
                                              
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                            
                                              
                                              
                                              
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">100,00%</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl}}</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl}} KGS</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl),2,',','.')}} USD</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.08,2,',','.')}} USD</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas),2,',','.')}} USD</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl),2,',','.')}} USD</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($flete4j+$flete3j+$flete2j+$fletej+$fletexl),2,',','.')}} USD</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($material4j+$material3j+$material2j+$materialj+$materialxl),2,',','.')}} USD</td>
                                              {{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl),2,',','.')}} USD</td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl))/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl),2)}} USD/KG</td>
                                              
                                            </tr>
                                            
                                
                                            @php
                                              $variedadcount+=1;
                                            @endphp
                                          
                                
                                        @endforeach
                                        <tr>
                                              
                                          
                                        
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
                                          
                                          
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                        
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                        
                                          
                                          
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($cantidadtotal)}}</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($pesonetototal)}} KGS</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.08,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($totalcostopacking),2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($exportaciontotal,2,',','.')}} USD</td>
                                          
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($globalfletehuerto),2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($totalmateriales,2,',','.')}} USD</td>
                                          {{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto)/$pesonetototal,2)}} usd/kg</td>
                                          
                                        </tr>
                                      @endif 
                              
                                    </tbody>
                                  </table>

                                  <h1 class="mt-6 font-bold text-center">
                                    Dentro de Norma por Semana
                                  </h1>
                                  <table id="balance" style="width:100%; border-collapse: collapse; margin-top: 15px;">
                                    <thead>
                                      <tr>
                                      <th>Especie</th>
                                      <th>Variedad</th>
                                      <th>Categoría</th>
                                      <th>Semana embarque</th>
                                      <th>Serie</th>
                                      <th>% Curva<br>
                                        Calibre </th>
                                      <th>Cajas</th>
                                      <th>Peso Neto</th>
                                      <th class="bg-green-100">Ingresos</th>
                                      <th class="bg-red-100">Comision</th>
                                      <th class="bg-red-100">FrioPacking</th>
                                      <th class="bg-red-100">Exportación</th>
                                      <th class="bg-red-100">Flete a <br> Huerto</th>
                                      <th class="bg-red-100">Materiales</th>
                                      <th class="bg-yellow-100">Retorno Neto<br> Total</th>
                                      <th class="bg-yellow-100">Retorno Kilo</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @php
                                      $variedadcount=1;
                                      $cantidadtotal=0;
                                      $pesonetototal=0;
                                      $retornototal=0;
                                      $kgsglobmas=0;
                                      $totalcostopacking=0;
                                      $exportaciontotal=0;
                                      $totalmateriales=0;
                                      $globalfletehuerto=0;

                                      @endphp
                                      @if ($unique_variedades->count()>0)
                                        @foreach ($unique_variedades as $variedad)
                                          

                                          @php

                                              $submaterial4j=0;
                                              $submaterial3j=0;
                                              $submaterial2j=0;
                                              $submaterialj=0;
                                              $submaterialxl=0;

                                            $subexportacion4j=0;
                                            $subexportacion3j=0;
                                            $subexportacion2j=0;
                                            $subexportacionj=0;
                                            $subexportacionxl=0;

                                            $subcantidad4j=0;
                                            $subcantidad3j=0;
                                            $subcantidad2j=0;
                                            $subcantidadj=0;
                                            $subcantidadxl=0;

                                            $calibrecount=1;

                                            $subretorno4j=0;
                                            $subretorno3j=0;
                                            $subretorno2j=0;
                                            $subretornoj=0;
                                            $subretornoxl=0;

                                            $subpesoneto4j=0;
                                            $subpesoneto3j=0;
                                            $subpesoneto2j=0;
                                            $subpesonetoj=0;
                                            $subpesonetoxl=0;

                                            $subflete4j=0;
                                            $subflete3j=0;
                                            $subflete2j=0;
                                            $subfletej=0;
                                            $subfletexl=0;

                                            
                                            $fletehuerto=0;
                                            
                                          
                                          @endphp
                                        
                                          
                                          
                                          @foreach ($unique_semanas as $semana)
                                
                                            @php    
                                          
                                            

                                              $material4j=0;
                                              $material3j=0;
                                              $material2j=0;
                                              $materialj=0;
                                              $materialxl=0;
                                            
                                              $exportacion4j=0;
                                              $exportacion3j=0;
                                              $exportacion2j=0;
                                              $exportacionj=0;
                                              $exportacionxl=0;
                                              
                                              $cantidad4j=0;
                                              $cantidad3j=0;
                                              $cantidad2j=0;
                                              $cantidadj=0;
                                              $cantidadxl=0;

                                              $pesoneto4j=0;
                                              $pesoneto3j=0;
                                              $pesoneto2j=0;
                                              $pesonetoj=0;
                                              $pesonetoxl=0;

                                              $retorno4j=0;
                                              $retorno3j=0;
                                              $retorno2j=0;
                                              $retornoj=0;
                                              $retornoxl=0;

                                              $flete4j=0;
                                              $flete3j=0;
                                              $flete2j=0;
                                              $fletej=0;
                                              $fletexl=0;

                                              $kgstotmas=0;
                                              $costopacking=0;

                                            @endphp
                                      
                                            @foreach ($masas as $masa)
                                              @if ($masa->n_etiqueta!='Loica' || $masa->n_categoria=='Cat 1')
                                                @if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                                  @php
                                                  $cantidad4j+=$masa->cantidad;
                                                  $subcantidad4j+=$masa->cantidad;
                                                  $pesoneto4j+=$masa->peso_neto;
                                                  $subpesoneto4j+=$masa->peso_neto;
                                                    $retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $subretorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                        if ($masa->tipo_transporte=='AEREO') {
                                                              if ($exportacions->where('type','aereo')->count()>0) {
                                                                $exportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $subexportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                              }
                                                          }
                                                        if ($masa->tipo_transporte=='MARITIMO') {
                                                            if ($exportacions->where('type','maritimo')->count()>0) {
                                                              $exportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $subexportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                            }
                                                          }
                                                          foreach ($materialestotal as $material) {
                                                            if ($material->c_embalaje==$masa->c_embalaje) {
                                                              $material4j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $submaterial4j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                            }  
                                                          }
                                                          foreach ($fletestotal as $flete) {
                                                            if ($flete->rut==$masa->r_productor) {
                                                              $flete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $subflete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            }  
                                                          }
                                                  @endphp	
                                                @endif
                                                @if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                                  @php
                                                  $cantidad3j+=$masa->cantidad;
                                                  $subcantidad3j+=$masa->cantidad;
                                                  $pesoneto3j+=$masa->peso_neto;
                                                  $subpesoneto3j+=$masa->peso_neto;
                                                    $retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $subretorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                        if ($masa->tipo_transporte=='AEREO') {
                                                              if ($exportacions->where('type','aereo')->count()>0) {
                                                                $exportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $subexportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                              }
                                                          }
                                                        if ($masa->tipo_transporte=='MARITIMO') {
                                                            if ($exportacions->where('type','maritimo')->count()>0) {
                                                              $exportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $subexportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                            }
                                                          }
                                                          foreach ($materialestotal as $material) {
                                                            if ($material->c_embalaje==$masa->c_embalaje) {
                                                              $material3j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $submaterial3j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                            }  
                                                          }
                                                          foreach ($fletestotal as $flete) {
                                                            if ($flete->rut==$masa->r_productor) {
                                                              $flete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $subflete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            }  
                                                          }
                                                  @endphp	
                                                @endif
                                                @if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                                  @php
                                                  $cantidad2j+=$masa->cantidad;
                                                  $subcantidad2j+=$masa->cantidad;
                                                  $pesoneto2j+=$masa->peso_neto;
                                                  $subpesoneto2j+=$masa->peso_neto;
                                                    $retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $subretorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                        if ($masa->tipo_transporte=='AEREO') {
                                                              if ($exportacions->where('type','aereo')->count()>0) {
                                                                $exportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $subexportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                              }
                                                          }
                                                        if ($masa->tipo_transporte=='MARITIMO') {
                                                            if ($exportacions->where('type','maritimo')->count()>0) {
                                                              $exportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $subexportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                            }
                                                          }
                                                          foreach ($materialestotal as $material) {
                                                            if ($material->c_embalaje==$masa->c_embalaje) {
                                                              $material2j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $submaterial2j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                            }  
                                                          }
                                                          foreach ($fletestotal as $flete) {
                                                            if ($flete->rut==$masa->r_productor) {
                                                              $flete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $subflete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            }  
                                                          }
                                                  @endphp	
                                                @endif
                                                @if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                                  @php
                                                    $cantidadj+=$masa->cantidad;
                                                    $subcantidadj+=$masa->cantidad;
                                                    $pesonetoj+=$masa->peso_neto;
                                                    $subpesonetoj+=$masa->peso_neto;
                                                    $retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $subretornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $cantidadtotal+=$masa->cantidad;
                                                    $pesonetototal+=$masa->peso_neto;
                                                    if ($masa->tipo_transporte=='AEREO') {
                                                              if ($exportacions->where('type','aereo')->count()>0) {
                                                                $exportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $subexportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                              }
                                                          }
                                                        if ($masa->tipo_transporte=='MARITIMO') {
                                                            if ($exportacions->where('type','maritimo')->count()>0) {
                                                              $exportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $subexportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                            }
                                                          }
                                                          foreach ($materialestotal as $material) {
                                                            if ($material->c_embalaje==$masa->c_embalaje) {
                                                              $materialj+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $submaterialj+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                            }  
                                                          }
                                                          foreach ($fletestotal as $flete) {
                                                            if ($flete->rut==$masa->r_productor) {
                                                              $fletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $subfletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            }  
                                                          }
                                                  @endphp	
                                                @endif
                                                @if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                                  @php
                                                  $cantidadxl+=$masa->cantidad;
                                                  $subcantidadxl+=$masa->cantidad;
                                                  $pesonetoxl+=$masa->peso_neto;
                                                  $subpesonetoxl+=$masa->peso_neto;
                                                    $retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $subretornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                        if ($masa->tipo_transporte=='AEREO') {
                                                              if ($exportacions->where('type','aereo')->count()>0) {
                                                                $exportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $subexportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                                $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                              }
                                                          }
                                                        if ($masa->tipo_transporte=='MARITIMO') {
                                                            if ($exportacions->where('type','maritimo')->count()>0) {
                                                              $exportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $subexportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                              $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                            }
                                                          }
                                                          foreach ($materialestotal as $material) {
                                                            if ($material->c_embalaje==$masa->c_embalaje) {
                                                              $materialxl+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $submaterialxl+=$masa->cantidad*$material->costo_por_caja_usd;
                                                              $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                            }  
                                                          }
                                                          foreach ($fletestotal as $flete) {
                                                            if ($flete->rut==$masa->r_productor) {
                                                              $fletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $subfletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                              $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                            }  
                                                          }
                                                  @endphp	
                                                @endif
                                              
                                              @endif
                                            @endforeach
                                            @foreach ($masas as $masa)
                                              @php
                                                if ($masa->n_variedad==$variedad) {
                                                    $kgstotmas+=$masa->peso_neto;
                                                    $kgsglobmas+=$masa->peso_neto;
                                                }
                                              @endphp
                                            @endforeach
                                            @php
                                                foreach ($packings as $costo) {
                                                  if ($costo->variedad==$variedad) {
                                                    $costopacking+=$costo->total_usd;
                                                  }  
                                                }
                                                $totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas;
                                            @endphp
                                            @php
                                            $semanacount=0;
                                            @endphp
                                
                                            @if ($cantidad4j>0)
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                <td>Cherries</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>Cat 1</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                
                                                
                                                @if ($semanacount==0)
                                                <td>{{$semana}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                  
                                                <td>4J</td>
                                                <td>{{number_format($cantidad4j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                <td>{{number_format($cantidad4j,0,',','.')}}</td>
                                                <td>{{number_format($pesoneto4j,0,',','.')}} KGS</td>
                                                <td>{{number_format($retorno4j,2,',','.')}} USD</td>
                                                <td>{{number_format($retorno4j*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesoneto4j))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacion4j,2,',','.')}} USD</td>
                                                <td>{{number_format($flete4j,2,',','.')}} USD</td>
                                                <td>{{number_format($material4j,2,',','.')}} USD</td>

                                                {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                <td>{{number_format($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j,2,',','.')}} USD</td>
                                                
                                                  <td>
                                                    @if ($pesoneto4j)
                                                      {{number_format(($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j)/$pesoneto4j,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                              </tr>
                                              @php
                                                $semanacount+=1;
                                                $calibrecount+=1;
                                              @endphp
                                            @endif
                                            @if ($cantidad3j>0)
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                <td>Cherries</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>Cat 1</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                
                                              @if ($semanacount==0)
                                                <td>{{$semana}}</td>
                                                @else
                                                <td> </td>
                                              @endif
                                              
                                              <td>3J</td>
                                              <td>{{number_format($cantidad3j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                              
                                              <td>{{number_format($cantidad3j,0,',','.')}}</td>
                                              <td>{{number_format($pesoneto3j,0,',','.')}} KGS</td>
                                              <td>{{number_format($retorno3j,2,',','.')}} USD</td>
                                              <td>{{number_format($retorno3j*0.08,2,',','.')}} USD</td>
                                              <td>{{number_format(($costopacking*($pesoneto3j))/$kgstotmas,2,',','.')}} USD</td>
                                              <td>{{number_format($exportacion3j,2,',','.')}} USD</td>
                                              <td>{{number_format($flete3j,2,',','.')}} USD</td>
                                              <td>{{number_format($material3j,2,',','.')}} USD</td>
                                              {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                              <td>{{number_format($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j-$flete3j,2,',','.')}} USD</td>
                                              <td>
                                                  @if ($pesoneto3j)
                                                    {{number_format(($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j-$flete3j)/$pesoneto3j,2)}} USD/kg
                                                  @else
                                                    0 USD/kg
                                                  @endif
                                                </td>
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                                $semanacount+=1;
                                              @endphp
                                            @endif
                                            @if ($cantidad2j>0)
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                <td>Cherries</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>Cat 1</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                
                                                @if ($semanacount==0)
                                                <td>{{$semana}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                
                                                <td>2J</td>
                                                <td>{{number_format($cantidad2j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                
                                                <td>{{number_format($cantidad2j,0,',','.')}}</td>
                                                <td>{{number_format($pesoneto2j,0,',','.')}} KGS</td>
                                                <td>{{number_format($retorno2j,2,',','.')}} USD</td>
                                                <td>{{number_format($retorno2j*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesoneto2j))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacion2j,2,',','.')}} USD</td>
                                                <td>{{number_format($flete2j,2,',','.')}} USD</td>
                                                <td>{{number_format($material2j,2,',','.')}} USD</td>
                                                {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                <td>{{number_format($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j,2,',','.')}} USD</td>
                                                <td>
                                                    @if ($pesoneto2j)
                                                      {{number_format(($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j)/$pesoneto2j,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                                $semanacount+=1;
                                              @endphp
                                            @endif
                                            @if ($cantidadj>0)
                                              <tr>
                                                @if ($variedadcount==1 && $calibrecount==1)
                                                <td>Cherries</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>Cat 1</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                
                                                
                                                @if ($semanacount==0)
                                                <td>{{$semana}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                
                                                <td>J</td>
                                                <td>{{number_format($cantidadj*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                <td>{{number_format($cantidadj,0,',','.')}}</td>
                                                <td>{{number_format($pesonetoj,0,',','.')}} KGS</td>
                                                <td>{{number_format($retornoj,2,',','.')}} USD</td>
                                                <td>{{number_format($retornoj*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesonetoj))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacionj,2,',','.')}} USD</td>
                                                <td>{{number_format($fletej,2,',','.')}} USD</td>
                                                <td>{{number_format($materialj,2,',','.')}} USD</td>

                                                {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                <td>{{number_format($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej,2,',','.')}} USD</td>
                                                <td>
                                                    @if ($pesonetoj)
                                                      {{number_format(($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej)/$pesonetoj,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                                $semanacount+=1;
                                              @endphp
                                            @endif
                                            @if ($cantidadxl>0)
                                              <tr>
                                              @if ($variedadcount==1 && $calibrecount==1)
                                                <td>Cherries</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                @if ($calibrecount==1)
                                                <td>Cat 1</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                
                                                
                                                @if ($semanacount==0)
                                                <td>{{$semana}}</td>
                                                @else
                                                <td> </td>
                                                @endif
                                                
                                                <td>XL</td>
                                                <td>{{number_format($cantidadxl*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                <td>{{number_format($cantidadxl,0,',','.')}}</td>
                                                <td>{{number_format($pesonetoxl,0,',','.')}} KGS</td>
                                                <td>{{number_format($retornoxl,2,',','.')}} USD</td>
                                                <td>{{number_format($retornoxl*0.08,2,',','.')}} USD</td>
                                                <td>{{number_format(($costopacking*($pesonetoxl))/$kgstotmas,2,',','.')}} USD</td>
                                                <td>{{number_format($exportacionxl,2,',','.')}} USD</td>
                                                <td>{{number_format($fletexl,2,',','.')}} USD</td>
                                                <td>{{number_format($materialxl,2,',','.')}} USD</td>

                                                {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                <td>{{number_format($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl,2,',','.')}} USD</td>
                                                <td>
                                                    @if ($pesonetoxl)
                                                      {{number_format(($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl)/$pesonetoxl,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                              </tr>
                                              @php
                                                $calibrecount+=1;
                                                $semanacount+=1;
                                              @endphp
                                            @endif
                                
                                            @if ($cantidad4j>0 || $cantidad3j>0 || $cantidad2j>0 || $cantidadj>0 || $cantidadxl>0)
                                              <tr>
                                                
                                                <td> </td>
                                              
                                              
                                                <td> </td>
                                                <td> </td>
                                              
                                              
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$semana}} </td>
                                              
                                              
                                              
                                              
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl,0,',','.')}}</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl,0,',','.')}} KGS</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl),2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.08,2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas,2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl),2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($flete4j+$flete3j+$flete2j+$fletej+$fletexl),2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($material4j+$material3j+$material2j+$materialj+$materialxl),2,',','.')}}  USD</td>
                                                {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl),2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl))/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl),2)}}  USD/KGS</td>
                                                
                                              </tr>
                                              @endif
                                              @php
                                                $semanacount+=1;
                                              @endphp
                                              
                                          @endforeach

                                            @if ($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl)
                                              <tr>
                                                
                                                <td> </td>
                                              
                                              
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
                                                
                                                
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                              
                                                
                                                
                                                
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($subcantidad4j+$subcantidad3j+$subcantidad2j+$subcantidadj+$subcantidadxl)}}</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl)}} KGS</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($subretorno4j+$subretorno3j+$subretorno2j+$subretornoj+$subretornoxl),2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($subretorno4j+$subretorno3j+$subretorno2j+$subretornoj+$subretornoxl)*0.08,2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($costopacking*($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl))/$kgstotmas,2,',','.')}}  USD </td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($subexportacion4j+$subexportacion3j+$subexportacion2j+$subexportacionj+$subexportacionxl),2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($subflete4j+$subflete3j+$subflete2j+$subfletej+$subfletexl),2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($submaterial4j+$submaterial3j+$submaterial2j+$submaterialj+$submaterialxl),2,',','.')}}  USD</td>
                                                {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($subretorno4j+$subretorno3j+$subretorno2j+$subretornoj+$subretornoxl)*0.92-(($costopacking*($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl))/$kgstotmas)-($submaterial4j+$submaterial3j+$submaterial2j+$submaterialj+$submaterialxl)-($subexportacion4j+$subexportacion3j+$subexportacion2j+$subexportacionj+$subexportacionxl)-($subflete4j+$subflete3j+$subflete2j+$subfletej+$subfletexl),2,',','.')}}  USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($subretorno4j+$subretorno3j+$subretorno2j+$subretornoj+$subretornoxl)*0.92-(($costopacking*($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl))/$kgstotmas)-($submaterial4j+$submaterial3j+$submaterial2j+$submaterialj+$submaterialxl)-($subexportacion4j+$subexportacion3j+$subexportacion2j+$subexportacionj+$subexportacionxl)-($subflete4j+$subflete3j+$subflete2j+$subfletej+$subfletexl))/($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl),2,',','.')}}  USD/KG</td>
                                                
                                              </tr>
                                            @endif
                                      
                                            @php
                                            $variedadcount+=1;
                                            @endphp
                                          
                                      
                                        @endforeach
                                        <tr>
                                          
                                        
                                        
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total General</td>
                                        
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                        
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                        
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                        
                                        
                                          
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($cantidadtotal)}}</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($pesonetototal)}} KG</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.08,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($totalcostopacking,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($exportaciontotal,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($globalfletehuerto,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($totalmateriales,2,',','.')}} USD</td>
                                          {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto,2,',','.')}} USD</td>
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto)/$pesonetototal,2)}} usd/kg</td>
                                          
                                        </tr>
                                      @endif   
                                    </tbody>
                                  </table>
                                   <h1 class="mt-6 font-bold text-center">
                                    Fuera de Norma por Semana
                                  </h1>
                                  <table id="balance" style="width:100%; border-collapse: collapse; margin-top: 20px;">
                                    <thead>
                                      <tr>
                                      <th>Especie</th>
                                      <th>Categoría</th>
                                      <th>Variedad</th>
                                      
                                      <th>Serie</th>
                                      <th>% Curva<br>
                                        Calibre </th>
                                      <th>Cajas</th>
                                      <th>Peso Neto</th>
                                      <th class="bg-green-100">Ingresos</th>
                                      <th class="bg-red-100">Comision</th>
                                      <th class="bg-red-100">Frio<br>Packing</th>
                                      <th class="bg-red-100">Exportación</th>
                                      <th class="bg-red-100">Flete<br>Puerto</th>
                                      <th class="bg-red-100">Materiales</th>
                                      <th  class="bg-yellow-100">Retorno Neto<br> Total</th>
                                      <th class="bg-yellow-100">Retorno Kilo</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @php
                                          $variedadcount=1;
                                          $supercantidadtotal=0;
                                          $superpesonetototal=0;
                                          $superretornototal=0;
                                          $superexportaciontotal=0;
                                          $globalfletehuerto=0;
                                          $supertotalmateriales=0;
                                          $supertotalcostopacking=0;
                                        @endphp
                                      @foreach ($unique_categorias as $categoria)
                                        @php
                                          $fletehuerto=0;
                                          $totalcostopacking=0;
                                          $variedadcount=1;
                                          $cantidadtotal=0;
                                          $pesonetototal=0;
                                          $retornototal=0;
                                          $exportaciontotal=0;
                                          $totalmateriales=0;
                                          $kgsglobmas=0;

                                            $subflete4j=0;
                                            $subflete3j=0;
                                            $subflete2j=0;
                                            $subfletej=0;
                                            $subfletexl=0;
                                            $subfletel=0;

                                        @endphp

                                        @foreach ($unique_variedades as $variedad)
                                          @php
                                            $costopacking=0;
                                            $calibrecount=1;
                                            
                                            $cantidad4j=0;
                                            $cantidad3j=0;
                                            $cantidad2j=0;
                                            $cantidadj=0;
                                            $cantidadxl=0;
                                            $cantidadl=0;

                                            $exportacion4j=0;
                                            $exportacion3j=0;
                                            $exportacion2j=0;
                                            $exportacionj=0;
                                            $exportacionxl=0;
                                            $exportacionl=0;
                            
                                            $pesoneto4j=0;
                                            $pesoneto3j=0;
                                            $pesoneto2j=0;
                                            $pesonetoj=0;
                                            $pesonetoxl=0;
                                            $pesonetol=0;
                            
                                            $retorno4j=0;
                                            $retorno3j=0;
                                            $retorno2j=0;
                                            $retornoj=0;
                                            $retornoxl=0;
                                            $retornol=0;

                                            $flete4j=0;
                                            $flete3j=0;
                                            $flete2j=0;
                                            $fletej=0;
                                            $fletexl=0;
                                            $fletel=0;

                                            $material4j=0;
                                            $material3j=0;
                                            $material2j=0;
                                            $materialj=0;
                                            $materialxl=0;
                                            $materiall=0;

                                            $kgstotmas=0;
                                          @endphp
                                
                                          @foreach ($masas as $masa)
                                            @if (($masa->n_etiqueta=='Loica' || $masa->n_calibre=='L' || $masa->n_calibre=='LD') && $masa->n_categoria==$categoria && $categoria!='Vega')
                                            
                                            @if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidad4j+=$masa->cantidad;
                                                  $pesoneto4j+=$masa->peso_neto;
                                                    $retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                  if ($masa->tipo_transporte=='AEREO') {
                                                        if ($exportacions->where('type','aereo')->count()>0) {
                                                          $exportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                           $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                        }
                                                    }
                                                  if ($masa->tipo_transporte=='MARITIMO') {
                                                      if ($exportacions->where('type','maritimo')->count()>0) {
                                                        $exportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                         $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                      }
                                                    }
                                                    foreach ($materialestotal as $material) {
                                                      if ($material->c_embalaje==$masa->c_embalaje) {
                                                        $material4j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                            $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                            $supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                          }  
                                                    }
                                                    foreach ($fletestotal as $flete) {
                                                        if ($flete->rut==$masa->r_productor) {
                                                          $flete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $subflete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                        }  
                                                      }
                                                @endphp	
                                                
                                            @endif
                                            @if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidad3j+=$masa->cantidad;
                                                  $pesoneto3j+=$masa->peso_neto;
                                                    $retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                  if ($masa->tipo_transporte=='AEREO') {
                                                        if ($exportacions->where('type','aereo')->count()>0) {
                                                          $exportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                           $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                        }
                                                    }
                                                  if ($masa->tipo_transporte=='MARITIMO') {
                                                      if ($exportacions->where('type','maritimo')->count()>0) {
                                                        $exportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                         $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                      }
                                                    }
                                                    foreach ($materialestotal as $material) {
                                                      if ($material->c_embalaje==$masa->c_embalaje) {
                                                        $material3j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        $supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                      }  
                                                    }
                                                    foreach ($fletestotal as $flete) {
                                                        if ($flete->rut==$masa->r_productor) {
                                                          $flete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $subflete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                        }  
                                                      }
                                                @endphp	
                                            @endif
                                            @if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidad2j+=$masa->cantidad;
                                                  $pesoneto2j+=$masa->peso_neto;
                                                    $retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                  if ($masa->tipo_transporte=='AEREO') {
                                                        if ($exportacions->where('type','aereo')->count()>0) {
                                                          $exportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                           $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                        }
                                                    }
                                                  if ($masa->tipo_transporte=='MARITIMO') {
                                                      if ($exportacions->where('type','maritimo')->count()>0) {
                                                        $exportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                         $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                      }
                                                    }
                                                    foreach ($materialestotal as $material) {
                                                      if ($material->c_embalaje==$masa->c_embalaje) {
                                                        $material2j+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        $supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                      }  
                                                    }
                                                    foreach ($fletestotal as $flete) {
                                                        if ($flete->rut==$masa->r_productor) {
                                                          $flete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $subflete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                        }  
                                                      }
                                                @endphp	
                                            @endif
                                            @if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidadj+=$masa->cantidad;
                                                    $pesonetoj+=$masa->peso_neto;
                                                      $retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                      $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                  if ($masa->tipo_transporte=='AEREO') {
                                                        if ($exportacions->where('type','aereo')->count()>0) {
                                                          $exportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                           $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                        }
                                                    }
                                                  if ($masa->tipo_transporte=='MARITIMO') {
                                                      if ($exportacions->where('type','maritimo')->count()>0) {
                                                        $exportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                         $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                      }
                                                    }
                                                    foreach ($materialestotal as $material) {
                                                      if ($material->c_embalaje==$masa->c_embalaje) {
                                                        $materialj+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        $supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                      }  
                                                    }
                                                    foreach ($fletestotal as $flete) {
                                                        if ($flete->rut==$masa->r_productor) {
                                                          $fletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $subfletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                        }  
                                                      }
                                                @endphp	
                                            @endif
                                            @if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidadxl+=$masa->cantidad;
                                                  $pesonetoxl+=$masa->peso_neto;
                                                    $retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                  if ($masa->tipo_transporte=='AEREO') {
                                                        if ($exportacions->where('type','aereo')->count()>0) {
                                                          $exportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                           $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                        }
                                                    }
                                                  if ($masa->tipo_transporte=='MARITIMO') {
                                                      if ($exportacions->where('type','maritimo')->count()>0) {
                                                        $exportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                         $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                      }
                                                    }
                                                    foreach ($materialestotal as $material) {
                                                      if ($material->c_embalaje==$masa->c_embalaje) {
                                                        $materialxl+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        $supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                      }  
                                                    }
                                                    foreach ($fletestotal as $flete) {
                                                        if ($flete->rut==$masa->r_productor) {
                                                          $fletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $subfletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                        }  
                                                      }
                                                @endphp	
                                            @endif
                                              @if (($masa->n_calibre=='L' || $masa->n_calibre=='LD') && $masa->n_variedad==$variedad)
                                                @php
                                                    $cantidadl+=$masa->cantidad;
                                                    $pesonetol+=$masa->peso_neto;
                                                    $retornol+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                    $cantidadtotal+=$masa->cantidad;
                                                    $pesonetototal+=$masa->peso_neto;
                                                    if ($masa->tipo_transporte=='AEREO') {
                                                          if ($exportacions->where('type','aereo')->count()>0) {
                                                            $exportacionl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                            $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                            $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                          }
                                                      }
                                                    if ($masa->tipo_transporte=='MARITIMO') {
                                                        if ($exportacions->where('type','maritimo')->count()>0) {
                                                          $exportacionl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                          $exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                          $superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                        }
                                                      }
                                                      foreach ($materialestotal as $material) {
                                                        if ($material->c_embalaje==$masa->c_embalaje) {
                                                          $materiall+=$masa->cantidad*$material->costo_por_caja_usd;
                                                          $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                          $supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                        }  
                                                      }
                                                      foreach ($fletestotal as $flete) {
                                                        if ($flete->rut==$masa->r_productor) {
                                                          $fletel+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $subfletel+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                          $globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
                                                        }  
                                                      }
                                                  @endphp	
                                                    
                                              @endif
                                              
                                            @endif
                                            
                                          @endforeach
                                          
                                          @foreach ($masas as $masa)
                                            @php
                                              if ($masa->n_variedad==$variedad) {
                                                  $kgstotmas+=$masa->peso_neto;
                                                  $kgsglobmas+=$masa->peso_neto;
                                              }
                                            @endphp
                                          @endforeach
                                          @php
                                            foreach ($packings as $costo) {
                                              if ($costo->variedad==$variedad) {
                                                $costopacking+=$costo->total_usd;
                                             
                                              }  
                                            }
                                            $totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas;
                                            $supertotalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas;
                                          @endphp
                            
                                          @if (($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol)>0)
                                            
                                            
                                              @if (($unique_calibres->contains('4J') || $unique_calibres->contains('4JD') || $unique_calibres->contains('4JDD')) && $pesoneto4j>0)
                                                <tr>
                                                  @if ($variedadcount==1 && $calibrecount==1)
                                                    <td>Cherries</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$categoria}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$variedad}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  
                                                  
                                                  
                                                  
                                                  <td>4J</td>
                                                  @if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
                                                    <td>{{number_format($cantidad4j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
                                                  @else
                                                    <td>0</td>
                                                  @endif
                                                    
                                                  <td>{{$cantidad4j}}</td>
                                                  <td>{{$pesoneto4j}} KGS</td>
                                                  <td>{{number_format($retorno4j,2,',','.')}} USD</td>
                                                  <td>{{number_format($retorno4j*0.08,2,',','.')}} USD</td>
                                                  <td>{{number_format(($costopacking*$pesoneto4j)/$kgstotmas,2,',','.')}} USD</td>
                                                  <td>{{number_format($exportacion4j,2,',','.')}} USD</td>
                                                  <td>{{number_format($flete4j,2,',','.')}} USD</td>
                                                  <td>{{number_format($material4j,2,',','.')}} USD</td>
                                                   {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                  <td>{{number_format($retorno4j*0.92-(($costopacking*$pesoneto4j)/$kgstotmas)-$exportacion4j-$material4j-$flete4j,2,',','.')}} USD</td>
                                                  <td>
                                                    @if ($pesoneto4j)
                                                      {{number_format(($retorno4j*0.92-(($costopacking*$pesoneto4j)/$kgstotmas)-$exportacion4j-$material4j-$flete4j)/$pesoneto4j,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                                  
                                                </tr>
                                                @php
                                                  $calibrecount+=1;
                                                @endphp
                                              @endif
                                              
                                              @if (($unique_calibres->contains('3J') || $unique_calibres->contains('3JD') || $unique_calibres->contains('3JDD')) && $pesoneto3j>0)
                                                <tr>
                                                  @if ($variedadcount==1 && $calibrecount==1)
                                                    <td>Cherries</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$categoria}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$variedad}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  
                                                  
                                                  
                                                  <td>3J</td>
                                                  @if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
                                                    <td>{{number_format($cantidad3j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
                                                  @else
                                                    <td>0</td>	
                                                  @endif
                            
                                                  <td>{{$cantidad3j}}</td>
                                                  <td>{{$pesoneto3j}} KGS</td>
                                                  <td>{{number_format($retorno3j,2,',','.')}} USD</td>
                                                  <td>{{number_format($retorno3j*0.08,2,',','.')}} USD</td>
                                                  <td>{{number_format(($costopacking*$pesoneto3j)/$kgstotmas,2,',','.')}} USD</td>
                                                  <td>{{number_format($exportacion3j,2,',','.')}} USD</td>
                                                  <td>{{number_format($flete3j,2,',','.')}} USD</td>
                                                  <td>{{number_format($material3j,2,',','.')}} USD</td>
                                                  {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                  <td>{{number_format($retorno3j*0.92-(($costopacking*$pesoneto3j)/$kgstotmas)-$exportacion3j-$material3j-$flete3j,2,',','.')}} USD</td>
                                                  <td>
                                                    @if ($pesoneto3j)
                                                      {{number_format(($retorno3j*0.92-(($costopacking*$pesoneto3j)/$kgstotmas)-$exportacion3j-$material3j-$flete3j)/$pesoneto3j,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                                  
                                                </tr>
                                                @php
                                                  $calibrecount+=1;
                                                @endphp
                                              @endif
                                              
                                              @if (($unique_calibres->contains('2J') || $unique_calibres->contains('2JD') || $unique_calibres->contains('2JDD')) && $pesoneto2j>0)
                                                <tr>
                                                  @if ($variedadcount==1 && $calibrecount==1)
                                                    <td>Cherries</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$categoria}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$variedad}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  
                                                  
                                                  
                                                  <td>2J</td>
                            
                                                  @if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
                                                    <td>{{number_format($cantidad2j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
                                                  @else
                                                    <td>0</td>
                                                  @endif
                                                  
                                                  <td>{{$cantidad2j}}</td>
                                                  <td>{{$pesoneto2j}} KGS</td>
                                                  <td>{{number_format($retorno2j,2,',','.')}} USD</td>
                                                  <td>{{number_format($retorno2j*0.08,2,',','.')}} USD</td>
                                                  <td>{{number_format(($costopacking*$pesoneto2j)/$kgstotmas,2,',','.')}} USD</td>
                                                  <td>{{number_format($exportacion2j,2,',','.')}} USD</td>
                                                  <td>{{number_format($flete2j,2,',','.')}} USD</td>
                                                  <td>{{number_format($material2j,2,',','.')}} USD</td>
                                                  {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                  <td>{{number_format($retorno2j*0.92-(($costopacking*$pesoneto2j)/$kgstotmas)-$exportacion2j-$material2j-$flete2j,2,',','.')}} USD</td>
                                              
                                                  <td>
                                                    @if ($pesoneto2j)
                                                      {{number_format(($retorno2j*0.92-(($costopacking*$pesoneto2j)/$kgstotmas)-$exportacion2j-$material2j-$flete2j)/$pesoneto2j,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                                  
                                                </tr>
                                                @php
                                                  $calibrecount+=1;
                                                @endphp
                                              @endif
                                              
                                              @if (($unique_calibres->contains('J') || $unique_calibres->contains('JD') || $unique_calibres->contains('JDD')) && $pesonetoj>0)
                                                <tr>
                                                  @if ($variedadcount==1 && $calibrecount==1)
                                                    <td>Cherries</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$categoria}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$variedad}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  
                                                  
                                                  
                                                  
                                                  <td>J</td>
                                                  @if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
                                                    <td>{{number_format($cantidadj*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
                                                  @else
                                                    <td>0</td>
                                                  @endif
                                                  
                                                  <td>{{$cantidadj}}</td>
                                                  <td>{{$pesonetoj}} KGS</td>
                                                  <td>{{number_format($retornoj,2,',','.')}} USD</td>
                                                  <td>{{number_format($retornoj*0.08,2,',','.')}} USD</td>
                                                  <td>{{number_format(($costopacking*$pesonetoj)/$kgstotmas,2,',','.')}} USD</td>
                                                  <td>{{number_format($exportacionj,2,',','.')}} USD</td>
                                                  <td>{{number_format($fletej,2,',','.')}} USD</td>
                                                  <td>{{number_format($materialj,2,',','.')}} USD</td>
                                                  {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                  <td>{{number_format($retornoj*0.92-(($costopacking*$pesonetoj)/$kgstotmas)-$exportacionj-$materialj-$fletej,2,',','.')}} USD</td>
                                                  <td>
                                                    @if ($pesonetoj)
                                                      {{number_format(($retornoj*0.92-(($costopacking*$pesonetoj)/$kgstotmas)-$exportacionj-$materialj-$fletej)/$pesonetoj,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                    
                                                  
                                                </tr>
                                                @php
                                                  $calibrecount+=1;
                                                @endphp
                                              @endif
                                              
                                              @if (($unique_calibres->contains('XL') || $unique_calibres->contains('XLD') || $unique_calibres->contains('XLDD')) && $pesonetoxl>0)
                                                <tr>
                                                  @if ($variedadcount==1 && $calibrecount==1)
                                                    <td>Cherries</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$categoria}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$variedad}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  
                                                  
                                                  
                                                  
                                                  <td>XL</td>
                                                  @if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
                                                    <td>{{number_format($cantidadxl*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
                                                  @else
                                                    <td>0</td>	
                                                  @endif
                            
                                                  <td>{{$cantidadxl}}</td>
                                                  <td>{{$pesonetoxl}} KGS</td>
                                                  <td>{{number_format($retornoxl,2,',','.')}} USD</td>
                                                  <td>{{number_format($retornoxl*0.08,2,',','.')}} USD</td>
                                                  <td>{{number_format(($costopacking*$pesonetoxl)/$kgstotmas,2,',','.')}} USD</td>
                                                  <td>{{number_format($exportacionxl,2,',','.')}} USD</td>
                                                  <td>{{number_format($fletexl,2,',','.')}} USD</td>
                                                  <td>{{number_format($materialxl,2,',','.')}} USD</td>
                                                  {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                  <td>{{number_format($retornoxl*0.92-(($costopacking*$pesonetoxl)/$kgstotmas)-$exportacionxl-$materialxl-$fletexl,2,',','.')}} USD</td>
                                              
                                                  <td>
                                                    @if ($pesonetoxl)
                                                      {{number_format(($retornoxl*0.92-(($costopacking*$pesonetoxl)/$kgstotmas)-$exportacionxl-$materialxl-$fletexl)/$pesonetoxl,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                                  
                                                </tr>
                                                @php
                                                  $calibrecount+=1;
                                                @endphp
                                              @endif
                                              
                                              @if (($unique_calibres->contains('L') || $unique_calibres->contains('LD')) && $pesonetol>0)
                                                <tr>
                                                  @if ($variedadcount==1 && $calibrecount==1)
                                                    <td>Cherries</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$categoria}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  @if ($calibrecount==1)
                                                    <td>{{$variedad}}</td>
                                                  @else
                                                    <td> </td>
                                                  @endif
                                                  
                                                  
                                                  
                                                  
                                                  <td>L</td>
                                                  @if (($cantidadl+$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl)>0)
                                                    <td>{{number_format($cantidadl*100/($cantidadl+$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
                                                  @else
                                                    <td>0</td>	
                                                  @endif
                            
                                                  <td>{{$cantidadl}}</td>
                                                  <td>{{$pesonetol}} KGS</td>
                                                  <td>{{number_format($retornol,2,',','.')}} USD</td>
                                                  <td>{{number_format($retornol*0.08,2,',','.')}} USD</td>
                                                  <td>{{number_format(($costopacking*$pesonetol)/$kgstotmas,2,',','.')}} USD</td>
                                                  <td>{{number_format($exportacionl,2,',','.')}} USD</td>
                                                  <td>{{number_format($fletel,2,',','.')}} USD</td>
                                                  <td>{{number_format($materiall,2,',','.')}} USD</td>
                                                  {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                  <td>{{number_format($retornol*0.92-(($costopacking*$pesonetol)/$kgstotmas)-$exportacionl-$materiall-$fletel,2,',','.')}} USD</td>
                                              
                                                  <td>
                                                    @if ($pesonetol)
                                                      {{number_format(($retornol*0.92-(($costopacking*$pesonetol)/$kgstotmas)-$exportacionl-$materiall-$fletel)/$pesonetol,2)}} USD/kg
                                                    @else
                                                      0 USD/kg
                                                    @endif
                                                  </td>
                                                  
                                                </tr>
                                                @php
                                                  $calibrecount+=1;
                                                @endphp
                                              @endif
                                
                                              
                                              <tr>
                                                
                                                  <td> </td>
                                                  <td> </td>
                                              
                                              
                                                  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
                                                
                                                
                                                  
                                                
                                                
                                                
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">100,00%</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl}}</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol}} KGS</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl+$retornol),2,',','.')}} USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl+$retornol)*0.08,2,',','.')}} USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas,2,',','.')}} USD</td>
                                                
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl+$exportacionl),2,',','.')}} USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($flete4j+$flete3j+$flete2j+$fletej+$fletexl+$fletel),2,',','.')}} USD</td>
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($material4j+$material3j+$material2j+$materialj+$materialxl+$materiall),2,',','.')}} USD</td>
                                               {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl+$retornol)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas)-($material4j+$material3j+$material2j+$materialj+$materialxl+$materiall)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl+$exportacionl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl+$fletel),2,',','.')}} USD</td>
                                              
                                                @if (($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol)>0)
                                                  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl+$retornol)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas)-($material4j+$material3j+$material2j+$materialj+$materialxl+$materiall)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl+$exportacionl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl+$fletel))/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol),2)}} USD/KG</td>
                                                @else
                                                  <td>0</td>	
                                                @endif
                                              </tr>
                                            
                                
                                            @php
                                              $variedadcount+=1;
                                              
                                          
                                              $supercantidadtotal+=$cantidadtotal;
                                              $superpesonetototal+=$pesonetototal;
                                              $superretornototal+=$retornototal; 
                                        
                                            @endphp
                                          
                                          @endif
                                
                                        @endforeach
                            
                                        @if (($cantidadtotal+$pesonetototal)>0)
                                          <tr>
                                                
                                            
                                              <td></td>
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$categoria}}</td>
                                            
                                            
                                            
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                          
                                            
                                            
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidadtotal}}</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KGS</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal,2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.08,2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($totalcostopacking,2,',','.')}} USD </td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($exportaciontotal,2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($fletehuerto,2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($totalmateriales,2,',','.')}} USD</td>
                                            {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$fletehuerto,2,',','.')}} USD</td>
                                            
                                            @if ($pesonetototal>0)
                                              <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal/$pesonetototal,2)}} usd/kg</td>
                                            @else
                                              <td>0</td>
                                            @endif
                                          </tr>
                                        @endif
                            
                                      @endforeach
                            
                                      <tr>
                                                  
                                              
                                            
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
                                        
                                        
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                      
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
                                      
                                        
                                        
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$supercantidadtotal}}</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$superpesonetototal}} KGS</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superretornototal,2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superretornototal*0.08,2,',','.')}} USD</td>
                                        
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($supertotalcostopacking,2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superexportaciontotal,2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($globalfletehuerto,2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($supertotalmateriales,2,',','.')}} USD</td>
                                        {{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superretornototal*0.92-($supertotalcostopacking)-$superexportaciontotal-$supertotalmateriales-$globalfletehuerto,2,',','.')}} USD</td>
                                        @if ($superpesonetototal>0)
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superretornototal/$superpesonetototal,2)}} usd/kg</td>
                                        @else
                                          <td>0</td>
                                        @endif
                                      </tr>
                              
                                    </tbody>
                                  </table>
                                  <h1 class="mt-6 font-bold text-center">
                                    Fruta Comercial
                                  </h1>
                                  <table id="balance" style="width:70%; border-collapse: collapse; margin-top: 20px;">
                                    <thead>
                                      <tr>
                                      
                                      <th>Variedad</th>
                                      
                                      <th>Serie</th>
                                      
                                    
                                      <th>Peso Neto</th>
                                      <th class="bg-green-100">Ingreso Comercial</th>
                                      
                                      <th class="bg-red-100">FrioPacking</th>
                                      <th class="bg-yellow-100">Ingreso Comercial</th>
                                      
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @php
                                        $variedadcount=1;
                                        $cantidadtotal=0;
                                        $pesonetototal=0;
                                        $retornototal=0;
                                        $totalcostopacking=0;
                                        $kgsglobmas=0;
                                      @endphp
                                      @foreach ($unique_variedades as $variedad)
                                        @php
                                          $calibrecount=1;
                                          $costopacking=0;
                                          $cantidad4j=0;
                                          $cantidad3j=0;
                                          $cantidad2j=0;
                                          $cantidadj=0;
                                          $cantidadxl=0;
                                          $pesoneto4j=0;
                                          $pesoneto3j=0;
                                          $pesoneto2j=0;
                                          $pesonetoj=0;
                                          $pesonetoxl=0;
                                          $retorno4j=0;
                                          $retorno3j=0;
                                          $retorno2j=0;
                                          $retornoj=0;
                                          $retornoxl=0;
                                          $kgstotmas=0;
                                        @endphp
                              
                                        @foreach ($masas as $masa)
                                          @if ($masa->n_calibre=='Comercial' || $masa->n_calibre=='Precalibre' || $masa->n_calibre=='Desecho' || $masa->n_calibre=='Merma')
                                            @if (($masa->n_calibre=='Comercial') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidad4j+=$masa->cantidad;
                                                  $pesoneto4j+=$masa->peso_neto;
                                                  foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
                                                    $retorno4j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
                                                    $retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
                                                  break;
                                                  }
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                @endphp	
                                            @endif
                                            @if (($masa->n_calibre=='Precalibre') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidad3j+=$masa->cantidad;
                                                  $pesoneto3j+=$masa->peso_neto;
                                                  foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
                                                    $retorno3j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
                                                    $retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
                                                  break;
                                                  }
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                @endphp	
                                            @endif
                                            @if (($masa->n_calibre=='Desecho') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidad2j+=$masa->cantidad;
                                                  $pesoneto2j+=$masa->peso_neto;
                                                  foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
                                                    $retorno2j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
                                                    $retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
                                                  break;
                                                  }
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                @endphp	
                                            @endif
                                            @if (($masa->n_calibre=='Merma') && $masa->n_variedad==$variedad)
                                                @php
                                                  $cantidadj+=$masa->cantidad;
                                                  $pesonetoj+=$masa->peso_neto;
                                                  foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
                                                    $retornoj+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
                                                    $retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
                                                    break;
                                                  }
                                                  $cantidadtotal+=$masa->cantidad;
                                                  $pesonetototal+=$masa->peso_neto;
                                                @endphp	
                                            @endif
                                            
                                            
                                          @endif
                                          
                                        @endforeach
                                        @foreach ($masas as $masa)
                                          @php
                                            if ($masa->n_variedad==$variedad) {
                                                $kgstotmas+=$masa->peso_neto;
                                                $kgsglobmas+=$masa->peso_neto;
                                            }
                                          @endphp
                                        @endforeach
                                          @php
                                            foreach ($packings as $costo) {
                                              if ($costo->variedad==$variedad) {
                                                $costopacking+=$costo->total_usd;
                                              }  
                                            }
                                            $totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj))/$kgstotmas;
                                         
                                          @endphp
                              
                                            <tr>
                                              
                                              @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                              @else
                                                <td> </td>
                                              @endif
                                              
                                              
                                              
                                              
                                              <td>Comercial</td>
                                              
                                              <td>{{$pesoneto4j}} KGS</td>
                                              <td>{{$retorno4j}} USD</td>
                                              <td>{{number_format(($costopacking*$pesoneto4j)/$kgstotmas,2,',','.')}} USD</td>
                                               {{-- Retorno - CostoPacking --}}
                                              <td>{{number_format($retorno4j,2,',','.')}} CLP</td>
                                              
                                              
                                            </tr>
                                            @php
                                              $calibrecount+=1;
                                            @endphp
                                            <tr>
                                              
                                              @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                              @else
                                                <td> </td>
                                              @endif
                                              
                                              
                                              
                                              <td>Precalibre</td>
                                              
                                              
                                              <td>{{$pesoneto3j}} KGS</td>
                                              <td>{{$retorno3j}} USD</td>
                                              <td>{{number_format(($costopacking*$pesoneto3j)/$kgstotmas,2,',','.')}} USD</td>
                                               {{-- Retorno - CostoPacking --}}
                                              <td>{{number_format($retorno3j,2,',','.')}} CLP</td>
                                              
                                              
                                            </tr>
                                            @php
                                              $calibrecount+=1;
                                            @endphp
                                            <tr>
                                            
                                              @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                              @else
                                                <td> </td>
                                              @endif
                                              
                                              
                                              
                                              <td>Desecho</td>
                                              
                                            
                                              <td>{{$pesoneto2j}} KGS</td>
                                              <td>{{$retorno2j}} USD</td>
                                              <td>{{number_format(($costopacking*$pesoneto2j)/$kgstotmas,2,',','.')}} USD</td>
                                               {{-- Retorno - CostoPacking --}}
                                              <td>{{number_format($retorno2j,2,',','.')}} CLP</td>
                                              
                                              
                                            </tr>
                                            @php
                                              $calibrecount+=1;
                                            @endphp
                                      
                                            <tr>
                                            
                                              @if ($calibrecount==1)
                                                <td>{{$variedad}}</td>
                                              @else
                                                <td> </td>
                                              @endif
                                              
                                              
                                              
                                              <td>Merma</td>
                                              
                                            
                                              <td>{{$pesonetoj}} KGS</td>
                                              <td>{{$retornoj}} USD</td>
                                              <td>{{($costopacking*$pesonetoj)/$kgstotmas}} USD</td>
                                               {{-- Retorno - CostoPacking --}}
                                              <td>{{number_format($retornoj,2,',','.')}} CLP</td>
                                              
                                              
                                            </tr>
                                            @php
                                              $calibrecount+=1;
                                            @endphp
                                        
                            
                                          
                              
                                          <tr>
                                            
                                              
                                          
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
                                            
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj}}</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$retorno4j+$retorno3j+$retorno2j+$retornoj}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj))/$kgstotmas,2,',','.')}} USD </td>
                                             {{-- Retorno - CostoPacking --}}
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retorno4j+$retorno3j+$retorno2j+$retornoj,2,',','.')}} CLP</td>
                                            
                                          </tr>
                                          
                              
                                          @php
                                            $variedadcount+=1;
                                          @endphp
                                        
                              
                                      @endforeach
                              
                                      <tr>
                                            
                                        
                                      
                                          <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
                                        
                                        
                                        
                                        
                                        
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KGS</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$retornototal}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($totalcostopacking,2,',','.')}} USD</td>
                                        {{-- Retorno - CostoPacking --}}
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal,2,',','.')}} CLP</td>
                                     
                                      </tr>
                                          
                              
                                    </tbody>
                                  </table>

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
