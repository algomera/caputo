<div class="p-4 space-y-8 !align-top">
    <div class="flex items-start gap-2">
        @if ($visit->customer->photo()->first())
        <img class="w-28 h-28" src="{{Vite::asset($visit->registration->customer->photo()->first()->path)}}" alt="">
        @else
        <div class="w-28 h-28 border shadow flex items-center justify-center">
            <x-icons name="default_photo" />
        </div>
        @endif
        <div>
            <h3 class="text-lg font-medium">{{$visit->customer->full_name}}</h3>
            <p class="text-color-808080 text-sm font-bold">Iscritto a: <span class="text-base text-color-2c2c2c capitalize font-medium">{{$visit->registration->course->name}}</span></p>
            <p class="text-color-808080 text-sm font-bold">Tipo visita: <span class=" text-base text-color-2c2c2c capitalize font-medium">{{$visit->registration->course->type_visit}}</span></p>
        </div>

        <div class="ml-auto flex flex-col gap-4">
            <button wire:click="delete" class="px-6 py-2 bg-red-500/70 text-white uppercase font-semibold  focus-visible:ring-0 focus-visible:border-none focus-visible:outline-none focus-visible:ring-offset-0 hover:scale-105 transition-all duration-300">annulla visita</button>
            <button wire:click="showCustomer" class="px-6 py-2 bg-color-347af2/70 text-white uppercase font-semibold  focus-visible:ring-0 focus-visible:border-none focus-visible:outline-none focus-visible:ring-offset-0 hover:scale-105 transition-all duration-300">mostra Profilo</button>
        </div>
    </div>

</div>
