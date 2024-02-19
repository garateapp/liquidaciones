<x-app-layout>
  

    <div class="container pb-8 pt-2">
        
        <div class="card">
            @livewire('temporada-show', ['temporada' => $temporada], key($temporada->id))
        </div>

    </div>

</x-app-layout>