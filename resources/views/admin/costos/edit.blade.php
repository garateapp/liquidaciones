<x-app-layout>
    <x-slot name="header">
       
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
                                            'TPC' => 'Tarifa Por Caja',
                                            'MTC' => 'Monto total (Divido por Categoría)',
                                            'MTE' => 'Monto total (Separado por Especie)',
                                            'TPK' => 'Tarifa Por Kilo',
                                            'MTEB' => 'Monto Total (Por número de Embarque)',
                                            'MTEmp' => 'Monto total (Por Empresa)',
                                            'MTT' => 'Monto total (Según tipo de Transporte)'
                                        ];
                                    @endphp
                                  
                                    <div class="block">
                                        {!! Form::label('metodo', 'Método:',['class'=>'text-center']) !!}<br>
                                        {!! Form::select('metodo', $opciones, null, ['class'=>'mt-1 block w-full rounded-lg']) !!}
                                        @error('metodo')
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

            
</x-app-layout>
