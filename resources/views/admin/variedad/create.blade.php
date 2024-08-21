<x-app-layout>
    <x-slot name="header">
       
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

            
</x-app-layout>
