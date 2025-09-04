<div class="card-body">
  
    <h1 class="text-2xl font-bold">Temporada {{$temporada->name}}</h1>
    <hr class="mt-2 mb-6">




  <section id="informacion">
    <div class="flex w-full bg-gray-300 mt-2"  @if ($vista=="resumes") x-data="{openMenu: 1}" @else x-data="{openMenu: 1}" @endif >

        @if ($vista!='FACTOR')
          @livewire('menu-aside',['temporada'=>$temporada->id])
        @endif
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
                
                <div wire:loading wire:target="archivo, importar, variedadpacking, updatevariedades, filters, checkEtiqueta, filtrar_fechanull, filtrar_multiplicacion, syncfecha, syncfactor, foliosexept, checkfolio, checkfolioreset, checkfobcategoria, checkfobvariedad, checkfobetiqueta, checkfobmaterial, checkfobcalibre, set_fobid, save_fobid, exportacion_store, exportacion_destroy">
                  <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                    <div class="max-h-full w-full max-w-sm overflow-y-auto mx-auto sm:rounded-2xl bg-white border-2 border-gray-200 shadow-xl">
                      <div class="w-full">
                        <div class="px-6 my-6 mx-auto">
                          <div class="mb-8">
                            <div class="flex justify-between items-center">
                              <h1 class="text-2xl font-extrabold mr-4">Cargando...</h1>
                              <div><img class="h-10" src="{{asset('image/cargando.gif')}}" alt=""></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                
                
                      
                  <h2 class="text-2xl font-semibold my-4"> 


                      @if ($vista=='MASAS')
                          Filtros      Balance de Masa
                      @elseif ($vista=='resumes')
                          Filtros   Resumen
                      @elseif ($vista=='show')
                          Filtros   del Listado de Productores
                      @elseif ($vista=='Recepcion' || $vista=='Procesos' || $vista=='Despachos' || $vista=='Embarques')
                    
                      @else
                          Filtros   {{$vista}} 
                      @endif

                    
                
                    

                    @if ($vista=='FOB' && $fobs)
                      ({{$fobsall->count()}} Resultados)
                    @endif
                    @php
                        $kgstotmas=0;
                        $sinfechaetd=0;
                        $sinfechaeta=0;
                        $sinsemana=0;
                        $sinfactor=0;
                    @endphp
                    @if ($vista=='MASAS' || $vista=='FOB')
                    
                  
                          
                      @foreach ($masastotal as $masa)
                        @php  
                          
                            
                            if ($masa->etd) {
                            
                            }else{
                              $sinfechaetd+=1;
                            }
                            if ($masa->eta) {
                            
                            }else{
                              $sinfechaeta+=1;
                            }

                            if ($masa->semana) {
                              # code...
                            } else {
                              $sinsemana+=1;
                            }

                            $kgstotmas+=$masa->peso_neto;

                            if ($masa->factor) {
                              # code...
                            }else{
                              $sinfactor+=1;
                            }
                        @endphp
                      @endforeach
                      @foreach ($masastotalnacional as $masa)
                        @php
                            //$kgstotmas+=$masa->peso_neto;
                        @endphp
                      @endforeach
                    
                      ({{(number_format($masastotal->count()))}} Resultados) ({{number_format($kgstotmas)}} KGS)
                    @endif

                  </h2>

                  <div class="flex w-full px-2">
                    
                
                    <div class="my-2 flex justify-between w-full">
                    
                      @if ($vista=="Recepcion")

                        <div class="w-6/12">
                          <h2 class="text-2xl font-semibold my-4"> 
                            Sincronización Recepciones
                          </h2>
                          @php
                            $cant=0;
                            $cant2=0;
                              foreach($recepcionall as $recepcion){
                                  $cant+=$recepcion->peso_neto;
                              }
                              foreach($recepcionall as $recepcion){
                                  $cant2+=$recepcion->peso_neto;
                              }
                      
                          @endphp
                           <div class="flex">
                            <div class="w-full bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                               <div class="flex items-center justify-center">
                                  <div class="flex-shrink-0 text-center">
                                     <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$temporada->especie->name}}</span>
                                     <h3 class="text-base font-normal text-gray-500">Especie</h3>
                                  </div>
                                 
                               </div>
                            </div>
                          </div>
                          <div class="flex">
                            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                               <div class="flex items-center justify-center">
                                  <div class="flex-shrink-0 text-center">
                                     <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($recepcionall->pluck('numero_g_recepcion')->unique()->sort()->count())}}</span>
                                     <h3 class="text-base font-normal text-gray-500">Recepciones</h3>
                                  </div>
                                 
                               </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                 <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($recepcionall->count())}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Folios</h3>
                                 </div>
                                
                              </div>
                           </div>
                            <div class=" bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 ml-2">
                                @if ($filters['razonsocial'])
                                    <div class="flex items-center justify-center content-center">
                                                <span class="text-xl sm:text-xl leading-none font-bold text-gray-900 content-center">{{number_format($cant2)}}/</span>
                                                <h3 class="text-base font-normal items-center content-center text-gray-500">{{$filters['razonsocial']}}</h3>
                                           
                                    
                                    </div>
                                @endif
            
                                <div class="flex items-center justify-center">
                                    <div class="flex-shrink-0 text-center">
                                       <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($cant)}}</span>
                                       <h3 class="text-base font-normal text-gray-500">Kilos Totales</h3>
                                    </div>
                                   
                                 </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="text-xl font-bold  flex w-full">
                          <div class="mx-4 border border-gray-300 p-6 grid grid-cols-1 gap-6 bg-white shadow-lg rounded-lg w-full">
                        
                              <div class="grid grid-cols-1 md:grid-cols-1 gap-x-4">
                                  <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                      <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                          <svg class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                              <path class="heroicon-ui"
                                                    d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/>
                                          </svg>
                                          <input type="text" value="https://api.greenexweb.cl/api/receptions?filter[fecha_g_recepcion][lte]=2023-11-09&select=c_empresa,tipo_g_recepcion,numero_g_recepcion,fecha_g_recepcion,n_transportista,id_exportadora,folio,fecha_cosecha,n_grupo,r_productor,c_productor,id_especie,id_variedad,c_envase,c_categoria,t_categoria,c_calibre,c_serie,cantidad,peso_neto,destruccion_tipo,creacion_tipo,Notas,n_estado,N_tratamiento,n_tipo_cobro,N_productor_rotulado,CSG_productor_rotulado,destruccion_id" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                      </div>
                                
                                  </div>
                                
                              </div>
                              <div class="grid grid-cols-2 md:grid-cols-2 gap-x-4">
                                <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                       <h1 class="text-gray-800 text-sm font-bold whitespace-nowrap mr-2">FECHA I</h1>
                                        <input type="date" wire:model="fechai" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                      <h1 class="text-gray-800 text-sm font-bold whitespace-nowrap mr-2">FECHA F</h1>
                                        <input type="date" wire:model="fechaf" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                            </div>
                            
                              <div class="grid grid-cols-2 gap-x-4">
                                <button onclick="confirmSync()" class="mt-4 bg-blue-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 px-3 py-3 hover:bg-blue-600 focus:outline-none rounded content-center">
                                    <p class="text-sm font-medium leading-none text-white">Sincronizar Recepciones</p>
                                </button>
                                @if ($recepcions->count())
                                    
                                <button onclick="confirmDeletion()" class="mt-4 bg-red-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 px-3 py-3 hover:bg-red-500 focus:outline-none rounded content-center">
                                    <p class="text-sm font-medium leading-none text-white">Eliminar Ultima Sincronización</p>
                                    <p class="text-sm font-medium leading-none text-white mt-1">{{$recepcions->first()->created_at}}</p>
                                </button>
                                
                                @endif
                              </div>
                          </div>
                        </div>
                      @elseif($vista=="Procesos")
                        <div class="w-6/12">
                          <h2 class="text-2xl font-semibold my-4"> 
                            Sincronización Procesos
                          </h2>
                          @php
                            $cant=0;
                            $cantprocesos=0;
                              foreach($procesosall as $recepcion){
                                  $cant+=$recepcion->peso_neto;
                              }
                              foreach($procesosall as $recepcion){
                                  $cantprocesos+=$recepcion->peso_neto;
                              }
                      
                          @endphp
                          <div class="flex">
                            <div class="w-full bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                  <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$temporada->especie->name}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Especie</h3>
                                  </div>
                                
                              </div>
                            </div>
                          </div>
                          <div class="flex">
                            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                  <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($procesosall->pluck('numero_g_produccion')->unique()->sort()->count())}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Procesos</h3>
                                  </div>
                                
                              </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($procesosall->count())}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Folios</h3>
                                </div>
                                
                              </div>
                          </div>
                            <div class=" bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 ml-2">
                                @if ($filters['razonsocial'])
                                    <div class="flex items-center justify-center content-center">
                                                <span class="text-xl sm:text-xl leading-none font-bold text-gray-900 content-center">{{number_format($cantprocesos)}}/</span>
                                                <h3 class="text-base font-normal items-center content-center text-gray-500">{{$filters['razonsocial']}}</h3>
                                          
                                    
                                    </div>
                                @endif
            
                                <div class="flex items-center justify-center">
                                    <div class="flex-shrink-0 text-center">
                                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($cant)}}</span>
                                      <h3 class="text-base font-normal text-gray-500">Kilos Totales</h3>
                                    </div>
                                  
                                </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="text-xl font-bold  flex w-full">
                          <div class="mx-4 border border-gray-300 px-6 py-2 grid grid-cols-1 gap-x-6 bg-white shadow-lg rounded-lg w-full">
                        
                              <div class="grid grid-cols-1 md:grid-cols-1 gap-x-4">
                                  <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                      <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                          <svg class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                              <path class="heroicon-ui"
                                                    d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/>
                                          </svg>
                                          <input type="text" value="https://api.greenexweb.cl/api/productions?filter[fecha_g_recepcion][lte]=2023-11-09&select=c_empresa,tipo_g_recepcion,numero_g_recepcion,fecha_g_recepcion,n_transportista,id_exportadora,folio,fecha_cosecha,n_grupo,r_productor,c_productor,id_especie,id_variedad,c_envase,c_categoria,t_categoria,c_calibre,c_serie,cantidad,peso_neto,destruccion_tipo,creacion_tipo,Notas,n_estado,N_tratamiento,n_tipo_cobro,N_productor_rotulado,CSG_productor_rotulado,destruccion_id" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                      </div>
                                
                                  </div>
                                
                              </div>
                              <div class="grid grid-cols-2 md:grid-cols-2 gap-x-4 mt-2">
                                <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                      <h1 class="text-gray-800 text-sm font-bold whitespace-nowrap mr-2">FECHA I</h1>
                                        <input type="date" wire:model="fechai" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                      <h1 class="text-gray-800 text-sm font-bold whitespace-nowrap mr-2">FECHA F</h1>
                                        <input type="date" wire:model="fechaf" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                              </div>
                            
                              <div class="grid grid-cols-2 gap-x-4 h-8 mt-2">
                                <button onclick="confirmSyncProceso()" class="mt-4 bg-blue-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 px-3 py-1 hover:bg-blue-600 focus:outline-none rounded content-center">
                                    <p class="text-sm font-medium leading-none text-white">Sincronizar Ingresos a Procesos</p>
                                </button>
                                @if ($procesos->count())
                                    
                                  <button onclick="confirmDeletionProceso()" class="mt-4 bg-red-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 px-3 py-1 hover:bg-red-500 focus:outline-none rounded content-center">
                                      <p class="text-sm font-medium leading-none text-white">Eliminar Ultima Sincronización</p>
                                      <p class="text-sm font-medium leading-none text-white mt-1">{{$temporada->proceso_end}}</p>
                                  </button>
                                
                                @endif
                              </div>
                              <div class="grid grid-cols-2 gap-x-4 h-8">
                                <button onclick="confirmSyncProceso()" class="bg-blue-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 px-3 py-1 hover:bg-blue-600 focus:outline-none rounded content-center">
                                    <p class="text-sm font-medium leading-none text-white">Sincronizar Salidas de Procesos</p>
                                </button>
                                @if ($procesos->count())
                                    
                                  <button onclick="confirmDeletionProceso()" class="bg-red-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 px-3 py-1 hover:bg-red-500 focus:outline-none rounded content-center">
                                      <p class="text-sm font-medium leading-none text-white">Eliminar Ultima Sincronización</p>
                                      <p class="text-sm font-medium leading-none text-white mt-1">{{$temporada->proceso_end}}</p>
                                  </button>
                                
                                @endif
                              </div>
                          </div>
                        </div>
                      @elseif($vista=="Despachos")
                        <div class="w-6/12">
                          <h2 class="text-2xl font-semibold my-4"> 
                            Sincronización Despachos
                          </h2>
                          @php
                            $cant_despachos=0;
                            $cantdespachos=0;
                              foreach($despachosall as $recepcion){
                                  $cant_despachos+=$recepcion->peso_neto;
                              }
                              foreach($despachosall as $recepcion){
                                  $cantdespachos+=$recepcion->peso_neto;
                              }
                      
                          @endphp
                          <div class="flex">
                            <div class="w-full bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                  <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$temporada->especie->name}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Especie</h3>
                                  </div>
                                
                              </div>
                            </div>
                          </div>
                          <div class="flex">
                            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                  <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($despachosall->pluck('numero_g_despacho')->unique()->sort()->count())}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Despachos</h3>
                                  </div>
                                
                              </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($despachosall->count())}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Filas</h3>
                                </div>
                                
                              </div>
                          </div>
                            <div class=" bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 ml-2">
                                @if ($filters['razonsocial'])
                                    <div class="flex items-center justify-center content-center">
                                                <span class="text-xl sm:text-xl leading-none font-bold text-gray-900 content-center">{{number_format($cantdespachos)}}/</span>
                                                <h3 class="text-base font-normal items-center content-center text-gray-500">{{$filters['razonsocial']}}</h3>
                                          
                                    
                                    </div>
                                @endif
            
                                <div class="flex items-center justify-center">
                                    <div class="flex-shrink-0 text-center">
                                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($cant_despachos)}}</span>
                                      <h3 class="text-base font-normal text-gray-500">Kilos Totales</h3>
                                    </div>
                                  
                                </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="text-xl font-bold  flex w-full">
                          <div class="mx-4 border border-gray-300 p-6 grid grid-cols-1 gap-6 bg-white shadow-lg rounded-lg w-full">
                        
                              <div class="grid grid-cols-1 md:grid-cols-1 gap-x-4">
                                  <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                      <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                          <svg class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                              <path class="heroicon-ui"
                                                    d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/>
                                          </svg>
                                          <input type="text" value="https://api.greenexweb.cl/api/dispatch?filter[fecha_g_recepcion][lte]=2023-11-09&select=c_empresa,tipo_g_recepcion,numero_g_recepcion,fecha_g_recepcion,n_transportista,id_exportadora,folio,fecha_cosecha,n_grupo,r_productor,c_productor,id_especie,id_variedad,c_envase,c_categoria,t_categoria,c_calibre,c_serie,cantidad,peso_neto,destruccion_tipo,creacion_tipo,Notas,n_estado,N_tratamiento,n_tipo_cobro,N_productor_rotulado,CSG_productor_rotulado,destruccion_id" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                      </div>
                                
                                  </div>
                                
                              </div>
                              <div class="grid grid-cols-2 md:grid-cols-2 gap-x-4">
                                <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                      <h1 class="text-gray-800 text-sm font-bold whitespace-nowrap mr-2">FECHA I</h1>
                                        <input type="date" wire:model="fechai" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                      <h1 class="text-gray-800 text-sm font-bold whitespace-nowrap mr-2">FECHA F</h1>
                                        <input type="date" wire:model="fechaf" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                            </div>
                            
                              <div class="grid grid-cols-2 gap-x-4">
                                <button onclick="confirmSyncDespacho()" class="mt-4 bg-blue-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 px-3 py-3 hover:bg-blue-600 focus:outline-none rounded content-center">
                                    <p class="text-sm font-medium leading-none text-white">Sincronizar Despachos</p>
                                </button>
                                @if ($despachos->count())
                                    
                                  <button onclick="confirmDeletionDespacho()" class="mt-4 bg-red-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 px-3 py-3 hover:bg-red-500 focus:outline-none rounded content-center">
                                      <p class="text-sm font-medium leading-none text-white">Eliminar Ultima Sincronización</p>
                                      <p class="text-sm font-medium leading-none text-white mt-1">{{$despachos->first()->created_at}}</p>
                                  </button>
                                
                                @endif
                              </div>
                          </div>
                        </div>
                      @elseif($vista=="Embarques")
                        <div class="w-6/12">
                          <h2 class="text-2xl font-semibold my-4"> 
                            Sincronización Embarques
                          </h2>
                          @php
                            $cant_despachos=0;
                            $cantdespachos=0;
                              foreach($embarquesall as $recepcion){
                                  $cant_despachos+=$recepcion->peso_neto;
                              }
                              foreach($embarquesall as $recepcion){
                                  $cantdespachos+=$recepcion->peso_neto;
                              }
                      
                          @endphp
                          <div class="flex">
                            <div class="w-full bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                  <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$temporada->especie->name}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Especie</h3>
                                  </div>
                                
                              </div>
                            </div>
                          </div>
                          <div class="flex">
                            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                  <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($embarquesall->pluck('numero_g_despacho')->unique()->sort()->count())}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Embarques</h3>
                                  </div>
                                
                              </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2">
                              <div class="flex items-center justify-center">
                                <div class="flex-shrink-0 text-center">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($embarquesall->count())}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Filas</h3>
                                </div>
                                
                              </div>
                          </div>
                            <div class=" bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 ml-2">
                                @if ($filters['razonsocial'])
                                    <div class="flex items-center justify-center content-center">
                                                <span class="text-xl sm:text-xl leading-none font-bold text-gray-900 content-center">{{number_format($cantdespachos)}}/</span>
                                                <h3 class="text-base font-normal items-center content-center text-gray-500">{{$filters['razonsocial']}}</h3>
                                          
                                    
                                    </div>
                                @endif
            
                                <div class="flex items-center justify-center">
                                    <div class="flex-shrink-0 text-center">
                                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($cant_despachos)}}</span>
                                      <h3 class="text-base font-normal text-gray-500">Kilos Totales</h3>
                                    </div>
                                  
                                </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="text-xl font-bold  flex w-full">
                          <div class="mx-4 border border-gray-300 p-6 grid grid-cols-1 gap-6 bg-white shadow-lg rounded-lg w-full">
                        
                              <div class="grid grid-cols-1 md:grid-cols-1 gap-x-4">
                                  <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                      <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                          <svg class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                              <path class="heroicon-ui"
                                                    d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/>
                                          </svg>
                                          <input type="text" value="https://api.greenexweb.cl/api/receptions?filter[fecha_g_recepcion][lte]=2023-11-09&select=c_empresa,tipo_g_recepcion,numero_g_recepcion,fecha_g_recepcion,n_transportista,id_exportadora,folio,fecha_cosecha,n_grupo,r_productor,c_productor,id_especie,id_variedad,c_envase,c_categoria,t_categoria,c_calibre,c_serie,cantidad,peso_neto,destruccion_tipo,creacion_tipo,Notas,n_estado,N_tratamiento,n_tipo_cobro,N_productor_rotulado,CSG_productor_rotulado,destruccion_id" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                      </div>
                                
                                  </div>
                                
                              </div>
                              <div class="grid grid-cols-2 md:grid-cols-2 gap-x-4">
                                <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                      <h1 class="text-gray-800 text-sm font-bold whitespace-nowrap mr-2">FECHA I</h1>
                                        <input type="date" wire:model="fechai" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-2 border border-gray-200 px-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                      <h1 class="text-gray-800 text-sm font-bold whitespace-nowrap mr-2">FECHA F</h1>
                                        <input type="date" wire:model="fechaf" class="bg-gray-300 flex w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                            </div>
                            
                              <div class="grid grid-cols-2 gap-x-4">
                                <button onclick="confirmSyncEmbarque()" class="mt-4 bg-blue-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 px-3 py-3 hover:bg-blue-600 focus:outline-none rounded content-center">
                                    <p class="text-sm font-medium leading-none text-white">Sincronizar Embarques</p>
                                </button>
                                @if ($embarques->count())
                                    
                                  <button onclick="confirmDeletionEmbarque()" class="mt-4 bg-red-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 px-3 py-3 hover:bg-red-500 focus:outline-none rounded content-center">
                                      <p class="text-sm font-medium leading-none text-white">Eliminar Ultima Sincronización</p>
                                      <p class="text-sm font-medium leading-none text-white mt-1">{{$embarques->first()->created_at}}</p>
                                  </button>
                                
                                @endif
                              </div>
                          </div>
                        </div>
                      @else
                        <div class="p-2 text-xl font-bold border-2 rounded-lg flex w-full">
                          @if ($razonsall)
                              
                             {{$razonsall->count()}} Productores @if ($filters['razonsocial'])  //  Resultados: {{$razonsallresult->count()}} @endif
                             
                          @endif
                        </div>
                      @endif
                      
    
                    </div>
                   
                  </div>

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
                
                <div class="flex">
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
                    Norma:<br>
                    <select wire:model.live="filters.norma" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                      <option value="">Todos</option>
                      
                        <option value="dentro"> Dentro de norma</option>
                        <option value="fuera"> Fuera de norma</option>
                      
                    
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
                
                </div>

              
                  
                
                <div class="mb-4 flex mt-2">
                  @if ($vista=='Procesos' || $vista=='Despachos')
                  
                      @foreach ($despachosall as $masa)
                        @php
                          
                            if ($masa->etd) {
                            
                            }else{
                              $sinfechaetd+=1;
                            }
                            if ($masa->eta) {
                            
                            }else{
                              $sinfechaeta+=1;
                            }

                            if ($masa->semana) {
                              # code...
                            } else {
                              $sinsemana+=1;
                            }
                        @endphp
                      @endforeach

                    <div>
                        Unicos/Repetidos:<br>
                        <div>
                            <input type="checkbox" wire:model.live="filters.p_unicos" id="unicos" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" checked>
                            <label for="unicos">Únicos</label>
                        </div>
                    
                        <div>
                            <input type="checkbox" wire:model.live="filters.p_repetidos" id="repetidos" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" checked>
                            <label for="repetidos">Repetidos</label>
                        </div>
                    </div>
                    <div class="ml-4">
                      Tipo_g_produccion:
                   
                      <br>
                      <select wire:model.live="filters.tipo" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                        <option value="">Todos</option>
                        
                        @foreach ($tipo_procesos as $semana)
                          @if ($semana)
                            <option value="{{$semana}}">{{$semana}}</option>
                          @endif
                        @endforeach
                        
                      
                      </select>
                      Tipo:
                   
                      <br>
                      <select wire:model.live="filters.tipo2" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                        <option value="">Todos</option>
                        
                        @foreach ($tipo_procesos2 as $semana)
                          @if ($semana)
                            <option value="{{$semana}}">{{$semana}}</option>
                          @endif
                        @endforeach
                        
                      
                      </select>
                    </div>

                   


                  @endif
                  @if ($vista=='MASAS' || $vista=='FOB' || $vista=='resumes' || $vista=='resumesnacional' || $vista=='Despachos')
                    <div class="ml-4">
                      Categoria:<br>
                      <div>
                        <input type="checkbox" wire:model.live="filters.exp" id="exp" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" checked>
                        <label for="exp" title="{{$exportacionCodes}}">Exportación</label>
                      </div>
                      <div>
                          <input type="checkbox" wire:model.live="filters.com" id="com" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" checked>
                          <label for="com" title="{{$comercialCodes}}">Comercial</label>
                      </div>
                      <div>
                          <input type="checkbox" wire:model.live="filters.mi" id="mi" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" checked>
                          <label for="mi" title="{{$mercadoInternoCodes}}">Mercado Interno</label>
                      </div>
                     
                      
                      <div class="hidden">
                        <input type="checkbox" wire:model.live="filters.mer" id="mer" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <label for="mer">Merma</label>
                      </div>
                  
                    


                    
                    </div>

                    <div class="ml-4">
                      Etiquetas:
                      {{-- comment 
                      @foreach ($filters['etiquetas'] as $item)
                          {{ $item }}
                      @endforeach
                      --}}
                      <br>
                      @foreach ($unique_etiquetas as $etiqueta)
                          @if ($etiqueta)
                              <label>
                                  <input type="checkbox"
                                        @if(in_array($etiqueta, $filters['etiquetas'])) checked @endif
                                        wire:click="checkEtiqueta('{{ $etiqueta }}')"
                                        value="{{ $etiqueta }}">
                                  {{ $etiqueta }}
                              </label><br>
                          @endif
                      @endforeach
                    
                    </div>
                
                    <div class="ml-4">
                      Etiqueta:
                      {{-- comment 
                      @foreach ($filters['etiquetas'] as $item)
                          {{ $item }}
                      @endforeach
                      --}}
                      <br>
                      <select wire:model.live="filters.etiqueta" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                        <option value="">Todos</option>
                        @foreach ($unique_etiquetas as $etiqueta)
                          @if ($etiqueta)
                            <option value="{{$etiqueta}}">{{$etiqueta}}</option>
                          @endif
                        @endforeach
                      </select>

                      <br>
                      Precio_fob:<br>
                      <select wire:model.live="filters.precioFob" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                        <option value="">Todos</option>
                        
                          <option value="fobcero">Fob Cero</option>
                          <option value="null"> Sin Precio Fob</option>
                          <option value="fob"> Con Precio Fob</option>
                        
                      
                      </select>
                    </div>

                    <div class="ml-4">
                        Excepto folio:
                        <select  wire:model.live="foliosexept" name="" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-40">
                          <option value="">Todos</option>
                          @foreach ($unique_folios as $folio)
                            @if ($folio)
                              <option value="{{$folio}}">{{$folio}}</option>
                            @endif
                          @endforeach
                        </select>    

                        @foreach ($filters['notfolios'] as $folio)
                              <p wire:click="checkfolio('{{ $folio }}')" class="cursor-pointer hover:text-red-500 hover:font-bold mt-2" title="Quitar">{{$folio}}</p>
                        @endforeach
                        @if ($filters['notfolios'])
                          @if (count($filters['notfolios'])>1)
                            <p wire:click="checkfolioreset()" class="cursor-pointer text-red-500 font-bold mt-2" title="Quitar">Quitar Todos</p>
                          @endif     
                        @endif              
                       
                    </div>
                    
                    <div class="ml-4" >
                        <button wire:click='updatevariedades' >
                            Actualizar Variedades
                        </button>
                    </div>
                   
                      @if($vista=="Despachos" || $vista=='MASAS')
                        <!-- Extra Chatbot Card -->
                        <div class="relative max-w-[600px] w-full bg-white border rounded-lg shadow-lg overflow-hidden ml-4 z-10"
                        wire:loading.class="pointer-events-none">
                          <!-- Slider Wrapper -->
                          <div id="slider" class="flex transition-transform duration-500 ease-in-out">
                              @if ($vista=="Despachos")
                                <!-- Slide 1: Current Synchronization Section -->
                                <div class="w-full flex-shrink-0 p-2">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-xl font-semibold">
                                            Sincronización de Fechas
                                        </h3>
                                        <button wire:click='filtrar_fechanull()' class="flex items-center @if($filters['fechanull']==True) bg-blue-600 text-white @else bg-gray-100 text-gray-500 @endif py-1 px-2 transition-colors rounded hover:bg-blue-700 hover:text-white focus:outline-none">
                                            Filtrar
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="mt-4 text-gray-600">El sistema buscará en los registros de despacho la fecha etd/eta por coincidencia de la columna numero_g_despacho.</p>
                                    <div class="flex justify-end items-center space-x-4">
                                      <select 
                                          id="syncfecha" 
                                          wire:model.live="syncfecha" 
                                          class="bg-gray-200 border border-gray-300 text-gray-700 rounded-lg pr-8 py-2 focus:outline-none focus:ring focus:ring-indigo-300">
                                          <option value="todos">Todos</option>
                                          <option value="nulos">Nulos</option>
                                      </select>
                                    </div>
                                    <div class="flex items-center mt-4">
                                        <span class="text-2xl font-bold">{{$embarquesall->count()}}</span>
                                        <span class="ml-1 text-sm text-gray-600">Embarques</span>
                                        <button onclick="confirmSyncFechas()" class="ml-auto px-5 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded hover:bg-blue-700 hover:border-blue-700">
                                            Sincronizar
                                        </button>
                                    </div>

                                    <p>{{$sinfechaetd}} Registros sin Fecha ETD</p>
                                    <p>{{$sinfechaeta}} Registros sin Fecha ETA</p>
                                    <p>{{$sinsemana}} Registros sin Semana</p>

                                </div>
                              @endif
                              <!-- Slide 2: New Section for Multiplication Factor Synchronization -->
                              @if ($vista=='MASAS')
                                <div class="w-full flex-shrink-0 p-2">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-xl font-semibold">
                                          {{$sinfactor}} Registros Sin Factor de Multiplicación
                                        </h3>
                                        <button wire:click='filtrar_multiplicacion()' class="flex items-center @if($filters['multiplicacion']==True) bg-blue-600 text-white @else bg-gray-100 text-gray-500 @endif py-1 px-2 transition-colors rounded hover:bg-blue-700 hover:text-white focus:outline-none">
                                            Filtrar
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="mt-4 text-gray-600">El sistema realizará la sincronización basándose en el factor de multiplicación configurado.</p>
                                
                                    <div class="flex justify-between mt-4">
                                      <div>
                                        <a href="{{route('temporada.factor',$temporada)}}">
                                          <span class="text-lg font-bold">{{$factores->count()}}</span>
                                        </a>
                                        <span class="ml-1 text-sm text-gray-600">Factores</span>
                                      </div>
                                      
                                      <div class="flex gap-2 ml-auto">
                                        <div class="flex flex-col gap-2">
                                        
                                          <div class="flex justify-end items-center space-x-4">
                                            <select 
                                                id="syncfactor" 
                                                wire:model.live="syncfactor" 
                                                class="bg-gray-200 border border-gray-300 text-gray-700 rounded-lg pr-8 py-2 focus:outline-none focus:ring focus:ring-indigo-300">
                                                <option value="todos">Todos</option>
                                                <option value="nulos">Nulos</option>
                                            </select>
                                          </div>

                                          <button onclick="confirmSyncFactors2()" class="px-5 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded hover:bg-blue-700 hover:border-blue-700 h-10">
                                            Sincronizar Factores
                                          </button>
                                        </div>
                                    
                                        <div class="flex flex-col gap-2">
                                          <div class="px-5 py-2 text-sm font-medium text-gray-900 bg-white border border-blue-600 rounded  hover:border-blue-700">
                                            {{$factores->where('type','proceso')->where('sync_control','sincronizado')->count()}} / {{$factores->where('type','proceso')->count()}}
                                          </div>
                                          <button onclick="confirmSyncFactors3()" class="px-5 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded hover:bg-blue-700 hover:border-blue-700">
                                            Importar desde Procesos
                                          </button>
                                          <button onclick="confirmDeleteBalanceProceso()" class="px-5 py-2 text-sm font-medium text-white bg-red-600 border border-red-600 rounded hover:bg-red-700 hover:border-red-700">
                                            Eliminar Registro de Procesos
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    
                                </div>
                              @endif

                              @if($vista=='FOB')
                                <div class="w-full flex-shrink-0 p-2">
                                    
                                </div>
                              @endif
                          </div>
                      
                          <div class="flex justify-between mt-8" >
                            <div>
                              <button onclick="prevSlide()" class=" transform -translate-y-1/2 bg-gray-800 text-white px-3 py-1 rounded-r-lg hover:bg-gray-700 focus:outline-none">
                                Prev
                            </button>
                            </div>
                            <div>
                              <button onclick="nextSlide()" class=" transform -translate-y-1/2 bg-gray-800 text-white px-3 py-1 rounded-l-lg hover:bg-gray-700 focus:outline-none">
                                Next
                              </button>
                            </div>
                          

                          </div>
                          <!-- Navigation Buttons -->
                        
                        
                        </div>

                      @endif
                  
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

              @if($vista=="FOB TREE" || $vista=="FOB" || $vista=="MASAS")
                <div class="px-6 pt-6 2xl:container">
                  <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-3">
                      <div class="md:col-span-1 lg:col-span-1" >
                          <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                          
                              <div>
                                  <h5 class="text-xl text-gray-600 text-center">Exportación</h5>
                                  <div class="mt-2 flex justify-center gap-4">  
                                            @php
                                              $pesoexp=0;
                                              $pesoexp2=0;

                                              $pesomi=0;
                                              $pesomi2=0;

                                              $pesocom=0;
                                              $pesocom2=0;

                                              $ingresoreal_exp=0;
                                              $ingresoprom_exp=0;
                                              $ingresoreal_mi=0;
                                              $ingresoprom_mi=0;
                                              $ingresoreal_com=0;
                                              $ingresoprom_com=0;
                                            @endphp 
                                        @foreach($masastotal->whereIn('n_categoria', $exportacionCodes) as $masa)
                                            @if ($masa->fob)
                                                @if ($masa->infocategoria->unidad_multiplicadora=="Kilo")
                                                   @php
                                                       $ingresoreal_exp+=$masa->fob->fob_kilo_salida*$masa->peso_neto;
                                                       $ingresoprom_exp+=$masa->fob->fob_kilo_salida*$masa->peso_neto2;
                                                   @endphp
                                                @elseif($masa->infocategoria->unidad_multiplicadora=="Cantidad")
                                                  @php
                                                    if($masa->peso_std_embalaje*$masa->peso_neto>0){
                                                      $ingresoreal_exp+=$masa->precio_unitario/$masa->peso_std_embalaje*$masa->peso_neto;
                                                      $ingresoprom_exp+=$masa->fob->fob_kilo_salida/$masa->peso_std_embalaje*$masa->peso_neto2;
                                                    }
                                                  @endphp
                                                @endif
                                            @endif
                                            @php
                                              $pesoexp+=$masa->peso_neto2;
                                              $pesoexp2+=$masa->peso_neto;
                                            @endphp 
                                        @endforeach
                                        @foreach($masastotal->whereIn('n_categoria', $mercadoInternoCodes) as $masa)
                                            @if ($masa->fob)
                                                @if ($masa->infocategoria->unidad_multiplicadora=="Kilo")
                                                   @php
                                                       $ingresoreal_mi+=$masa->fob->fob_kilo_salida*$masa->peso_neto;
                                                       $ingresoprom_mi+=$masa->fob->fob_kilo_salida*$masa->peso_neto2;
                                                   @endphp
                                                @elseif($masa->infocategoria->unidad_multiplicadora=="Cantidad")
                                                  @php
                                                    if($masa->peso_std_embalaje*$masa->peso_neto>0){
                                                      $ingresoreal_mi+=$masa->precio_unitario/$masa->peso_std_embalaje*$masa->peso_neto;
                                                      $ingresoprom_mi+=$masa->fob->fob_kilo_salida/$masa->peso_std_embalaje*$masa->peso_neto2;
                                                    }
                                                  @endphp
                                                @endif
                                            @endif
                                              @php
                                                $pesomi+=$masa->peso_neto2;
                                                $pesomi2+=$masa->peso_neto;
                                              @endphp 
                                          @endforeach
                                        @foreach($masastotal->whereIn('n_categoria', $comercialCodes) as $masa)
                                        @if ($masa->fob)
                                                @if ($masa->infocategoria->unidad_multiplicadora=="Kilo")
                                                   @php
                                                       $ingresoreal_com+=$masa->fob->fob_kilo_salida*$masa->peso_neto;
                                                       $ingresoprom_com+=$masa->fob->fob_kilo_salida*$masa->peso_neto2;
                                                   @endphp
                                                @elseif($masa->infocategoria->unidad_multiplicadora=="Cantidad")
                                                  @php
                                                    if($masa->peso_std_embalaje*$masa->peso_neto>0){
                                                      $ingresoreal_com+=$masa->precio_unitario/$masa->peso_std_embalaje*$masa->peso_neto;
                                                      $ingresoprom_com+=$masa->fob->fob_kilo_salida/$masa->peso_std_embalaje*$masa->peso_neto2;
                                                    }
                                                  @endphp
                                                @endif
                                            @endif
                                          @php
                                            $pesocom+=$masa->peso_neto2;
                                            $pesocom2+=$masa->peso_neto;
                                          @endphp 
                                        @endforeach
                                  

                                    
                                      <h3 class="text-3xl font-bold text-gray-700">{{number_format($pesoexp,1,',','.')}}</h3>
                                      <div class="flex items-end gap-1 text-green-500">
                                          <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                          </svg>
                                          <span>2%</span>
                                      </div>
                                  </div>
                                  <span class="block text-center text-gray-500">Total despacho {{number_format($pesoexp2,1,',','.')}}</span>
                              </div>
                              <table class="w-full text-gray-600">
                                  <tbody>
                                      <tr>
                                          <td class="py-2">TOTAL REAL</td>
                                          <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoreal_exp,2,',','.')}}</td>
                                        
                                      </tr>
                                      <tr>
                                          <td class="py-2">TOTAL PROM</td>
                                          <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoprom_exp,2,',','.')}}</td>
                                            
                                      </tr>
                                      <tr>
                                          <td class="py-2">DIFERENCIA</td>
                                          <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoreal_exp-$ingresoprom_exp,2,',','.')}}</td>
                                          
                                      </tr>
                                  </tbody>
                              </table> 
                          </div>
                      </div>
                      <div class="md:col-span-1 lg:col-span-1" >
                        <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                        
                            <div>
                                <h5 class="text-xl text-gray-600 text-center">Mercado Interno</h5>
                                <div class="mt-2 flex justify-center gap-4">
                                    <h3 class="text-3xl font-bold text-gray-700">{{number_format($pesomi,1,',','.')}}</h3>
                                    <div class="flex items-end gap-1 text-green-500">
                                        <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                        </svg>
                                        <span>2%</span>
                                    </div>
                                </div>
                                <span class="block text-center text-gray-500">Total despacho {{number_format($pesomi2,1,',','.')}}</span>
                            </div>
                            <table class="w-full text-gray-600">
                              <tbody>
                                <tr>
                                    <td class="py-2">TOTAL REAL</td>
                                    <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoreal_mi,0,',','.')}}</td>
                                  
                                </tr>
                                <tr>
                                    <td class="py-2">TOTAL PROM</td>
                                    <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoprom_mi,0,',','.')}}</td>
                                      
                                </tr>
                                <tr>
                                    <td class="py-2">DIFERENCIA</td>
                                    <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoreal_mi-$ingresoprom_mi,0,',','.')}}</td>
                                    
                                </tr>
                            </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="md:col-span-1 lg:col-span-1" >
                      <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                      
                          <div>
                              <h5 class="text-xl text-gray-600 text-center">Comercial</h5>
                              <div class="mt-2 flex justify-center gap-4">
                                  <h3 class="text-3xl font-bold text-gray-700">{{number_format($pesocom,1,',','.')}}</h3>
                                  <div class="flex items-end gap-1 text-green-500">
                                      <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                      </svg>
                                      <span>2%</span>
                                  </div>
                              </div>
                              <span class="block text-center text-gray-500">Total despacho {{number_format($pesocom2,1,',','.')}}</span>
                          </div>
                          <table class="w-full text-gray-600">
                            <tbody>
                                <tr>
                                    <td class="py-2">TOTAL REAL</td>
                                    <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoreal_com,0,',','.')}}</td>
                                  
                                </tr>
                                <tr>
                                    <td class="py-2">TOTAL PROM</td>
                                    <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoprom_com,0,',','.')}}</td>
                                      
                                </tr>
                                <tr>
                                    <td class="py-2">DIFERENCIA</td>
                                    <td class="text-gray-500 ml-auto text-right">{{number_format($ingresoreal_com-$ingresoprom_com,0,',','.')}}</td>
                                    
                                </tr>
                            </tbody>
                          </table> 
                      </div>
                  </div>
                    
                  </div>
                </div>
              @endif
             
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
                  
                  <x-button onclick="confirmDeleteFob()" class="bg-red-500 text-white hover:bg-red-600 active:bg-red-900 mb-2">
                    Eliminar FOB'S
                 </x-button>
                  <x-button onclick="confirmDeleteBalance()" class="bg-red-500 text-white hover:bg-red-600 active:bg-red-900">
                    Eliminar Balance de masa
                 </x-button>
                
                         
               
                </div>
              @endif
              @if ($vista!='Recepcion' )
                <select wire:model.live="ctd" class="max-w-xl  mx-2 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-6 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="25" class="text-left px-10">25 </option>
                    <option value="50" class="text-left px-10">50 </option>
                    <option value="100" class="text-left px-10">100 </option>
                    <option value="500" class="text-left px-10">500 </option>
                    
                </select>
              @endif

              @if ($vista=="show" || $vista=="Procesos")
                  <div class="flex">
                    @if ($vista=="show")
                      <div>
                        <p class="text-center">Ordenar por:</p>
                          <!-- Select para columna de orden -->
                          <select wire:model.live="sortBy" class="max-w-5xl mx-2 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-8 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="sub.csg_count">Cantidad de CSG</option>
                            <option value="razonsocials.name">Nombre</option>
                            <option value="razonsocials.rut">RUT</option>
                            <!-- Agrega más opciones según tus columnas disponibles -->
                        </select>
                      </div>
                    @endif
                    <!-- Select para dirección de orden -->
                    <div>
                      <p class="text-center">Orden:</p>
                      <select wire:model.live="sortDirection" class="max-w-xl mx-2 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-6 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                          <option value="asc">Ascendente</option>
                          <option value="desc">Descendente</option>
                      </select>
                    </div>
                  </div>
              @endif
              @if ($vista=='FACTOR')

                <div>
                  <a href="{{route('temporada.balancemasa',$temporada)}}">
                    <button type="button" class="text-white font-normal py-2 px-4 rounded transition duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-blue-700 border border-blue-700 hover:bg-blue-900 hover:border-blue-900">
                      Balance de Masa
                    </button>
                  </a>                      

                </div>
              @endif
            </div>
            
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
              <div class="inline-block min-w-full rounded-lg overflow-hidden">
                  
                @if ($vista=='resumes')
                
                    <h1 class="ml-10 mt-2" >Exportación</h1>
               

                  @foreach($costos as $menuId => $porMetodo)
                    <tr><td colspan="999" class="bg-gray-200 font-semibold px-3 py-2">
                      Menú #{{ $menuId }}
                    </td></tr>

                    
                  @endforeach

                
                @endif 

                @if ($vista=='resumesnacional' || $vista=="show")
                  <div class="flex justify-center mt-4">
                      <div> 
                          <p class="text-center mb-2">¿Aun no tienes la plantilla de Excel para subir las condiciones del productor?</p>
                          <div class="flex gap-x-2">
                              <button wire:click="exportarExcel('TODAS')"  class="bg-gray-300 hover:bg-gray-200 text-grey-darkest font-bold py-2 px-4 rounded items-center mx-auto flex justify-center">
                                  <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                  <span>Download</span>
                              </button>
                              
                                
                              
                              <div class="text-center">

                                      {{-- Input oculto --}}
                                  <input 
                                      type="file" 
                                      id="archivo_importacion" 
                                      wire:model="archivo" 
                                      class="hidden" 
                                      accept=".xlsx,.xls"
                                  />

                                  {{-- Botón para abrir el selector de archivo --}}
                                  <button 
                                      type="button"
                                      onclick="document.getElementById('archivo_importacion').click()"
                                      class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded inline-flex items-center"
                                  >
                                      <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                          <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                                      </svg>
                                      <span>Seleccionar archivo</span>
                                  </button>

                                  {{-- Botón para confirmar importación después de seleccionar archivo --}}
                                  @if ($archivo)
                                      <button 
                                          wire:click="importar"
                                          class="ml-4 bg-green-500 hover:bg-green-400 text-white font-semibold py-2 px-4 rounded"
                                      >
                                          Importar ahora
                                      </button>
                                  @endif

                                   {{-- Mensaje de éxito --}}
                                    @if (session()->has('success'))
                                        <div class="mt-2 text-green-600 text-sm">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                              
                                  @error('file') 
                                      <span class="text-red-600 text-sm">{{ $message }}</span> 
                                  @enderror
                          
                              
                              
                            </div>
                          </div>
                      </div> 
                  </div>
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
                                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$razon->id}}</td>
                                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                @if ($razon && $temporada)
                                                    
                                                <a href="{{route('razonsocial.temporada.show',['razonsocial'=>$razon,'temporada'=>$temporada])}}" target="_blank"> {{$razon->name}}
                                                </a>
                                                
                                                @endif
                                              </td>
                                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                              {{$razon->rut}}
                                              </td>
                                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                              {{$razon->csg_count}}
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
                            {{$razons->links()}}
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
                            @if ($variedad->bi_color=='bicolor')
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
                        @foreach ($temporada->especie->colorespecies as $color)
                        <tr>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{$color->name}}
                            </td>
                        
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            
                            @foreach ($unique_variedades as $item)
                                @if ($item->bi_color=="rojo")
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
                        @endforeach

                
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
                    

                    <table class="min-w-full leading-normal hidden">
                      <thead>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tarifa</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Facturado</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Monto del Servicio</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                      
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kks Exportacion</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tarifa</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                          Tarifa Frio Packing Exportacion
                          </td>
                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {!! Form::model($temporada, ['route'=>['temporadas.update',$temporada],'method' => 'put', 'autocomplete'=>'off']) !!}    
                                {!! Form::label('costos_packing', 'Variedad Roja', ['class' => 'hidden']) !!}
                                {!! Form::number('costos_packing', null, ['step' => '0.001', 'class' => 'form-input text-right mr-2 mt-1 rounded-lg' . ($errors->has('costos_packing') ? ' border-red-600' : '')]) !!}
                                {!! Form::submit('Actualizar', ['class' => 'font-bold py-2 px-4 rounded bg-blue-500 text-white cursor-pointer']) !!}
                              {!! Form::close() !!}
                          </td>
                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{number_format($montoservicio)}}
                          </td>
                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{number_format($temporada->costos_packing-$montoservicio)}}
                          </td>
                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{number_format($kgsexportacion)}}
                          </td>
                          
                          <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{number_format(($temporada->costos_packing-$montoservicio)/$kgsexportacion,3)}}
                          </td>
                        </tr>
                      
                      </tbody>
                    </table>

                    @if ($CostosPackings->count()>0)
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
                                                <a href="{{route('razonsocial.temporada.show',['razonsocial'=>$razon,'temporada'=>$temporada])}}" target="_blank"> 
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
                    @if ($PackingCodes->count()>0)
                    <div class="mt-4">
                      <h1 class="text-xl font-semibold mb-4 text-center">
                          Por favor selecione el archivo de "Costos de packing por Codigo" que desea importar
                      </h1>
                      <div class="flex justify-center ">
                          
                          <form action="{{route('temporada.importPackingcode')}}"
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
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Código Embalaje
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Costo por Caja (USD)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($PackingCodes as $costo)
                                <tr>
                                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $costo->c_embalaje }}</p>
                                    </td>
                                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ number_format($costo->costo_por_caja_usd, 2) }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                      
                    @endif
                  
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
                          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            CODIGO DE EMBALAJE
                          </th>
                          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            TARIFA (DolaresxCaja)
                          </th>
                         
                          <th class="hidden px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
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
                              
                          

                              <td class="hidden px-5 py-2 border-b border-gray-200 bg-white text-sm">
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
                    @if ($costomenus->where('name','Gastos de exportación')->count()>0)
                      @if ($costomenus->where('name','Gastos de exportación')->first()->costos->where('metodo', '!=', 'null')->count()>0)
                        <div x-data="{ openTab: {{$costomenus->where('name','Gastos de exportación')->first()->costos->where('metodo', '!=', 'null')->first()->id}} }" class="px-2">
                          <div class="max-w-md mx-auto">
                              <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md">
                                @foreach ($costomenus->where('name','Gastos de exportación')->first()->costos->where('metodo', '!=', 'null') as $menu)
                                    <button x-on:click="openTab = {{$menu->id}}" :class="{ 'bg-blue-600 text-white': openTab === {{$menu->id}} }" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">{{$menu->name}}</button>
                                @endforeach
                              
                              </div>
                          </div>
                          @foreach ($costomenus->where('name','Gastos de exportación')->first()->costos->where('metodo', '!=', 'null') as $menu)
                              @switch($menu->metodo)
                                @case('TPT')
                                    <div x-show="openTab === {{$menu->id}}" class="grid grid-cols-3 gap-x-4 items-center mb-6">

                                      <select wire:model="type" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                          <option value="" class="text-center">Selecciona una categoría</option>
                                          <option value="maritimo" class="text-center">Maritimo</option>
                                          <option value="aereo" class="text-center">Aereo</option>
                                          <option value="terrestre" class="text-center">Terrestre</option>
                  
                                          
                  
                                      </select>
                  
                                      <input wire:model="precio_usd" type="number" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                                      
                                      <button wire:click="exportacion_store('{{$menu->id}}')" class="focus:ring-2 focus:ring-offset-2 focus:ring-green-300 text-sm leading-none text-green-600 py-3 px-5 bg-green-600 rounded hover:bg-green-500 focus:outline-none">
                  
                                          <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                                          Agregar
                                              
                                          </h1>
                                      </button>
                                    </div>
                                    <table x-show="openTab === {{$menu->id}}" class="min-w-full leading-normal">
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
                                        
                                        @if ($exportacions->where('costo_id',$menu->id))
                                            
                                          @foreach ($exportacions->where('costo_id',$menu->id) as $exportacion)
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
                                  @break
                                @case('TPC')
                                
                                  @break
                                @case('TPK')
                                
                                  @break
                                @case('MTC')
                                  
                                  @break
                                @case('MTE')
                                  
                                  @break
                                @case('MTEB')
                                
                                  @break
                                @case('MTEmp')
                                
                                  @break
                                @case('MTT')
                                
                                  @break
                                @default
                                
                              @endswitch 
                            
                            
                          
                          @endforeach
                        </div>
                      @endif
                    @endif
                

                
                    
                
                  

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
                        Condicion  
                        </th>
                        <th
                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Productor
                        </th>
                        <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      CLP
                      </th>
                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        USD
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
                                      {{$flete->condicion}}
                                    </p>
                                  </div>
                                </div>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->productor}}</p>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->clp}}</p>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->usd}}</p>
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
                        {{-- comment
                        @if ($masastotal && $masastotalnacional)
                          {{($masastotal->count()+$masastotalnacional->count())}}
                        @elseif($masastotal)
                          {{($masastotal->count())}}
                        @elseif($masastotalnacional)
                          {{($masastotalnacional->count())}}
                        @endif
                        --}}
                        {{($masastotal->count())}}

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
                                  'tipo_g_despacho',
                                  'numero_g_despacho',
                                  'fecha_g_despacho',
                                  'semana',
                                  'etd',
                                  'eta',
                                  'Control Fecha',
                                   'semana_fecha_produccion',
                                  'fecha_produccion',
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
                                  'c_calibre',
                                  'color',
                                  'n_calibre',
                                  'n_etiqueta',
                                  'cantidad',
                                  'cantidad2',
                                  'peso_neto',
                                  'Factor Multiplicador',
                                  'peso_neto 2',
                                  'transporte',
                                  'fob_real',
                                  'fob_promedio',
                                   'fob_kg_real',
                                   'fob_kg_promedio',
                                    'TOTAL_REAL',
                                    'TOTAL_PROM',
                                    'DIF'
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
                                <p class="text-gray-900 whitespace-no-wrap">{{ $masa->numero_guia_produccion }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $masa->tipo_g_despacho }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ $masa->numero_g_despacho }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{$masa->fecha_g_despacho }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{$masa->semana}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">

                                @if ($masaid==$masa->id)
                                    <input wire:model="fechaetd" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                    <p class="text-gray-900 whitespace-no-wrap">{{$masa->etd_semana}}</p>
                                @endif
                                

                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{$masa->eta_semana}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200  text-sm @if($masa->control_fechas>2)bg-red-100 @else bg-white @endif">
                                  <p class="text-gray-900 whitespace-no-wrap">{{$masa->control_fechas}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{date('W', strtotime($masa->fecha_produccion))}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{$masa->fecha_produccion}}</p>
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
                                <p class="text-gray-900 whitespace-no-wrap">{{ $masa->c_calibre }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $masa->color }}</p>
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

                                <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->cantidad,2) }}</p>
                                

                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->peso_neto,1) }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 @if($masa->factor==0) bg-red-100 @else bg-white @endif text-sm">
                                <a href="{{route('temporada.factor',$temporada)}}">
                                  <p class=" whitespace-no-wrap cursor-pointer text-blue-500">{{ number_format($masa->factor,2) }}</p>
                                </a>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->peso_neto2,1) }}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $masa->tipo_transporte }}</p>
                              </td>
                              {{-- Fob real --}}
                              <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-32">
                                @if ($masaid==$masa->id)
                                    <input wire:model="preciomasa" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                  
                                 
                                    <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->precio_unitario,2,',','.') }}</p>
                                 

                                @endif
                                

                              </td>
                              {{-- Fob Promedio --}}
                              <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-32">
                                @if ($masaid==$masa->id)
                                    <input wire:model="preciomasa" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                 
                                      @if ($masa->fob)
                                        <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->fob->fob_kilo_salida,2,',','.') }}</p>
                                      @else
                                        <p class="text-gray-900 whitespace-no-wrap">NULL</p>
                                      @endif
                                  
                                @endif
                              </td>
                              {{-- Fob KG REAL--}}
                              <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-32">
                                @if ($masaid==$masa->id)
                                    <input wire:model="preciomasa" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                 
                                    @if ($masa->fob)
                                        @if ($masa->infocategoria->unidad_multiplicadora=="Kilo")
                                            <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->fob->fob_kilo_salida,2,',','.')}}</p>
                                        @elseif($masa->infocategoria->unidad_multiplicadora=="Cantidad")
                                          <p class="text-gray-900 whitespace-no-wrap">{{  number_format($masa->precio_unitario/$masa->peso_std_embalaje,2,',','.') }}</p>
                                        @endif
                                    @else
                                      <p class="text-gray-900 whitespace-no-wrap">Null</p>
                                    @endif
                                    
                                @endif
                                

                              </td>
                              {{-- Fob KG Promedio --}}
                              <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-32">
                                @if ($masaid==$masa->id)
                                    <input wire:model="preciomasa" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                 
                                    @if ($masa->fob)
                                        @if ($masa->infocategoria->unidad_multiplicadora=="Kilo")
                                            <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->fob->fob_kilo_salida,2,',','.')}}</p>
                                        @elseif($masa->infocategoria->unidad_multiplicadora=="Cantidad")
                                          <p class="text-gray-900 whitespace-no-wrap">{{  number_format($masa->fob->fob_kilo_salida/$masa->peso_std_embalaje,2,',','.') }}</p>
                                        @endif
                                    @else
                                      <p class="text-gray-900 whitespace-no-wrap">Null</p>
                                    @endif
                                    
                                @endif
                                

                              </td>
                              {{-- Total real --}}
                              <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-32">
                                @if ($masaid==$masa->id)
                                    <input wire:model="preciomasa" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                 
                                    @if ($masa->fob)
                                        @if ($masa->infocategoria->unidad_multiplicadora=="Kilo")
                                            <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->fob->fob_kilo_salida*$masa->peso_neto,2,',','.')}}</p>
                                        @elseif($masa->infocategoria->unidad_multiplicadora=="Cantidad")
                                          <p class="text-gray-900 whitespace-no-wrap">{{  number_format($masa->precio_unitario/$masa->peso_std_embalaje*$masa->peso_neto,2,',','.') }}</p>
                                        @endif
                                    @else
                                      <p class="text-gray-900 whitespace-no-wrap">Null</p>
                                    @endif
                                    
                                @endif
                                

                              </td>
                               {{-- Total Promedio --}}
                              <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-32">
                               
                                  @if ($masaid==$masa->id)
                                      <input wire:model="preciomasa" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                  @else
                                      @if ($masa->fob)
                                          @if ($masa->infocategoria->unidad_multiplicadora=="Kilo")
                                              <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->fob->fob_kilo_salida*$masa->peso_neto2,2,',','.')}}</p>
                                          @elseif($masa->infocategoria->unidad_multiplicadora=="Cantidad")
                                            <p class="text-gray-900 whitespace-no-wrap">{{  number_format($masa->fob->fob_kilo_salida/$masa->peso_std_embalaje*$masa->peso_neto2,2,',','.') }}</p>
                                          @endif
                                      @else
                                        <p class="text-gray-900 whitespace-no-wrap">Null</p>
                                      @endif
                                  @endif
                               
                              </td>
                               {{-- DIFERENCIA --}}
                              <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-32">
                               
                                  @if ($masaid==$masa->id)
                                      <input wire:model="preciomasa" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                  @else
                                      @if ($masa->fob)
                                          @if ($masa->infocategoria->unidad_multiplicadora=="Kilo")
                                              <p class="text-gray-900 whitespace-no-wrap">{{ number_format($masa->fob->fob_kilo_salida*($masa->peso_neto-$masa->peso_neto2),2,',','.')}}</p>
                                          @elseif($masa->infocategoria->unidad_multiplicadora=="Cantidad")
                                            <p class="text-gray-900 whitespace-no-wrap">{{  number_format($masa->fob->fob_kilo_salida/$masa->peso_std_embalaje*($masa->peso_neto-$masa->peso_neto2),2,',','.') }}</p>
                                          @endif
                                      @else
                                        <p class="text-gray-900 whitespace-no-wrap">Null</p>
                                      @endif
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

                @if ($vista=='FACTOR')

                  
                  <div class="grid grid-cols-2" >
                    <div>
                      <h1 class="font-bold text-xl" >
                        Procesos
                      </h1>
                      <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                @php
                                
                                    
                                    echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">';
                                    echo  'id_empresa / numero_g_produccion / c_productor_proceso<br>'.'c_etiqueta / id_variedad / c_calibre / c_categoria / c_embalaje';
                                    echo '</th>';
                                @endphp
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{$procesosall_group->count()}} <br> Total<br>{{number_format($procesosall_group->sum('total'),2,',','.')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($procesosall_group as $masa)
                                <tr>
                                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                        @php
                                            if($masa->c_etiqueta){
                                                  $subetiqueta=$masa->c_etiqueta;
                                                }else{
                                                  $subetiqueta='NULL';
                                                } 
                                        @endphp 
                                      <p class="text-gray-900 whitespace-no-wrap">
                                            {{ 
                                                $masa->id_empresa . '/' .
                                                $masa->numero_g_produccion . '/' .
                                                $masa->c_productor_proceso . '/' .
                                                $subetiqueta. '/' .
                                                $masa->id_variedad . '/' .
                                                $masa->c_calibre . '/' .
                                                $masa->c_categoria . '/' .
                                                $masa->c_embalaje 
                                            }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $masa->total }}</p>
                                    </td>
                                  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    
                    
                    </div>
                    <div>
                      <div class="flex justify-between">
                        <div>
                          <h1 class="font-bold text-xl">
                            Despachos
                          </h1>
                        </div>
                        <div>
                          <button type="button" onclick="processCheckFactors()" class="text-white font-normal py-2 px-4 rounded transition duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-purple-700 border border-purple-700 hover:bg-purple-900 hover:border-purple-900">
                            Checkear
                          </button>
                        
                        </div>
                      </div>
                   
                    
                        @if ($factores->count()>0)
                        <div class="overflow-x-auto">
                          <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    @php
                                        echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">';
                                        echo 'id_empresa / numero_guia_produccion / c_productor<br>'.'c_etiqueta / id_variedad / c_calibre / c_categoria / c_embalaje';
                                        echo '</th>';
                                    @endphp
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"> ({{$despachosall_group->count()}}) <br>Total<br>{{number_format($despachosall_group->sum('total'),2,',','.')}}</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">({{$factores->whereNull('total_proceso')->count()}}/{{$factores->count()}})<br>TOTAL PROCESOS<br>{{number_format($factores->sum('total_proceso'),2,',','.')}}</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{$factores->count()}} <br> Factor</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">TIPO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factores as $masa)
                                    <tr>
                                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                          @php
                                                if($masa->c_etiqueta){
                                                      $subetiqueta=$masa->c_etiqueta;
                                                    }else{
                                                      $subetiqueta='NULL';
                                                    } 

                                                    if ($masa->numero_guia_produccion) {
                                                      $numero_guia_produccion=$masa->numero_guia_produccion;
                                                    }else{
                                                      $numero_guia_produccion='NULL';
                                                    }
                                            @endphp   
                                          <p class="text-gray-900 whitespace-no-wrap">
                                                {{ 
                                                    $masa->id_empresa . '/' .
                                                    $numero_guia_produccion . '/' .
                                                    $masa->c_productor . '/' .
                                                    $subetiqueta. '/' .
                                                    $masa->id_variedad . '/' .
                                                    $masa->c_calibre . '/' .
                                                    $masa->c_categoria . '/' .
                                                    $masa->c_embalaje 
                                                }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $masa->total }}</p>
                                        </td>
                                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                          <p class="text-gray-900 whitespace-no-wrap">{{ $masa->total_proceso }}</p>
                                        </td>
                                        <td class="px-5 py-2 border-b border-gray-200 @if($masa->total_proceso==0) bg-red-100 @else bg-white  @endif text-sm">
                                            {{number_format($masa->factor,2)}}
                                        </td>
                                        <td class="px-5 py-2 border-b border-gray-200  bg-white text-sm">
                                          @if ($masa->type)
                                              Proceso
                                          @else
                                              Despachos
                                          @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
  
                          </table>
                        </div>
                    
                        @else
                            <div class='w-full max-w-xl px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
                              <h1 class="font-mono font-bold text-purple-900 text-lg leading-tight border-b pb-4">Sin Factores Generados ({{$despachosall_group->count()}} Combinaciones)</h1>
                              <div class="pt-8">
                                <div class="flex space-x-2">
                                  <button type="button" onclick="confirmSyncFactors()" class="text-white font-normal py-2 px-4 rounded transition duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-purple-700 border border-purple-700 hover:bg-purple-900 hover:border-purple-900">
                                      Generar
                                  </button>
                              </div>
                              
                              </div>
                            </div>
                           

                        @endif
                     
                    
                    </div>
                  </div>
                  

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
                      <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Embalaje
                    </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Categoria
                          </th>
                          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            FOB
                            </th>

                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              FOB2
                              </th>
                              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                FOB3
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
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->embalaje}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->categoria}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                               
                                  <p class="text-gray-900 whitespace-no-wrap"> {{number_format(floatval($fob->fob_kilo_salida),2,',','.')}}</p>
                              
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                @if ($fobid==$fob->id)
                                    <input wire:model="preciofob2" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                  <p class="text-gray-900 whitespace-no-wrap"> {{number_format($fob->fob_kilo_salida2,2,',','.')}}</p>
                                @endif
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                @if ($fobid==$fob->id)
                                    <input wire:model="preciofob3" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                  <p class="text-gray-900 whitespace-no-wrap"> {{number_format($fob->fob_kilo_salida3,2,',','.')}}</p>
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

                @if ($vista=='FOB TREE')


              <div class="main flex flex-col m-5">
               
                @foreach ($categoria_fobs as $categoria)
                  <div wire:click="checkfobcategoria('{{$categoria}}')" class="@if($filters['ncategoria']==$categoria) ml-2  @endif">
                    <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['ncategoria']==$categoria) bg-gray-100  @endif">
                      <div class="left">
                        <div class="header @if($filters['ncategoria']==$categoria) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$categoria}}</div>
                        <div class="desc text-gray-600">Categoria de Exportación</div>
                      </div>
                      <div class="right m-auto mr-0">
                        @if($fobsall2->where('categoria',$categoria)->count()>0)
                          <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$categoria)->sum('fob_kilo_salida')/$fobsall2->where('categoria',$categoria)->count(),2,',','.')}}</p>
                        @else
                          <p class="text-2xl font-bold text-gray-600">-</p>
                        @endif
                        
                      </div>
                    </div>
                  </div>
                  @if($filters['ncategoria']==$categoria) 
                    @if($filters['variedad']) 
                        <div wire:click="checkfobcategoria('{{$categoria}}')" class="ml-4">
                          <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['ncategoria']==$categoria) bg-gray-200  @endif">
                            <div class="left">
                              <div class="header @if($filters['ncategoria']==$categoria) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$filters['variedad']}}</div>
                              <div class="desc text-gray-600">Variedad</div>
                            </div>
                            <div class="right m-auto mr-0">
                              @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->count()>0)
                                <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->count(),2,',','.')}}</p>
                              @else
                                <p class="text-2xl font-bold text-gray-600">-</p>
                              @endif
                              
                            </div>
                          </div>
                        </div>
                        @if($filters['etiqueta']) 
                          <div wire:click="checkfobvariedad('{{$filters['variedad']}}')" class="ml-6">
                            <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['ncategoria']==$categoria) bg-gray-300  @endif">
                              <div class="left">
                                <div class="header  text-gray-600   font-semibold text-2xl">{{$filters['etiqueta']}}</div>
                                <div class="desc text-gray-600">Etiqueta - Variedad: {{$filters['variedad']}}</div>
                              </div>
                              <div class="right m-auto mr-0">

                                @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->count()>0)
                                  <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->count(),2,',','.')}}</p>
                                @else
                                  <p class="text-2xl font-bold text-gray-600">-</p>
                                @endif
                                
                              
                              </div>
                            </div>
                          </div>

                              @if ($filters['calibre'])
                                <div wire:click="checkfobmaterial('{{$filters['material']}}')" class="ml-10">
                                  <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['material']==$etiqueta) bg-gray-400  @endif">
                                    <div class="left">
                                      <div class="header @if($filters['material']==$etiqueta) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$filters['calibre']}}</div>
                                      <div class="desc text-gray-600">Calibre - Embalaje: {{$filters['calibre']}}</div>
                                    </div>
                                    <div class="right m-auto mr-0">
                                      @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('n_calibre',$filters['calibre'])->count()>0)
                                        <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('n_calibre',$filters['calibre'])->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('n_calibre',$filters['calibre'])->count(),2,',','.')}}</p>
                                      @else
                                        <p class="text-2xl font-bold text-gray-600">-</p>
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                @if ($filters['material'])
                                    <div wire:click="checkfobmaterial('{{$etiqueta}}')" class="ml-12">
                                      <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['material']==$filters['material']) bg-gray-300  @endif">
                                        <div class="left">
                                          <div class="header @if($filters['material']==$filters['material']) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$filters['material']}}</div>
                                          <div class="desc text-gray-600">Embalaje - Etiqueta: {{$filters['etiqueta']}}</div>
                                        </div>
                                        <div class="right m-auto mr-0">

                                          @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$filters['material'])->count()>0)
                                            <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$filters['material'])->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$filters['material'])->count(),2,',','.')}}</p>
                                          @else
                                            <p class="text-2xl font-bold text-gray-600">-</p>
                                          @endif
                                          
                                      
                                        </div>
                                      </div>
                                    </div>
                                    @foreach ($color_fobs as $color)
                                      @if($color)
                                        <div wire:click="checkfobcolor('{{$color}}')" class="ml-12">
                                          <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['material']==$color) bg-gray-400  @endif">
                                            <div class="left">
                                              <div class="header @if($filters['material']==$color) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$color}}</div>
                                              <div class="desc text-gray-600">Calibre - Embalaje: {{$filters['material']}}</div>
                                            </div>
                                            <div class="right m-auto mr-0">
                                              @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$filters['material'])->where('n_calibre',$filters['calibre'])->count()>0)
                                                <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$filters['material'])->where('n_calibre',$filters['calibre'])->where('color',$color)->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$filters['material'])->where('n_calibre',$filters['calibre'])->where('color',$color)->count(),2,',','.')}}</p>
                                              @else
                                                <p class="text-2xl font-bold text-gray-600">-</p>
                                              @endif
                                            </div>
                                          </div>
                                        </div>
                                      @endif
                                    @endforeach

                                @else
                                    @foreach ($embalaje_fobs as $embalaje)
                                      @if($embalaje)
                                        <div wire:click="checkfobmaterial('{{$embalaje}}')" class="ml-12">
                                          <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['material']==$embalaje) bg-gray-400  @endif">
                                            <div class="left">
                                              <div class="header @if($filters['material']==$embalaje) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$embalaje}}</div>
                                              <div class="desc text-gray-600">Embalaje - Etiqueta: {{$filters['etiqueta']}}</div>
                                            </div>
                                            <div class="right m-auto mr-0">
                                              @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$embalaje)->count()>0)
                                                <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$embalaje)->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('embalaje',$embalaje)->count(),2,',','.')}}</p>
                                              @else
                                                <p class="text-2xl font-bold text-gray-600">-</p>
                                              @endif
                                              
                                            </div>
                                          </div>
                                        </div>
                                      @endif
                                    @endforeach
                                @endif
                              
                             

                              @else
                                
                                @foreach ($calibre_fobs as $calibre)
                                  @if($calibre)
                                    <div wire:click="checkfobcalibre('{{$calibre}}')" class="ml-10">
                                      <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['material']==$calibre) bg-gray-400  @endif">
                                        <div class="left">
                                          <div class="header @if($filters['material']==$calibre) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$calibre}}</div>
                                          <div class="desc text-gray-600">Calibre - Embalaje: {{$filters['material']}}</div>
                                        </div>
                                        <div class="right m-auto mr-0">
                                          @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('n_calibre',$calibre)->count()>0)
                                            <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('n_calibre',$calibre)->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$filters['etiqueta'])->where('n_calibre',$calibre)->count(),2,',','.')}}</p>
                                          @else
                                            <p class="text-2xl font-bold text-gray-600">-</p>
                                          @endif
                                          
                                        </div>
                                      </div>
                                    </div>
                                  @endif
                                @endforeach
                              @endif

                          


                        @else
                          @foreach ($etiqueta_fobs as $etiqueta)
                            @if($etiqueta)
                              <div wire:click="checkfobetiqueta('{{$etiqueta}}')" class="ml-6">
                                <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['ncategoria']==$categoria) bg-gray-300  @endif">
                                  <div class="left">
                                    <div class="header @if($filters['ncategoria']==$categoria) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$etiqueta}}</div>
                                    <div class="desc text-gray-600">Etiqueta - Variedad: {{$filters['variedad']}}</div>
                                  </div>
                                  <div class="right m-auto mr-0">
                                    @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$etiqueta)->count()>0)
                                      <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$etiqueta)->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$filters['variedad'])->where('etiqueta',$etiqueta)->count(),2,',','.')}}</p>
                                    @else
                                      <p class="text-2xl font-bold text-gray-600">-</p>
                                    @endif
                                  
                                  </div>
                                </div>
                              </div>
                            @endif
                          @endforeach
                        @endif

                    @else
                      @foreach ($unique_variedades as $variedad)
                        <div wire:click="checkfobvariedad('{{$variedad->name}}')" class="ml-4">
                          <div class="each flex hover:shadow-lg select-none px-2 py-1 rounded-md border-gray-300 border mb-1 hover:border-gray-500 cursor-pointer @if($filters['ncategoria']==$categoria) bg-gray-200  @endif">
                            <div class="left">
                              <div class="header @if($filters['ncategoria']==$categoria) text-gray-600 @else text-blue-600  @endif  font-semibold text-2xl">{{$variedad->name}}</div>
                              <div class="desc text-gray-600">Variedad</div>
                            </div>
                            <div class="right m-auto mr-0">
                              @if($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$variedad->name)->count()>0)
                                <p class="text-2xl font-bold text-gray-600">{{number_format($fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$variedad->name)->sum('fob_kilo_salida')/$fobsall2->where('categoria',$filters['ncategoria'])->where('n_variedad',$variedad->name)->count(),2,',','.')}}</p>
                              @else
                                <p class="text-2xl font-bold text-gray-600">-</p>
                              @endif
                            </div>
                          </div>
                        </div>
                      @endforeach

                    @endif
                  @endif
                @endforeach
               
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
                      <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Embalaje
                    </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                          Categoria
                          </th>
                          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            FOB
                            </th>

                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              FOB2
                              </th>
                              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                FOB3
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
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->embalaje}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"> {{$fob->categoria}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                  <p class="text-gray-900 whitespace-no-wrap"> {{number_format(floatval($fob->fob_kilo_salida),2,',','.')}}</p>
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                @if ($fobid==$fob->id)
                                    <input wire:model="preciofob2" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                  <p class="text-gray-900 whitespace-no-wrap"> {{number_format($fob->fob_kilo_salida2,2,',','.')}}</p>
                                @endif
                              </td>
                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                @if ($fobid==$fob->id)
                                    <input wire:model="preciofob3" class="w-32 shadow-sm  border-2 border-gray-300 bg-white h-10 px-2 rounded-lg focus:outline-none">
                                @else
                                  <p class="text-gray-900 whitespace-no-wrap"> {{number_format($fob->fob_kilo_salida3,2,',','.')}}</p>
                                @endif
                              </td>
                          
                          

                              <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                @if ($fobid==$fob->id)
                                  <span wire:click='save_fobid' class="cursor-pointer relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
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
                
                    
                  <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
                      @if ($recepcions->count())
                          <div class="">
                              {{$recepcions->links()}}
                          </div>
                  
                      @endif 
                          <div class="flex flex-col">
                              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                  <div class="py-2 align-middle inline-block min-w-full sm:px-2 lg:px-2">
                                      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                          
                                
                                        <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
                                          <thead class="bg-gray-50 rounded-full">
                                              <tr>
                                                  <th class="text-center whitespace-nowrap">Empresa</th>
                                                  <th class="text-center whitespace-nowrap">Tipo Recepción</th>
                                                  <th class="text-center whitespace-nowrap">Número Recepción</th>
                                                  <th class="text-center whitespace-nowrap">Fecha Recepción</th>
                                                  <th class="text-center whitespace-nowrap">Transportista</th>
                                                  <th class="text-center whitespace-nowrap">Exportadora</th>
                                                  <th class="text-center whitespace-nowrap">Folio</th>
                                                  <th class="text-center whitespace-nowrap">Fecha Cosecha</th>
                                                  <th class="text-center whitespace-nowrap">Grupo</th>
                                                  <th class="text-center whitespace-nowrap">Productor</th>
                                                  <th class="text-center whitespace-nowrap">Código Productor</th>
                                                  <th class="text-center whitespace-nowrap">Especie</th>
                                                  <th class="text-center whitespace-nowrap">Variedad</th>
                                                  <th class="text-center whitespace-nowrap">Envase</th>
                                                  <th class="text-center whitespace-nowrap">Categoría</th>
                                                  <th class="text-center whitespace-nowrap">Subcategoría</th>
                                                  <th class="text-center whitespace-nowrap">Calibre</th>
                                                  <th class="text-center whitespace-nowrap">Serie</th>
                                                  <th class="text-center whitespace-nowrap">Cantidad</th>
                                                  <th class="text-center whitespace-nowrap">Peso Neto</th>
                                                  <th class="text-center whitespace-nowrap">Destrucción Tipo</th>
                                                  <th class="text-center whitespace-nowrap">Creación Tipo</th>
                                                  <th class="text-center whitespace-nowrap">Notas</th>
                                                  <th class="text-center whitespace-nowrap">Estado</th>
                                                  <th class="text-center whitespace-nowrap">Tratamiento</th>
                                                  <th class="text-center whitespace-nowrap">Tipo Cobro</th>
                                                  <th class="text-center whitespace-nowrap">Productor Rotulado</th>
                                                  <th class="text-center whitespace-nowrap">CSG Productor Rotulado</th>
                                                  <th class="text-center whitespace-nowrap">Destrucción ID</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              @foreach ($recepcions as $recepcion)
                                              <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->c_empresa ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->tipo_g_recepcion ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->numero_g_recepcion ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->fecha_g_recepcion ? date('d M Y g:i a', strtotime($recepcion->fecha_g_recepcion)) : 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->n_transportista ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->id_exportadora ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->folio ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->fecha_cosecha ? date('d M Y', strtotime($recepcion->fecha_cosecha)) : 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->n_grupo ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->r_productor ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->c_productor ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->n_especie ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->id_variedad ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->c_envase ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->c_categoria ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->t_categoria ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->c_calibre ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->c_serie ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->cantidad ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->peso_neto ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->destruccion_tipo ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->creacion_tipo ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->Notas ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->n_estado ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->N_tratamiento ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->n_tipo_cobro ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->N_productor_rotulado ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->CSG_productor_rotulado ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $recepcion->destruccion_id ?? 'N/A' }}</td>
                                              </tr>
                                              @endforeach
                                          </tbody>
                                        </table>
                                      
                                      
                                  
                                      
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @if ($recepcions->count())
                          <div class="">
                              {{$recepcions->links()}}
                          </div>
                  
                      @endif 
                  </div>

                @endif

                @if ($vista=='Procesos') 
                        
                  <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
                      @if ($procesos->count())
                          <div class="">
                              {{$procesos->links()}}
                          </div>
                  
                      @endif 
                          <div class="flex flex-col">
                              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                  <div class="py-2 align-middle inline-block min-w-full sm:px-2 lg:px-2">
                                      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                          
                                
                                        <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
                                          <thead class="bg-gray-50 rounded-full">
                                              <tr>
                                                  <th class="text-center whitespace-nowrap">Empresa</th>
                                                  <th class="text-center whitespace-nowrap">Tipo Producción</th>
                                                  <th class="text-center whitespace-nowrap">Número Producción</th>
                                                  <th class="text-center whitespace-nowrap">Fecha G Producción</th>
                                                  <th class="text-center whitespace-nowrap">Fecha G Producción 2</th>
                                                  <th class="text-center whitespace-nowrap">Tipo</th>
                                                  <th class="text-center whitespace-nowrap">ID Productor Proceso</th>
                                                  <th class="text-center whitespace-nowrap">Nombre Productor Proceso</th>
                                                  <th class="text-center whitespace-nowrap">Código Productor</th>
                                                  <th class="text-center whitespace-nowrap">Nombre Productor</th>
                                                  <th class="text-center whitespace-nowrap">Tipo Categoría</th>
                                                  <th class="text-center whitespace-nowrap">Código Categoría</th>
                                                  <th class="text-center whitespace-nowrap">Código Embalaje</th>
                                                  <th class="text-center whitespace-nowrap">Calibre</th>
                                                  <th class="text-center whitespace-nowrap">Serie</th>
                                                  <th class="text-center whitespace-nowrap">Etiqueta</th>
                                                  <th class="text-center whitespace-nowrap">Cantidad</th>
                                                  <th class="text-center whitespace-nowrap">Peso Neto</th>
                                                  <th class="text-center whitespace-nowrap">Fecha Recepción</th>
                                                  <th class="text-center whitespace-nowrap">Folio</th>
                                                  <th class="text-center whitespace-nowrap">ID Exportadora</th>
                                                  <th class="text-center whitespace-nowrap">ID Especie</th>
                                                  <th class="text-center whitespace-nowrap">ID Variedad</th>
                                                  <th class="text-center whitespace-nowrap">ID Línea Proceso</th>
                                                  <th class="text-center whitespace-nowrap">Número Guía Recepción</th>
                                                  <th class="text-center whitespace-nowrap">ID Embalaje</th>
                                                  <th class="text-center whitespace-nowrap">Tipo Proceso</th>
                                                  <th class="text-center whitespace-nowrap">Variedad Rotulación</th>
                                                  <th class="text-center whitespace-nowrap">Peso Std Embalaje</th>
                                                  <th class="text-center whitespace-nowrap">Creación Tipo</th>
                                                  <th class="text-center whitespace-nowrap">Notas</th>
                                                  <th class="text-center whitespace-nowrap">Estado</th>
                                                  <th class="text-center whitespace-nowrap">Destrucción Tipo</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              @foreach ($procesos as $proceso)
                                              <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->id_empresa ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->tipo_g_produccion ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->numero_g_produccion ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->fecha_g_produccion ? date('d M Y g:i a', strtotime($proceso->fecha_g_produccion)) : 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ date('d/m/Y', strtotime($proceso->fecha_g_produccion . ' +7 days')) }} </td>
                                                  
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->tipo ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->id_productor_proceso ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->n_productor_proceso ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->c_productor ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->n_productor ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->t_categoria ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->c_categoria ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->c_embalaje ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->c_calibre ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->c_serie ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->c_etiqueta ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->cantidad ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->peso_neto ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->fecha_recepcion ? date('d M Y g:i a', strtotime($proceso->fecha_recepcion)) : 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->folio ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->id_exportadora ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->id_especie ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->id_variedad ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->id_linea_proceso ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->numero_guia_recepcion ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->id_embalaje ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->n_tipo_proceso ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->n_variedad_rotulacion ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->peso_std_embalaje ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->creacion_tipo ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->notas ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->Estado ?? 'N/A' }}</td>
                                                  <td class="text-center whitespace-nowrap">{{ $proceso->destruccion_tipo ?? 'N/A' }}</td>
                                              </tr>
                                              @endforeach
                                          </tbody>
                                      </table>
                                      
                                      
                                      
                                      
                                  
                                      
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @if ($procesos->count())
                          <div class="">
                              {{$procesos->links()}}
                          </div>
                  
                      @endif 
                  </div>

                @endif

                @if ($vista=='Embarques') 
                  <div class="overflow-x-auto">
                      <table class="min-w-full bg-white border border-gray-200">
                          <thead>
                              <tr>
                                  <th class="px-4 py-2 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                                      N° Embarque
                                  </th>
                                  <th class="px-4 py-2 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                                      Fecha Embarque
                                  </th>
                                  <th class="px-4 py-2 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                                      Nave
                                  </th>
                                  <th class="px-4 py-2 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                                      Transporte
                                  </th>
                                  <th class="px-4 py-2 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                                      Fecha Despacho
                                  </th>
                                  <th class="px-4 py-2 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                                      Número Guía Despacho
                                  </th>
                                  <th class="px-4 py-2 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                                      ETD
                                  </th>
                                  <th class="px-4 py-2 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                                      ETA
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($embarques as $item)
                              <tr>
                                  <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">
                                      {{ $item['n_embarque'] ?? 'N/A' }}
                                  </td>
                                  <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">
                                      {{ $item['fecha_embarque'] ?? 'N/A' }}
                                  </td>
                                  <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">
                                      {{ $item['nave'] ?? 'N/A' }}
                                  </td>
                                  <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">
                                      {{ $item['transporte'] ?? 'N/A' }}
                                  </td>
                                  <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">
                                      {{ $item['fecha_despacho'] ?? 'N/A' }}
                                  </td>
                                  <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">
                                      {{ $item['numero_g_despacho'] ?? 'N/A' }}
                                  </td>
                                  <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">
                                      {{ $item['etd'] ?? 'N/A' }}
                                  </td>
                                  <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">
                                      {{ $item['eta'] ?? 'N/A' }}
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                
                  
                @endif

                @if ($vista=="Despachos") 
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ID Pkg Stock Det</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Tipo G Despacho</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Número G Despacho</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Fecha G Despacho</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Fecha Producción</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">R Productor</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Variedad</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Semana</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Categoría</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Exportadora</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Exportadora Embarque</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ID Empresa</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ID Exportadora</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ID Exportadora Embarque</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">C Destinatario</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Destinatario</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Transportista</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Folio</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Número Guía Producción</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">C Productor</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Productor</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ID Especie</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Especie</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ID Variedad</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ID Embalaje</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">C Embalaje</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Embalaje</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Peso Std Embalaje</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">C Categoría</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">T Categoría</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">C Calibre</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Calibre</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">C Serie</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">C Etiqueta</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Cantidad</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Peso Neto</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Variedad Rotulación</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N País Destino</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">N Puerto Destino</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Contenedor</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Precio Unitario</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Tipo Interno</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Creación Tipo</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Destrucción Tipo</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Transporte</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Nota Calidad</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Nave</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Número Embarque</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Número Proceso</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Estado</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ETD</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">ETA</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Semana ETD</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Semana ETA</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Control Fechas</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Duplicado</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($despachos as $despacho)
                                  <tr>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->id_pkg_stock_det }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->tipo_g_despacho }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->numero_g_despacho }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->fecha_g_despacho }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->fecha_produccion }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->r_productor }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_variedad }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->semana }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_categoria }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_exportadora }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_exportadora_embarque }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->id_empresa }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->id_exportadora }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->id_exportadora_embarque }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->c_destinatario }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_destinatario }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_transportista }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->folio }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->numero_guia_produccion }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->c_productor }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_productor }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->id_especie }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_especie }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->id_variedad }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->id_embalaje }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->c_embalaje }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_embalaje }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->peso_std_embalaje }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->c_categoria }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->t_categoria }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->c_calibre }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_calibre }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->c_serie }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->c_etiqueta }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->cantidad }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->peso_neto }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_variedad_rotulacion }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_pais_destino }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_puerto_destino }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->contenedor }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->precio_unitario }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->tipo_interno }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->creacion_tipo }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->destruccion_tipo }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->Transporte }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->nota_calidad }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->n_nave }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->Numero_Embarque }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->N_Proceso }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->Estado }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->etd }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->eta }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->etd_semana }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->eta_semana }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->control_fechas }}</td>
                                      <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">{{ $despacho->duplicado }}</td>
                                  </tr>
                              @endforeach
                          
                          </tbody>
                          
                        </table>
                    </div>
                @endif
              
              </div>
            </div>


          </main>
        </div>
    </div>
  </section>
   
  <script>
    function confirmDeletion() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará todos los registros.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'Por favor, espera mientras se eliminan los registros.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('recepcions_delete').then(() => {
                    Swal.close(); // Cerrar la alerta de "Eliminando" cuando se complete la eliminación
                    Swal.fire(
                        '¡Eliminado!',
                        'Todos los registros han sido eliminados.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error',
                        'Hubo un problema al eliminar los registros.',
                        'error'
                    );
                });
            }
        });
    }
  </script>
  <script>
    function confirmDeletionProceso() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará todos los registros.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'Por favor, espera mientras se eliminan los registros.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('procesos_delete').then(() => {
                    Swal.close(); // Cerrar la alerta de "Eliminando" cuando se complete la eliminación
                    Swal.fire(
                        '¡Eliminado!',
                        'Todos los registros han sido eliminados.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error',
                        'Hubo un problema al eliminar los registros.',
                        'error'
                    );
                });
            }
        });
    }
    function confirmDeletionDespacho() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará todos los registros.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'Por favor, espera mientras se eliminan los registros.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('despachos_delete').then(() => {
                    Swal.close(); // Cerrar la alerta de "Eliminando" cuando se complete la eliminación
                    Swal.fire(
                        '¡Eliminado!',
                        'Todos los registros han sido eliminados.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error',
                        'Hubo un problema al eliminar los registros.',
                        'error'
                    );
                });
            }
        });
    }

    function confirmDeletionEmbarque() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará todos los registros.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'Por favor, espera mientras se eliminan los registros.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('embarques_delete').then(() => {
                    Swal.close(); // Cerrar la alerta de "Eliminando" cuando se complete la eliminación
                    Swal.fire(
                        '¡Eliminado!',
                        'Todos los registros han sido eliminados.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error',
                        'Hubo un problema al eliminar los registros.',
                        'error'
                    );
                });
            }
        });
    }
  </script>

  <script>
    
    function confirmSync() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        Swal.fire({
            title: '¿Iniciar sincronización?',
            text: `Este proceso conectará el sistema de liquidaciones y la base de datos de 'Recepciones' hasta las ${formattedTime} del dia de hoy.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, sincronizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sincronizando...',
                    text: 'Estamos conectando con el API de Greenex. Por favor, espera mientras actualizamos los datos de recepciones.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('production_refresh').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                        '¡Sincronización completada!',
                        'Los datos de recepciones han sido actualizados exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de recepciones. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });
            }
        });
    }

    function confirmSyncProceso() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        Swal.fire({
            title: '¿Iniciar sincronización?',
            text: `Este proceso conectará el sistema de liquidaciones y la base de datos de 'Producción' hasta las ${formattedTime} del dia de hoy.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, sincronizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sincronizando...',
                    text: 'Estamos conectando con el API de Greenex. Por favor, espera mientras actualizamos los datos de Procesos.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('procesos_refresh').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                        '¡Sincronización completada!',
                        'Los datos de procesos han sido actualizados exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de procesos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });
            }
        });
    }

    function confirmSyncDespacho() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        Swal.fire({
            title: '¿Iniciar sincronización?',
            text: `Este proceso conectará el sistema de liquidaciones y la base de datos de 'Despachos' hasta las ${formattedTime} del dia de hoy.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, sincronizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sincronizando...',
                    text: 'Estamos conectando con el API de Greenex. Por favor, espera mientras actualizamos los datos de Despachos.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('despachos_refresh').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                        '¡Sincronización completada!',
                        'Los datos de despachos han sido actualizados exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de procesos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });
            }
        });
    }

    function confirmSyncEmbarque() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        Swal.fire({
            title: '¿Iniciar sincronización?',
            text: `Este proceso conectará el sistema de liquidaciones y la base de datos de 'Embarque' hasta las ${formattedTime} del dia de hoy.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, sincronizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sincronizando...',
                    text: 'Estamos conectando con el API de Greenex. Por favor, espera mientras actualizamos los datos de Embarques.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('embarques_refresh').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                        '¡Sincronización completada!',
                        'Los datos de embarques han sido actualizados exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de procesos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });
            }
        });
    }

  </script>

  <script>
    
    function confirmDeleteBalance() {
      Swal.fire({
            title: '¿Estás seguro?',
            text: "Esto eliminará el balance de masa. Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar mensaje de eliminación en progreso
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'El balance de masa está siendo eliminado, por favor espera.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                @this.call('delete_balancemasas').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                      '¡Eliminación completada!',
                      'El balance de masa ha sido eliminado exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de procesos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });



            }
        });
    }

    function confirmDeleteFob() {
      Swal.fire({
            title: '¿Estás seguro?',
            text: "Esto eliminará el listado de Fobs. Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar mensaje de eliminación en progreso
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'El balance de masa está siendo eliminado, por favor espera.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                @this.call('delete_fobs').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                      '¡Eliminación completada!',
                      'El balance de masa ha sido eliminado exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de procesos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });



            }
        });
    }

    function confirmDeleteBalanceProceso() {
      Swal.fire({
            title: '¿Estás seguro?',
            text: "Esto eliminará el balance de masa. Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar mensaje de eliminación en progreso
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'El balance de masa está siendo eliminado, por favor espera.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                @this.call('delete_balancemasasProceso').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                      '¡Eliminación completada!',
                      'El balance de masa ha sido eliminado exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de procesos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });



            }
        });
    }

    function confirmSyncFechas() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        Swal.fire({
            title: '¿Iniciar sincronización?',
            text: `Este proceso conectará el balance de masa con la base de Embarques para obtener las fechas etd y eta.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, sincronizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sincronizando...',
                    text: 'Estamos conectando la base de datos con la información de Embarques para obtener fecha etd/eta.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Llamar al método Livewire para sincronizar fechas
                @this.call('sync_fechas').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                        '¡Sincronización completada!',
                        'Los datos de procesos han sido actualizados exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de procesos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });
            }
        });
    }

    function confirmSyncFactors() {
      const now = new Date();
      const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

      Swal.fire({
          title: '¿Iniciar sincronización de factores?',
          text: `Este proceso conectará la base de procesos y despachos para obtener los factores de multiplicación.`,
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, sincronizar',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire({
                  title: 'Sincronizando...',
                  text: 'Estamos conectando con el sistema de despachos. Por favor, espera mientras obtenemos los factores de multiplicación.',
                  allowOutsideClick: false,
                  didOpen: () => {
                      Swal.showLoading();
                  }
              });
              
              @this.call('factores_create').then(() => {
                  Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                  Swal.fire(
                      '¡Sincronización completada!',
                      'Los factores de multiplicación han sido obtenidos exitosamente.',
                      'success'
                  );
              }).catch(() => {
                  Swal.close(); // Cerrar la alerta en caso de error
                  Swal.fire(
                      'Error en la sincronización',
                      'Ocurrió un problema al conectar con el sistema de despachos. Por favor, inténtalo de nuevo más tarde.',
                      'error'
                  );
              });
          }
      });
    }

    function confirmSyncFactors2() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        Swal.fire({
            title: '¿Iniciar sincronización de factores?',
            text: `Este proceso conectará el balance de masas con el listado de factores para obtener los factores de multiplicación.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, sincronizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sincronizando...',
                    text: 'Estamos procesando la data. Por favor, espera mientras obtenemos los factores de multiplicación.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('factores_update').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                        '¡Sincronización completada!',
                        'Los factores de multiplicación han sido obtenidos exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de despachos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });
            }
        });
    }

    function confirmSyncFactors3() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        Swal.fire({
            title: '¿Iniciar sincronización de factores?',
            text: `Este proceso conectará el balance de masas con el listado de factores para obtener los factores de multiplicación.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, sincronizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sincronizando...',
                    text: 'Estamos procesando la data. Por favor, espera mientras obtenemos los factores de multiplicación.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                @this.call('factores_update2').then(() => {
                    Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                    Swal.fire(
                        '¡Sincronización completada!',
                        'Los factores de multiplicación han sido obtenidos exitosamente.',
                        'success'
                    );
                }).catch(() => {
                    Swal.close(); // Cerrar la alerta en caso de error
                    Swal.fire(
                        'Error en la sincronización',
                        'Ocurrió un problema al conectar con el sistema de despachos. Por favor, inténtalo de nuevo más tarde.',
                        'error'
                    );
                });
            }
        });
    }

    function processCheckFactors() {
        Swal.fire({
            title: 'Procesando...',
            text: 'Por favor, espera mientras verificamos los factores de multiplicación en el sistema de despachos.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        @this.call('factores_count').then(() => {
            Swal.close(); // Cerrar la alerta de "Procesando" cuando se complete la verificación
            Swal.fire(
                'Verificación completada',
                'Los factores de multiplicación han sido verificados exitosamente.',
                'success'
            );
        }).catch(() => {
            Swal.close(); // Cerrar la alerta en caso de error
            Swal.fire(
                'Error en la verificación',
                'Ocurrió un problema al verificar con el sistema de despachos. Por favor, inténtalo de nuevo más tarde.',
                'error'
            );
        });
    }

  
  </script>
  <script>
    let currentIndex = 0;
    const slides = document.querySelectorAll("#slider > div");
    const totalSlides = slides.length;

    function updateSlidePosition() {
        const slider = document.getElementById("slider");
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlidePosition();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlidePosition();
    }
  </script>


</div>