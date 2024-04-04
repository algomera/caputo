<div class="p-10">
    <div class="sticky top-0 left-0 w-full flex items-center justify-between border-b border-color-347af2">
        <div class="flex items-center gap-2">
            <x-icons name="{{get_icon(get_course($courseRegistration->course_id)->service->name)}}" class="w-12"/>
            <h1 class="text-4xl font-medium text-color-347af2 pt-2 capitalize">{{get_course($courseRegistration->course_id, $courseRegistration->variant_id)->name}}</h1>
            <h1 class="text-2xl text-color-347af2 pt-2 capitalize">({{get_registrationType($courseRegistration->registration_type_id)->name}})</h1>
        </div>
        <x-icons wire:click="$dispatch('closeModal')" name="x_close" class="w-8 text-gray-400 cursor-pointer hover:text-color-2c2c2c transition-all duration-200" />
    </div>

    <div class="flex flex-col h-[600px] overflow-scroll no-scrollbar gap-5">

        {{-- Tipi di iscrizione --}}
        <div class="grow pt-5">
            <div class="space-y-3">
                <h3 class="text-lg capitalize font-medium text-color-347af2">Tipi di iscrizione</h3>
                <div class="w-full flex divide-x-2">
                    @foreach ($branches as $branch)
                        <div class="grow space-y-3 px-6">
                            <x-custom-checkbox wire:model.live="selectedBranch" value="{{ $branch->id }}" label="{{$branch->name}}" />
                            @if (in_array($branch->id, $selectedBranch))
                                <div class="flex flex-col gap-3">
                                    <x-input-text x-mask="99" wire:model="courseBranch.absences" width="grow" name="courseBranch" label="Assenze" />
                                    <x-input-text x-mask="99" wire:model="courseBranch.guides" width="grow" name="courseBranch" label="Guide" />
                                    <x-input-text x-mask:dynamic="$money($input, '.', ' ')" wire:model="courseBranch.price" width="grow" name="courseBranch.price" placeholder="0.00" label="Prezzo €" />
                                </div>
                            @endif
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

        {{-- Step registrazione --}}
        <div class="grow pt-5 border-t-2">
            <div class="space-y-3">
                <h3 wire:click='debug' class="text-lg capitalize font-medium text-color-347af2">Step registrazione</h3>
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

    <div class="sticky bottom-0 left-0 w-full flex justify-end mt-10">
        <x-submit-button wire:click='store' class="bg-color-347af2">Salva</x-submit-button>
    </div>
</div>
