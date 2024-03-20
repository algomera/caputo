<div class="p-4 pb-16">
    @if (!$selectedRegistrationType)
        <div class="w-full flex justify-between">
            <h1 @class(["text-4xl font-semibold", 'text-color-'.get_color($course->service->name)])>Selezionare l'opzione</h1>
            <small class="text-gray-400 font-bold">{{$course->name}}</small>
        </div>

        <div class="m-auto flex flex-col gap-4 px-20 2xl:px-56 mt-16">
            @foreach ($courseRegistrationTypes as $key => $type)
                <div wire:key="type-{{$key}}" wire:click="setRegistrationType({{$type->registrationType->id}})" class="w-full h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                    <p class="text-lg text-color-2c2c2c font-semibold capitalize">{{$type->registrationType->name}}</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="w-full flex justify-between">
            <div wire:click='resetOption' class="flex items-center gap-2 group cursor-pointer ">
                <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
                <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
            </div>
            <small class="text-gray-400 font-bold capitalize">{{$selectedRegistrationType}}</small>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-5 py-24">
            @if (session()->get('course')['registration_type'] != 'guide')
                <div wire:click='setType("teoria")' class="px-24 h-24 flex items-center justify-center border rounded-md shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                    <p class="text-lg text-color-2c2c2c whitespace-nowrap">Gestione teoria</p>
                </div>
            @endif
            <div wire:click='setType("guide")' class="px-24 h-24 flex items-center justify-center border rounded-md shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c whitespace-nowrap">Gestione guide</p>
            </div>
            @if (session('course')['id'] == 13)
                <div wire:click='setType("guide/s.esame")' class="px-24 h-24 flex items-center justify-center border rounded-md shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                    <div class="text-center relative">
                        <p class="text-lg text-color-2c2c2c whitespace-nowrap">Gestione guide</p>
                        <small>(Senza esame per possessori di A2)</small>
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
