<div class="p-10 flex flex-col gap-6">
    <div class="flex items-center gap-5 pb-5 border-b">
        <x-icons name="{{get_icon($service->name)}}" class="w-12"/>
        <div class="flex items-center">
            <h2 class="text-2xl font-medium text-color-347af2">{{$service->name}} - </h2>
            <h2 class="text-2xl font-medium text-color-347af2"> {{$courseForm->name}}</h2>
        </div>
    </div>

    <p class="text-color-2c2c2c text-xl">
        Modifica i dati del corso
    </p>

    <div class="flex item-center gap-4">
        <x-input-text wire:model="courseForm.name" width="grow" name="courseForm.name" label="Nome Corso" required="true" />
        <x-input-text wire:model="courseForm.label" width="grow" name="courseForm.label" label="Etichetta" />
        <x-custom-select wire:model="courseForm.type_visit" name="courseForm.type_visit" label="Tipo visita" width="w-fit" required="true">
            <option value="rilascio">Rilascio</option>
            <option value="rinnovo">Rinnovo</option>
        </x-custom-select>
    </div>
    {{-- <div class="flex item-center gap-4">
        <x-input-text x-mask="99" wire:model="courseForm.absences" width="w-fit" name="courseForm.absences" label="Assenze consentite" placeholder="0" required="true" />
        <x-input-text x-mask="99" wire:model="courseForm.guides" width="w-fit" name="courseForm.guides" label="Guide obbligatorie" placeholder="0" required="true" />
    </div> --}}
    <div>
        <label for="courseForm.description" class="text-sm font-light text-color-2c2c2c mb-1 w-fit ml-2">Descrizione corso</label>
        <textarea wire:model="courseForm.description" name="courseForm.description" id="" cols="30" rows="5" class="w-full border-color-dfdfdf rounded-md"></textarea>
    </div>

    <div class="ml-auto">
        <x-submit-button wire:click='update' class="bg-color-347af2">Salva</x-submit-button>
    </div>
</div>
