<div class="p-4 space-y-8 !align-top">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            @if ($driving->customer->photo()->first())
            <img class="w-28 h-28" src="{{asset($driving->customer->photo()->first()->path)}}" alt="">
            @else
            <div class="w-28 h-28 border shadow flex items-center justify-center">
                <x-icons name="default_photo" />
            </div>
            @endif
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="text-lg font-medium">{{$driving->customer->full_name}}</h3>
                    @if (count(json_decode($driving->registration->step_skipped)))
                        <span title="Mandare in accettazione" class="px-3 text-sm font-medium text-red-500 underline cursor-default">Dati Mancanti!</span>
                    @endif
                </div>
                <p class="text-color-808080 text-sm font-bold">Corso:
                    <span class="text-base text-color-2c2c2c capitalize font-medium">
                        @if ($driving->registration->courseVariant)
                            {{$driving->registration->courseVariant->name}}
                        @else
                            {{$driving->registration->course->name}}
                        @endif
                    </span>
                </p>
                <p class="text-color-808080 text-sm font-bold">Istruttore: <span class=" text-base text-color-2c2c2c capitalize font-medium">{{$driving->instructor->full_name}}</span></p>
                <div class="flex items-center gap-4">
                    <span class="text-color-808080 text-sm font-bold">Veicolo: <span class=" text-base text-color-2c2c2c capitalize font-medium">{{ $driving->vehicle->type}}</span></span>
                    <span class="text-color-808080 text-sm font-bold">Targa: <span class=" text-base text-color-2c2c2c capitalize font-medium">{{$driving->vehicle->plate}}</span></span>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <div class="ml-auto flex flex-col gap-3">
                @if ($deletable)
                    <button wire:click="delete" class="px-6 py-2 bg-red-500/70 text-white uppercase font-semibold  focus-visible:ring-0 focus-visible:border-none focus-visible:outline-none focus-visible:ring-offset-0 hover:scale-105 transition-all duration-300">annulla guida</button>
                @endif
                @if ($driving->note)
                    <button wire:click="$dispatch('openModal', { component: 'driving.modals.show-note-guide', arguments: { guide: {{ $driving->id }} }})" class="px-6 py-2 bg-color-e9863e/70 text-white uppercase font-semibold  focus-visible:ring-0 focus-visible:border-none focus-visible:outline-none focus-visible:ring-offset-0 hover:scale-105 transition-all duration-300">Note guida</button>
                @endif
            </div>
            <div class="ml-auto flex flex-col gap-3">
                <button wire:click="$dispatch('openModal', { component: 'driving.modals.show-registration-guides', arguments: { registration: {{ $driving->registration_id }} }})" class="px-6 py-2 bg-color-74d4ff text-white uppercase font-semibold  focus-visible:ring-0 focus-visible:border-none focus-visible:outline-none focus-visible:ring-offset-0 hover:scale-105 transition-all duration-300">Storico guide</button>
                @role('admin|responsabile sede|segretaria')
                    <button wire:click="showCustomer" class="px-6 py-2 bg-color-347af2/70 text-white uppercase font-semibold  focus-visible:ring-0 focus-visible:border-none focus-visible:outline-none focus-visible:ring-offset-0 hover:scale-105 transition-all duration-300">Vai al Profilo</button>
                @endrole
            </div>
        </div>
    </div>
</div>
