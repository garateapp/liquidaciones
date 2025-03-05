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
                                    @foreach ($unique_variedades as $item)
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
      



</div>
