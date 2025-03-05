<div class="container m-auto px-6 text-gray-500 md:px-12 xl:px-0">
    <div class="mx-auto grid gap-6 md:w-3/4 lg:w-full lg:grid-cols-3">
        <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8">
            <div class="mb-12 space-y-4">
                <h3 class="text-2xl font-semibold text-purple-900">Super Especies</h3>
                @foreach ($superespecies as $item)
                    @if ($item->id==$selectedespecie->id)
                         <div class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-green-600 hover:bg-green-800 text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                            {{$item->name}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                            </svg>
                        </div>
                    @else
                         <div wire:click='updateespecie({{$item->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-gray-400 hover:bg-green-600 text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                            {{$item->name}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                            </svg>
                        </div>
                    @endif
                   
                
                @endforeach
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8">
            <div class="mb-12 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-purple-900">Especies</h3>
                    <h3 class="text-s font-light text-gray-500">{{$selectedespecie->name}}</h3>
                </div>
                @foreach ($especies as $especie)
                        @if ($selectedsubespecie)
                            @if ($selectedsubespecie->id==$especie->id)
                                <div class="py-3 w-full font-semibold rounded-md bg-orange-400 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                    <div class="flex items-center justify-center text-white ">
                                        {{$especie->name}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                            <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                        </svg>
                                    </div>
                                    <div class="flex items-center justify-center mt-2 mx-2">
                                        <select wire:model.live='selectedsubespeciefam'>
                                            <option value="null">N/A</option>
                                            @foreach ($superespecies as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <button wire:click='updatesubespecietype()' class="rounded-md bg-white hover:bg-gray-200 transition-all duration-500 ml-2 py-2 w-full">Actualizar</button>
                                    </div>
                                    <p class="text-center font-bold mx-2 text-white mt-2">Opciones de color:</p>
                                    <div class="flex items-center justify-center mx-2">
                                        <input wire:model.live='color' type="text">
                                        <button wire:click='savecolor()' class="rounded-md bg-white hover:bg-gray-200 transition-all duration-500 ml-2 py-2 w-full">Agregar</button>
                                    </div>
                                    <div class="items-center justify-center mt-2 mx-2">

                                        @foreach ($especie->colorespecies as $item)
                                            <p class="text-white mx-2">{{$item->name}} <span wire:click='delete_colorespecie({{$item->id}})'  class="text-red-500 font-bold ml-2 cursor-pointer">X</span> </p>
                                           
                                        @endforeach
                                    </div>
                                    
                                    

                                </div>
                            @else
                                <div wire:click='updatesubespecie({{$especie->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-orange-400 hover:bg-orange-600 text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                    {{$especie->name}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                        <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                    </svg>
                                </div>
                            @endif
                        @else
                            <div wire:click='updatesubespecie({{$especie->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-orange-400 hover:bg-orange-600 text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                {{$especie->name}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                    <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                </svg>
                            </div>
                        @endif
                @endforeach
                @foreach ($especiesnull as $especie)
                            
                    @if ($selectedsubespecie)
                        @if ($selectedsubespecie->id==$especie->id)
                            <div class="py-3 w-full font-semibold rounded-md bg-yellow-200 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                <div class="flex items-center justify-center text-gray-600 ">
                                    {{$especie->name}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                        <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                    </svg>
                                </div>
                                <div class="flex items-center justify-center mt-2 mx-2">
                                    <select wire:model='selectedsubespeciefam'>
                                        <option value="null">N/A</option>
                                        @foreach ($superespecies as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <button wire:click='updatesubespecietype()' class="rounded-md bg-white hover:bg-gray-200 transition-all duration-500 ml-2 py-2 w-full">Actualizar</button>
                                </div>
                            </div>
                        
                        @else
                            <div wire:click='updatesubespecie({{$especie->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-yellow-100 hover:bg-yellow-200 text-gray-600 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                {{$especie->name}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                    <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                </svg>
                            </div>
                        @endif
                    @else
                        <div wire:click='updatesubespecie({{$especie->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-yellow-100 text-gray-600 hover:bg-yellow-200 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                            {{$especie->name}} (null)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                            </svg>
                        </div>
                    @endif
                
                @endforeach
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8">
            <div class="mb-12 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-purple-900">Variedades</h3>
                    <h3 class="text-s font-light text-gray-500">{{$selectedespecie->name}}</h3>
                </div>
                @foreach ($variedades as $especie)
                        @if ($selectedsubvariedad)
                            @if ($selectedsubvariedad->id==$especie->id)
                                <div class="py-3 w-full font-semibold rounded-md bg-orange-400 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                    <div class="flex items-center justify-center text-white ">
                                        {{$especie->name}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3 mr-2">
                                            <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                        </svg>
                                        {{$especie->bi_color}}
                                    </div>
                                    <div class="flex items-center justify-center mt-2 mx-2">
                                        <select wire:model.live='selectedsubvariedadfam'>
                                            @foreach ($selectedsubespecie->colorespecies as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                               
                                            
                                        </select>
                                        <button wire:click='updatesubvariedadtype()' class="rounded-md bg-white hover:bg-gray-200 transition-all duration-500 ml-2 py-2 w-full">Actualizar</button>
                                    </div>
                                </div>
                               
                            @else
                                <div wire:click='updatesubvariedad({{$especie->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-orange-400 hover:bg-orange-600 text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                    {{$especie->name}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3 mr-2">
                                        <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                    </svg>
                                    {{$especie->bi_color}}
                                </div>
                            @endif
                        @else
                            <div wire:click='updatesubvariedad({{$especie->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-orange-400 hover:bg-orange-600 text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                {{$especie->name}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3 mr-2">
                                    <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                </svg>
                                {{$especie->bi_color}}
                            </div>
                        @endif
                @endforeach
                @foreach ($variedadsnull as $especie)
                            
                    @if ($selectedsubvariedad)
                        @if ($selectedsubvariedad->id==$especie->id)
                            <div class="py-3 w-full font-semibold rounded-md bg-yellow-200 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                <div class="flex items-center justify-center text-gray-600 ">
                                    {{$especie->name}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                        <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                    </svg>
                                </div>
                                <div class="flex items-center justify-center mt-2 mx-2">
                                    <select wire:model='selectedsubvariedadfam'>
                                        <option value="null">N/A</option>
                                        @foreach ($superespecies as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <button wire:click='updatesubespecietype()' class="rounded-md bg-white hover:bg-gray-200 transition-all duration-500 ml-2 py-2 w-full">Actualizar</button>
                                </div>
                            </div>
                        
                        @else
                            <div wire:click='updatesubespecie({{$especie->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-yellow-100 hover:bg-yellow-200 text-gray-600 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                                {{$especie->name}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                    <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                </svg>
                            </div>
                        @endif
                    @else
                        <div wire:click='updatesubvariedad({{$especie->id}})' class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-yellow-100 text-gray-600 hover:bg-yellow-200 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white ">
                            {{$especie->name}} (null)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" h-5 w-5 ms-3">
                                <path fill="currentColor" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                            </svg>
                        </div>
                    @endif
                
                @endforeach
            </div>
        </div>
    </div>
</div>
