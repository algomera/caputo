<div class="w-full h-full py-10 px-8 2xl:px-14">

    <div class="flex items-center gap-5">
        <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group">
            <x-icons name="back" class="transition-all duration-300 group-hover:-translate-x-1" />
        </div>
        <h1 class="text-5xl font-bold text-color-17489f capitalize">{{$customerForm->name}}</h1>
    </div>

    <div class="mt-10 p-4 w-full flex flex-col gap-4 shadow-shadow-card bg-color-f7f7f7">
        {{-- Autoscuola --}}
        <div class="flex items-end justify-between border-b pb-4">
            <div class="flex items-center gap-4">
                <x-fake-input width="w-48" label="Codice autoscuola" uppercase="">{{$customerForm->customer->school->code}}</x-fake-input>
                <x-fake-input width="w-fit" label="Sede" uppercase="">{{$customerForm->customer->school->address}}</x-fake-input>
                <x-fake-input width="w-48" label="Data acquisizione" uppercase="">{{date("d/m/Y", strtotime($customerForm->customer->created_at))}}</x-fake-input>
            </div>
            <div class="flex items-center gap-2">
                <button class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-ffb205/30 hover:scale-105 transition-all duration-300">Storico</button>
                @if ($modify)
                    <button wire:click="$set('modify', false)" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-red-500/60 hover:scale-105 transition-all duration-300">Disabilita Modifica</button>
                    <button wire:click="save" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">Salva</button>
                @else
                    <button wire:click="$set('modify', true)" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">Abilita Modifica</button>
                @endif
            </div>
        </div>
        {{-- Dati Customer --}}
        <div class="w-full inline-flex gap-5 border-b pb-4">
            @if ($photo)
                <div class="w-64 h-64 bg-white relative">
                    <img class="w-full h-full" src="{{ $photo->temporaryUrl() }}">
                    <div class="absolute top-2 right-2 bg-color-01a53a/40 px-2 rounded-full">
                        <div class="w-fit flex items-start gap-5 relative text-gray-400">
                            <label for="photo" class="font-medium cursor-pointer">
                                <span class="text-color-2c2c2c text-sm font-light">Carica Foto</span>
                            </label>
                            <input wire:model="photo" type="file" name="photo" id="photo" class="block mt-1 w-full opacity-0 z-[-1] absolute">
                        </div>
                    </div>
                </div>
            @elseif ($customerForm->customer->photo()->first())
                <div class="w-64 h-64 bg-white relative">
                    <img class="w-full h-full" src="{{Vite::asset($customerForm->customer->photo()->first()->path)}}" alt="">
                    @if ($modify)
                        <div class="absolute top-2 right-2 bg-color-01a53a/40 px-2 rounded-full">
                            <div class="w-fit flex items-start gap-5 relative text-gray-400">
                                <label for="photo" class="font-medium cursor-pointer">
                                    <span class="text-color-2c2c2c text-sm font-light">Carica Foto</span>
                                </label>
                                <input wire:model="photo" type="file" name="photo" id="photo" class="block mt-1 w-full opacity-0 z-[-1] absolute">
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            <div class="grow space-y-3">
                <div class="w-full flex items-center gap-2">
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.name" width="grow" name="customerForm.name" label="Nome" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.lastName" width="grow" name="customerForm.lastName" label="Cognome" />
                    <x-custom-select disabled="{{!$modify}}" wire:model="customerForm.sex" name="customerForm.sex" label="Sesso" width="w-fit" >
                        <option value="">Seleziona</option>
                        <option value="donna" class="capitalize">donna</option>
                        <option value="uomo" class="capitalize">uomo</option>
                    </x-custom-select>
                    <x-input-text disabled="{{!$modify}}" type="date" wire:model="customerForm.date_of_birth" width="w-fit" name="customerForm.date_of_birth" label="Nato il" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.birth_place" width="grow" name="customerForm.birth_place" label="Luogo di nascita" uppercase="capitalize" />
                    <x-input-text disabled="{{!$modify}}" x-mask="aa" wire:model="customerForm.country_of_birth" width="w-fit" name="customerForm.country_of_birth" label="Provincia di nascita" uppercase="uppercase" />
                </div>

                <div class="w-full flex items-center gap-2">
                    <x-input-text disabled="{{!$modify}}" x-mask="aaaaaa99a99a999a" wire:model="customerForm.fiscal_code" width="w-fit" name="customerForm.fiscal_code" label="Codice Fiscale" uppercase="uppercase" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.city" width="w-fit" name="customerForm.city" label="Citta" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.address" width="grow" name="customerForm.address" label="Via/Piazza" />
                    <x-input-text disabled="{{!$modify}}" x-mask="99999" wire:model="customerForm.civic" width="w-20" name="customerForm.civic" label="Civico" />
                    <x-input-text disabled="{{!$modify}}" x-mask="aa" wire:model="customerForm.province" width="w-20" name="customerForm.province" label="Provincia" uppercase="uppercase" />
                    <x-input-text disabled="{{!$modify}}" x-mask="99999" wire:model="customerForm.postcode" width="w-20" name="customerForm.postcode" label="Cap" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.country" width="w-fit" name="customerForm.country" label="Cittadinanza" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.aire" width="w-fit" name="customerForm.aire" label="Iscritto Aire" />
                </div>
                <div class="flex items-center gap-2">
                    <x-input-text disabled="{{!$modify}}" x-mask="999 9999999" wire:model="customerForm.phone_1" width="w-1/4" name="customerForm.phone_1" label="1° Cellulare" />
                    <x-input-text disabled="{{!$modify}}" x-mask="999 9999999" wire:model="customerForm.phone_2" width="w-1/4" name="customerForm.phone_2" label="2° Cellulare" />
                    <x-input-text disabled="{{!$modify}}" type="email" wire:model="customerForm.email" width="w-1/4" name="customerForm.email" label="Email" />
                </div>
            </div>
        </div>
        {{-- Firma e Documenti --}}
        <div class="w-full flex items-end gap-5">
            @if ($customerForm->customer->customerSignature())
            <div>
                <p class="text-sm font-light text-color-2c2c2c mb-1 w-fit ml-2">Firma digitale</p>
                <img class="w-64 h-36 bg-white shadow-shadow-card" src="{{Vite::asset($customerForm->customer->customerSignature()->first()->path)}}" alt="">
            </div>
            @endif
            <div class="grow space-y-3">
                <div class="w-full flex items-center gap-2">
                    <x-input-text disabled="{{!$modify}}" wire:model="documentForm.n_document" width="w-1/6" name="documentForm.n_document" label="N. Patente" />
                    <x-input-text disabled="{{!$modify}}" type="date" wire:model="documentForm.document_release" width="w-1/6" name="documentForm.document_release" label="Rilasciata il" />
                    <x-input-text disabled="{{!$modify}}" wire:model="documentForm.document_from" width="w-1/6" name="documentForm.document_from" label="Ente di rilascio" />
                    <x-input-text disabled="{{!$modify}}" type="date" wire:model="documentForm.document_expiration" width="w-1/6" name="documentForm.document_expiration" label="Scade il" />
                    <x-input-text disabled="{{!$modify}}" wire:model="documentForm.qualification" width="w-1/6" name="documentForm.qualification" label="Abilitazioni" />
                </div>
                <div class="w-full flex items-center gap-2">
                    <x-custom-select wire:model.live="document" name="document" label="Tipo Documento" width="w-1/6" >
                        @foreach ($types as $type )
                            <option value="{{$type}}" class="capitalize">{{$type}}</option>
                        @endforeach
                    </x-custom-select>
                    <x-input-text disabled="{{!$modify}}" wire:model.live="n_document" width="w-1/6" name="n_document" label="N. Documento" />
                    <x-input-text disabled="{{!$modify}}" type="date" wire:model="document_release" width="w-1/6" name="document_release" label="Rilasciata il" />
                    <x-input-text disabled="{{!$modify}}" wire:model="document_from" width="w-1/6" name="document_from" label="Ente di rilascio" />
                    <x-input-text disabled="{{!$modify}}" type="date" wire:model="document_expiration" width="w-1/6" name="document_expiration" label="Scade il" />
                </div>

            </div>
        </div>
    </div>
</div>

{{-- @push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            const inputs = document.getElementsByTagName('input');
            const selects = document.getElementsByTagName('select');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].setAttribute('disabled', true);
            };
            for (let i = 0; i < selects.length; i++) {
                selects[i].setAttribute('disabled', true);
            };

            Livewire.on('modifyData', (value) => {
                if (value[0]) {
                }
                if (!value[0]) {
                    console.log(value[0]);

                    for (let i = 0; i < inputs.length; i++) {
                        inputs[i].setAttribute('disabled', true);
                    }
                    for (let i = 0; i < selects.length; i++) {
                        selects[i].setAttribute('disabled', true);
                    }
                }
            });
        })
    </script>
@endpush --}}
