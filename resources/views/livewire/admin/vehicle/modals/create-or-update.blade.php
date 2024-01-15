<div class="p-10 flex flex-col gap-6">
    @if ($action == 'edit')
    <h2 class="text-2xl font-medium text-color-347af2">Modifica veicolo</h2>
    @else
    <h2 class="text-2xl font-medium text-color-347af2">Aggiungi veicolo</h2>
    @endif

    <p class="text-color-2c2c2c text-xl">
        Inserire i dati per la creazione dei veicoli dell’autoscuola, sarà possibile aggiungere o modificare
        quelle esistenti.
    </p>

    <div class="flex item-center gap-4">
        <x-custom-select wire:model="vehicleForm.type" name="vehicleForm.type" label="Tipo veicolo" width="w-1/4" required="true">
            <option value="">Seleziona tipologia</option>
            @foreach ($vehicleTypes as $type )
                <option value="{{$type}}" class="capitalize">{{$type}}</option>
            @endforeach
        </x-custom-select>
        <x-input-text wire:model="vehicleForm.model" width="w-1/4" name="vehicleForm.model" label="modello" />
        <x-custom-select wire:model="vehicleForm.transmission" name="vehicleForm.transmission" label="Cambio" width="w-1/4" required="true">
            <option value="">Seleziona cambio</option>
            <option value="Automatico" class="capitalize">Automatico</option>
            <option value="Manuale" class="capitalize">Manuale</option>
        </x-custom-select>
        <x-input-text wire:model="vehicleForm.plate" width="w-1/4" name="vehicleForm.plate" label="Targa" required="true" />
    </div>

    <div class="ml-auto">
        <x-submit-button wire:click='next' class="bg-color-347af2">Salva</x-submit-button>
    </div>
</div>
