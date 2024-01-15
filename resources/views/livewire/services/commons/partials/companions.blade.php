<div class="w-full flex flex-col items-end gap-5 mt-5">
    <div class="w-full flex flex-col items-center gap-5">
        @foreach ($companions as $key => $companion)
            <div class="w-full p-4 bg-white flex flex-col gap-2">
                <p class="text-xl font-bold capitalize text-color-2c2c2c">
                    accompagnatore {{$key}}
                </p>
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

                        <span wire:click="nextStep" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                    </div>

                    <div class="grow flex gap-5 justify-between pt-2">
                        <div class="flex flex-col gap-2">
                            <p>Caricare la <span class="font-bold">carta di Identità</span> e il <span class="font-bold">codice fiscale</span> dell'Accompagnatore</p>
                            <x-input-files multiple wire:model="companions.{{$key}}.scans" text="Carica Scansioni" color="{{get_color(session()->get('serviceName'))}}" name="companion.{{$key}}.scans"  preview="scans_uploaded" icon="upload" />
                            <span wire:click="nextStep" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                        </div>

                        <div class="flex flex-col gap-1 grow max-w-lg relative py-4 border">
                            <p @class(["font-bold mb-5 pl-4",'text-color-'.get_color(session()->get('serviceName'))])>File Caricati</p>
                            @if ($companion['scans'])
                                @foreach ($companion['scans'] as $number => $scan)
                                    <div @class(["flex items-center px-4 py-1", ($key < count($companion['scans'])-1) ? 'border-b': ''])>
                                        <x-icons name="file" class="mr-2" />
                                        <span class="font-medium text-gray-400">{{$scan->getClientOriginalName()}}</span>
                                        <x-icons wire:click="removeScan({{$key}}, {{$number}})" name="file_delete" class="ml-auto cursor-pointer" />
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
        <x-submit-button wire:click='putCompanion' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
    </div>
</div>
