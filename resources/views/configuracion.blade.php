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
                 <span class="text-gray-600 text-lg font-semibold">Bienvenid@ al Configurador del sistema</span>
                 <h2 class="mt-4 text-2xl text-gray-900 font-bold md:text-4xl">Las configuración que sean modificadas a continuación afectara a todas las nuevas liquidaciones que sean creadas en el futuro.</h2>
             </div>
             <div class="mt-16 grid border divide-x divide-y rounded-xl overflow-hidden sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-4 xl:grid-cols-4">
               <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                  <div class="relative p-8 space-y-8">
                      <img src="https://images.vexels.com/media/users/3/261301/isolated/preview/c7683a822fb4f6d5fb21e9493caf35a3-lana-ar-silhueta-de-transporte-de-barco.png" class="w-10" width="512" height="512" alt="burger illustration">
                      
                      <div class="space-y-2">
                           <a href="{{Route('admin.especies.index')}}">
                               <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600 cursor-pointer">Especies y Variedades</h5>
                           </a>
                          <p class="text-sm text-gray-600">Neque Dolor, fugiat non cum doloribus aperiam voluptates nostrum.</p>
                      </div>
                      <a href="{{Route('admin.especies.index')}}" class="flex justify-between items-center group-hover:text-yellow-600">
                          <span class="text-sm">Ver más</span>
                          <span class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                      </a>
                  </div>
              </div>
              <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                   <div class="relative p-8 space-y-8">
                       <img src="{{asset('image/presupuesto.png')}}" class="w-10" width="512" height="512" alt="burger illustration">
                       
                       <div class="space-y-2">
                       <a href="{{Route('admin.costos.index')}}">
                           <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600 cursor-pointer">Costos</h5>
                       </a>
                           <p class="text-sm text-gray-600">Neque Dolor, fugiat non cum doloribus aperiam voluptates nostrum.</p>
                       </div>
                       <a href="{{Route('admin.costos.index')}}" class="flex justify-between items-center group-hover:text-yellow-600">
                           <span class="text-sm">Ver más</span>
                           <span class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                       </a>
                   </div>
               </div>
                 <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                     <div class="relative p-8 space-y-8">
                         <img src="{{asset('image/productorespng.png')}}" class="w-10" width="512" height="512" alt="burger illustration">
                         
                         <div class="space-y-2">
                               <a href="{{Route('admin.condicionproductors.index')}}">
                               <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600 cursor-pointer">Condiciones del productor</h5>
                               </a>
                             <p class="text-sm text-gray-600">Neque Dolor, fugiat non cum doloribus aperiam voluptates nostrum.</p>
                         </div>
                         <a href="{{Route('admin.condicionproductors.index')}}" class="flex justify-between items-center group-hover:text-yellow-600">
                             <span class="text-sm">Ver más</span>
                             <span class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                         </a>
                     </div>
                 </div>
                
                 <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                       <div class="relative p-8 space-y-8">
                           <img src="https://cdn-icons-png.flaticon.com/512/6724/6724239.png" class="w-10" width="512" height="512" alt="burger illustration">
                           
                           <div class="space-y-2">
                           <a href="{{Route('admin.categorias.index')}}">
                               <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600 cursor-pointer">Categorias</h5>
                           </a>
                               <p class="text-sm text-gray-600">Neque Dolor, fugiat non cum doloribus aperiam voluptates nostrum.</p>
                           </div>
                           <a href="{{Route('admin.categorias.index')}}" class="flex justify-between items-center group-hover:text-yellow-600">
                               <span class="text-sm">Ver más</span>
                               <span class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                           </a>
                       </div>
                   </div>
                
             </div>
         </div>
     </div>

  
  
    

    </div>

            
</x-app-layout>
