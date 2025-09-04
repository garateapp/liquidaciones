<x-app-layout>
    <x-slot name="header">
        <style>
            #condicionproductor_block {
                display: none;
            }
        </style>
    </x-slot>
    <div class="bg-white shadow-lg rounded overflow-hidden">

        @if(session('info'))
            <div class="flex justify-center">
                <div class="justify-center">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded justify-center w-full flex" role="alert">
                    <strong class="font-bold mx-2">Exito!</strong>
                    <span class="flex">{{session('info')}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
                </div>
            </div>
        @endif

   
        <div class="px-6 py-4">
            {!! Form::model($costo, ['route'=>['admin.costos.update',$costo],'method' => 'put']) !!}

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div>
                            <div class="form-group flex justify-center">
                                <div>
                                    <div class="block">
                                        {!! Form::label('name', 'Nombre:',['class'=>'text-center']) !!}<br>
                                        {!! Form::text('name', null , ['class' => 'form-control mb-4'.($errors->has('name') ? ' is-invalid' : ''),'placeholder'=>'Escriba un nombre']) !!}
                                        @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                    
                                            </span>
                                        @enderror
                                    </div>
                                    @php
                                       $opciones = [
                                        'null'=> 'NULL',
                                        'TPT' => 'Tarifa Por Transporte',
                                        'TPCL' => 'Tarifa Por Color',
                                        'TPE' => 'Tarifa Por Embalaje',
                                        'TPC' => 'Tarifa Por Caja',
                                        'TPK' => 'Tarifa Por Kilo',
                                        'MTC' => 'Monto total (Divido por Categoría)',
                                        'MTE' => 'Monto total (Separado por Especie)',
                                        'MTEB' => 'Monto Total (Por número de Embarque)',
                                        'MTEmp' => 'Monto total (Por Empresa)',
                                        'MTT' => 'Monto total (Según tipo de Transporte)',
                                        'MPC' => 'Monto por Condición (Según Productor)',
                                        'PSF' => 'Porcentaje sobre el Fob'
                                    ];
                                    @endphp
                                    <div class="block">
                                        {!! Form::label('costomenu_id', 'Menú:',['class'=>'text-center']) !!}<br>
                                        {!! Form::select('costomenu_id', $opcionesmenu, null, ['class'=>'mt-1 block w-full rounded-lg mb-4']) !!}
                                        @error('costomenu_id')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                    
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="block">
                                        {!! Form::label('metodo', 'Método:',['class'=>'text-center']) !!}<br>
                                        {!! Form::select('metodo', $opciones, null, [
                                            'id' => 'metodo',
                                            'class'=>'mt-1 block w-full rounded-lg mb-4'
                                        ]) !!}
                                        @error('metodo')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Bloque explicativo dinámico --}}
                                    <div id="metodo_explicacion" class="p-4 bg-gray-100 rounded border border-gray-300 text-sm text-gray-700">
                                        @switch($costo->metodo)
                                            @case('TPT')
                                                <p><strong>Tarifa Por Transporte:</strong> El costo se calcula según el tipo de transporte utilizado.</p>
                                                @break
                                            @case('TPCL')
                                                <p><strong>Tarifa Por Color:</strong> El costo se determina por los colores involucrados en el proceso.</p>
                                                @break
                                            @case('TPE')
                                                <p><strong>Tarifa Por Embalaje:</strong> El costo se asigna de acuerdo al tipo y cantidad de embalaje.</p>
                                                @break
                                            @case('TPC')
                                                <p><strong>Tarifa Por Caja:</strong> El costo se calcula en función de la cantidad de cajas utilizadas.</p>
                                                @break
                                            @case('TPK')
                                                <p><strong>Tarifa Por Kilo:</strong> El costo se define por el peso total en kilos.</p>
                                                @break
                                            @case('MTC')
                                                <p><strong>Monto total (Dividido por Categoría):</strong> Se distribuye el monto total entre las categorías.</p>
                                                @break
                                            @case('MTE')
                                                <p><strong>Monto total (Separado por Especie):</strong> El monto se divide según la especie.</p>
                                                @break
                                            @case('MTEB')
                                                <p><strong>Monto Total (Por número de Embarque):</strong> El monto se reparte por cada embarque realizado.</p>
                                                @break
                                            @case('MTEmp')
                                                <p><strong>Monto total (Por Empresa):</strong> Se asigna un monto específico a cada empresa.</p>
                                                @break
                                            @case('MTT')
                                                <p><strong>Monto total (Según tipo de Transporte):</strong> Se calcula según el transporte utilizado.</p>
                                                @break
                                            @case('MPC')
                                                <p><strong>Monto por Condición (Según Productor):</strong> El cálculo depende de las condiciones establecidas por productor.</p>
                                                @break
                                            @case('PSF')
                                                <p><strong>Porcentaje sobre el FOB:</strong> El costo corresponde a un porcentaje sobre el valor FOB.</p>
                                                @break
                                            @default
                                                <p><strong>No especificado:</strong> Selecciona un método para ver su descripción.</p>
                                        @endswitch
                                    </div>


                                    <div class="block" id="condicionproductor_block">
                                        {!! Form::label('condicionproductor_id', 'Condición:',['class'=>'text-center']) !!}<br>
                                        {!! Form::select('condicionproductor_id', $opcionescondiciones, null, ['class'=>'mt-1 block w-full rounded-lg mb-4']) !!}
                                        @error('condicionproductor_id')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                  
                                </div>
                            </div>
                    </div>
                    <div>
                    <strong class="flex justify-center">Aplica para:</strong>
                    <br>

                        <div class="grid grid-cols-2">

                            <div>
                            @error('permissions')
                                    <small class="text-danger">
                                        <strong>{{$message}}</strong>
                        
                                    </small>
                            @enderror
                    
                            @foreach($especies as $permission)
                                <div class="">
                                    <label class="">
                                        {!! Form::checkbox('superespecies[]', $permission->id ,null, ['class' => 'mr-1']) !!}
                                        {{$permission->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <!-- Checkboxes -->
                            <div>
                                {!! Form::checkbox('exp', 1, $costo->exp, ['id' => 'exp']) !!}
                                {!! Form::label('exp', 'Exportación') !!}
                            </div>
            
                            <div>
                                {!! Form::checkbox('mi', 1, $costo->mi, ['id' => 'mi']) !!}
                                {!! Form::label('mi', 'Mercado Interno') !!}
                            </div>
            
                            <div>
                                {!! Form::checkbox('com', 1, $costo->com, ['id' => 'com']) !!}
                                {!! Form::label('com', 'Comercial') !!}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                    
                <div class="flex justify-center mt-6">
                    <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                        <p class="text-sm font-medium leading-none text-white">Actualizar Costo</p>
                    </button>
                </div>

            {!! Form::close() !!}
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const metodoSelect = document.getElementById('metodo');
            const condicionBlock = document.getElementById('condicionproductor_block');
    
            function toggleCondicionBlock() {
                if (metodoSelect.value === 'MPC') {
                    condicionBlock.style.display = 'block';
                } else {
                    condicionBlock.style.display = 'none';
                }
            }
    
            // Ejecutar al cargar la página
            toggleCondicionBlock();
    
            // Escuchar cambios
            metodoSelect.addEventListener('change', toggleCondicionBlock);
        });
    </script> 
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const metodoSelect = document.getElementById('metodo');
        const explicacionDiv = document.getElementById('metodo_explicacion');

        const explicaciones = {
            'TPT': '<p><strong>Tarifa Por Transporte:</strong> El costo se calcula según el tipo de transporte utilizado.</p>',
            'TPCL': '<p><strong>Tarifa Por Color:</strong> El costo se determina por los colores involucrados en el proceso.</p>',
            'TPE': '<p><strong>Tarifa Por Embalaje:</strong> El costo se asigna de acuerdo al tipo y cantidad de embalaje.</p>',
            'TPC': '<p><strong>Tarifa Por Caja:</strong> El costo se calcula en función de la cantidad de cajas utilizadas.</p>',
            'TPK': '<p><strong>Tarifa Por Kilo:</strong> El costo se define por el peso total en kilos.</p>',
            'MTC': '<p><strong>Monto total (Dividido por Categoría):</strong> Se distribuye el monto total entre las categorías.</p>',
            'MTE': '<p><strong>Monto total (Separado por Especie):</strong> El monto se divide según la especie.</p>',
            'MTEB': '<p><strong>Monto Total (Por número de Embarque):</strong> El monto se reparte por cada embarque realizado.</p>',
            'MTEmp': '<p><strong>Monto total (Por Empresa):</strong> Se asigna un monto específico a cada empresa.</p>',
            'MTT': '<p><strong>Monto total (Según tipo de Transporte):</strong> Se calcula según el transporte utilizado.</p>',
            'MPC': '<p><strong>Monto por Condición (Según Productor):</strong> El cálculo depende de las condiciones establecidas por productor.</p>',
            'PSF': '<p><strong>Porcentaje sobre el FOB:</strong> El costo corresponde a un porcentaje sobre el valor FOB.</p>',
            'null': '<p><strong>No especificado:</strong> Selecciona un método para ver su descripción.</p>'
        };

        metodoSelect.addEventListener('change', function () {
            const value = metodoSelect.value;
            explicacionDiv.innerHTML = explicaciones[value] || explicaciones['null'];
        });
    });
</script>

</x-app-layout>
