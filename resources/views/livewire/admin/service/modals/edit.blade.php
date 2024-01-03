<div class="p-10 flex flex-col gap-6">
    @if ($service)
        <div class="flex items-center gap-5 pb-5 border-b">
            <x-icons name="{{get_icon($service->name)}}" class="w-12"/>
            <h2 class="text-2xl font-medium text-color-347af2">{{$service->name}}</h2>
        </div>

        <p class="text-color-2c2c2c text-2xl">
            Vuoi Rimuovere <span class="font-bold">{{$service->name}}</span> da questa autoscuola?
        </p>

        <div class="w-fit ml-auto space-x-5">
            <button wire:click="$dispatch('closeModal')" class="w-fit text-2xl inline-flex items-center px-6 py-2 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-200 active:bg-gray-200 disabled:opacity-50 font-bold tracking-widestfocus:bg-gray-700 transition ease-in-out duration-150">
                Annulla
            </button>
            <x-submit-button wire:click="remove">Conferma</x-submit-button>
        </div>
    @else
        <p class="text-color-2c2c2c text-2xl">
            Seleziona il servizio da aggiungere in questa autoscuola.
        </p>

        <x-custom-select wire:model="selectedService" name="selectedService" label="Servizi" width="w-1/4" required="true">
            <option value="">Seleziona servizio</option>
            @foreach ($school->otherServices() as $service )
                <option value="{{$service->id}}" class="capitalize">{{$service->name}}</option>
            @endforeach
        </x-custom-select>

        <div class="w-fit ml-auto space-x-5">
            <button wire:click="$dispatch('closeModal')" class="w-fit text-2xl inline-flex items-center px-6 py-2 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-200 active:bg-gray-200 disabled:opacity-50 font-bold tracking-widestfocus:bg-gray-700 transition ease-in-out duration-150">
                Annulla
            </button>
            <x-submit-button wire:click="add">Aggiungi</x-submit-button>
        </div>
    @endif
</div>
