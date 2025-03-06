<div>
    <div wire:loading wire:target="variedadpacking, formcolor">
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
          <div class="max-h-full w-full max-w-sm overflow-y-auto mx-auto sm:rounded-2xl bg-white border-2 border-gray-200 shadow-xl">
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
      </div>

    @if ($costomenus->where('name',$costomenu->name)->count()>0)
        @if ($costomenus->where('name',$costomenu->name)->first()->costos->where('metodo', '!=', 'null')->count()>0)
        <div x-data="{ openTab: {{$costomenus->where('name',$costomenu->name)->first()->costos->where('metodo', '!=', 'null')->first()->id}} }" class="px-2">
            <div class="max-w-md mx-auto">
                <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md">
                @foreach ($costomenus->where('name',$costomenu->name)->first()->costos->where('metodo', '!=', 'null') as $menu)
                    <button x-on:click="openTab = {{$menu->id}}" :class="{ 'bg-blue-600 text-white': openTab === {{$menu->id}} }" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">{{$menu->name}}</button>
                @endforeach
                
                </div>
            </div>
            @foreach ($costomenus->where('name',$costomenu->name)->first()->costos->where('metodo', '!=', 'null') as $menu)
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
                    @case('TPCL')

                            <h1 x-show="openTab === {{$menu->id}}" class="ml-4 text-center">Agregar Variedades por Color:</h1>
                            <div x-show="openTab === {{$menu->id}}" class="grid grid-cols-3 gap-x-4 items-center mb-6">
                                <div>
                                   
                                <select wire:model.live="formcolor" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="" class="text-center">Selecciona un color</option>
                                        @foreach ($temporada->especie->colorespecies as $item)
                                            <option value="{{$item->name}}" class="text-center">{{$item->name}}</option>
                                        @endforeach
                                
                                    
            
                                </select>
                                </div>
            
                                <select wire:model.live="variedadpacking" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="" class="text-center">Selecciona una variedad</option>
                                    @foreach ($unique_variedades->filter(function ($item) use ($temporada) {
                                        return empty($item->bi_color) || !$temporada->especie->colorespecies->contains('name', $item->bi_color);
                                    }) as $item)
                                        <option value="{{$item->id}}" class="text-center">{{$item->name}}</option>
                                    @endforeach
                                    
                                
                                    
            
                                </select>
            
                                
                                <button wire:click="variedadcolor_add" class="focus:ring-2 focus:ring-offset-2 focus:ring-green-300 text-sm leading-none text-green-600 py-3 px-5 bg-green-600 rounded hover:bg-green-500 focus:outline-none">
            
                                    <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                                    Agregar
                                        
                                    </h1>
                                </button>
                            </div>
                            @php
                                $kgredcolor=0;
                                $kgbicolor=0;
                            @endphp
                    
                    
                            @php
                            $kgsexportacion=0;
                            @endphp
                            
                            <table x-show="openTab === {{$menu->id}}" class="min-w-full leading-normal">
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
                                                @if ($item->bi_color==$color->name)
                                                    {{$item->name}}<br>
                                                @endif
                                            @endforeach
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                            {{number_format($kgredcolor)}} kgs
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm ">
                                                @if ($temporada->costotarifacolors->where('color',$color->name)->count())
                                                    {{$temporada->costotarifacolors->where('color',$color->name)->first()->tarifa_kg}} <span onclick="confirmDeletionCostotarifacolor({{ $temporada->costotarifacolors->where('color', $color->name)->first()->id }})"
                                                        class="text-red-500 font-bold cursor-pointer">
                                                      X
                                                  </span>
                                                  
                                                @else
                                                    <div class="flex items-center my-auto">

                                                        <input type="number" step="0.01" min="0"
                                                            wire:model.defer="tarifas.{{ $color->name }}"
                                                            wire:keydown.enter="saveTarifa('{{ $color->name }}', {{ $menu->id }})"
                                                            class="w-20 shadow-sm border-2 border-gray-300 bg-white h-7 px-2 rounded-lg focus:outline-none">

                                                        <!-- Botón para guardar tarifa -->
                                                        <button wire:click="saveTarifa('{{ $color->name }}', {{ $menu->id }})"
                                                                class="ml-2 cursor-pointer relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">Guardar</span>
                                                        </button>
                                                        
                                                    </div>
                                                @endif
                                               
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
      

    <script>
        function confirmDeletionCostotarifacolor(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará este registro.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // Azul para confirmar
                cancelButtonColor: '#d33', // Rojo para cancelar
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar el loading mientras se elimina
                    Swal.fire({
                        title: 'Eliminando...',
                        text: 'Por favor, espera mientras se elimina el registro.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
    
                    // Llamada al método Livewire con el ID
                    @this.call('destroy_costotarifacolor', id).then(() => {
                        // Cerrar el loading después de la eliminación
                        Swal.close();
                        Swal.fire({
                            title: '¡Eliminado!',
                            text: 'El registro ha sido eliminado.',
                            icon: 'success', // Icono de éxito
                            confirmButtonColor: '#28a745', // Verde para el botón de "OK"
                        });
                    }).catch(() => {
                        // En caso de error
                        Swal.close();
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al eliminar el registro.',
                            icon: 'error',
                            confirmButtonColor: '#d33', // Rojo para el error
                        });
                    });
                }
            });
        }
    </script>
    
</div>
