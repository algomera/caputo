<div class="px-14 py-8 flex flex-col gap-4">
    @if ($stepSkipped)
        <div wire:click="back" class="flex items-center gap-2 group cursor-pointer ">
            <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
            <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
        </div>
    @endif

    @if ($stepSkipped)
        <h1 class="text-3xl font-bold text-color-17489f">{{get_step($stepSkipped)->name}}
            <span class="text-lg">({{$registration->course->name}})</span>
        </h1>

        @if ($stepSkipped == 3) {{-- documenti cliente --}}
            <div class="flex items-center gap-3">
                <x-container-step>
                    <p class="text-xl font-light text-color-2c2c2c">
                        Caricare la scansione della <span class="font-bold">patente, carta d’identità</span> e il <span class="font-bold">codice fiscale</span>.
                    </p>

                    <div class="flex items-start justify-between gap-20">
                        <div class="flex flex-col gap-2">
                            <x-input-files multiple wire:model="scans" text="Carica Scansioni" color="{{get_color($registration->course->service->name)}}" name="scans"  preview="scans_uploaded" icon="upload" />

                            <div class="text-gray-500 mt-5">
                                <small class="block">Cittadino extra-comunitario caricare il permesso di soggiorno</small>
                                <small>Cittadino comunitario caricare il certificato di residenza</small>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 grow max-w-lg relative py-4 border">
                            <p @class(["font-bold mb-5 pl-4",'text-color-'.get_color($registration->course->service->name)])>File Caricati</p>
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

                    @if ($scanUploaded)
                        <x-submit-button wire:click='save' @class(["ml-auto",'bg-color-'.get_color($registration->course->service->name)])>Salva</x-submit-button>
                    @endif
                </x-container-step>
            </div>
        @endif

        @if ($stepSkipped == 6) {{-- genitore/tutore --}}
            <div class="flex items-center gap-3">
                <x-container-step>
                    <p class="text-xl font-light text-color-2c2c2c">
                        Caricare la scansione della <span class="font-bold">carta d’identità</span> e il <span class="font-bold">codice fiscale</span>.
                    </p>

                    <div class="flex items-start justify-between gap-20">
                        <div class="flex flex-col gap-2">
                            <x-input-files multiple wire:model="scans" text="Carica Scansioni" color="{{get_color($registration->course->service->name)}}" name="scans"  preview="scans_uploaded" icon="upload" />

                            <button wire:click="$dispatch('openModal', { component: 'services.commons.modals.signature'})"
                                @class(["p-3 rounded-md flex items-center gap-8 cursor-pointer w-fit", 'bg-color-'.get_color($registration->course->service->name).'/20'])>
                                @if ($signatureUpload)
                                    <span class="text-color-2c2c2c font-light">Firma Caricata</span>
                                    <x-icons name="check" />
                                @else
                                    <span class="text-color-2c2c2c font-light">Carica Firma</span>
                                    <x-icons name="signature" />
                                @endif
                            </button>

                            <div class="text-gray-500 mt-5">
                                <small class="block">Cittadino extra-comunitario caricare il permesso di soggiorno</small>
                                <small>Cittadino comunitario caricare il certificato di residenza</small>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 grow max-w-lg relative py-4 border">
                            <p @class(["font-bold mb-5 pl-4",'text-color-'.get_color($registration->course->service->name)])>File Caricati</p>
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

                    @if ($scanUploaded && $signatureUpload)
                        <x-submit-button wire:click='save' @class(["ml-auto",'bg-color-'.get_color($registration->course->service->name)])>Salva</x-submit-button>
                    @endif
                </x-container-step>
            </div>
        @endif

        @if ($stepSkipped == 7) {{-- accompagnatore --}}
            <div class="w-full flex flex-col items-end gap-5">
                <div class="w-full bg-white flex flex-col items-center gap-5">
                    @if ((count($companions) + count($newCompanions)) < 3)
                        <button wire:click="addCompanion" class="ml-auto w-fit text-lg inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                            + Accompagnatore
                        </button>
                    @endif

                    @foreach ($newCompanions as $key => $companion)
                        <div class="w-full p-4  bg-color-f7f7f7 shadow-shadow-card flex flex-col gap-2">
                            <div class="flex items-end justify-between">
                                <p class="text-xl font-bold capitalize text-color-2c2c2c">accompagnatore {{$key}}</p>
                                @if ($key != 1)
                                    <x-icons name="delete" wire:click="removeCompanion({{$key}})" class="cursor-pointer" />
                                @endif
                            </div>
                            <div class="flex border-t">
                                <div class="flex flex-col gap-2 pt-2 pr-5 mr-5 border-r">
                                    <p>Caricare la <span class="font-bold">firma</span> dell'Accompagnatore</p>
                                    <button wire:click="$dispatch('openModal', { component: 'services.commons.modals.signature', arguments: {signature: 'companion', key: {{$key}}} })"
                                    @class(["w-fit p-3 rounded-md flex items-center gap-8 cursor-pointer", 'bg-color-'.get_color($registration->course->service->name).'/20'])>
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
                                        <x-input-files wire:model="newCompanions.{{$key}}.scans" text="Carica Scansioni" color="{{get_color($registration->course->service->name)}}" name="companion.{{$key}}.scans"  preview="scans_uploaded" icon="upload" />
                                    </div>

                                    <div class="flex flex-col gap-1 grow max-w-lg relative py-4 border">
                                        <p @class(["font-bold mb-5 pl-4",'text-color-'.get_color($registration->course->service->name)])>File Caricato</p>
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

                @if ($companionUploaded)
                    <x-submit-button wire:click='save' @class(["ml-auto",'bg-color-'.get_color($registration->course->service->name)])>salva</x-submit-button>
                @endif
            </div>
        @endif

        @if ($stepSkipped == 9) {{-- visita medica --}}
            <div class="flex items-center gap-3">
                <x-container-step>
                    <div class="flex items-start justify-between gap-20">
                        <div class="flex flex-col gap-2">
                            <x-input-files multiple wire:model="scans" text="Carica Scansioni" color="{{get_color($registration->course->service->name)}}" name="scans"  preview="scans_uploaded" icon="upload" />

                            <div class="text-gray-500 mt-5">
                                <small class="block">Assicurati che il certificato medico sia in corso di validità.</small>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 grow max-w-lg relative py-4 border">
                            <p @class(["font-bold mb-5 pl-4",'text-color-'.get_color($registration->course->service->name)])>File Caricati</p>
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

                    @if ($scanUploaded)
                        <x-submit-button wire:click='save' @class(["ml-auto",'bg-color-'.get_color($registration->course->service->name)])>Salva</x-submit-button>
                    @endif
                </x-container-step>
            </div>
        @endif

    @else
        <h1 class="text-5xl font-bold text-color-17489f capitalize">Documenti Mancanti
            <span class="text-2xl">{{$registration->course->name}}</span>
        </h1>

        <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
            <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
                <thead class="customHead">
                    <tr class="text-center text-color-545454">
                        <th colspan="3" scope="col" class="px-3 py-3.5 font-light text-left">Descrizione</th>
                        <th scope="col" class="px-3 py-3.5 font-light text-left"></th>
                    </tr>
                </thead>
                <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                    @if (count(json_decode($registration->step_skipped)) > 0)
                        @foreach(json_decode($registration->step_skipped) as $step)
                            <tr class="text-center even:bg-color-f7f7f7">
                                <td colspan="3" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c">{{get_step($step)->name}}</td>
                                <td class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">
                                    @if (!in_array($step, [2,4]))
                                        <div class="w-full flex items-center justify-center">
                                            <button wire:click="$set('stepSkipped', '{{$step}}')" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">inserisci</button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun documento mancante...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @endif
</div>
