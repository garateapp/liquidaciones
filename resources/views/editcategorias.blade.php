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
                 <h2 class="mt-4 text-2xl text-gray-900 font-bold md:text-4xl hidden">Las configuración que sean modificadas a continuación afectara a todas las liquidaciones.</h2>
             </div>

              
             
         </div>
     </div>

      
  
  
    

    </div>

            
</x-app-layout>
