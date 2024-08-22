<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="bg-white shadow-lg rounded overflow-hidden">
        <div class="px-6 py-4 mx-auto">
            {!! Form::open(['route'=>'admin.condicionproductors.store']) !!}

            <div class="grid grid-cols-1 md:grid-cols-3 max-w-7xl mx-auto">
                <div>
                    <div class="">
                        <div class="block">
                            {!! Form::label('name', 'Nombre:', ['class'=>'text-center']) !!}<br>
                            {!! Form::text('name', null , ['class' => 'form-control mb-4'.($errors->has('name') ? ' is-invalid' : ''), 'placeholder'=>'Escriba un nombre']) !!}
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="flex justify-between mt-4 w-full items-center">
                        <strong class="flex justify-center items-center">Opciones:</strong>
                        <button type="button" id="add-option" class="items-center text-white focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-2 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                            Añadir opción
                        </button>
                    </div>

                    <br>

                    <div id="options-container">
                        <!-- Initial option -->
                        <div class="flex justify-between items-center mb-2">
                            <input type="text" name="opcions[0][text]" placeholder="Texto" class="form-control mr-2" value="">
                            @error('opcions.0.text')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                            <input type="text" name="opcions[0][value]" placeholder="Valor (opcional)" class="form-control ml-2" value="">
                            @error('opcions.0.value')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="button" id="delete-lastoption" class="items-center text-white focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 px-3 py-2 bg-red-500 hover:bg-red-500 focus:outline-none rounded">
                            Quitar opción
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-6">
                <button class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 px-6 py-3 bg-blue-500 hover:bg-blue-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Crear Condición</p>
                </button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let optionIndex = 1; // Iniciar en 1 porque ya tenemos una opción inicial

            document.getElementById('add-option').addEventListener('click', function () {
                const container = document.getElementById('options-container');
    
                const optionDiv = document.createElement('div');
                optionDiv.classList.add('flex', 'justify-between', 'items-center', 'mb-2');
                optionDiv.setAttribute('data-index', optionIndex);
    
                const textInput = document.createElement('input');
                textInput.type = 'text';
                textInput.name = `opcions[${optionIndex}][text]`;
                textInput.placeholder = 'Texto';
                textInput.classList.add('form-control', 'mr-2');
    
                const valueInput = document.createElement('input');
                valueInput.type = 'text';
                valueInput.name = `opcions[${optionIndex}][value]`;
                valueInput.placeholder = 'Valor (opcional)';
                valueInput.classList.add('form-control', 'ml-2');
    
                optionDiv.appendChild(textInput);
                optionDiv.appendChild(valueInput);
    
                container.appendChild(optionDiv);
    
                optionIndex++;
            });

            document.getElementById('delete-lastoption').addEventListener('click', function () {
                if (optionIndex > 1) { // Solo eliminar si hay más de una opción
                    optionIndex--;
                    const container = document.getElementById('options-container');
                    const lastOption = container.querySelector(`div[data-index="${optionIndex}"]`);
                    if (lastOption) {
                        lastOption.remove(); // Eliminar la última opción
                    }
                } else {
                    alert('No hay opciones para eliminar.');
                }
            });
        });
    </script>

            
</x-app-layout>
