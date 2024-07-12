<div class="card-body">
  @php
      $totalfriopacking=0;
  @endphp
  @if ($CostosPackingsall->count()>0)
    @foreach ($CostosPackingsall as $packing)
        @php
            $totalfriopacking+=intval($packing->total_usd);
        @endphp
          
    @endforeach
  @endif
    <h1 class="text-2xl font-bold">Temporada {{$temporada->name}}</h1>
    <hr class="mt-2 mb-6">



  <section id="informacion">
    <div class="flex w-full bg-gray-300 mt-2"  @if ($vista=="resumes") x-data="{openMenu: 1}" @else x-data="{openMenu: 1}" @endif >
        
        @livewire('menu-aside',['temporada'=>$temporada->id])
        <!-- End Sidebar -->
        <div class="flex flex-col flex-1 w-full overflow-y-auto">
            <!--Start Topbar -->
            <!--End Topbar -->
          <main class="relative z-0 flex-1 pb-8 bg-white">
            <div class="flex justify-center">
              <div class="inline-flex items-center rounded-md shadow-sm gap-x-2">
                  <button wire:click="set_view('resumes')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>                      
                      </span>
                      <span>RESUMEN</span>
                  </button>
      
                  
                
                    <button wire:click="set_view('GASTOS')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>GASTO</span>
                    </button>
                    <button wire:click="set_view('EXPORTACION')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>EXPORTACIÓN</span>
                    </button>
                    <button wire:click="set_view('PACKING')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>COSTOS <br>PACKING</span>
                    </button>
                    <button wire:click="set_view('MATERIALES')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>MATERIALES</span>
                    </button>
                    <button wire:click="set_view('FLETES')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>FLETES</span>
                    </button>
                    <button wire:click="set_view('COMISION')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>COMISION</span>
                    </button>
                    <button wire:click="set_view('MASAS')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>BALANCE</span>
                  </button>
                  <button wire:click="set_view('FOB')" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    </span>
                    <span>FOB</span>
                </button>
              </div>
          </div>

            <div class="bg-gray-100 rounded px-2 md:p-8 shadow mb-6">
              <h2 @click.on="openMenu = 1"  class="hidden cursor-pointer text-xs text-blue-500 font-semibold mb-4"><-Abrir Menu</h2>


              <h2 class="text-2xl font-semibold my-4">Filtros 


                @if ($vista=='MASAS')
                    Balance de Masa

                @elseif ($vista=='resumes')
                Resumen
                @else
                  {{$vista}} 
                @endif

             
                <div wire:loading wire:target="filters">
                    
                    <div class="fixed max-h-full w-full max-w-sm overflow-y-auto mx-auto sm:rounded-2xl bg-white border-2 border-gray-200 shadow-xl">
                      <div class="w-full">
                        <div class="px-6 my-6 mx-auto">
                          <div class="mb-8">
                            <div class="flex justify-between items-center">
                              <h1 class="text-2xl font-extrabold mr-4">Cargando filtros...</h1>
                              <div><img class="h-10" src="{{asset('image/cargando.gif')}}" alt=""></div>
                            </div>
                          
                          </div>
                        
                        </div>
                      </div>
                    </div>
                </div>

                @if ($vista=='FOB' && $fobs)
                  ({{$fobsall->count()}} Resultados)
                @endif
                @if ($vista=='MASAS')
                  @php
                      $kgstotmas=0;
                  @endphp
                  @foreach ($masastotal as $masa)
                    @php
                        $kgstotmas+=$masa->peso_neto;
                    @endphp
                  @endforeach
                  @foreach ($masastotalnacional as $masa)
                    @php
                        $kgstotmas+=$masa->peso_neto;
                    @endphp
                  @endforeach
                
                  @if ($masastotal && $masastotalnacional)
                    ({{(number_format($masastotal->count()+$masastotalnacional->count()))}} Resultados) ({{number_format($kgstotmas)}} KGS)
                  @elseif($masastotal)
                    ({{(number_format($masastotal->count()))}} Resultados) ({{number_format($kgstotmas)}} KGS)
                  @elseif($masastotalnacional)
                    ({{(number_format($masastotalnacional->count()))}} Resultados) ({{number_format($kgstotmas)}} KGS)
                  @endif
                @endif
              </h2>
              <div class="mb-4">
                Productor/Csg
                <x-input wire:model.live="filters.razonsocial" type="text" class="w-full" />
                @if ($filters['razonsocial'])
                  <ul class="relative z-1 left-0 w-full bg-white mt-1 rounded-lg overflow-hidden px-4">
                    @forelse ($this->users as $objet)
                        <li wire:click='set_productorid({{$objet->id}})' class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300">
                            <p>{{$objet->name}}-{{$objet->rut}}-{{$objet->csg}}</p>
                        </li>
                        @empty
                    @endforelse
                  </ul>
                @endif
              </div>

              <div class="mb-4 flex">
                <div>
                  Exportadora:<br>
                  <select wire:model.live="filters.exportadora" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-32">
                    <option value="">Todos</option>
                    <option value="greenex">Greenex</option>
                  </select>
                </div>
                <div class="ml-4">
                  Especie:<br>
                  <select wire:model.live="filters.especie" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                    <option value="">Todos</option>
                    @foreach ($unique_especies as $item)
                      <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                   
                  </select>
                </div>
                <div class="ml-4">
                  Variedades:<br>
                  <select wire:model.live="filters.variedad" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                    <option value="">Todos</option>
                    @foreach ($unique_variedades as $item)
                      <option value="{{$item->name}}">{{$item->name}}</option>
                    @endforeach
                   
                  </select>
                </div>
                <div class="ml-4">
                  Materiales:<br>
                  <select wire:model.live="filters.material" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                    <option value="">Todos</option>
                    @foreach ($unique_materiales as $item)
                      @if ($item)
                        <option value="{{$item}}">{{$item}}</option>
                      @endif
                    @endforeach
                   
                  </select>
                </div>
                <div class="ml-4">
                  Calibre:<br>
                  <select wire:model.live="filters.calibre" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                    <option value="">Todos</option>
                    @foreach ($unique_calibres as $calibre)
                      @if ($calibre)
                        <option value="{{$calibre}}">{{$calibre}}</option>
                      @endif

                    @endforeach
                  </select>
                </div>
                <div class="ml-4">
                  Etiqueta: <br>
                  @foreach ($filters['etiquetas'] as $item)
                      {{$item}}
                  @endforeach
                  <br>
                  @foreach ($unique_etiquetas as $etiqueta)
                    @if ($etiqueta)
                      <label>
                        <input type="checkbox" wire:model="filters.etiquetas" value="{{ $etiqueta }}">
                        {{ $etiqueta }}
                      </label><br>
                    @endif
                  @endforeach
                  <br>
                  <select wire:model.live="filters.etiqueta" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                    <option value="">Todos</option>
                    @foreach ($unique_etiquetas as $etiqueta)
                      @if ($etiqueta)
                        <option value="{{$etiqueta}}">{{$etiqueta}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              
              <div class="mb-4 flex">
                @if ($vista=='MASAS' || $vista=='FOB' || $vista=='resumes' || $vista=='resumesnacional')
                  <div class="">
                    Categoria:<br>
                    <div>
                      <input type="checkbox" wire:model.live="filters.exp" id="exp" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                      <label for="exp">Exportación</label>
                    </div>
                   
                    <div>
                      <input type="checkbox" wire:model.live="filters.mi" id="mi" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                      <label for="mi">Mercado Interno</label>
                    </div>
                    <div>
                      <input type="checkbox" wire:model.live="filters.desc" id="desc" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                      <label for="desc">Desecho</label>
                    </div>
                    <div>
                      <input type="checkbox" wire:model.live="filters.mer" id="mer" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                      <label for="mer">Merma</label>
                    </div>
                 
                  


                  
                  </div>
               
                  <div class="ml-4">
                    Norma:<br>
                    <select wire:model.live="filters.norma" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                      <option value="">Todos</option>
                      
                        <option value="dentro"> Dentro de norma</option>
                        <option value="fuera"> Fuera de norma</option>
                      
                    
                    </select>
                  </div>
                  <div class="ml-4">
                    Precio_fob:<br>
                    <select wire:model.live="filters.precioFob" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                      <option value="">Todos</option>
                      
                        <option value="null"> Sin Precio Fob</option>
                      
                    
                    </select>
                  </div>
                  <div class="ml-4">
                    Semana:<br>
                    <select wire:model.live="filters.semana" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                      <option value="">Todos</option>
                      
                      @foreach ($unique_semanas as $semana)
                      @if ($semana)
                        <option value="{{$semana}}">{{$semana}}</option>
                      @endif
                    @endforeach
                      
                    
                    </select>
                  </div>
                @endif

                @if ($vista=='PACKING')
                  <div class="ml-auto p-3 shadow-lg rounded-lg bg-white">
                    <h1 class="text-center font-bold text-xl">{{number_format($totalfriopacking,1)}} usd</h1>
                    <h1 class="text-center font-semibold text-sm">TOTAL COSTOS PACKING</h1>
                  </div>
                @endif
              </div>

              <div class="flex mb-4 hidden">
                <div class="mr-4">
                  Desde:
                  <x-input wire:model.live="filters.fromNumber" type="text" class="w-20" />
                </div>
                <div>
                  Hasta:
                  <x-input wire:model.live="filters.toNumber" type="text" class="w-20" />
                </div>
              </div>
              <div class="flex mb-4 hidden">
                <div class="mr-4">
                  Desde fecha:
                  <x-input wire:model.live="filters.fromDate" type="date" class="w-36" />
                </div>
                <div>
                  Hasta fecha:
                  <x-input wire:model.live="filters.toDate" type="date" class="w-36" />
                </div>
              </div>

             
              <div class="flex mb-4 hidden">
                @if($vista=="resumes")
                  <a href="{{Route('temporadas.show',$temporada)}}" wire:navigate>
                    <button class="inline-flex items-center px-4 mr-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                      EXPORTACIÓN
                    </button>
                  </a>
                @elseif($vista=="resumesnacional")
                  <a href="{{Route('temporadas.show',$temporada)}}" wire:navigate>
                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                      EXPORTACIÓN
                    </button>
                  </a>
                @endif
                @if($vista=="resumesnacional")
                  <a href="{{Route('temporada.nacional',$temporada)}}" wire:navigate>
                    <button class="inline-flex items-center px-4 ml-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                      NACIONAL
                    </button>
                  </a>
                @elseif($vista=="resumes")
                  <a href="{{Route('temporada.nacional',$temporada)}}" wire:navigate>
                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                      NACIONAL
                    </button>
                  </a>
                @endif
          
              </div>
             
              @if ($vista=="resumes")
              
                  <div class="flex flex-col mb-2">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                              <table class="min-w-full divide-y divide-gray-200">
                                  <thead class="bg-yellow-400">
                                    <tr>
                                        <th class="px-6 py-0 text-center text-xs font-bold text-gray-900">
                                        Grupo variedad
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Caja Bulto
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                        Kilos Netos
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Cajas Base
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Fob Liquidacion
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Comision
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Frio Packing
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Gastos de Exportacion
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                        Total Flete a huerto
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Materiales
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                        Retorno Productor
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Retorno por kg
                                        </th>
                                        <th class="relative px-6 py-0">
                                        <span class="sr-only"></span>
                                        </th>
                                    </tr>
                                  </thead>
                                  <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $globalcajasbulto=0;
                                        $globalpesoneto=0;
                                        $globaltotalmateriales=0;
                                        $globalfletehuerto=0;
                                        $globalgastoexportacion=0;
                                        $globalventafob=0;
                                        $globalkgsp=0;
                                        $globalcostopacking=0;
                                    @endphp
                                          @foreach ($unique_variedades as $item)
                                          @php
                                              $cajasbulto=0;
                                              $pesoneto=0;
                                              $totalmateriales=0;
                                              $fletehuerto=0;
                                              $gastoexportacion=0;
                                              $ventafob=0;
                                              $kgsp=0;
                                              $costopacking=0;
                                          @endphp
                                          @foreach ($masastotal as $masa)
                                            @php
                                              if ($masa->n_variedad==$item->name) {
                                                $cajasbulto+=$masa->cantidad;
                                                $pesoneto+=$masa->peso_neto;
                                                $globalcajasbulto+=$masa->cantidad;
                                                $globalpesoneto+=$masa->peso_neto;
                                                
                                                if (!IS_NULL($masa->precio_fob)) {
                                                  $ventafob+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $globalventafob+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                                } else {
                                                  $kgsp+=floatval($masa->peso_neto);
                                                  $globalkgsp+=floatval($masa->peso_neto);
                                                }
                                                
                                                
                                                
                                                if ($masa->tipo_transporte=='AEREO') {
                                                      if ($exportacions->where('type','aereo')->count()>0) {
                                                        $gastoexportacion+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                        $globalgastoexportacion+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                      }
                                                  }
                                                if ($masa->tipo_transporte=='MARITIMO') {
                                                  if ($exportacions->where('type','maritimo')->count()>0) {
                                                      $gastoexportacion+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                      $globalgastoexportacion+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                    }
                                                  }
          
                                                foreach ($materialestotal as $material) {
                                                  if ($material->c_embalaje==$masa->c_embalaje) {
                                                    $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                    $globaltotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                  }  
                                                }
          
                                                foreach ($fletestotal as $flete) {
                                                  if ($flete->rut==$masa->r_productor) {
                                                    $fletehuerto+=$masa->peso_neto*$flete->tarifa;
                                                    $globalfletehuerto+=$masa->peso_neto*$flete->tarifa;
                                                  }  
                                                }
                                              }
                                              
                                            @endphp
                                          @endforeach
                                          {{-- comment
                                            @php
                                                foreach ($CostosPackingsall as $costo) {
                                                  if ($costo->variedad==$item->name) {
                                                    $costopacking+=$costo->total_usd;
                                                    $globalcostopacking+=$costo->total_usd;
                                                  }  
                                                }
                                            @endphp
                                          --}}
                                           @if ($item->red_color=='True')
                                                @php
                                                    $costopacking+=$pesoneto*$temporada->variedadbicolor;
                                                    $globalcostopacking+=$pesoneto*$temporada->variedadbicolor;
                                                @endphp
                                          @else
                                              @php
                                                  $costopacking+=$pesoneto*$temporada->variedadroja;
                                                  $globalcostopacking+=$pesoneto*$temporada->variedadroja;
                                              @endphp
                                          @endif

                                            @if ($pesoneto>0)
                                              <tr>
                                                <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$item->name}}</div>    
                                                </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                      <div class="text-sm text-gray-900">
                                                          {{number_format($cajasbulto)}}
                                                      </div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($pesoneto)}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ number_format($pesoneto/5,0)}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($ventafob,2,'.','.')}} ({{number_format($kgsp)}} Kilos/SP)</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                      <div class="text-sm text-gray-900">{{number_format($ventafob*(0.08) ,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($costopacking ,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($gastoexportacion,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($fletehuerto,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($totalmateriales,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format(($ventafob-($ventafob*(0.08)+$costopacking+$gastoexportacion+$fletehuerto+$totalmateriales)),2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                      @if ($pesoneto==0)
                                                        0      
                                                      @else
                                                       {{number_format(($ventafob-($ventafob*(0.08)+$costopacking+$gastoexportacion+$fletehuerto+$totalmateriales))/$pesoneto,2,'.','.')}}
                                                          
                                                      @endif
                                                    </div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap text-right text-sm font-medium">
                                                      <a href="" class="text-indigo-600 hover:text-indigo-900">Ver detalles</a>
                                                  </td>
                                              </tr>
                                            @endif
                                          @endforeach
          
                                          <tr class="bg-yellow-400">
                                            <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">Total</div>    
                                            </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                  <div class="text-sm text-gray-900">
                                                      {{number_format($globalcajasbulto)}}
                                                  </div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalpesoneto)}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{ number_format($globalpesoneto/5,0)}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalventafob,2,'.','.')}} ({{number_format($globalkgsp)}} Kilos/SP)</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                  <div class="text-sm text-gray-900">{{number_format($globalventafob*(0.08) ,2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalcostopacking ,2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalgastoexportacion,2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalfletehuerto)}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globaltotalmateriales,2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format(($globalventafob-($globalventafob*(0.08)+$globalcostopacking+$globalgastoexportacion+$globalfletehuerto+$globaltotalmateriales)),2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">
                                                  @if ($globalpesoneto==0)
                                                      0
                                                  @else
                                                    {{number_format(($globalventafob-($globalventafob*(0.08)+$globalcostopacking+$globalgastoexportacion+$globalfletehuerto+$globaltotalmateriales))/$globalpesoneto,2,'.','.')}}</div>    
                                                      
                                                  @endif
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap text-right text-sm font-medium bg-yellow-500">
                                                  <a href="" class="text-gray-600 hover:text-gray-900">Ver detalles</a>
                                              </td>
                                          </tr>
                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                  </div>
              
                  <div class="flex ">
                      <a href="{{Route('variedades.refresh',$temporada)}}" class="mr-2">
                        <x-button>
                          Actualizar Variedades
                        </x-button>
                      </a>
                      <a href="{{Route('preciofob.refresh',$temporada)}}"  class="mr-2">
                        <x-button>
                          Actualizar PRECIO FOB
                        </x-button>
                      </a>
                      <a href="{{Route('preciofob.create',$temporada)}}">
                        <x-button>
                          Crear PRECIOS FOB Pendientes
                        </x-button>
                      </a>
                    </div>
              @endif
              @if ($vista=="resumesnacional")
              
                  <div class="flex flex-col mb-2">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                              <table class="min-w-full divide-y divide-gray-200">
                                  <thead class="bg-yellow-400">
                                    <tr>
                                        <th class="px-6 py-0 text-center text-xs font-bold text-gray-900">
                                        Grupo variedad NACIONAL
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Caja Bulto
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                        Kilos Netos
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Cajas Base
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Fob Liquidacion
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Comision
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Frio Packing
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Gastos de Exportacion
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                        Total Flete a huerto
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Total Materiales
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                        Retorno Productor
                                        </th>
                                        <th class="px-6 py-0 text-left text-xs font-bold text-gray-900">
                                          Retorno por kg
                                        </th>
                                        <th class="relative px-6 py-0">
                                        <span class="sr-only"></span>
                                        </th>
                                    </tr>
                                  </thead>
                                  <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $globalcajasbulto=0;
                                        $globalpesoneto=0;
                                        $globaltotalmateriales=0;
                                        $globalfletehuerto=0;
                                        $globalgastoexportacion=0;
                                        $globalventafob=0;
                                        $globalkgsp=0;
                                        $globalcostopacking=0;
                                    @endphp
                                          @foreach ($unique_variedades as $item)
                                          @php
                                            $cajasbulto=0;
                                            $pesoneto=0;
                                            $totalmateriales=0;
                                            $fletehuerto=0;
                                            $gastoexportacion=0;
                                            $ventafob=0;
                                            $kgsp=0;
                                            $costopacking=0;
                                        @endphp
                                        @foreach ($masastotalnacional as $masa)
                                          @php
                                              if ($masa->n_variedad==$item->name) {
                                                $cajasbulto+=$masa->cantidad;
                                                $pesoneto+=$masa->peso_neto;
                                                $globalcajasbulto+=$masa->cantidad;
                                                $globalpesoneto+=$masa->peso_neto;
                                                
                                                if (!IS_NULL($masa->precio_fob)) {
                                                  $ventafob+=intval($masa->peso_neto)*floatval($masa->precio_fob);
                                                  $globalventafob+=intval($masa->peso_neto)*floatval($masa->precio_fob);
                                                } else {
                                                  $kgsp+=intval($masa->peso_neto);
                                                  $globalkgsp+=intval($masa->peso_neto);
                                                }
                                                
                                                
                                                
                                                if ($masa->tipo_transporte=='AEREO') {
                                                      if ($exportacions->where('type','aereo')->count()>0) {
                                                        $gastoexportacion+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                        $globalgastoexportacion+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                                      }
                                                  }
                                                if ($masa->tipo_transporte=='MARITIMO') {
                                                  if ($exportacions->where('type','maritimo')->count()>0) {
                                                      $gastoexportacion+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                      $globalgastoexportacion+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                                    }
                                                  }
          
                                                foreach ($materialestotal as $material) {
                                                  if ($material->c_embalaje==$masa->c_embalaje) {
                                                    $totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                    $globaltotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
                                                  }  
                                                }
          
                                                foreach ($fletestotal as $flete) {
                                                  if ($flete->rut==$masa->r_productor) {
                                                    $fletehuerto+=$masa->peso_neto*$flete->tarifa;
                                                    $globalfletehuerto+=$masa->peso_neto*$flete->tarifa;
                                                  }  
                                                }
                                              }
                                              
                                            @endphp
                                        @endforeach
                                          @php
                                                  
                                            foreach ($CostosPackingsall as $costo) {
                                              if ($costo->variedad==$item->name) {
                                                $costopacking+=$costo->total_usd;
                                                $globalcostopacking+=$costo->total_usd;
                                              }  
                                            }
          
                                          @endphp
                                          
                                            @if ($pesoneto>0)
                                              <tr>
                                                <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$item->name}}</div>    
                                                </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                 
          
                                                      <div class="text-sm text-gray-900">
                                                          {{number_format($cajasbulto)}}
                                                      </div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($pesoneto)}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ number_format($pesoneto/5,0)}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($ventafob,2,'.','.')}} ({{number_format($kgsp)}} Kilos/SP)</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                      <div class="text-sm text-gray-900">{{number_format($ventafob*(0.08) ,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($costopacking ,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($gastoexportacion,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($fletehuerto,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format($totalmateriales,2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{number_format(($ventafob-($ventafob*(0.08)+$costopacking+$gastoexportacion+$fletehuerto+$totalmateriales)),2,'.','.')}}</div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                      @if ($pesoneto==0)
                                                        0      
                                                      @else
                                                       {{number_format(($ventafob-($ventafob*(0.08)+$costopacking+$gastoexportacion+$fletehuerto+$totalmateriales))/$pesoneto,2,'.','.')}}
                                                          
                                                      @endif
                                                    </div>    
                                                  </td>
                                                  <td class="px-6 py-0 whitespace-nowrap text-right text-sm font-medium">
                                                      <a href="" class="text-indigo-600 hover:text-indigo-900">Ver detalles</a>
                                                  </td>
                                              </tr>
                                            @endif
                                          @endforeach
          
                                          <tr class="bg-yellow-400">
                                            <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">Total</div>    
                                            </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                  <div class="text-sm text-gray-900">
                                                      {{number_format($globalcajasbulto)}}
                                                  </div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalpesoneto)}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{ number_format($globalpesoneto/5,0)}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalventafob,2,'.','.')}} ({{number_format($globalkgsp)}} Kilos/SP)</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                  <div class="text-sm text-gray-900">{{number_format($globalventafob*(0.08) ,2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalcostopacking ,2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalgastoexportacion,2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globalfletehuerto)}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format($globaltotalmateriales,2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">{{number_format(($globalventafob-($globalventafob*(0.08)+$globalcostopacking+$globalgastoexportacion+$globalfletehuerto+$globaltotalmateriales)),2,'.','.')}}</div>    
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap bg-yellow-500">
                                                <div class="text-sm text-gray-900">
                                                  @if ($globalpesoneto==0)
                                                      0
                                                  @else
                                                    {{number_format(($globalventafob-($globalventafob*(0.08)+$globalcostopacking+$globalgastoexportacion+$globalfletehuerto+$globaltotalmateriales))/$globalpesoneto,2,'.','.')}}</div>    
                                                      
                                                  @endif
                                              </td>
                                              <td class="px-6 py-0 whitespace-nowrap text-right text-sm font-medium bg-yellow-500">
                                                  <a href="" class="text-gray-600 hover:text-gray-900">Ver detalles</a>
                                              </td>
                                          </tr>
                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                  </div>
              
                  <div class="flex ">
                      <a href="{{Route('variedades.refresh',$temporada)}}" class="mr-2">
                        <x-button>
                          Actualizar Variedades
                        </x-button>
                      </a>
                      <a href="{{Route('preciofob.refresh',$temporada)}}">
                        <x-button>
                          Actualizar PRECIO FOB
                        </x-button>
                      </a>
                      <a href="{{Route('preciofob.create',$temporada)}}">
                        <x-button>
                          Crear PRECIOS FOB Pendientes
                        </x-button>
                      </a>
                    </div>
              @endif
              

            </div>

            

          <div class="hidden">
            <div class="flex justify-center">
                <div class="inline-flex items-center rounded-md shadow-sm gap-x-2">
                    <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>                      
                        </span>
                        <span>EXPORTADORA</span>
                    </button>
                    <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>PRODUCTOR</span>
                    </button>
                    <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>CSG</span>
                    </button>
                    <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>ESPECIE</span>
                    </button>
                    <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        </span>
                        <span>VARIEDAD</span>
                    </button>
                  
                </div>
            </div>
            <div class="flex justify-center">
              <div class="inline-flex items-center rounded-md shadow-sm gap-x-2">
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>                      
                      </span>
                      <span>ETIQUETA</span>
                  </button>
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>EMBALAJE</span>
                  </button>
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>CALIBRE</span>
                  </button>
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>CATEGORIA</span>
                  </button>
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>CONTENEDOR</span>
                  </button>
                
              </div>
            </div>
            <div class="flex justify-center">
              <div class="inline-flex items-center rounded-md shadow-sm gap-x-2">
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>                      
                      </span>
                      <span>PESO NETO</span>
                  </button>
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>MERCADO</span>
                  </button>
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>TIPO NAVE</span>
                  </button>
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>SEMANA</span>
                  </button>
                  <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                      <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                      </span>
                      <span>PAIS</span>
                  </button>
                
              </div>
            </div>
          </div>

            <div class="flex justify-between ml-4">
              @if ($vista=='MASAS' || $vista=='FOB')
                <div class="grid grid-cols-1">
                  <a href="{{Route('preciofob.refresh',$temporada)}}" class="mb-2">
                    <x-button>
                      Actualizar PRECIO FOB
                    </x-button>
                  </a>
                  <a href="{{Route('preciofob.create',$temporada)}}" class="mb-2"> 
                    <x-button>
                      Crear PRECIOS FOB Pendientes
                    </x-button>
                  </a>
                  <a href="{{Route('fob.export',$temporada)}}" class="mb-2">
                    <x-button>
                     Exportar Fob Prendientes
                    </x-button>
                  </a>
                </div>
              @endif
              
              <select wire:model.live="ctd" class="max-w-xl  mx-2 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-6 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                  <option value="25" class="text-left px-10">25 </option>
                  <option value="50" class="text-left px-10">50 </option>
                  <option value="100" class="text-left px-10">100 </option>
                  <option value="500" class="text-left px-10">500 </option>
                  
              </select>
            </div>
            
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
              <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">

                @if ($vista=='resumes' || $vista=='resumesnacional')
                  <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
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
                                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Accion
                                      </th>
                                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Informe
                                      </th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                        $n=1;
                                    @endphp
                                   
                                      @foreach ($razons as $razon)
                                       
                                          <tr class="bg-gray-100 border-b">
                                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$n}}) {{$razon->id}}</td>
                                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                @if ($razon && $temporada)
                                                    
                                                <a href="{{route('razonsocial.show',['razonsocial'=>$razon,'temporada'=>$temporada])}}" target="_blank"> {{$razon->name}}
                                                </a>
                                                
                                                @endif
                                              </td>
                                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                              {{$razon->rut}}
                                              </td>
                                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                              {{$razon->csg}}
                                              </td>
                                             
                                              <td class="text-sm text-gray-900 font-light px-2 py-4 whitespace-nowrap">
                                                <a href="{{route('exportpdff',['razonsocial'=>$razon,'temporada'=>$temporada])}}" target="_blank">
                                                  <x-button>
                                                    Generar
                                                  </x-button>
                                                </a>
                                              </td> 
                                              <td class="text-sm text-gray-900 font-light py-4 text-center">

                                                @if ($razon->informe)
                                                    <a href="{{route('informe.download',$razon)}}" target="_blank" class="h-10 mr-2 items-center content-center">   
                                                      <img class="h-10 ml-4 pl-2 object-contain" src="{{asset('image/pdf_icon2.png')}}" title="Descargar" alt="">
                                                    </a>
                                                
                                                    
                                                @else
                                                    
                                                @endif

                                              </td>
                                          </tr>
                                        @php
                                            $n+=1;
                                        @endphp
                                      @endforeach
                                  
                                    
                                  </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>
                @endif

                @if ($vista=='PACKING')
                  @php
                      $kgredcolor=0;
                      $kgbicolor=0;
                  @endphp
                @foreach ($unique_variedades as $variedad)
               
                  @foreach ($masastotalnacional as $masa2)
                      @if ($masa2->n_variedad==$variedad->name)
                          @if ($variedad->red_color=='True')
                                @php
                                    $kgbicolor+=$masa2->peso_neto;
                                @endphp
                          @else
                              @php
                                  $kgredcolor+=$masa2->peso_neto;
                              @endphp
                          @endif
                      @endif
                  @endforeach
                @endforeach

                @php
                    $kgsexportacion=0;
                @endphp
                
                @foreach ($masastotal as $masa)
                  
                              @php
                                  if ($masa->n_categoria=="Cat 1" || $masa->n_categoria=="Cat I") {
                                  
                                    $kgsexportacion+=$masa->peso_neto;
                                  }

                              @endphp
                       
                @endforeach
                  
                <div class="grid grid-cols-3 gap-x-4 items-center mb-6">
                  <div>
                    <h1 class="ml-4">Agregar Variedades Bicolor:</h1>
                  </div>

                  <select wire:model="variedadpacking" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                      <option value="" class="text-center">Selecciona una variedad</option>
                      @foreach ($unique_variedades as $item)
                        <option value="{{$item->id}}" class="text-center">{{$item->name}}</option>
                      @endforeach
                  
                      

                  </select>

                  
                  <button wire:click="redcolor_add" class="focus:ring-2 focus:ring-offset-2 focus:ring-green-300 text-sm leading-none text-green-600 py-3 px-5 bg-green-600 rounded hover:bg-green-500 focus:outline-none">

                      <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                      Agregar
                          
                      </h1>
                  </button>
                </div>

                  <table class="min-w-full leading-normal">
                    <thead>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Mercado</th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Variedad</th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kilos</th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tarifa</th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cantidad</th>
                   
                    </thead>
                    <tbody>
                      <tr>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          Variedades Rojas
                        </td>
                      
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                           
                          @foreach ($unique_variedades as $item)
                            @if ($item->red_color==Null)
                              {{$item->name}}<br>
                            @endif
                           
                        @endforeach
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                        {{number_format($kgredcolor)}} kgs
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm ">
                          <div class="flex items-center my-auto">
                            {!! Form::model($temporada, ['route'=>['temporadas.update',$temporada],'method' => 'put', 'autocomplete'=>'off']) !!}    
                              {!! Form::label('variedadroja', 'Variedad Roja', ['class' => 'hidden']) !!}
                              {!! Form::number('variedadroja', null, ['step' => '0.001', 'class' => 'form-input text-right mr-2 mt-1 rounded-lg' . ($errors->has('variedadroja') ? ' border-red-600' : '')]) !!}
                              {!! Form::submit('Actualizar', ['class' => 'font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer']) !!}
                            {!! Form::close() !!}
                          </div>
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          @if ($temporada->variedadroja)
                            {{number_format($kgredcolor*floatval($temporada->variedadroja),2)}} usd
                          @endif
                        
                        </td>
                      </tr>
                      <tr>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                        Variedades BICOLOR
                        </td>
                       
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm flex">
                          <div class="grid grid-cols-1">
                            @foreach ($unique_variedades as $item)
                                @if ($item->red_color=='True')
                                <div class="flex">
                                  <p>{{$item->name}}</p> <p wire:click='redcolor_destroy({{$item->id}})' class="text-red-500 hover:text-red-700 ml-2 cursor-pointer">(Quitar)</p>
                                </div>
                                @endif
                            @endforeach
                          </div>
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          {{number_format($kgbicolor)}} kgs
                         </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          <div class="flex items-center my-auto">
                            {!! Form::model($temporada, ['route'=>['temporadas.update',$temporada],'method' => 'put', 'autocomplete'=>'off']) !!}    
                              {!! Form::label('variedadbicolor', 'Variedad Roja', ['class' => 'hidden']) !!}
                              {!! Form::number('variedadbicolor', null, ['step' => '0.001', 'class' => 'form-input text-right mr-2 mt-1 rounded-lg' . ($errors->has('variedadroja') ? ' border-red-600' : '')]) !!}
                              {!! Form::submit('Actualizar', ['class' => 'font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer']) !!}
                            {!! Form::close() !!}
                          </div>
                        </td>

                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          @if ($temporada->variedadbicolor)
                            {{number_format($kgbicolor*floatval($temporada->variedadbicolor),2)}} usd
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm font-bold">
                       Total
                        </td>
                       
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm flex">
                        
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          {{number_format($kgbicolor+$kgredcolor)}} kgs
                         </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                         
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          {{number_format($kgbicolor*1.352+$kgredcolor*1.092,2)}}  usd
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  @php
                      $montoservicio=$kgbicolor*1.352+$kgredcolor*1.092;
                  @endphp
                  

                  <table class="min-w-full leading-normal">
                    <thead>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tarifa</th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Facturado</th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Monto del Servicio</th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kks Exportacion</th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tarifa</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                         Tarifa Frio Packing Exportacion
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                        {{number_format($totalfriopacking)}}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          {{number_format($montoservicio)}}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          {{number_format($kgsexportacion)}}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          {{number_format(($totalfriopacking-$montoservicio)/$kgsexportacion,3)}}
                        </td>
                      </tr>
                    
                    </tbody>
                  </table>
         
                  <div>
                    <h1 class="text-xl font-semibold mb-4 text-center">
                        Por favor selecione el archivo de "Costos de packing" que desea importar
                    </h1>
                    <div class="flex justify-center ">
                        
                        <form action="{{route('temporada.importCostosPacking')}}"
                            method="POST"
                            class="bg-white rounded p-8 shadow"
                            enctype="multipart/form-data">
                            
                            @csrf

                            <input type="hidden" name="temporada" value={{$temporada->id}}>

                            <x-validation-errors class="errors">

                            </x-validation-errors>

                            <input type="file" name="file" accept=".csv,.xlsx">

                            <x-button class="ml-4">
                                Importar
                            </x-button>
                        </form>
                    </div>
                  </div>
                    <table class="min-w-full leading-normal">
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
                        
                          @foreach ($CostosPackings as $packing)
                            <tr>
                              
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$packing->especie}}</p>
                              </td>
                              
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$packing->variedad}}</p>
                              </td>

                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                  <div class="flex-shrink-0 w-10 h-10 hidden">
                                    <img class="w-full h-full rounded-full"
                                                              src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                              alt="" />
                                                      </div>
                                    <div class="ml-3">
                                      <p class="text-gray-900 whitespace-no-wrap">
                                        @foreach ($razonsall as $razon)
                                            @if ($razon->csg==$packing->csg)
                                              <a href="{{route('razonsocial.show',['razonsocial'=>$razon,'temporada'=>$temporada])}}" target="_blank"> 
                                                {{$packing->n_productor}}
                                              </a>
                                            @endif
                                        @endforeach
                                        
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
                @endif

                @if ($vista=='MATERIALES') 

                  <div>
                    <h1 class="text-xl font-semibold mb-4 ml-4">
                        Por favor selecione el archivo de "Materiales" que desea importar
                        @if ($materialestotal)
                          {{$materialestotal->count()}}
                        @endif 
                    </h1>
                  
                    @if ($materialestotal->count()>0)
                        
                      <h1 class="text-xl font-semibold mb-4 ml-4">
                        Fecha de importación: {{$materialestotal->first()->created_at}}
                      </h1>
                      
                    @endif

                    <div class="flex">
                        
                        <form action="{{route('temporada.importMateriales')}}"
                            method="POST"
                            class="bg-white rounded p-8 shadow"
                            enctype="multipart/form-data">
                            
                            @csrf

                            <input type="hidden" name="temporada" value={{$temporada->id}}>

                            <x-validation-errors class="errors">

                            </x-validation-errors>

                            <input type="file" name="file" accept=".csv,.xlsx">

                            <x-button class="ml-4">
                                Importar
                            </x-button>
                        </form>
                        </div>
                    </div>
                    <table class="min-w-full leading-normal">
                      <thead>
                        <tr>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            CODIGO DE EMBALAJE
                          </th>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            TARIFA (DolaresxCaja)
                          </th>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            DESCRIPCION
                          </th>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ACCIÓN
                          </th>
                        
                      </tr>
                      </thead>
                      <tbody>
                    
                          @foreach ($materiales as $material)
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
                                        {{$material->c_embalaje}}
                                      </p>
                                    </div>
                                  </div>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$material->costo_por_caja_usd}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                  {{$material->descripcion}}
                                </p>
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
                @endif

                @if ($vista=='EXPORTACION') 
                  <div class="grid grid-cols-3 gap-x-4 items-center mb-6">

                    <select wire:model="type" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" class="text-center">Selecciona una categoría</option>
                        <option value="maritimo" class="text-center">Maritimo</option>
                        <option value="aereo" class="text-center">Aereo</option>
                        <option value="terrestre" class="text-center">Terrestre</option>

                        

                    </select>

                    <input wire:model="precio_usd" type="number" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                    
                    <button wire:click="exportacion_store" class="focus:ring-2 focus:ring-offset-2 focus:ring-green-300 text-sm leading-none text-green-600 py-3 px-5 bg-green-600 rounded hover:bg-green-500 focus:outline-none">

                        <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                        Agregar
                            
                        </h1>
                    </button>
                  </div>

                  <table class="min-w-full leading-normal">
                    <thead>
                      <tr>
                        <th
                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Tipo
                        </th>
                        <th
                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Precio USD
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Acción
                          </th>
                      
                      
                    
                    </tr>
                    </thead>
                    <tbody>
                      
                      @if ($exportacions)
                          
                        @foreach ($exportacions as $exportacion)
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
                                      {{$exportacion->type}}
                                    </p>
                                  </div>
                                </div>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <p class="text-gray-900 whitespace-no-wrap"> 
                            
                                {{$exportacion->precio_usd}}</p>
                            </td>
                        
                        

                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <a href="{{route('exportacion.edit',['exportacion'=>$exportacion,'temporada'=>$temporada])}}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Editar</span>
                                </span>
                              </a>
                              <span wire:click="exportacion_destroy({{$exportacion->id}})" class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                  <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                  <span class="relative">Eliminar</span>
                              </span>
                            </td>
                          </tr>
                        @endforeach
                      @endif

                    </tbody>
                  </table>
                    
                
                  

                @endif

                @if ($vista=='COMISION') 
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
                                <div class="flex-shrink-0 w-10 h-10 hidden">
                                  <img class="w-full h-full rounded-full"
                                                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                            alt="" />
                                                    </div>
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
                              <a href="{{route('comision.edit',['comision'=>$comision,'temporada'=>$temporada])}}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Editar</span>
                                </span>
                              </a>
                            </td>
                          </tr>
                        @endforeach
              
                    </tbody>
                  </table>
                @endif

                @if ($vista=='FLETES')
             
                  <h1 class="text-xl font-semibold mb-4 ml-4">
                        Por favor selecione el archivo de "Flete a huerto" que desea importar
                  </h1>
                  
                


                  <form action="{{route('temporada.importFlete')}}"
                      method="POST"
                      class="bg-white rounded p-8 shadow"
                      enctype="multipart/form-data">
                      
                      @csrf

                      <input type="hidden" name="temporada" value={{$temporada->id}}>

                      <x-validation-errors class="errors">

                      </x-validation-errors>

                      <input type="file" name="file" accept=".csv,.xlsx">

                      <x-button class="ml-4">
                          Importar
                      </x-button>
                  </form>

                  <table class="min-w-full leading-normal">
                    <thead>
                      <tr>
                        <th
                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Grupo
                        </th>
                        <th
                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Rut
                        </th>
                        <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Productor
                      </th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        TARIFA
                        </th>
                    
                      
                    
                    </tr>
                    </thead>
                    <tbody>
                  
                        @foreach ($fletes as $flete)
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
                                      {{$flete->grupo}}
                                    </p>
                                  </div>
                                </div>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->rut}}</p>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->productor}}</p>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->tarifa}}</p>
                            </td>
                        
                        

                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <a href="{{route('flete.edit',['flete'=>$flete,'temporada'=>$temporada])}}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                      <span aria-hidden
                                                          class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                <span class="relative">Editar</span>
                              </a>
                              <span wire:click="flete_destroy({{$flete->id}})" class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                <span class="relative">Eliminar</span>
                            </span>
                              </span>
                            </td>
                          </tr>
                        @endforeach
              
                    </tbody>
                  </table>

                @endif
                
                @if ($vista=='MASAS')

                  
                
                  <div class="flex justify-start">
                    <div class="">
                      <h1 class="text-xl font-semibold mb-4 ml-4">
                        Por favor selecione el archivo de "Balance de masas" que desea importar. 
                        @if ($masastotal && $masastotalnacional)
                          {{($masastotal->count()+$masastotalnacional->count())}}
                        @elseif($masastotal)
                          {{($masastotal->count())}}
                        @elseif($masastotalnacional)
                          {{($masastotalnacional->count())}}
                        @endif
                       


                      </h1>
                      <h1 class="text-xl font-semibold mb-4 ml-4">
                        @if ($masastotal->count())
                            Fecha de importación: {{$masastotal->first()->created_at}}
                        @endif
                      </h1>
                      
                          <form action="{{route('temporada.importBalance')}}"
                              method="POST"
                              class="bg-white rounded p-8 shadow"
                              enctype="multipart/form-data">
                              
                              @csrf

                              <input type="hidden" name="temporada" value={{$temporada->id}}>

                              <x-validation-errors class="errors">

                              </x-validation-errors>

                              <input type="file" name="file" accept=".csv,.xlsx">

                              <x-button class="ml-4">
                                  Importar
                              </x-button>
                          </form>

                    </div>
                  </div>
                    <table class="min-w-full leading-normal">
                      <thead>
                        <tr>
                          @php
                                
                                $columnas = [
                                  'id',
                                  'tipo_g_produccion',
                                  'numero_g_produccion',
                                  'fecha_g_produccion_sh',
                                  'semana',
                                  'folio',
                                  'r_productor',
                                  'c_productor',
                                  'n_productor',
                                  'n_especie',
                                  'n_variedad',
                                  'c_embalaje',
                                  'n_embalaje',
                                  'n_categoria',
                                  't_categoria',
                                  'n_categoria_st',
                                  'n_calibre',
                                  'n_etiqueta',
                                  'cantidad',
                                  'peso_neto',
                                  'transporte',
                                  'precio_fob'
                              ];

                            
                            foreach ($columnas as $columna) {
                                echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">';
                                echo ucfirst(str_replace('_', ' ', $columna));
                                echo '</th>';
                            }
                            
                          @endphp
                        </tr>
                      </thead>
                      <tbody>
                    
                          @foreach ($masasbalances as $masa)
                            <tr>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $masa->id }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $masa->tipo_g_produccion }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->numero_g_produccion }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{date('d/m/Y', strtotime($masa->fecha_g_produccion_sh))}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{$masa->semana}}</p>
                            </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->folio }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm" style="white-space: nowrap;">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->r_productor }}</p>
                              </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm" style="white-space: nowrap;">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->c_productor }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm" style="white-space: nowrap;">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->n_productor }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->n_especie }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->n_variedad }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->c_embalaje }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm" style="white-space: nowrap;">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->n_embalaje }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm" style="white-space: nowrap;">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->n_categoria }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->t_categoria }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->n_categoria_st }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->n_calibre }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm" style="white-space: nowrap;">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->n_etiqueta }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->cantidad }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->peso_neto }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $masa->tipo_transporte }}</p>
                              </td>
                              <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-32">
                                @if ($masaid==$masa->id)
                                    <input wire:model="preciomasa" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->precio_fob }}</p>
                                @endif
                                

                              </td>
                          
                          

                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                @if ($masaid==$masa->id)
                                  <span wire:click='save_masaid()' class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Guardar</span>
                                  </span>
                                @else
                                  <span wire:click='set_masaid({{$masa->id}})' class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Editar</span>
                                  </span>
                                @endif
                              

                              </td>
                            </tr>
                          @endforeach
                
                      </tbody>
                    </table>
                    {{$masasbalances->links()}}

                @endif

                @if ($vista=='ANTICIPOS')
                     <div>
                        <h1 class="text-xl font-semibold mb-4">
                            Por favor selecione el archivo de "Anticipos" que desea importar
                        </h1>
                        <div class="">
                            <form action="{{route('temporada.importAnticipo')}}"
                                method="POST"
                                class="bg-white rounded p-8 shadow"
                                enctype="multipart/form-data">
                                
                                @csrf

                                <input type="hidden" name="temporada" value={{$temporada->id}}>

                                <x-validation-errors class="errors">

                                </x-validation-errors>

                                <input type="file" name="file" accept=".csv,.xlsx">

                                <x-button class="ml-4">
                                    Importar
                                </x-button>
                            </form>

                        </div>
                    </div>
                  <table class="min-w-full leading-normal">
                      <thead>
                        <tr>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Grupo
                          </th>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Rut
                          </th>
                          <th
                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Productor
                        </th>
                        <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Fecha
                      </th>
                      <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Cantidad
                    </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Acción
                          </th>
                      
                        
                      
                      </tr>
                      </thead>
                      <tbody>
                    
                          @foreach ($anticipos as $flete)
                            <tr>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                
                                    <div class="ml-3">
                                      <p class="text-gray-900 whitespace-no-wrap">
                                        {{$flete->grupo}}
                                      </p>
                                    </div>
                                  </div>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$flete->rut}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$flete->n_productor}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{date('d/m/Y', strtotime($flete->fecha))}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{number_format($flete->cantidad,2,',','.')}}</p>
                              </td>
                          
                          

                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <a href="{{route('flete.edit',['flete'=>$flete,'temporada'=>$temporada])}}">
                                  <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                  <span class="relative">Editar</span>
                                </a>
                                <span wire:click="flete_destroy({{$flete->id}})" class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                  <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                  <span class="relative">Eliminar</span>
                              </span>
                                </span>
                              </td>
                            </tr>
                          @endforeach
                
                      </tbody>
                  </table>
                @endif

                @if ($vista=='FOB')

                  <div class="flex justify-center">
                      <div>
                        <h1 class="text-xl font-semibold mb-4">
                            Por favor selecione el archivo de "FOB" que desea importar
                        </h1>
                        <div class="">
                            <form action="{{route('temporada.importFob')}}"
                                method="POST"
                                class="bg-white rounded p-8 shadow"
                                enctype="multipart/form-data">
                                
                                @csrf

                                <input type="hidden" name="temporada" value={{$temporada->id}}>

                                <x-validation-errors class="errors">

                                </x-validation-errors>

                                <input type="file" name="file" accept=".csv,.xlsx">

                                <x-button class="ml-4">
                                    Importar
                                </x-button>
                            </form>

                        </div>
                      </div>
                  </div>

                  <table class="min-w-full leading-normal">
                      <thead>
                        <tr>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            n_variedad
                          </th>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Semana
                          </th>
                          <th
                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Etiqueta
                        </th>
                        <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Calibre
                      </th>
                      <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Color
                    </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Categoria
                          </th>
                          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            FOB
                            </th>
                      
                        
                      
                      </tr>
                      </thead>
                      <tbody>
                    
                          @foreach ($fobs as $fob)
                            <tr>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                
                                    <div class="ml-3">
                                      <p class="text-gray-900 whitespace-no-wrap">
                                        {{$fob->n_variedad}}
                                      </p>
                                    </div>
                                  </div>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->semana}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->etiqueta}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->n_calibre}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->color}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->categoria}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                @if ($fobid==$fob->id)
                                    <input wire:model="preciofob" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                  <p class="text-gray-900 whitespace-no-wrap"> {{$fob->fob_kilo_salida}}</p>
                                @endif

                             
                              </td>
                          
                          

                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                @if ($fobid==$fob->id)
                                  <span wire:click='save_fobid()' class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Guardar</span>
                                  </span>
                                @else
                                  <span wire:click='set_fobid({{$fob->id}})' class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Editar</span>
                                  </span>
                                @endif

                                <span  class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                  <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                  <span class="relative">Eliminar</span>
                              </span>
                                </span>
                              </td>
                            </tr>
                          @endforeach
                
                      </tbody>
                  </table>
                @endif

                @if ($vista=='GASTOS') 
                  
                    <div> 
                      <div class="grid grid-cols-6 gap-x-4 items-center mb-6">

                          <select wire:model="familia" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                              <option value="1" class="text-center">Selecciona una familia</option>
                              
                              @foreach ($familias as $familia)
                                  <option value="{{$familia->id}}" class="text-center">{{$familia->name}}</option>
                              @endforeach
                              

                          </select>

                          
                          <select wire:model="categoria" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                              <option value="" class="text-center">Selecciona una categoria</option>
                              
                            
                                  <option value="nacional" class="text-center">Nacional</option>
                                  <option value="exportacion" class="text-center">Exportación</option>
                                  <option value="todas" class="text-center">Todas</option>
                            
                          </select>

                          <input wire:model="item" type="text" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                        

                          <select wire:model="descuenta" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                              <option value="" class="text-center">¿Donde Descuenta?</option>
                                  <option value="fob" class="text-center">Fob</option>
                                  <option value="ctacorriente" class="text-center">Cuenta Corriente</option>
                          </select>

                          <select wire:model="unidad" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" class="text-center">¿Unidad?</option>
                                <option value="caja" class="text-center">Caja</option>
                                <option value="kg" class="text-center">KG</option>
                          </select>

                          <button wire:click="gasto_store" class="focus:ring-2 focus:ring-offset-2 focus:ring-green-300 text-sm leading-none text-green-600 py-3 px-5 bg-green-600 rounded hover:bg-green-500 focus:outline-none">

                              <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                              Agregar
                                  
                              </h1>
                          </button>
                      </div>
                      @if ($temporada->gastos->count()>0)
                          <table class="min-w-full leading-normal">
                          <thead>
                            <tr>
                              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                  Familia
                                  </th>
                              <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                item
                              </th>
                            
                                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                      Categoria
                                      </th>
                              <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Descuenta
                              </th>
                              <th
                              class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Unidad
                            </th>
                            
                            
                            
                          
                          </tr>
                          </thead>
                          <tbody>
                        
                              @foreach ($temporada->gastos as $gasto)
                                <tr>
                                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                      <p class="text-gray-900 whitespace-no-wrap"> {{$gasto->familia->name}}</p>
                                    </td>
                                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                      <div class="flex-shrink-0 w-10 h-10 hidden">
                                        <img class="w-full h-full rounded-full"
                                                                  src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                                  alt="" />
                                                          </div>
                                        <div class="ml-3">
                                          <p class="text-gray-900 whitespace-no-wrap">
                                            {{$gasto->item}}
                                          </p>
                                        </div>
                                      </div>
                                  </td>
                                
                                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                      <p class="text-gray-900 whitespace-no-wrap"> {{$gasto->categoria}}</p>
                                    </td>
                                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                      <p class="text-gray-900 whitespace-no-wrap"> {{$gasto->descuenta}}</p>
                                    </td>
                                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                      <p class="text-gray-900 whitespace-no-wrap"> {{$gasto->unidad}}</p>
                                    </td>
                              
                              
      
                                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                      <a href="{{Route('gasto.edit',['gasto'=>$gasto,'temporada'=>$temporada])}}">
                                        <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                            <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Editar</span>
                                        </span>
                                      </a>
                                  </td>
                                </tr>
                              @endforeach
                    
                          </tbody>
                        </table>
                      @endif


                     

                  </div>
                

                @endif

                @if ($vista=='OTROSGASTOS') 
                    <h1 class="text-xl text-center font-semibold mb-4 ">
                      Por favor selecione el archivo de "Gastos" que desea importar
                  </h1>
                  <div class="flex justify-center">
                      
                      <form action="{{route('temporada.importGasto')}}"
                          method="POST"
                          class="bg-white rounded p-8 shadow"
                          enctype="multipart/form-data">
                          
                          @csrf

                          <input type="hidden" name="temporada" value={{$temporada->id}}>

                          <x-validation-errors class="errors">

                          </x-validation-errors>

                          <input type="file" name="file" accept=".csv,.xlsx">

                          <x-button class="ml-4">
                              Importar
                          </x-button>
                      </form>
                  </div>

                  @if ($detalles->count()>0)
                    <table class="min-w-full leading-normal">
                        <thead>
                          <tr>
                            <th
                              class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Grupo
                            </th>
                            <th
                              class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Rut
                            </th>
                            <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Productor
                          </th>
                          <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Item
                          </th>
                          <th
                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Fecha
                        </th>
                        <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Cantidad
                      </th>
                          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Acción
                            </th>
                        
                          
                        
                        </tr>
                        </thead>
                        <tbody>
                      
                            @foreach ($detalles as $detalle)
                              <tr>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <div class="flex items-center">
                                  
                                      <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                          {{$detalle->grupo}}
                                        </p>
                                      </div>
                                    </div>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap"> {{$detalle->rut}}</p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap"> {{$detalle->n_productor}}</p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap"> {{$detalle->item}}</p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap"> {{date('d/m/Y', strtotime($detalle->fecha))}}</p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  @if ($gastoid==$detalle->id)
                                      <input wire:model="gastocant" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                  @else
                                    <p class="text-gray-900 whitespace-no-wrap"> {{number_format(floatval($detalle->cantidad),2,',','.')}}</p>
                                  @endif
                                
                                  
                                </td>
                            
                            

                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm flex">
                                  @if ($gastoid==$detalle->id)
                                    <span wire:click='save_gastoid()' class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                      <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                      <span class="relative">Guardar</span>
                                    </span>
                                  @else
                                    <span wire:click='set_gastoid({{$detalle->id}})' class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight mr-2">
                                      <span aria-hidden     class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                      <span class="relative">Editar</span>
                                    </span>
                                    
                                    <span wire:click="" class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                      <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                      <span class="relative">Eliminar</span>
                                    </span>
                                  @endif
                                
                                 
                                </td>
                              </tr>
                            @endforeach
                  
                        </tbody>
                    </table>
                  @endif
                @endif

                @if ($vista=='Recepcion') 
                    
                    @livewire('production-search',['temporada_id'=>$temporada->id])

                @endif

                @if ($vista=='Procesos') 
                        
                    @livewire('proceso-search',['temporada_id'=>$temporada->id])

                @endif
              
              </div>
            </div>


          </main>
        </div>
    </div>
  </section>
   
</div>