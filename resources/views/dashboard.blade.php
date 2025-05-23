<x-app-layout>
  

    <div class="pb-12 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg mb-4">

                    <!-- Contenido de la Landing Page -->
                <div class="bg-white">
                    <div class="flex justify-between items-center py-4 px-5">
                        <div class="w-3/4">
                            <h2 class="text-5xl font-semibold text-gray-800">Lista de Productores</h2>
                            <h3 class="text-xl font-semibold text-gray-600 mt-4">¡Revisa el historial y estadistica de cada uno de los productores!</h3>
                            <p class="text-gray-600 mt-4">El sistema de Liquidaciones de Greenex permite llevar un historial de temporadas de cada uno de los productores con sus respectivas condiciones y estadisticas por liquidación.</p>
                            <a href="{{route('razonsocial.index')}}">
                                <button class="bg-gray-600 mt-4 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Ver Listado de Productores</button>
                              </a>
                        </div>
                        <div class="w-1/4">
                            <img src="{{asset('image/productorespng.png')}}" alt="Imagen simbolica de los productores" class="w-full h-auto p-10">
                        </div>
                    </div>
                </div>

            
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

          

              @livewire('temporadas-index')
                
            </div>
        </div>
    </div>
</x-app-layout>
