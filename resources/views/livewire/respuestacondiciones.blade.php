<div>
     <!-- Mostrar mensaje de confirmación -->
     @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('message2'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            {{ session('message2') }}
        </div>
    @endif

    <h1 class="text-center mt-4 mb-2 font-bold text-2xl">Condiciones del Productor</h1>
                            

    <!-- Tu lógica de condiciones y opciones -->
    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mt-2 mx-2 mb-2">
        @foreach ($condicions as $condicion)
        <div>
            <div class="p-7 rounded-xl bg-amber-100 dark:bg-neutral-700/70">
                <h3 class="text-xl font-semibold mb-7">{{ $condicion->name }}</h3>
                <p class="font-medium leading-7 text-gray-500 mb-6 dark:text-gray-400">Selecciona una alternativa.</p>
    
                @php
                    // Verificar si ya existe una respuesta registrada para esta condición
                    $arrayRespuestasid = $razonsocial->respuestas->pluck('opcion_condicion_id');
                    $arrayOpcionesid = $condicion->opcions->pluck('id');



                    $respuestaSeleccionada=$arrayRespuestasid;

                @endphp

                {{-- comment
                    {{$arrayRespuestasid}}
                    <br>
                    {{$arrayOpcionesid}}
                --}}
               
                   

                    
                        @if ($arrayRespuestasid->intersect($arrayOpcionesid)->isNotEmpty())
                        @php
                             $primerObjeto = $arrayRespuestasid->intersect($arrayOpcionesid)->first();
                        @endphp
                          {{--   Mostrar solo la opción seleccionada  
                            <div class="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-white dark:bg-neutral-900">
                                {{$primerObjeto}}

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5 ms-3">
                                    <path fill="currentColor"
                                        d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                </svg>
                            </div>--}}
                            @foreach ($condicion->opcions as $item)
                                @if ($item->id==$primerObjeto)
                                
                                    <a href="#" wire:click.prevent="eliminarRespuesta({{ $item->id }})"
                                        class="py-3 flex items-center mb-2 justify-center w-full font-semibold rounded-md bg-green-600 hover:bg-green-500 text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white">
                                        {{ $item->text }}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5 ms-3">
                                            <path fill="currentColor"
                                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="#" wire:click.prevent="eliminarRespuesta({{ $primerObjeto}})"
                                        class="py-3 flex items-center mb-2 justify-center w-full font-semibold rounded-md bg-white text-gray-300 transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white">
                                        {{ $item->text }}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5 ms-3">
                                            <path fill="currentColor"
                                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                        </svg>
                                    </a>
                                @endif
                            @endforeach

                        @else
                             {{-- Mostrar todas las opciones si no se ha registrado una respuesta --}}
                            @foreach ($condicion->opcions as $item)
                                <a href="#" wire:click.prevent="registrarRespuesta({{ $item->id }})"
                                    class="py-3 flex items-center mb-2 justify-center w-full font-semibold rounded-md bg-white hover:bg-green-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-purple-500 dark:hover:text-white">
                                    {{ $item->text }}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5 ms-3">
                                        <path fill="currentColor"
                                            d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                    </svg>
                                </a>
                            @endforeach
                        @endif
                   
            </div>
        </div>
    @endforeach
    
    </div>
    
</div>
