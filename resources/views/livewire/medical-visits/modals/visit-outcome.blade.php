<div class="px-14 py-8 flex flex-col gap-4">
    <h1 class="text-2xl font-bold text-color-17489f capitalize">Protocollo visita: <span class="text-xl font-medium text-color-2c2c2c">{{$visit->customer->full_name}}</span></h1>

    <div class="flex gap-2">
        <x-input-text type="date" wire:model="release" width="grow" name="release" label="Rilasciato il" />
        <x-input-text wire:model="protocol" width="grow" name="protocol" label="N. Protocollo" uppercase="uppercase" />
    </div>

    <div class="w-full flex justify-end">
        <x-submit-button wire:click='save' class="ml-auto bg-color-17489f">Salva</x-submit-button>
    </div>
</div>
