<div>
    @php
    $cant=0;
    $cant2=0;
        foreach($allsubrecepcions as $recepcion){
            $cant+=$recepcion->peso_neto;
        }
        foreach($allsubrecepcions as $recepcion){
            $cant2+=$recepcion->peso_neto;
        }

    @endphp
    <div class="pb-12">
        <div class="sm:px-6 w-full">
           
        <div class="px-6 py-4 hidden">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese la variedad, especie o lote de la recepción" autocomplete="off">
        </div>

        <div class="hidden mx-2 sm:mx-12 md:mx-14 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3 justify-between  content-center">
            @if ($espec)
                <button wire:click="espec_clean"   class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded content-center" style="background-color: #FF8000;">
                    <p class="text-sm font-medium leading-none text-white">{{$espec->name}}</p>
                </button>
            
                @if ($variedades)
   
                    @if ($varie)
                        <button wire:click="varie_clean"  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                            <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$varie->name}}</p>
                        </button>
                    @else
                        @foreach ($variedades as $variedad)
                            @if ($variedad->especie_id==$espec->id)
                              <div class="flex justify-center">
                                <button wire:click="set_varie({{$variedad->id}})"  class=" w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-2 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                                    <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$variedad->name}}</p>
                                </button>
                              </div>
                            @endif
                        @endforeach
                    @endif
   
                  
                @endif
            @else
                @foreach ($especies as $especie)
                <div class="justify-center ">
                    <button wire:click="set_especie({{$especie->id}})"  class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-4 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                        <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$especie->name}}</p>
                    </button>
                </div>
                @endforeach
                
            @endif
        
        </div>
       
        <div class="sm:flex items-center justify-between mb-2">

            <div class="flex">
                <div class="max-w-7xl bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2 ml-12">
                   <div class="flex items-center justify-center">
                      <div class="flex-shrink-0 text-center">
                         <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($allsubrecepcions->count())}}</span>
                         <h3 class="text-base font-normal text-gray-500">Recepciones</h3>
                      </div>
                     
                   </div>
                </div>
                <div class="max-w-7xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 ml-2">
                    @if ($search)
                        <div class="flex items-center justify-center content-center">
                                    <span class="text-xl sm:text-xl leading-none font-bold text-gray-900 content-center">{{number_format($cant2)}}/</span>
                                    <h3 class="text-base font-normal items-center content-center text-gray-500">{{$search}}</h3>
                               
                        
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
            
            <div class="flex justify-center mb-2 items-center content-center "> 
                <div class="hidden">
                        <a href="{{route('production.refresh',$temp)}}" class="hidden">
                            <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                <p class="text-sm font-medium leading-none text-white">FX IMPORT</p>
                            </button>
                        </a>

                        <button onclick="confirmSync()" class="mt-4 bg-blue-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 px-3 py-3 hover:bg-blue-600 focus:outline-none rounded content-center">
                            <p class="text-sm font-medium leading-none text-white">Sincronizar Recepciones</p>
                        </button>
                        
                     
                        
                    
                        <button onclick="confirmDeletion()" class="mt-4 bg-red-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 px-3 py-3 hover:bg-red-500 focus:outline-none rounded content-center">
                            <p class="text-sm font-medium leading-none text-white">Eliminar Todos Los Registros</p>
                        </button>
                        
                    
                </div>
                
                <select wire:model.live="ctd" class="max-w-xl  mx-2 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-6 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="25" class="text-left px-10">25 </option>
                    <option value="50" class="text-left px-10">50 </option>
                    <option value="100" class="text-left px-10">100 </option>
                    <option value="500" class="text-left px-10">500 </option>
                    
                </select>
                
            </div>
        </div>
                        

        
        </div>
    </div>

   
              
</div>
