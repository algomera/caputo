<div class="p-10 flex flex-col text-center justify-center gap-10 relative">
    <h1 class="text-4xl font-medium text-color-2c2c2c">Conferma residenza</h1>

    <div class="flex flex-wrap gap-4">
        <x-input-text wire:model="customer.city" width="grow" name="customer.city" label="Località residenza" uppercase="capitalize" required="true" />
        <x-input-text wire:model="customer.province" width="grow" name="customer.province" label="Provincia" uppercase="uppercase" required="true" />
        <x-input-text wire:model="customer.postcode" width="grow" name="customer.postcode" label="Cap" uppercase="uppercase" required="true" />
        <x-input-text wire:model="customer.toponym" width="grow" name="customer.toponym" label="Toponimo" uppercase="capitalize" />
        <x-input-text wire:model="customer.address" width="grow" name="customer.address" label="Indirizzo" uppercase="capitalize" required="true" />
        <x-input-text wire:model="customer.civic" width="grow" name="customer.civic" label="N. Civico" uppercase="uppercase" required="true" />
    </div>

    <x-submit-button wire:click="next"
        @class(["m-auto", 'bg-color-'.get_color($course->service->name)])>
        Conferma
    </x-submit-button>
</div>
