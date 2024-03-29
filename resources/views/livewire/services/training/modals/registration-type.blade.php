<div class="p-4 pb-16">
    @if (!$selectedRegistrationType)
        <div class="w-full flex justify-between">
            <h1 @class(["text-4xl font-semibold", 'text-color-'.get_color($course->service->name)])>Selezionare opzione
                <span class="text-2xl">({{$course->name}})</span>
            </h1>
            @if ($existingVariant)
                <button wire:click="showVariant" class="text-lg font-medium capitalize pt-1 px-4 bg-color-017c67 text-white border-transparent focus-visible:border-transparent focus:border-transparent !outline-none focus:ring-0 {{$variant ? 'bg-yellow-500/70' : 'bg-color-017c67/70'}}">
                    @if ($variant) Varianti corso @else Corso standard @endif
                </button>
            @endif
        </div>

        <div class="m-auto flex flex-col gap-4 px-20 2xl:px-56 mt-16">
            @foreach ($courseRegistrationTypes as $key => $type)
                <div wire:key="type-{{$key}}" wire:click="setRegistrationType({{$type->registration_type_id}}, {{$type->variant_id}})" class="w-full h-24 flex flex-col items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                    <p class="text-lg text-color-2c2c2c font-semibold capitalize">{{$type->registrationType->name}} {{$type->condition}}</p>
                    @if ($variant)
                        <small class="font-semibold text-gray-400 text-center">{{$type->courseVariant->name}}</small>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="w-full flex justify-between">
            <div wire:click='resetOption' class="flex items-center gap-2 group cursor-pointer ">
                <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
                <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
            </div>
            <small class="text-gray-400 font-bold capitalize">{{get_registrationType(session('course')['registration_type'])->name}}</small>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-5 py-24">

            @foreach ($selectedRegistrationType->branchCourses()->get() as $branchCourse )
                <div wire:click='setBranch({{$branchCourse->id}})' class="px-24 h-24 flex flex-col items-center justify-center border rounded-md shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                    <p class="text-lg text-color-2c2c2c whitespace-nowrap capitalize">Gestione {{$branchCourse->branch->name}}</p>
                    <small>{{$branchCourse->condition}}</small>
                </div>
            @endforeach
        </div>
    @endif
</div>
