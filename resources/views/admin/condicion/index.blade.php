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
                 <span class="text-gray-600 text-lg font-semibold">Configurador de las Condiciones del Productor</span>
               </a>
                 <h2 class="mt-4 text-2xl text-gray-900 font-bold md:text-4xl">Las configuración que sean modificadas a continuación afectara a todas las nuevas liquidaciones que sean creadas en el futuro.</h2>
                 <div class="flex justify-end mb-4 -mt-4">
                  <a href="{{route('admin.condicionproductors.create')}}">
                     <button  class="ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                        <p class="text-sm font-medium leading-none text-white">Crear Nueva Condición</p>
                     </button>
                  </a>
               </div>

               </div>
        
  
          <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
              <table class="min-w-full leading-normal">
                <thead>
                  <tr>
                    <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Name
                    </th>
                    <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Opciones
                    </th>
                    <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Created at
                    </th>
                 
                    <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Acción
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @if ($condicions->count()>0)
                    @foreach ($condicions->reverse() as $condicion)
                      <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                          <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10">
                              <img class="w-full h-full"
                                                        src="https://cdn-icons-png.flaticon.com/512/1760/1760560.png"
                                                        alt="" />
                                                </div>
                              <div class="ml-3">
                                <a href="{{Route('admin.condicionproductors.edit',$condicion)}}">
                                  <p class="text-gray-900 whitespace-no-wrap">
                                    {{$condicion->name}}
                                  </p>
                                </a>
                              </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                          @foreach ($condicion->opcions as $item)
                            <a href="{{Route('admin.condicionproductors.edit',$condicion)}}">
                              <p class="text-gray-900 whitespace-no-wrap">{{$item->text}}</p>
                            </a>
                          @endforeach
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                          <p class="text-gray-900 whitespace-no-wrap">
                            {{$condicion->created_at}}
                          </p>
                        </td>
                     
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                          <div class="inline-flex items-center rounded-md shadow-sm">
                            <a href="{{Route('admin.condicionproductors.edit',$condicion)}}">
                              <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                  <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    </span>
                              </button>
                            </a>
                            <button class="hidden text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                      </svg>                      
                                </span>
                            </button>
                            <form action="{{ route('admin.condicionproductors.destroy', $condicion->id) }}" method="POST" class="inline" id="delete-form-{{ $condicion->id }}">
                              @csrf
                              @method('DELETE')
                              <button type="button" onclick="confirmDelete({{ $condicion->id }})" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
                                  <span>
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                      </svg>
                                  </span>
                              </button>
                          </form>
                        </div>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            
            </div>
          </div>
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
              confirmButtonText: 'Sí, eliminar condición!',
              cancelButtonText: 'Cancelar'
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('delete-form-' + id).submit();
              }
          })
      }
  </script>
</x-app-layout>
