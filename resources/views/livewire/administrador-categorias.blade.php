<div>
    
    <div class="max-w-7xl items-center mx-auto mt-12">
        <div class="md:mb-0 mb-8 md:text-left text-center">
            <h2 class="font-medium dark:text-white text-xl leading-5 text-gray-800 lg:mb-2 mb-4 text-center">Categorias</h2>
            
                <!-- Input para seleccionar el archivo -->
                
        
                <!-- Botón para subir -->
                <!-- Botón para subir y spinner de carga -->
               
                <div class="flex justify-between">
                    <div>
                        <form wire:submit.prevent="importExcel" class="space-y-6">
                            <div class="flex justify-center  items-center space-x-4 my-auto">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 hidden">Seleccionar archivo:</label>
                                    <input type="file" wire:model="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('file') 
                                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> 
                                    @enderror
                                </div>
                                <!-- Indicador de carga -->
                                <div wire:loading wire:target="file" class="flex items-center my-auto">
                                    <svg class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                    </svg>
                                    <span class="ml-2 text-sm text-gray-600">Cargando...</span>
                                </div>
                                <!-- Botón para subir archivo -->
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            wire:loading.attr="disabled" wire:target="file">
                                        Subir Excel
                                    </button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form wire:submit.prevent="importExcel2" class="space-y-6">
                            <div class="flex justify-center  items-center space-x-4 my-auto">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 hidden">Seleccionar archivo:</label>
                                    <input type="file" wire:model="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('file') 
                                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> 
                                    @enderror
                                </div>
                                <!-- Indicador de carga -->
                                <div wire:loading wire:target="file" class="flex items-center my-auto">
                                    <svg class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                    </svg>
                                    <span class="ml-2 text-sm text-gray-600">Cargando...</span>
                                </div>
                                <!-- Botón para subir archivo -->
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            wire:loading.attr="disabled" wire:target="file">
                                        Subir Excel
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
                        
               
          
              

        
                <!-- Mensaje de éxito -->
                @if (session()->has('message'))
                    <div class="text-green-500 text-sm text-center mt-4">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('message2'))
                    <div class="text-red-500 text-sm text-center mt-4">
                        {{ session('message2') }}
                    </div>
                @endif
           
        </div>

        <div class="overflow-x-auto mt-8">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">ID Sistema</th>
                        <th class="px-4 py-2 text-left">Código</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Tipo</th>
                        <th class="px-4 py-2 text-left">Grupo</th>
                        <th class="px-4 py-2 text-left">CAP</th>
                        <th class="px-4 py-2 text-left">MONEDA</th>
                        <th class="px-4 py-2 text-left">UNIDAD<br>MULTIPLICADORA</th>
                        <th class="px-4 py-2 text-left">Acciones</th> <!-- Columna para botones -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $item->id_sistema }}</td>
                            <td class="px-4 py-2">{{ $item->codigo }}</td>
                            <td class="px-4 py-2">{{ $item->nombre }}</td>
                            <td class="px-4 py-2">{{ $item->tipo }}</td>
                            <td class="px-4 py-2">{{ $item->grupo }}</td>
                            <td class="px-4 py-2">{{ $item->cap }}</td>
                            <td class="px-4 py-2">{{ $item->moneda }}</td>
                            <td class="px-4 py-2">{{ $item->unidad_multiplicadora }}</td>
                            <td class="px-4 py-2">
                                <!-- Botones de editar y eliminar -->
                                <a href="{{ route('admin.categorias.edit', $item->id) }}" class="text-blue-500 hover:underline">Editar</a>

                                <form action="{{ route('admin.categorias.destroy', $item) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>

</div>
