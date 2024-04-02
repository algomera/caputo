<div class="p-10">
    <x-icons wire:click="$dispatch('closeModal')" name="x_close" class="absolute top-5 right-5 w-8 text-gray-400 cursor-pointer hover:text-color-2c2c2c transition-all duration-200" />

    <h2 class="mb-5 text-2xl font-medium text-color-347af2">{{$lessonForm->subject}}</h2>

    <div class="flex item-center gap-4">
        <x-custom-select wire:model="lessonForm.type" name="lessonForm.type" label="Tipologia" width="w-fit" required="true">
            <option value="teoria">Teoria</option>
            <option value="pratica">Pratica</option>
        </x-custom-select>
        <x-input-text wire:model="lessonForm.subject" width="grow" name="lessonForm.subject" label="Titolo lezione" required="true" />
        <x-input-text x-mask="999" wire:model="lessonForm.duration" width="w-40" name="lessonForm.duration" placeholder="60" label="Durata Min." required="true"/>
    </div>
    <div class="mt-4">
        <label for="lessonForm.description" class="text-sm font-light text-color-2c2c2c mb-1 w-fit ml-2">Descrizione Lezione</label>
        <textarea wire:model="lessonForm.description" name="lessonForm.description" id="" cols="30" rows="5" class="w-full border-color-dfdfdf rounded-md"></textarea>
    </div>

    <div class="w-full flex justify-end mt-5">
        <x-submit-button wire:click='update' class="bg-color-347af2">Salva</x-submit-button>
    </div>
</div>
