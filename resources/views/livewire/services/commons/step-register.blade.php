<div class="w-full h-full pt-14 2xl:px-28">
    <div class="px-10 2xl:px-0">
        <div class="flex items-center gap-5">
            <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group">
                <x-icons name="back" @class(["transition-all duration-300 group-hover:-translate-x-1", 'group-hover:text-color-'.get_color(session()->get('serviceName'))]) />
            </div>
            <h1 @class(["text-5xl font-bold", 'text-color-'.get_color(session()->get('serviceName'))])>{{$course->name}}</h1>
        </div>

        <div class="px-5 xl:px-16 py-9 mt-0 mx-20 2xl:mx-44">

            <div class="flex justify-center gap-1">
                @foreach ($steps as $key => $step)
                    <x-steps
                        color="{{$customerForm->currentStep >= $key ? get_color(session()->get('serviceName')) : 'afafaf'}}"
                        currentStep="{{$customerForm->currentStep}}"
                        number="{{$key}}"
                        step="{{$step['short_name']}}"
                    />
                    @if ($key < count($steps) )
                        <div @class(["h-1 grow max-w-[138px] rounded-full shadow mt-4", $customerForm->currentStep >= $key+1 ? 'bg-color-'.get_color(session()->get('serviceName')) : 'bg-color-afafaf'])></div>
                    @endif
                @endforeach
            </div>

            @switch($currentStep)
                @case('dati')
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Inserire i <span class="font-bold">Dati</span> del cliente per proseguire.
                        </p>

                        <div class="flex flex-col gap-5">
                            <div class="flex flex-wrap gap-2 relative ">
                                <x-input-text wire:model="customerForm.name" width="grow" name="customerForm.name" label="Nome" required="true" />
                                <x-input-text wire:model="customerForm.lastName" width="grow" name="customerForm.lastName" label="Cognome" required="true" />
                                <x-custom-select wire:model="customerForm.sex" name="customerForm.sex" label="Sesso" width="w-1/4" required="true">
                                    <option value="">Seleziona</option>
                                    <option value="donna" class="capitalize">donna</option>
                                    <option value="uomo" class="capitalize">uomo</option>
                                </x-custom-select>
                                <x-input-text x-mask="aaaaaa99a99a999a" wire:model="customerForm.fiscal_code" width="grow" name="customerForm.fiscal_code" label="Codice Fiscale" uppercase="uppercase" required="true" />
                            </div>
                            <div class="flex flex-wrap gap-2 relative ">
                                <x-input-text type="date" wire:model="customerForm.date_of_birth" width="w-1/4" name="customerForm.date_of_birth" label="Nato il" required="true" />
                                <x-input-text wire:model="customerForm.birth_place" width="grow" name="customerForm.birth_place" label="Luogo di nascita" uppercase="capitalize" required="true" />
                                <x-input-text x-mask="aa" wire:model="customerForm.country_of_birth" width="grow" name="customerForm.country_of_birth" label="Provincia di nascita" uppercase="uppercase" required="true" />
                                <x-input-text wire:model="customerForm.country" width="grow" name="customerForm.country" label="Cittadinanza" required="true" />
                            </div>
                            <div class="flex flex-wrap gap-2 relative ">
                                <x-input-text wire:model="customerForm.address" width="grow" name="customerForm.address" label="Via/Piazza" required="true" />
                                <x-input-text x-mask="99999" wire:model="customerForm.civic" width="w-1/12" name="customerForm.civic" label="Civico" required="true" />
                                <x-input-text wire:model="customerForm.city" width="w-1/4" name="customerForm.city" label="Citta" required="true" />
                                <x-input-text x-mask="aa" wire:model="customerForm.province" width="w-1/4" name="customerForm.province" label="Provincia" uppercase="uppercase" required="true" />
                                <x-input-text x-mask="99999" wire:model="customerForm.postcode" width="w-1/12" name="customerForm.postcode" label="Cap" required="true" />
                            </div>
                            <div class="flex flex-wrap gap-2 relative">
                                <x-input-text type="email" wire:model="customerForm.email" width="w-1/4" name="customerForm.email" label="Email" required="true" />
                                <x-input-text x-mask="999 9999999" wire:model="customerForm.phone_1" width="w-1/4" name="customerForm.phone_1" label="1° Cellulare" required="true" />
                                <x-input-text x-mask="999 9999999" wire:model="customerForm.phone_2" width="w-1/4" name="customerForm.phone_2" label="2° Cellulare" />
                            </div>
                        </div>

                        <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
                    </x-container-step>
                @break

                @case('documenti')
                    <x-container-step>
                        <div class="flex justify-between gap-5">
                            <p class="text-xl font-light text-color-2c2c2c">
                                Aggiungere documento e compilare i dati o
                                <span wire:click="skip" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                            </p>
                            <x-submit-button wire:click='addDocument' @class(["ml-auto text-sm",'bg-color-'.get_color(session()->get('serviceName')).'/70'])>+ Documento</x-submit-button>
                        </div>

                        @if (count($documents) > 0)
                        <div class="flex gap-5 overflow-hidden overflow-x-auto pb-5">
                            @foreach ($documents as $key => $document )
                            <div class="flex items-end gap-5">
                                <div class="w-fit flex gap-3 border rounded-md p-4 relative bg-color-f7f7f7 shadow">
                                    <div class="flex flex-col gap-3">
                                        <x-custom-select wire:model.live="documents.{{$key}}.identification_type_id" name="documents.{{$key}}.identification_type_id" label="Tipologia" width="grow" >
                                            <option value="">Seleziona</option>
                                            @foreach ($typeDocuments as $type )
                                                <option @if($type['disabled']) disabled @endif value="{{$type['id']}}" class="capitalize">{{$type['name']}}</option>
                                            @endforeach
                                        </x-custom-select>
                                        <x-input-text wire:model.live="documents.{{$key}}.n_document" width="grow" name="documents.{{$key}}.n_document" uppercase="uppercase" label="Numero documento" />
                                        <x-input-text type="date" wire:model.live="documents.{{$key}}.document_release" width="grow" name="documents.{{$key}}.document_release" label="Rilasciato il" />
                                        <x-input-text wire:model.live="documents.{{$key}}.document_from" width="grow" name="documents.{{$key}}.document_from" uppercase="capitalize" label="Ente di rilascio" />
                                        <x-input-text type="date" wire:model.live="documents.{{$key}}.document_expiration" width="grow" name="documents.{{$key}}.document_expiration" label="Scadenza" />
                                    </div>
                                    @if ($documents[$key]['identification_type_id'] == 2)
                                        <x-custom-select multiple wire:model.live="documents.{{$key}}.qualification" name="documents.{{$key}}.type" label="Qualifiche" width="grow" height="!min-h-[calc(100%-10px)]" >
                                            @foreach ($typePatents as $patent )
                                                <option value="{{$patent}}" class="capitalize">{{$patent}}</option>
                                            @endforeach
                                        </x-custom-select>
                                        {{-- @if (array_key_exists('qualification', $documents[$key]))
                                            <div class="absolute -bottom-8 left-0 font-semibold text-gray-400 flex gap-1">
                                                @foreach ($documents[$key]['qualification'] as $qualification)
                                                    <span> {{$qualification}} </span>
                                                @endforeach
                                            </div>
                                        @endif --}}
                                    @endif
                                    <x-icons wire:click="removeDocument({{$key}})" name="delete" class="mb-5 cursor-pointer absolute top-2 right-2" />
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            @if ($documentUploaded)
                                <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
                            @endif
                        </div>
                    </x-container-step>
                @break

                @case('scansioni')
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la scansione della <span class="font-bold">patente, carta d’identità</span> e il <span class="font-bold">codice fiscale</span>, altrimenti cliccare “inserisci in seguito”
                        </p>

                        <div class="flex items-start justify-between gap-20">
                            <div class="flex flex-col gap-2">
                                <x-input-files multiple wire:model="scans" text="Carica Scansioni" color="{{get_color(session()->get('serviceName'))}}" name="scans"  preview="scans_uploaded" icon="upload" />
                                <span wire:click="skip" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>

                                <div class="text-gray-500 mt-5">
                                    <small class="block">Cittadino extra-comunitario caricare il permesso di soggiorno</small>
                                    <small>Cittadino comunitario caricare il certificato di residenza</small>
                                </div>
                            </div>

                            <div class="flex flex-col gap-1 grow max-w-lg relative py-4 border">
                                <p @class(["font-bold mb-5 pl-4",'text-color-'.get_color(session()->get('serviceName'))])>File Caricati</p>
                                @if ($scans)
                                    @foreach ($scans as $key => $scan)
                                        <div @class(["flex items-center px-4 py-1", ($key < count($scans)-1) ? 'border-b': ''])>
                                            <x-icons name="file" class="mr-2" />
                                            <span class="font-medium text-gray-400">{{$scan->getClientOriginalName()}}</span>
                                            <x-icons wire:click="removeScan({{$key}})" name="file_delete" class="ml-auto cursor-pointer" />
                                        </div>
                                    @endforeach
                                @else
                                    <p class="font-semibold text-gray-400 pl-4">Nessun file presente</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-between">
                            @if (session('course')['registration_type'] == 1)
                                <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Indietro
                                </button>
                            @endif
                            @if ($scanUploaded)
                                <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
                            @endif
                        </div>
                    </x-container-step>
                @break

                @case('fototessera')
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la fototessera, altrimenti cliccare “inserire in seguito”
                        </p>

                        <div class="flex gap-8">
                            <div class="flex flex-col gap-2">
                                <x-input-files wire:model.live="photo" text="Carica Fototessera" color="{{get_color(session()->get('serviceName'))}}" name="photo" preview="fototessera_uploaded" icon="image" />
                                <span wire:click="skip" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                            </div>
                            @if ($photo)
                            <div class="flex items-center gap-3">
                                <img class="w-28 h-36 border" src="{{ $photo->temporaryUrl() }}">
                                <div class="font-medium text-gray-400">{{$photo->getClientOriginalName()}}</div>
                            </div>
                            @else
                            <div class="w-28 h-36 border border-color-dfdfdf rounded-md flex items-center justify-center">
                                <x-icons name="default_photo" />
                            </div>
                            @endif
                        </div>

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            @if ($photo)
                                <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
                            @endif
                        </div>
                    </x-container-step>
                @break

                @case('firma')
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la firma del cliente e salvare, per proseguire.
                        </p>

                        <button wire:click="$dispatch('openModal', { component: 'services.commons.modals.signature'})"
                        @class(["p-3 rounded-md flex items-center gap-8 cursor-pointer w-fit", 'bg-color-'.get_color(session()->get('serviceName')).'/20'])>
                            @if ($signature)
                                <span class="text-color-2c2c2c font-light">Firma Caricata</span>
                                <x-icons name="check" />
                            @else
                                <span class="text-color-2c2c2c font-light">Carica Firma</span>
                                <x-icons name="signature" />
                            @endif
                        </button>

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            @if ($signature)
                                <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
                            @endif
                        </div>
                    </x-container-step>
                @break

                @case('genitore/tutore')
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la <span class="font-bold">firma</span>, la <span class="font-bold">carta d’identità</span> e il <span class="font-bold">codice fiscale</span> del genitore/tutore
                        </p>

                        <div class="flex items-start justify-between gap-20">
                            <div class="flex flex-col gap-2">
                                <button wire:click="$dispatch('openModal', { component: 'services.commons.modals.signature', arguments: {signature: 'parent'} })"
                                @class(["p-3 rounded-md flex items-center gap-8 cursor-pointer", 'bg-color-'.get_color(session()->get('serviceName')).'/20'])>
                                    @if ($parentSignature)
                                        <span class="text-color-2c2c2c font-light">Firma Caricata</span>
                                        <x-icons name="check" />
                                    @else
                                        <span class="text-color-2c2c2c font-light">Carica Firma</span>
                                        <x-icons name="signature" />
                                    @endif
                                </button>

                                <x-input-files multiple wire:model="parentScans" text="Carica Scansioni" color="{{get_color(session()->get('serviceName'))}}" name="parentScans"  preview="scans_uploaded" icon="upload" />
                                <span wire:click="skip" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                            </div>

                            <div class="flex flex-col gap-1 grow max-w-lg relative py-4 border">
                                <p @class(["font-bold mb-5 pl-4",'text-color-'.get_color(session()->get('serviceName'))])>File Caricati</p>
                                @if ($parentScans)
                                    @foreach ($parentScans as $key => $parentScan)
                                        <div @class(["flex items-center px-4 py-1", ($key < count($parentScans)-1) ? 'border-b': ''])>
                                            <x-icons name="file" class="mr-2" />
                                            <span class="font-medium text-gray-400">{{$parentScan->getClientOriginalName()}}</span>
                                            <x-icons wire:click="removeParentScan({{$key}})" name="file_delete" class="ml-auto cursor-pointer" />
                                        </div>
                                    @endforeach
                                @else
                                    <p class="font-semibold text-gray-400 pl-4">Nessun file presente</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            @if ($parentSignature)
                                <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
                            @endif
                        </div>
                    </x-container-step>
                @break

                @case('accompagnatori')
                    <div class="w-full flex flex-col items-end gap-5 mt-5">
                        <div class="w-full bg-white p-4 flex flex-col items-center gap-5">
                            @if (count($companions) < 3)
                                <button wire:click="addCompanion" class="ml-auto w-fit text-lg inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                    + Accompagnatore
                                </button>
                            @endif

                            @foreach ($companions as $key => $companion)
                                <div class="w-full p-4  bg-color-f7f7f7 shadow-shadow-card flex flex-col gap-2">
                                    <div class="flex items-end justify-between">
                                        <p class="text-xl font-bold capitalize text-color-2c2c2c">
                                            accompagnatore {{$key}}
                                            @if ($key == 1 && count($companions) < 2 && !$companionUploaded)
                                                <span wire:click="skip" class="ml-4 text-base font-normal text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                                            @endif
                                        </p>
                                        @if ($key != 1)
                                            <x-icons name="delete" wire:click="removeCompanion({{$key}})" class="cursor-pointer" />
                                        @endif
                                    </div>
                                    <div class="flex border-t">
                                        <div class="flex flex-col gap-2 pt-2 pr-5 mr-5 border-r">
                                            <p>Caricare la <span class="font-bold">firma</span> dell'Accompagnatore</p>
                                            <button wire:click="$dispatch('openModal', { component: 'services.commons.modals.signature', arguments: {signature: 'companion', key: {{$key}}} })"
                                            @class(["w-fit p-3 rounded-md flex items-center gap-8 cursor-pointer", 'bg-color-'.get_color(session()->get('serviceName')).'/20'])>
                                                @if ($companion['signature'])
                                                    <span class="text-color-2c2c2c font-light">Firma Caricata</span>
                                                    <x-icons name="check" />
                                                @else
                                                    <span class="text-color-2c2c2c font-light">Carica Firma</span>
                                                    <x-icons name="signature" />
                                                @endif
                                            </button>
                                        </div>

                                        <div class="grow flex gap-5 justify-between pt-2">
                                            <div class="flex flex-col gap-2">
                                                <p>Caricare la <span class="font-bold">carta di Identità</span> e il <span class="font-bold">codice fiscale</span> dell'Accompagnatore</p>
                                                <x-input-files multiple wire:model="companions.{{$key}}.scans" text="Carica Scansioni" color="{{get_color(session()->get('serviceName'))}}" name="companion.{{$key}}.scans"  preview="scans_uploaded" icon="upload" />
                                            </div>

                                            <div class="flex flex-col gap-1 grow max-w-lg relative py-4 border">
                                                <p @class(["font-bold mb-5 pl-4",'text-color-'.get_color(session()->get('serviceName'))])>File Caricati</p>
                                                @if ($companion['scans'])
                                                    @foreach ($companion['scans'] as $number => $scan)
                                                        <div @class(["flex items-center px-4 py-1", ($key < count($companion['scans'])-1) ? 'border-b': ''])>
                                                            <x-icons name="file" class="mr-2" />
                                                            <span class="font-medium text-gray-400">{{$scan->getClientOriginalName()}}</span>
                                                            <x-icons wire:click="removeCompanionScan({{$key}}, {{$number}})" name="file_delete" class="ml-auto cursor-pointer" />
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="font-semibold text-gray-400 pl-4">Nessun file presente</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="flex gap-5 justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            @if ($companionUploaded)
                                <x-submit-button wire:click='nextStep' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
                            @endif
                        </div>
                    </div>
                @break

                @case('residenza')
                    <x-container-step>
                        <div class="p-10 flex flex-col text-center justify-center gap-10 relative">
                            <h1 class="text-4xl font-medium text-color-2c2c2c">Conferma residenza</h1>

                            <div class="flex flex-wrap gap-4">
                                <x-input-text wire:model="customerForm.city" width="grow" name="customerForm.city" label="Città" uppercase="capitalize" required="true" />
                                <x-input-text wire:model="customerForm.province" width="grow" name="customerForm.province" label="Provincia" uppercase="uppercase" required="true" />
                                <x-input-text wire:model="customerForm.postcode" width="grow" name="customerForm.postcode" label="Cap" uppercase="uppercase" required="true" />
                                <x-input-text wire:model="customerForm.toponym" width="grow" name="customerForm.toponym" label="Toponimo" uppercase="capitalize" />
                                <x-input-text wire:model="customerForm.address" width="grow" name="customerForm.address" label="Indirizzo" uppercase="capitalize" required="true" />
                                <x-input-text wire:model="customerForm.civic" width="grow" name="customerForm.civic" label="N. Civico" uppercase="uppercase" required="true" />
                            </div>

                            <div class="flex justify-between">
                                <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Indietro
                                </button>
                                <x-submit-button wire:click='nextStep' @class(['bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
                            </div>
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
                    @this.dispatch('closeModal');
                },
                uploadParentSignature() {
                    @this.set('parentSignature', this.signaturePadInstance.toDataURL('image/png'));
                    @this.dispatch('closeModal');
                },
                uploadCompanionSignature(key) {
                    @this.set('companions.'+key+'.signature', this.signaturePadInstance.toDataURL('image/png'));
                    @this.dispatch('closeModal');
                },
            }))
        })
    </script>
@endpush
