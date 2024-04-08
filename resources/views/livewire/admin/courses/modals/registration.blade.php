<div class="p-10 pb-5">
    <div class="sticky top-0 left-0 w-full flex items-center justify-between border-b border-color-347af2">
        <div class="flex items-center gap-2">
            <x-icons name="{{get_icon(get_course($courseRegistration->course_id)->service->name)}}" class="w-12"/>
            <h1 class="text-4xl font-medium text-color-347af2 pt-2 capitalize">{{get_course($courseRegistration->course_id, $courseRegistration->variant_id)->name}}</h1>
            <h1 class="text-2xl text-color-347af2 pt-2 capitalize">({{get_registrationType($courseRegistration->registration_type_id)->name}})</h1>
        </div>
        <x-icons wire:click="$dispatch('closeModal')" name="x_close" class="w-8 text-gray-400 cursor-pointer hover:text-color-2c2c2c transition-all duration-200" />
    </div>

    <div class="flex flex-col h-[600px] overflow-scroll no-scrollbar gap-5">
        {{-- Condizione --}}
        <div class="grow pt-5">
            <div class="space-y-3">
                <h3 class="text-lg capitalize font-medium text-color-347af2">Condizione di iscrizione</h3>
                <x-input-text wire:model="condition" width="w-full" name="condition" label="Condizioni" />
            </div>
        </div>

        {{-- Tipi di iscrizione --}}
        <div class="grow pt-5 border-t-2">
            <div class="space-y-3">
                <h3 class="text-lg capitalize font-medium text-color-347af2">Tipi di iscrizione</h3>
                <div class="w-full flex flex-col gap-4">
                    @foreach ($allBranches as $branch)
                        <div class="space-y-2">
                            <x-custom-checkbox wire:model.live="stateBranches.{{$branch->id}}" value="" label="{{$branch->name}}" />
                            @foreach ($selectedBranches as $key => $selectedBranch )
                                @if ($branch->id == $key && $selectedBranches[$key]['state'])
                                    <div class="max-w-full flex items-start justify-start flex-col gap-3 p-5 border rounded-md shadow">
                                        <div class="w-full grid grid-cols-3 gap-3">
                                            <x-input-text x-mask="99" wire:model="selectedBranches.{{$key}}.absences" width="grow" name="selectedBranches.{{$key}}.absences" label="Assenze consentite" />
                                            <x-input-text x-mask="99" wire:model="selectedBranches.{{$key}}.guides" width="grow" name="selectedBranches.{{$key}}.guides" label="Guide obbligatorie" />
                                            <x-input-text x-mask:dynamic="$money($input, '.', ' ')" wire:model="selectedBranches.{{$key}}.price" width="grow" name="selectedBranches.{{$key}}.price" placeholder="0.00" label="Prezzo iscrizione €" required="true" />
                                        </div>
                                        <x-input-text wire:model="selectedBranches.{{$key}}.condition" width="w-full" name="selectedBranches.{{$key}}.condition" label="Condizioni di iscrizione" />
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Costi --}}
        <div class="grow pt-5 border-t-2">
            <div class="space-y-3">
                <h3 class="text-lg capitalize font-medium text-color-347af2">Costi</h3>
                @foreach ($costs as $cost)
                    <div  class="flex items-end gap-2 my-1">
                        <x-custom-checkbox wire:model.live="selectedCosts" value="{{ $cost->id }}" label="{{$cost->name}}" />
                        <div class="grow h-[1px] min-w-[20px] bg-color-dfdfdf mb-2"></div>
                        <p class="text-color-2c2c2c">{{$cost->price}} €</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Opzioni --}}
        <div class="grow pt-5 border-t-2">
            <div class="space-y-3">
                <h3 class="text-lg capitalize font-medium text-color-347af2">opzioni</h3>
                @foreach ($options as $option)
                <div class="flex items-end gap-2 my-1">
                    <x-custom-checkbox wire:model.live="selectedOptions" value="{{ $option->id }}" label="{{$option->name}}" />
                    <div class="grow h-[1px] min-w-[20px] bg-color-dfdfdf mb-2"></div>
                    <p class="text-color-2c2c2c">{{$option->price}} €</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Guide --}}
        <div class="grow pt-5 border-t-2">
            <div class="flex items-end gap-4">
                <div class="space-y-3">
                    <h3 class="text-lg capitalize font-medium text-color-347af2">Tipologia Guide</h3>
                    <div class="flex items-start gap-5">
                        <x-custom-select wire:model.live="selectedGuide" name="selectedGuide" label="Guide prenotabili" width="w-fit" required="true">
                            <option value="">Seleziona</option>
                            @foreach ($guides as $guide )
                                <option value="{{$guide->id}}">{{$guide->name}}</option>
                            @endforeach
                        </x-custom-select>
                    </div>
                </div>
                <div class="flex gap-5">
                    <div>
                        <small class="block font-bold text-gray-400">Durata</small>
                        <span class="font-light text-color-2c2c2c">{{$detailGuide->duration}} Min.</span>
                    </div>
                    <div>
                        <small class="block font-bold text-gray-400">Prezzo</small>
                        <span class="font-light text-color-2c2c2c">{{$detailGuide->price}} €</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step registrazione --}}
        <div class="grow pt-5 border-t-2">
            <div class="space-y-3">
                <h3 class="text-lg capitalize font-medium text-color-347af2">Step registrazione</h3>
                @foreach ($steps as $step)
                    @if ($step->id == 1 || $step->id == 2)
                        <x-custom-radio wire:model.live='selectedStepData' label="{{$step->name}}" name="data" value="{{ $step->id }}" />
                    @else
                        <x-custom-checkbox wire:model.live="selectedSteps" value="{{ $step->id }}" label="{{$step->name}}" />
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="sticky bottom-0 left-0 w-full flex justify-end mt-5">
        <x-submit-button wire:click='save' class="bg-color-347af2">Salva</x-submit-button>
    </div>
</div>
