<div class="w-full h-full py-10 px-8 2xl:px-14">

    <div class="flex items-center gap-5">
        <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group">
            <x-icons name="back" class="transition-all duration-300 group-hover:-translate-x-1" />
        </div>
        <h1 class="text-5xl font-bold text-color-17489f capitalize">{{$customerForm->lastName}} {{$customerForm->name}}</h1>
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
                <button wire:click="$dispatch('openModal', { component: 'registry.modals.chronology', arguments: {customer: {{$customerForm->customer->id}}} })" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-ffb205/30 hover:scale-105 transition-all duration-300">Cronologia generale</button>
                <button wire:click="$dispatch('openModal', { component: 'registry.modals.scans', arguments: {customer: {{$customerForm->customer->id}}} })" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-ffb205/30 hover:scale-105 transition-all duration-300">Scansioni</button>
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
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.name" width="2xl:grow" name="customerForm.name" label="Nome" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.lastName" width="2xl:grow" name="customerForm.lastName" label="Cognome" />
                    <x-custom-select disabled="{{!$modify}}" wire:model="customerForm.sex" name="customerForm.sex" label="Sesso" width="w-fit" >
                        <option value="">Seleziona</option>
                        <option value="donna" class="capitalize">donna</option>
                        <option value="uomo" class="capitalize">uomo</option>
                    </x-custom-select>
                    <x-input-text disabled="{{!$modify}}" type="date" wire:model="customerForm.date_of_birth" width="w-fit" name="customerForm.date_of_birth" label="Nato il" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.birth_place" width="2xl:grow" name="customerForm.birth_place" label="Luogo di nascita" uppercase="capitalize" />
                    <x-input-text disabled="{{!$modify}}" x-mask="aa" wire:model="customerForm.country_of_birth" width="w-fit" name="customerForm.country_of_birth" label="Provincia di nascita" uppercase="uppercase" />
                </div>

                <div class="w-full flex items-center gap-2">
                    <x-input-text disabled="{{!$modify}}" x-mask="aaaaaa99a99a999a" wire:model="customerForm.fiscal_code" width="w-fit" name="customerForm.fiscal_code" label="Codice Fiscale" uppercase="uppercase" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.city" width="w-fit" name="customerForm.city" label="Citta" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.address" width="2xl:grow" name="customerForm.address" label="Via/Piazza" />
                    <x-input-text disabled="{{!$modify}}" x-mask="99999" wire:model="customerForm.civic" width="w-20" name="customerForm.civic" label="Civico" />
                    <x-input-text disabled="{{!$modify}}" x-mask="aa" wire:model="customerForm.province" width="w-20" name="customerForm.province" label="Provincia" uppercase="uppercase" />
                    <x-input-text disabled="{{!$modify}}" x-mask="99999" wire:model="customerForm.postcode" width="w-20" name="customerForm.postcode" label="Cap" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.country" width="2xl:grow" name="customerForm.country" label="Cittadinanza" />
                    <x-input-text disabled="{{!$modify}}" wire:model="customerForm.aire" width="2xl:grow" name="customerForm.aire" label="Iscritto Aire" />
                </div>
                <div class="flex items-center gap-2">
                    <x-input-text disabled="{{!$modify}}" x-mask="999 9999999" wire:model="customerForm.phone_1" width="w-1/4" name="customerForm.phone_1" label="1° Cellulare" />
                    <x-input-text disabled="{{!$modify}}" x-mask="999 9999999" wire:model="customerForm.phone_2" width="w-1/4" name="customerForm.phone_2" label="2° Cellulare" />
                    <x-input-text disabled="{{!$modify}}" type="email" wire:model="customerForm.email" width="w-1/4" name="customerForm.email" label="Email" />
                </div>
            </div>
        </div>

        {{-- Firma e Documenti --}}
        <div class="w-full flex items-start gap-5 relative">
            @if ($customerForm->customer->customerSignature())
            <div>
                <p class="text-sm font-light text-color-2c2c2c mb-1 w-fit ml-2">Firma digitale</p>
                <div class="w-64 h-36 bg-white flex items-center shadow-shadow-card">
                    <img class="w-full" src="{{Vite::asset($customerForm->customer->customerSignature()->first()->path)}}" alt="">
                </div>
            </div>
            @endif
            <div class="grow space-y-3">
                <div class="w-full flex items-end gap-2">
                    <x-input-text disabled="{{!$modify}}" wire:model="documentForm.n_document" width="w-1/6" name="documentForm.n_document" label="N. Patente" />
                    <x-input-text disabled="{{!$modify}}" type="date" wire:model="documentForm.document_release" width="w-1/6" name="documentForm.document_release" label="Rilasciata il" />
                    <x-input-text disabled="{{!$modify}}" wire:model="documentForm.document_from" width="w-1/6" name="documentForm.document_from" label="Ente di rilascio" />
                    <x-input-text disabled="{{!$modify}}" type="date" wire:model="documentForm.document_expiration" width="w-1/6" name="documentForm.document_expiration" label="Scade il" />
                    <x-input-text disabled wire:model="documentForm.qualification" width="w-1/6" name="documentForm.qualification" label="Abilitazioni" />
                    {{-- @if ($modify)
                    <div wire:click="$dispatch('openModal', { component: 'registry.modals.document', arguments: {customer: {{$customerForm->customer->id}}, document: {{$documentForm->patent->id}}, action: 'edit'} })" class="hover:scale-105 transition-all duration-300 cursor-pointer">
                        <x-icons name="b-edit" />
                    </div>
                    @endif --}}
                </div>
                @if (count($documentForm->documents) > 0)
                    @foreach ($documentForm->documents as $document )
                        <div class="w-full flex items-end gap-2">
                            <x-fake-input width="w-1/6" label="Tipo Documento" uppercase="capitalize">{{$document->identificationType->name}}</x-fake-input>
                            <x-fake-input width="w-1/6" label="N. Documento" uppercase="uppercase">{{$document->n_document}}</x-fake-input>
                            <x-fake-input width="w-1/6" label="Rilasciato il">{{$document->document_release}}</x-fake-input>
                            <x-fake-input width="w-1/6" label="Ente di rilascio" uppercase="capitalize">{{$document->document_from}}</x-fake-input>
                            <x-fake-input width="w-1/6" label="Scade il">{{$document->document_expiration}}</x-fake-input>
                            @if ($modify)
                            <div class="flex gap-1">
                                <div wire:click="$dispatch('openModal', { component: 'registry.modals.document', arguments: {customer: {{$customerForm->customer->id}}, document: {{$document->id}}, action: 'edit'} })" class="hover:scale-105 transition-all duration-300 cursor-pointer">
                                    <x-icons name="b-edit" />
                                </div>
                                @role('admin')
                                <div wire:click="$dispatch('openModal', { component: 'registry.modals.delete-document', arguments: {document: {{$document->id}}} })" class="hover:scale-105 transition-all duration-300 cursor-pointer">
                                    <x-icons name="b-delete" />
                                </div>
                                @endrole
                            </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
            @if ($modify)
                <div wire:click="$dispatch('openModal', { component: 'registry.modals.document', arguments: {customer: {{$customerForm->customer->id}}} })"
                    class="absolute top-0 right-0 w-fit px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300 cursor-pointer">
                    + documento
                </div>
            @endif
        </div>

        {{-- Iscrizioni aperte --}}
        @if (count($registrations) > 0)
            @foreach ($registrations as $registration)
                <div class="w-full flex flex-col items-start gap-5 border-t pt-4 relative">
                    <div class="flex gap-2">
                        <p class="mr-5">Tipo di iscrizione: <span @class(["font-bold", 'text-color-'. get_color($registration->course->service->name)])>{{$registration->course->name}}</span></p>
                        <button class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-ffb205/30 hover:scale-105 transition-all duration-300">continua accettazione</button>
                        <button wire:click="$dispatch('openModal', { component: 'registry.modals.scans', arguments: {registration: {{$registration->id}}} })" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-ffb205/30 hover:scale-105 transition-all duration-300">Scansioni/Firme</button>
                        <button wire:click="$dispatch('openModal', { component: 'registry.modals.chronology', arguments: {registration: {{$registration->id}}} })" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-ffb205/30 hover:scale-105 transition-all duration-300">cronologia pratica</button>
                    </div>

                    <div class="flex items-center gap-2">
                        <x-fake-input width="grow 2xl:w-48" label="Stato della richiesta" uppercase="uppercase">{{$registration->state}}</x-fake-input>
                        <x-fake-input width="grow 2xl:w-48" label="Codice Statino" uppercase="uppercase">??</x-fake-input>
                        @if ($registration->medicalPlanning)
                            <x-fake-input width="grow 2xl:w-48" label="N. Protocollo" uppercase="uppercase">{{$registration->medicalPlanning->protocol ?? '---'}}</x-fake-input>
                            <x-fake-input width="grow 2xl:w-48" label="Emissione Protocollo">{{$registration->medicalPlanning->protocol_release ? date("d/m/Y", strtotime($registration->medicalPlanning->protocol_release)) : '---'}}</x-fake-input>
                            <x-fake-input width="grow 2xl:w-48" label="Scadenza Protocollo">{{$registration->medicalPlanning->protocol_expiration ? date("d/m/Y", strtotime($registration->medicalPlanning->protocol_expiration)) : '---'}}</x-fake-input>
                            <x-fake-input width="grow 2xl:w-48" label="Visita medica">{{$registration->medicalPlanning->booked}}</x-fake-input>
                        @endif
                    </div>
                    @if ($registration->pinkSheet)
                        <div class="flex items-center gap-2">
                            <x-fake-input width="grow 2xl:w-48" label="Emissione Foglio Rosa">{{date("d/m/Y", strtotime($registration->pinkSheet->release))}}</x-fake-input>
                            <x-fake-input width="grow 2xl:w-48" label="Scadenza Foglio Rosa">{{date("d/m/Y", strtotime($registration->pinkSheet->expiration))}}</x-fake-input>
                            <x-fake-input width="grow 2xl:w-48" label="Data Registrazione">{{date("d/m/Y", strtotime($registration->created_at))}}</x-fake-input>
                            <x-fake-input width="grow 2xl:w-48" label="N. Registrazione">{{$registration->id}}</x-fake-input>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
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
