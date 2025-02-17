<x-app-layout>

    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 ">

    @if(session('info'))
    <div class="flex justify-center">
        <div class="justify-center">
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded justify-center w-full flex" role="alert">
            <strong class="font-bold mx-2">Exito!</strong>
            <span class="flex">{{session('info')}}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
              <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
          </div>
        </div>
    </div>
      @endif

      <div class="py-2 bg-gray-50 overflow-hidden">
         <div class="container m-auto px-6 space-y-8 text-gray-500 md:px-12">
             <div>
               <a href="{{Route('configuracion')}}">
                 <span class="text-gray-600 text-lg font-semibold">Configurador de Costos</span>
               </a>
                 <h2 class="mt-4 text-2xl text-gray-900 font-bold md:text-4xl">Las configuración que sean modificadas a continuación afectara a todas las nuevas liquidaciones que sean creadas en el futuro.</h2>
             
         
  
               <div class="flex justify-end mb-6 -mt-4">
                  <a href="{{route('admin.costos.create')}}">
                     <button  class="ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                        <p class="text-sm font-medium leading-none text-white">Crear Nuevo Costo</p>
                     </button>
                  </a>
               </div>
            </div>

        <x-table-responsive>   
           <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
    
              <thead class="bg-gray-50 rounded-full">
                  <th>ID</th>
                  <th>Costo</th>
                  @if ($superespecies->count()>0)
                     @foreach ($superespecies as $item)
                        <th>{{$item->name}}</th>
                     @endforeach
                  @endif
                
                
                 <th>Estado</th>
                 <th>Edit</th>
              
               
                
              </thead>
              <tbody>
             
    
                  

                 
            @forelse ($costos as $costo)
                       
               <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                 <td class="text-center">
                    <p class="text-base font-medium leading-none text-gray-700 mr-2">

                    
                                                  {{$costo->id}}
                    
                          
                    </p>
                 
                 </td>
                  <td class="text-center">
                     <p class="text-base font-medium leading-none text-gray-700 mr-2">

                     
                                                   {{$costo->name}}
                     
                           
                     </p>
                  
                  </td>
                  @if ($superespecies->count()>0)
                     @foreach($superespecies as $permission)
                        @if ($costo->superespecies->contains($permission->id))
                           <td class="text-center">
                              <label class="">
                                 <input type="checkbox" checked disabled readonly>
                                 {{$permission->name}}
                              </label>
                           </td>
                        @else
                           <td class="text-center">
                              <label class="">
                                 <input type="checkbox" disabled readonly>
                                 {{$permission->name}}
                              </label>
                           </td>
                        @endif
                     @endforeach
                  @endif

                 <td width='120px'> 
                    <a href="{{route('admin.costos.edit', $costo)}}">
                       <button class="ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                          <p class="text-sm font-medium leading-none text-white">EDIT</p>
                      </button>
                    </a>
                 </td>
                 <td width='120px'>
                    <form action="{{route('admin.costos.destroy', $costo)}}" method="POST">
                        @method('delete')
                        @csrf

                        <button class="btn btn-danger" type='submit'>Eliminar</button>
                    </form>
                 </td>
                  
                
               </tr>
              
         
            @empty

       
               {{-- comment  --}}    
               <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                 <td class="text-center">
                    <p class="text-base font-medium leading-none text-gray-700 mr-2">

                    
                      -
                    
                          
                    </p>
                 
                 </td>
                  <td class="text-center">
                     <p class="text-base font-medium leading-none text-gray-700 mr-2">

                     
                       No hay ningun costo registrado
                     
                           
                     </p>
                  
                  </td>
                
               </tr>
           
             
            @endforelse
                     
               
              
                
               
              
              
              </tbody>
           </table>
        </x-table-responsive>


        <x-table-responsive>   
         <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
  
            <thead class="bg-gray-50 rounded-full">
                <th>ID</th>
                <th>Costo</th>
                <th>Metodo</th>
               <th>Exportación</th>
               <th>Mercado Interno</th>
               <th>Comercial</th>
              
             
               <th>Edit</th>
            
             
              
            </thead>
            <tbody>
           
  
                

               
          @forelse ($costos as $costo)
                     
             <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
               <td class="text-center">
                  <p class="text-base font-medium leading-none text-gray-700 mr-2">

                  
                                                {{$costo->id}}
                  
                        
                  </p>
               
               </td>
                <td class="text-center">
                   <p class="text-base font-medium leading-none text-gray-700 mr-2">

                   
                                                 {{$costo->name}}
                   
                         
                   </p>
                
                </td>

                <td class="text-center">
                  <p class="text-base font-medium leading-none text-gray-700 mr-2"
                     @switch($costo->metodo)
                        @case('TPC')
                           title="Tarifa Por Caja"
                           @break
                        @case('MTC')
                           title="Monto total (Dividido por Categoría)"
                           @break
                        @case('MTE')
                           title="Monto total (separado por especie)"
                           @break
                        @case('TPK')
                           title="Tarifa Por Kilo"
                           @break
                        @case('MTEB')
                           title="Monto Total (Por número de embarque)"
                           @break
                        @case('MTEmp')
                           title="Monto total (Por Empresa)"
                           @break
                        @case('MTT')
                           title="Monto total (Según tipo de Transporte)"
                           @break
                        @default
                           title="No especificado"
                     @endswitch 
                  >

                                 @if ($costo->metodo)
                                    {{$costo->metodo}}
                                 @else
                                     null
                                 @endif
                                                
                  
                        
                  </p>
               
               </td>

                      @if ($costo->exp)
                         <td class="text-center">
                            <label class="">
                               <input type="checkbox" checked disabled readonly>
                              Exportación
                            </label>
                         </td>
                      @else
                         <td class="text-center">
                            <label class="">
                               <input type="checkbox" disabled readonly>
                               Exportación
                            </label>
                         </td>
                      @endif

                     @if ($costo->mi)
                        <td class="text-center">
                           <label class="">
                              <input type="checkbox" checked disabled readonly>
                              Mercado Interno
                           </label>
                        </td>
                     @else
                        <td class="text-center">
                           <label class="">
                              <input type="checkbox" disabled readonly>
                              Mercado Interno
                           </label>
                        </td>
                     @endif

                     @if ($costo->com)
                        <td class="text-center">
                           <label class="">
                              <input type="checkbox" checked disabled readonly>
                              Comercial
                           </label>
                        </td>
                     @else
                        <td class="text-center">
                           <label class="">
                              <input type="checkbox" disabled readonly>
                              Comercial
                           </label>
                        </td>
                     @endif
                

               <td width='120px'> 
                  <a href="{{route('admin.costos.edit', $costo)}}">
                     <button class="ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                        <p class="text-sm font-medium leading-none text-white">EDIT</p>
                    </button>
                  </a>
               </td>
               <td width='120px'>
                  <form id="delete-form-{{$costo->id}}" action="{{route('admin.costos.destroy', $costo)}}" method="POST">
                     @method('delete')
                     @csrf
                     <button type="button" class="text-white ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 px-6 py-3 bg-red-500 hover:bg-red-500 focus:outline-none rounded" onclick="confirmDelete({{$costo->id}})">Eliminar</button>
                 </form>
                 
                
               </td>
                
              
             </tr>
            
       
          @empty

     
             {{-- comment  --}}    
             <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
               <td class="text-center">
                  <p class="text-base font-medium leading-none text-gray-700 mr-2">

                  
                    -
                  
                        
                  </p>
               
               </td>
                <td class="text-center">
                   <p class="text-base font-medium leading-none text-gray-700 mr-2">

                   
                     No hay ningun costo registrado
                   
                         
                   </p>
                
                </td>
              
             </tr>
         
           
          @endforelse
                   
             
            
              
             
            
            
            </tbody>
         </table>
      </x-table-responsive>
      
      </div>
   </div>
    </div>
               
    <script>
      function confirmDelete(id) {
          Swal.fire({
              title: '¿Estás seguro?',
              text: "¡No podrás revertir esto!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sí, eliminarlo!',
              cancelButtonText: 'Cancelar'
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('delete-form-' + id).submit();
              }
          })
      }
  </script> 
            
</x-app-layout>
