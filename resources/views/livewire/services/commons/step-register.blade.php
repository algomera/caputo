<div class="w-full h-full pt-14 2xl:px-28">
    <div class="px-10 2xl:px-0">
        <div class="flex items-center gap-5">
            <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group">
                <x-icons name="back" @class(["transition-all duration-300 group-hover:-translate-x-1", 'group-hover:text-color-'.get_color($course->service->name)]) />
            </div>
            <h1 @class(["text-5xl font-bold", 'text-color-'.get_color($course->service->name)])>{{$course->name}}</h1>
        </div>

        <div class="px-5 xl:px-16 py-9 mt-0 mx-20 2xl:mx-44">

            <div class="flex justify-center gap-1">
                @foreach ($steps as $key => $step)
                    <x-steps
                        color="{{$this->customerForm->currentStep >= $key+1 ? get_color($course->service->name) : 'afafaf'}}"
                        currentStep="{{$this->customerForm->currentStep}}"
                        number="{{$key+1}}"
                        step="{{$step}}"
                    />
                    @if ($key+1 < count($steps) )
                        <div @class(["h-1 grow max-w-[138px] rounded-full shadow mt-4", $this->customerForm->currentStep >= $key+2 ? 'bg-color-'.get_color($course->service->name) : 'bg-color-afafaf'])></div>
                    @endif
                @endforeach
            </div>

            @switch($this->customerForm->currentStep)
            {{-- Dati --}}
                @case(1)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Inserire i <span class="font-bold">Dati</span> del cliente per proseguire.
                        </p>

                        <div class="flex flex-col gap-5">
                            <div class="flex flex-wrap gap-2 border rounded-md relative p-4 bg-color-f7f7f7">
                                <x-input-text wire:model="customerForm.name" width="grow" name="customerForm.name" label="Nome" required="true" />
                                <x-input-text wire:model="customerForm.lastName" width="grow" name="customerForm.lastName" label="Cognome" required="true" />
                                <x-custom-select wire:model="customerForm.sex" name="customerForm.sex" label="Sesso" width="w-1/4" required="true">
                                    <option value="">Seleziona</option>
                                    <option value="donna" class="capitalize">donna</option>
                                    <option value="uomo" class="capitalize">uomo</option>
                                </x-custom-select>
                                <x-input-text x-mask="aaaaaa99a99a999a" wire:model="customerForm.fiscal_code" width="grow" name="customerForm.fiscal_code" label="Codice Fiscale" uppercase="uppercase" required="true" />
                            </div>
                            <div class="flex flex-wrap gap-2 border rounded-md relative p-4 bg-color-f7f7f7">
                                <x-input-text type="date" wire:model="customerForm.date_of_birth" width="w-1/4" name="customerForm.date_of_birth" label="Nato il" required="true" />
                                <x-input-text wire:model="customerForm.birth_place" width="grow" name="customerForm.birth_place" label="Luogo di nascita" required="true" />
                                <x-input-text x-mask="aa" wire:model="customerForm.country_of_birth" width="grow" name="customerForm.country_of_birth" label="Provincia di nascita" uppercase="uppercase" required="true" />
                                <x-input-text wire:model="customerForm.country" width="grow" name="customerForm.country" label="Cittadinanza" required="true" />
                            </div>
                            <div class="flex flex-wrap gap-2 border rounded-md relative p-4 bg-color-f7f7f7">
                                <x-input-text wire:model="customerForm.city" width="w-1/4" name="customerForm.city" label="Citta" required="true" />
                                <x-input-text x-mask="aa" wire:model="customerForm.province" width="w-1/4" name="customerForm.province" label="Provincia" uppercase="uppercase" required="true" />
                                <x-input-text wire:model="customerForm.address" width="grow" name="customerForm.address" label="Via/Piazza" required="true" />
                                <x-input-text x-mask="99999" wire:model="customerForm.civic" width="w-1/12" name="customerForm.civic" label="Civico" required="true" />
                                <x-input-text x-mask="99999" wire:model="customerForm.postcode" width="w-1/12" name="customerForm.postcode" label="Cap" required="true" />
                            </div>
                        </div>

                        <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                    </x-container-step>
                @break
            {{-- Recapiti --}}
                @case(2)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Inserire email e un numero di cellulare per proseguire.
                        </p>

                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-3">
                                <x-input-text type="email" wire:model.live="customerForm.email" width="w-1/4" name="customerForm.email" label="Email" required="true" />
                                <x-input-text x-mask="999 9999999" wire:model.live="customerForm.phone_1" width="w-1/4" name="customerForm.phone_1" label="1° Cellulare" required="true" />
                                <x-input-text x-mask="999 9999999" wire:model.live="customerForm.phone_2" width="w-1/4" name="customerForm.phone_2" label="2° Cellulare" />
                            </div>
                        </div>


                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                        </div>
                    </x-container-step>
                @break
            {{-- Fototessera --}}
                @case(3)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la fototessera, altrimenti cliccare “inserire in seguito”
                        </p>

                        <div class="flex gap-8">
                            <div class="flex flex-col gap-2">
                                <x-input-files wire:model.live="photo" text="Carica Fototessera" color="{{get_color($course->service->name)}}" name="photo" preview="fototessera_uploaded" />
                                <span wire:click="nextStep" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                            </div>
                            @if ($photo)
                            <div class="flex flex-col gap-1 relative">
                                <img class="w-20 h-24 border shadow" src="{{ $photo->temporaryUrl() }}">
                                <div class="absolute -bottom-5 font-medium text-gray-400">{{$photo->getClientOriginalName()}}</div>
                            </div>
                            @else
                            <div class="w-20 h-24 border shadow flex items-center justify-center">
                                <x-icons name="image" class="w-10 h-10 opacity-30"/>
                            </div>
                            @endif
                        </div>

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            @if ($photo)
                                <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                            @endif
                        </div>
                    </x-container-step>
                @break
            {{-- Scansioni --}}
                @case(4)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la scansione della <span class="font-bold">patente, carta d’identità</span> e il <span class="font-bold">codice fiscale</span>, altrimenti cliccare “inserire in seguito”
                        </p>

                        <div class="flex gap-8">
                            <div class="flex flex-col gap-2">
                                <x-input-files multiple wire:model="documents" text="Carica Documenti" color="{{get_color($course->service->name)}}" name="documents"  preview="documents_uploaded" />
                                <span wire:click="nextStep" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                            </div>

                            @if ($documents)
                                <div class="flex flex-col gap-1 relative">
                                    @foreach ($documents as $document)
                                        <span class="font-medium text-gray-400">{{$document->getClientOriginalName()}}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            @if ($documents)
                                <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                            @endif
                        </div>
                    </x-container-step>
                @break
            {{-- Firma --}}
                @case(5)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la firma e salvare, per proseguire.
                        </p>

                        <div class="w-fit flex items-start gap-5 relative text-gray-400">
                            <button wire:click="$dispatch('openModal', { component: 'services.commons.modals.signature'})"
                            @class(["p-3 rounded-md flex items-center gap-8 cursor-pointer w-fit", 'bg-color-'.get_color($course->service->name).'/20'])>
                                @if ($signature)
                                    <span class="text-color-2c2c2c font-light">Firma Caricata</span>
                                    <x-icons name="check" />
                                @else
                                    <span class="text-color-2c2c2c font-light">Carica Firma</span>
                                    <x-icons name="image" />
                                @endif
                            </button>
                        </div>

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                        </div>
                    </x-container-step>
                @break
            {{-- Jolly --}}
                @case(6)
                    <x-container-step>
                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                        </div>
                    </x-container-step>
                @break
            @endswitch
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('signaturePad', () => ({
                signaturePadInstance: null,
                init(){
                    this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas);
                },
                clearSignature(){
                    this.signaturePadInstance.clear();
                },
                uploadSignature(){
                    @this.set('signature', this.signaturePadInstance.toDataURL('image/png'));
                    @this.call('getSignature');
                }
            }))
        })
    </script>
@endpush
