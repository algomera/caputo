<div class="p-10 flex flex-col gap-6">
    @if ($action == 'edit')
    <h2 class="text-2xl font-medium text-color-347af2">Modifica filiale</h2>
    @else
    <h2 class="text-2xl font-medium text-color-347af2">Creare filiale</h2>
    @endif

    <p class="text-color-2c2c2c text-xl">
        Inserire i dati per la creazione delle filiali dell’autoscuola, sarà possibile aggiungere un’altra filiale, o modificare
        quelle esistenti.
    </p>

    <div class="flex item-center gap-4">
        <x-input-text wire:model="schoolForm.code" width="w-1/4" name="schoolForm.code" label="Codice autoscuola" required="true" />
        <x-input-text wire:model="schoolForm.address" width="w-1/4" name="schoolForm.address" label="Indirizzo e civico" required="true" />
        <x-input-text x-mask="99999" wire:model="schoolForm.postcode" width="w-1/4" name="schoolForm.postcode" label="Cap" required="true" />
        <x-input-text wire:model="schoolForm.city" width="w-1/4" name="schoolForm.city" label="Città" required="true" />
    </div>

    <div class="ml-auto">
        <x-submit-button wire:click='next'>Salva</x-submit-button>
    </div>
</div>
