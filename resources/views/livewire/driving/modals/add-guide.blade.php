<div class="px-14 py-8 flex flex-col gap-4">
    <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer ">
        <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
        <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
    </div>

    <h1 class="text-3xl font-bold text-color-17489f">Nuova prenotazione guida
        <span class="text-xl font-medium ml-4">{{date("d/m/Y - H:i", strtotime(session()->get('dateTimeSelected')))}}</span>
    </h1>

    <div class="mb-4">
        <div class="flex gap-4 mb-4">
            @role('admin|responsabile sede|segretaria')
            <x-custom-select wire:model="instructor" name="instructor" label="Istruttore" width="grow" >
                <option value="">Seleziona</option>
                @foreach ($instructors as $instructor)
                    <option value="{{$instructor->id}}">{{$instructor->full_name}}</option>
                @endforeach
            </x-custom-select>
            @endrole

            <x-custom-select wire:model="vehicle" name="vehicle" label="Veicolo" width="w-fit">
                <option value="">Seleziona</option>
                @foreach ($vehicles as $vehicle)
                    <option class="text-sm text-color-545454" value="{{$vehicle->id}}">{{$vehicle->type}} - Cambio: {{$vehicle->transmission}} targa: {{$vehicle->plate}}</option>
                @endforeach
            </x-custom-select>

            <x-custom-select wire:model="type" name="type" label="Tipologia" width="w-fit" >
                <option value="">Seleziona</option>
                <option value="extraurbana" class="capitalize">extraurbana</option>
                <option value="autostrada" class="capitalize">autostrada</option>
                <option value="notturna" class="capitalize">notturna</option>
            </x-custom-select>
        </div>

        <textarea wire:model="note" name="note" id="" cols="30" rows="4" placeholder="Note..." class="w-full border-color-dfdfdf rounded-md"></textarea>
    </div>

    <x-submit-button wire:click='create' class="ml-auto bg-color-347af2">Inserisci</x-submit-button>
</div>
