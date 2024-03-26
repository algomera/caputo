<div class="px-14 py-8 flex flex-col gap-4 relative">
    <div>
        <h1 class="text-3xl font-bold text-color-17489f capitalize">{{$lessonPlanning->training->course->name}}</h1>
        <div class="flex items-center gap-4">
            <h3 class="text-xl font-bold text-color-2c2c2c capitalize">Lezione: <span class="ml-2 text-lg">{{$lessonPlanning->lesson->subject}}</span></h3>
            <small class="text-color-808080 font-semibold">Durata: {{$lessonPlanning->lesson->duration}} Min.</small>
        </div>
    </div>
    <div class="absolute top-8 right-8 flex flex-col items-center font-medium">
        <span class="font-semibold text-xl">{{date("d/m/Y", strtotime($lessonPlanning->begin))}}</span>
        <span class=" text-color-17489f text-lg">{{date("H:i", strtotime($lessonPlanning->begin))}} - {{date("H:i", strtotime($endLesson))}}</span>
    </div>

    <div>
        <p class="text-color-2c2c2c">
            <span class="font-semibold uppercase">Descrizione:</span>
            {{$lessonPlanning->lesson->description}}
        </p>
    </div>

    @if ($training->id === $lessonPlanning->training_id && $lessonPlanning->begin > now())
        <div class="w-full flex items-center justify-between mt-5">
            @if ($training->ends)
                <x-submit-button wire:click='cancel' class="bg-red-500/70">Annulla lezione</x-submit-button>
            @endif

            @if (count($training->customers()->where('branch', 'teoria')->get()))
                <x-submit-button wire:click='presences' class="bg-color-347af2">Gestione presenze</x-submit-button>
            @endif
        </div>
    @endif
</div>
