<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    <div class="bg-white shadow-lg rounded overflow-hidden">

        @if(session('info'))
            <div class="flex justify-center">
                <div class="justify-center">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded justify-center w-full flex" role="alert">
                    <strong class="font-bold mx-2">Exito!</strong>
                    <span class="flex">{{session('info')}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
                </div>
            </div>
        @endif

   
        <div class="px-6 py-4">
            {!! Form::model($condicionproductor, ['route' => ['admin.condicionproductors.update', $condicionproductor], 'method' => 'put']) !!}
            <div class="grid grid-cols-1 md:grid-cols-3 max-w-7xl mx-auto">
                <div>
                    <div class="">
                        <div class="block">
                            {!! Form::label('name', 'Nombre:', ['class' => 'text-center']) !!}<br>
                            {!! Form::text('name', null , ['class' => 'form-control mb-4'.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Escriba un nombre']) !!}
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <strong class="flex justify-center">Opciones:</strong>
                    <br>
                
                    <div id="options-container">
                        @foreach($condicionproductor->opcions as $index => $opcion)
                            <div class="flex justify-between items-center mb-2">
                                {!! Form::text('opcions['.$loop->index.'][text]', old('opcions.'.$loop->index.'.text', $opcion->text), ['class' => 'form-control mr-2']) !!}
                                {!! Form::text('opcions['.$loop->index.'][value]', old('opcions.'.$loop->index.'.value', $opcion->value), ['class' => 'form-control ml-2']) !!}
                                
                                <button type="button" class="delete-option text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center" data-index="{{ $loop->index }}">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </span>
                                </button>
                               
                            </div>
                        @endforeach
                    </div>
                  
                    <div class="flex justify-center mt-4">
                        <button type="button" id="add-option" class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">
                            Añadir opción
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center mt-6">
                <button class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Actualizar</p>
                </button>
            </div>
        {!! Form::close() !!}
        
           
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var optionIndex = {{ $condicionproductor->opcions->count() }};
    
            document.getElementById('add-option').addEventListener('click', function() {
                var container = document.getElementById('options-container');
                var newOption = document.createElement('div');
                newOption.className = 'flex justify-between items-center mb-2';
                newOption.setAttribute('data-index', optionIndex);
                newOption.innerHTML = `
                    <input type="text" name="opcions[${optionIndex}][text]" placeholder="Texto" class="form-control mr-2">
                    <input type="text" name="opcions[${optionIndex}][value]" placeholder="Valor (opcional)" class="form-control ml-2">
                    <button type="button" class="delete-option text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center" data-url="/path/to/delete/${optionIndex}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </span>
                    </button>
                `;
                container.appendChild(newOption);
                optionIndex++;
            });
    
            document.getElementById('options-container').addEventListener('click', function(event) {
                if (event.target && event.target.matches('.delete-option')) {
                    var confirmed = confirm('¿Está seguro de que desea eliminar esta opción?');
                    if (confirmed) {
                        var button = event.target;
                        var url = button.getAttribute('data-url');
    
                        fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                var optionDiv = button.closest('div[data-index]');
                                if (optionDiv) {
                                    optionDiv.remove();
                                }
                            } else {
                                alert('Error al eliminar la opción.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al eliminar la opción.');
                        });
                    }
                }
            });
        });
    </script>
    

</x-app-layout>
