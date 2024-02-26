<div class="px-14 py-8 flex flex-col gap-4 relative">
    <div x-data="{ loopTraining: false }" class="flex flex-col gap-5">
        <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer ">
            <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
            <span class="text-lg text-color-808080 group-hover:underline pt-1">Indietro</span>
        </div>

        <div class="w-full flex items-end justify-between">
            <h1 @class(["text-4xl font-semibold", 'text-color-'.get_color($course->service->name)])>Seleziona e compila i campi</h1>
            <button x-on:click="loopTraining = !loopTraining, $wire.setLoop()" class="py-2 px-6 bg-color-dfdfdf border border-gray-200 text-gray-600 rounded hover:bg-gray-200 active:bg-gray-200 disabled:opacity-50 shadow-md">
                Corso in loop
            </button>
        </div>

        <div class="flex gap-2 border rounded-md relative p-4 bg-color-f7f7f7">
            @if (count($course->variants()->get()) > 0)
                <x-custom-select wire:model="trainingCourseVariant" name="trainingCourseVariant" label="Corso" width="grow" required="true">
                    <option value="">{{$course->name}}</option>
                    @foreach ($course->variants()->get() as $variant)
                        <option value="{{$variant->id}}" class="capitalize">{{$variant->name}}</option>
                    @endforeach
                </x-custom-select>
            @endif
            <x-custom-select wire:model="trainingUser" name="trainingUser" label="Insegnante" width="grow" required="true">
                <option value="">Seleziona</option>
                @foreach ($users as $user )
                    <option value="{{$user->id}}" class="capitalize">{{$user->name}} {{$user->lastName}}</option>
                @endforeach
            </x-custom-select>
            <x-input-text type="date" wire:model="trainingBegins" width="grow" name="trainingBegins" label="Inizio corso" required="true" />

            <div x-show="loopTraining" class="grow">
                <x-input-text type="time" wire:model.live="trainingTimeStart" width="grow" name="trainingTimeStart" label="Orario lezioni"  />
            </div>
            <div x-show="!loopTraining" class="grow">
                <x-input-text type="date" wire:model.live="trainingEnds" width="grow" name="trainingEnds" label="Fine corso"  />
            </div>
        </div>

        <x-submit-button wire:click='createTraining' @class(["ml-auto",'bg-color-'.get_color($course->service->name)])>Crea corso</x-submit-button>
    </div>
</div>
