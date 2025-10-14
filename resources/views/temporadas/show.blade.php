<x-app-layout>
  

    <div class=" pb-8 pt-2">
        
        <div class="card">
            <div class="px-0 md:px-6 py-4">
                   
                    
                    <!-- End Sidebar -->
                    <div class="flex flex-col flex-1 w-full overflow-y-auto">
                        <!--Start Topbar -->
                        <!--End Topbar -->
                        <div class="flex w-full bg-gray-300" x-data="{openMenu:1}">
                    
                            @livewire('menu-aside',['temporada'=>$temporada->id])
                            <div class="w-full">
                                <livewire:productores-listado :temporada="$temporada" />
                            </div>
                        </div>
                    </div>
               
            </div>
        </div>

    </div>

</x-app-layout>