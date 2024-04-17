<x-app-layout>
  

    <div class=" pb-8 pt-2">
        
        <div class="card">
            <div class="px-0 md:px-6 py-4">
                   
                    
                    <!-- End Sidebar -->
                    <div class="flex flex-col flex-1 w-full overflow-y-auto">
                        <!--Start Topbar -->
                        <!--End Topbar -->
                        @livewire('temporada-show', ['temporada' => $temporada, 'vista' => 'resumesnacional'], key($temporada->id))
                    

                    </div>
               
            </div>
        </div>

    </div>

</x-app-layout>