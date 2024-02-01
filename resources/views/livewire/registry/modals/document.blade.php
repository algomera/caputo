<div class="px-14 py-8 flex flex-col gap-4">
    @if ($action)
        <h1 class="text-3xl font-bold text-color-17489f capitalize mb-5">{{$identificationDocumentForm->identificationDocument->identificationType->name}}</h1>
    @else
        <h1 class="text-3xl font-bold text-color-17489f capitalize mb-5">Nuovo Documento</h1>
    @endif

    <div class="flex items-center gap-2">
        @if (!$action)
            <x-custom-select wire:model="identificationDocumentForm.identification_type_id" name="identificationDocumentForm.identification_type_id" label="Tipo Documento" width="grow" >
                <option value="">Seleziona documento</option>
                @foreach ($documentTypes as $type )
                    <option value="{{$type->id}}" class="capitalize">{{$type->name}}</option>
                @endforeach
            </x-custom-select>
        @endif
        <x-input-text wire:model="identificationDocumentForm.n_document" width="grow" name="identificationDocumentForm.n_document" label="N. Documento" />
        <x-input-text wire:model="identificationDocumentForm.document_from" width="grow" name="identificationDocumentForm.document_from" label="Ente di rilascio" />
    </div>
    <div class="flex items-center gap-2">
        <x-input-text type="date" wire:model="identificationDocumentForm.document_release" width="grow" name="identificationDocumentForm.document_release" label="Rilasciata il" />
        <x-input-text type="date" wire:model="identificationDocumentForm.document_expiration" width="grow" name="identificationDocumentForm.document_expiration" label="Scade il" />
    </div>
    @if ($action == 'edit')
        <x-submit-button wire:click='update' class="bg-color-347af2 mt-5 ml-auto">Modifica</x-submit-button>
    @else
        <x-submit-button wire:click='save' class="bg-color-347af2 mt-5 ml-auto">Crea</x-submit-button>
    @endif
</div>


