<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="bg-white shadow-lg rounded overflow-hidden">
        <div class="px-6 py-4">
            {!! Form::open(['route'=>'costomenus.store']) !!}

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
                            {!! Form::label('slug', 'URL:', ['class' => 'hidden']) !!}
                            {!! Form::text('slug', null , ['readonly'=>'redonly','class' => 'hidden form-input block  mt-1 w-full pl-2 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500','placeholder'=>'www.riderschilenos.cl/tiendas/']) !!}
                         

                        </div>
                </div>
            
                </div>
            </div>

                
            <div class="flex justify-center mb-6">
                <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Crear Menu-Costo</p>
                </button>
            </div>

            {!! Form::close() !!}
        </div>

    </div>

    <script>
        document.getElementById("name").addEventListener('keyup', slugChange);
    
        function slugChange(){
            
            title = document.getElementById("name").value;
            document.getElementById("slug").value = slug(title);
    
        }
    
        function slug (str) {
            var $slug = '';
            var trimmed = str.trim(str);
            $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
            return $slug.toLowerCase();
        }
    
    </script>
</x-app-layout>
