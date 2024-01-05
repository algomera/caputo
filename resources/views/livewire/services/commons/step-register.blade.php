<div class="w-full h-full py-14 2xl:px-28">
    <div class="px-10 2xl:px-0">
        <div class="flex items-center gap-5">
            <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group">
                <x-icons name="back" @class(["transition-all duration-300 group-hover:-translate-x-1", 'group-hover:text-color-'.get_color($course->service->name)]) />
            </div>
            <h1 @class(["text-5xl font-bold", 'text-color-'.get_color($course->service->name)])>{{$course->name}}</h1>
        </div>

        <div class="px-5 xl:px-16 py-9 mt-14 mx-20 2xl:mx-44">

            <div class="flex justify-center gap-1">
                @foreach ($steps as $key => $step)
                    <x-steps
                        color="{{$currentStep >= $key+1 ? get_color($course->service->name) : 'afafaf'}}"
                        currentStep="{{$currentStep}}"
                        number="{{$key+1}}"
                        step="{{$step}}"
                    />
                    @if ($key+1 < count($steps) )
                        <div @class(["h-1 grow max-w-[138px] rounded-full shadow mt-4", $currentStep >= $key+2 ? 'bg-color-'.get_color($course->service->name) : 'bg-color-afafaf'])></div>
                    @endif
                @endforeach
            </div>

            @switch($currentStep)
            {{-- Fototessera --}}
                @case(1)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la fototessera e salvare, altrimenti cliccare “inserire in seguito”
                        </p>

                        <div class="flex gap-8">
                            <div class="flex flex-col gap-2">
                                <x-input-files wire:model.live="photo" text="Carica Fototessera" color="{{get_color($course->service->name)}}" name="fototessera" preview="fototessera_uploaded" />
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
                            <x-submit-button wire:click='saveData' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                        </div>
                    </x-container-step>
                    @break
            {{-- Firma --}}
                @case(2)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la firma e salvare, altrimenti cliccare “inserire in seguito”
                        </p>

                        <div class="flex flex-col gap-2">
                            <x-input-files wire:model="signature" text="Carica Firma" color="{{get_color($course->service->name)}}" name="firma"  preview="firma_uploaded" />
                            <span wire:click="nextStep" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                        </div>

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            <x-submit-button wire:click='saveData' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                        </div>
                    </x-container-step>
                    @break
            {{-- Cellulare --}}
                @case(3)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Inserire il numero di cellulare e salvare, altrimenti cliccare “inserire in seguito”
                        </p>

                        <div class="flex flex-col gap-2">
                            <x-input-text x-mask="999 9999999" wire:model.live="phone" width="w-1/4" name="phone" label="Cellulare" required="true" />
                            <span wire:click="nextStep" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                        </div>


                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            <x-submit-button wire:click='saveData' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                        </div>
                    </x-container-step>
                    @break
            {{-- Email --}}
                @case(4)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Inserire l’email e salvare, altrimenti cliccare “inserire in seguito”
                        </p>

                        <div class="flex flex-col gap-2">
                            <x-input-text type="email" wire:model.live="email" width="w-1/4" name="email" label="Email" required="true" />
                            <span wire:click="nextStep" class="text-color-2c2c2c underline cursor-pointer">Inserisci in seguito</span>
                        </div>

                        <div class="flex justify-between">
                            <button wire:click="backStep" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                Indietro
                            </button>
                            <x-submit-button wire:click='saveData' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                        </div>
                    </x-container-step>
                    @break
            {{-- Documenti --}}
                @case(5)
                    <x-container-step>
                        <p class="text-xl font-light text-color-2c2c2c">
                            Caricare la scansione della <span class="font-bold">patente, carta d’identità</span> e il <span class="font-bold">codice fiscale</span>
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
                            <x-submit-button wire:click='saveData' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Prosegui</x-submit-button>
                        </div>
                    </x-container-step>
                    @break
            {{-- Anamnestico --}}
                @case(6)
                    <x-container-step></x-container-step>
                    @break
            @endswitch
        </div>
    </div>
</div>
