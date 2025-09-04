<x-app-layout>
    <x-slot name="header">
        <style>
            #condicionproductor_block {
                display: none;
            }
        </style>
    </x-slot>

    
    <div class="bg-white shadow-lg rounded overflow-hidden">
        <div class="px-6 py-4">
            {!! Form::open(['route'=>'admin.costos.store']) !!}

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div>
                        <div class="form-group flex justify-center">
                            <div class="block">
                                {!! Form::label('name', 'Nombre:',['class'=>'text-center']) !!}<br>
                                {!! Form::text('name', null , ['class' => 'form-control mb-4'.($errors->has('name') ? ' is-invalid' : ''),'placeholder'=>'Escriba un nombre']) !!}
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
            
                                    </span>
                                @enderror
                            </div>
                            <div class="block">
                                {!! Form::label('costomenu_id', 'Menú:',['class'=>'text-center']) !!}<br>
                                {!! Form::select('costomenu_id', $opcionesmenu, null, ['class'=>'mt-1 block w-full rounded-lg mb-4']) !!}
                                @error('costomenu_id')
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
                                        'MPC' => 'Monto por Condición (Según Productor)'
                                    ];
                                @endphp
                            <div class="block">
                                {!! Form::label('metodo', 'Método:',['class'=>'text-center']) !!}<br>
                                {!! Form::select('metodo', $opciones, null, ['class'=>'mt-1 block w-full rounded-lg mb-4']) !!}
                                @error('metodo')
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
                                <p><strong>No especificado:</strong> Selecciona un método para ver su descripción.</p>
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
                            <input type="checkbox" id="exp" name="exp" value="1">
                            <label for="exp">Exportación</label>
                        
                        </div>
                    
                        <div>
                            <input type="checkbox" id="mi" name="mi" value="1">
                            <label for="mi">Mercado Interno:</label>
                        
                        </div>
                    
                        <div>
                            <input type="checkbox" id="com" name="com" value="1">
                            <label for="com">Comercial:</label>
                        
                        </div>
                    </div>
                    </div>
                </div>
            </div>

                
            <div class="flex justify-center mt-6">
                <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Crear Costo</p>
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
                    condicionBlock.style.display = 'flex';
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
    const metodoSelect   = document.getElementById('metodo');
    const condicionBlock = document.getElementById('condicionproductor_block');
    const explicacionDiv = document.getElementById('metodo_explicacion');

    // --- Mostrar/ocultar "Condición" si es MPC ---
    function toggleCondicionBlock() {
        if (!metodoSelect) return;
        if (metodoSelect.value === 'MPC') {
            condicionBlock.style.display = 'block'; // usa 'block' para que respete el layout
        } else {
            condicionBlock.style.display = 'none';
        }
    }

    // --- Explicaciones por método ---
    const explicaciones = {
        'TPT':  '<p><strong>Tarifa Por Transporte:</strong> Calcula el costo según el tipo o tramo de transporte utilizado.</p>',
        'TPCL': '<p><strong>Tarifa Por Color:</strong> Determina el costo en función de la clasificación por color.</p>',
        'TPE':  '<p><strong>Tarifa Por Embalaje:</strong> Asigna costo según tipo y cantidad de embalaje.</p>',
        'TPC':  '<p><strong>Tarifa Por Caja:</strong> Calcula en base al número de cajas.</p>',
        'TPK':  '<p><strong>Tarifa Por Kilo:</strong> Costo proporcional al peso total (kg).</p>',
        'MTC':  '<p><strong>Monto total (Dividido por Categoría):</strong> Distribuye un monto global entre categorías.</p>',
        'MTE':  '<p><strong>Monto total (Separado por Especie):</strong> Separa el monto por especie.</p>',
        'MTEB': '<p><strong>Monto Total (Por número de Embarque):</strong> Reparte por embarque.</p>',
        'MTEmp':'<p><strong>Monto total (Por Empresa):</strong> Asigna un monto por empresa.</p>',
        'MTT':  '<p><strong>Monto total (Según tipo de Transporte):</strong> Agrupa y asigna según el transporte.</p>',
        'MPC':  '<p><strong>Monto por Condición (Según Productor):</strong> Calcula según la condición seleccionada del productor.</p>',
        'PSF':  '<p><strong>Porcentaje sobre el FOB:</strong> Aplica un % sobre el valor FOB.</p>',
        'null': '<p><strong>No especificado:</strong> Selecciona un método para ver su descripción.</p>'
    };

    function updateExplicacion() {
        if (!metodoSelect || !explicacionDiv) return;
        const value = metodoSelect.value || 'null';
        explicacionDiv.innerHTML = explicaciones[value] || explicaciones['null'];
    }

    // Inicializar
    toggleCondicionBlock();
    updateExplicacion();

    // Escuchar cambios
    if (metodoSelect) {
        metodoSelect.addEventListener('change', function () {
            toggleCondicionBlock();
            updateExplicacion();
        });
    }
});

// ----- (Tu script de slug se mantiene igual) -----
document.getElementById("name").addEventListener('keyup', slugChange);

function slugChange(){
    const title = document.getElementById("name").value;
    const slugInput = document.getElementById("slug");
    if (!slugInput) return; // por si no existe en esta vista
    slugInput.value = slug(title);
}

function slug (str) {
    var $slug = '';
    var trimmed = str.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-')
                   .replace(/-+/g, '-')
                   .replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}
</script>

            
</x-app-layout>
