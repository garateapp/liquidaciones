<div>
     <!-- Start Open Menu -->
     <aside class="animate__animated animate__fadeInLeft w-52 relative z-0 flex-shrink-0 hidden px-4 overflow-y-auto bg-gray-100 sm:block " 
     x-show="openMenu ==  1" 
     style="display: none;">
  <div class="mb-6">
    <!--Start Sidebar for open menu -->
    <div class="grid grid-cols-1 gap-4 grid-cols-2 mt-6">
      <!-- Start Navitem -->
      <a href="{{route('temporadas.show',$temporada)}}" 
      wire:navigate>
        <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
          <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
            <i class="fas fa-chart-pie fa-sm text-indigo-600"></i>
          </div>
          <p class="text-xs mt-1 text-center font-semibold">Resumen</p>
        </div>
      </a>
      <a href="{{route('temporada.packing',$temporada)}}"
      wire:navigate>
        <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
          <div class="rounded-full p-2 @if($temporada->packings->count()>0)bg-green-200 @else bg-indigo-200 @endif flex flex-col items-center">
            <i class="fas fa-chart-pie fa-sm @if($temporada->packings->count()>0)text-green-600 @else text-indigo-600 @endif"></i>
          </div>
          <p class="text-xs mt-1 text-center font-semibold">Costos Packing</p>
        </div>
      </a>
      <!-- End Navitem -->
      <!-- Start Navitem -->
      <a href="{{route('temporada.materiales',$temporada)}}"
      wire:navigate>
      <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
        <div class="rounded-full p-2 @if($temporada->materials->count()>0)bg-green-200 @else bg-indigo-200 @endif flex flex-col items-center">
          <i class="fas fa-calculator fa-sm @if($temporada->materials->count()>0)text-green-600 @else text-indigo-600 @endif"></i>
        </div>
        <p class="text-xs mt-1 text-center font-semibold">Materiales</p>
      </div>
      </a>
      <!-- End Navitem -->
      <!-- Start Navitem -->
      <a href="{{route('temporada.exportacion',$temporada)}}"
      wire:navigate>
      <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
        <div class="rounded-full p-2 @if($temporada->exportacions->count()>0)bg-green-200 @else bg-indigo-200 @endif  flex flex-col items-center">
          <i class="fas fa-wallet fa-sm @if($temporada->exportacions->count()>0)text-green-600 @else text-indigo-600 @endif"></i>
        </div>
        <p class="text-xs mt-1 text-center font-semibold">Gastos de exportación</p>
      </div>
      </a>
      <!-- End Navitem -->
      <!-- Start Navitem -->
      <a href="{{route('temporada.flete',$temporada)}}"
      wire:navigate>
      <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
        <div class="rounded-full p-2 @if($temporada->flets->count()>0)bg-green-200 @else bg-indigo-200 @endif flex flex-col items-center">
          <i class="fas fa-archive fa-sm @if($temporada->flets->count()>0)text-green-600 @else text-indigo-600 @endif"></i>
        </div>
        <p class="text-xs mt-1 text-center font-semibold">Fletes</p>
      </div>
      </a>
      <!-- End Navitem -->
      <!-- Start Navitem -->
      <a href="{{route('temporada.comision',$temporada)}}"
      wire:navigate>
      <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
        <div class="rounded-full p-2 @if($temporada->comisions->count()>0)bg-green-200 @else bg-indigo-200 @endif flex flex-col items-center">
          <i class="fas fa-money-bill-wave-alt fa-sm @if($temporada->comisions->count()>0)text-green-600 @else text-indigo-600 @endif"></i>
        </div>
        <p class="text-xs mt-1 text-center font-semibold">Comisión</p>
      </div>
      </a>
      <!-- End Navitem -->
       <!-- Start Navitem -->
      <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
        <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
          <i class="fas fa-shopping-basket fa-sm text-indigo-600"></i>
        </div>
        <p class="text-xs mt-1 text-center font-semibold">Balance de masa</p>
      </div>
      <div class="p-2 flex flex-col items-center bg-white rounded-md justify-center shadow-xl cursor-pointer">
          <div class="rounded-full p-2 bg-indigo-200 flex flex-col items-center">
            <i class="fas fa-shopping-basket fa-sm text-indigo-600"></i>
          </div>
          <p class="text-xs mt-1 text-center font-semibold">Finanzas</p>
        </div>
      <!-- End Navitem -->
    </div>
    <!--End Sidebar for open menu -->
  </div>
</aside>
<!-- End Open Menu -->
</div>
