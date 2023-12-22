<div class="p-4 pb-16">
    @if (!$selectedOption)
        <div class="w-full flex justify-between">
            <h1 class="text-4xl font-semibold text-color-7a95db">Selezionare l'opzione</h1>
            <small class="text-gray-400 font-bold">{{$course->name}}</small>
        </div>

        <div class="m-auto flex flex-col gap-4 px-56 mt-16">
            <div wire:click='setOption("prima patente")' class="w-full h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c">Il candidato si iscrive alla <b>prima patente</b></p>
            </div>
            <div wire:click='setOption("possessore di patente")' class="w-full h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c">Il candidato è possessore di <b>patente A1, B1 o B</b></p>
            </div>
            <div wire:click='setOption("cambio codice")' class="w-full h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c">Effettuare il <b>Cambio codice</b></p>
            </div>
            <div wire:click='setOption("guida accompagnata")' class="w-full h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c">Possiede l'autorizzazione per la <b>guida accompagnata</b></p>
            </div>
        </div>
    @else
        <div class="w-full flex justify-between">
            <div wire:click='resetOption' class="flex items-center gap-2 group cursor-pointer ">
                <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
                <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
            </div>
            <small class="text-gray-400 font-bold capitalize">{{$selectedOption}}</small>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-5 py-24">
            <div wire:click='setType("teoria")' class="px-24 h-24 flex items-center justify-center border rounded-md shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c whitespace-nowrap">Gestione teoria</p>
            </div>
            <div wire:click='setType("guide")' class="px-24 h-24 flex items-center justify-center border rounded-md shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c whitespace-nowrap">Gestione guide</p>
            </div>
            <div wire:click='setType("guide/s.esame")' class="px-24 h-24 flex items-center justify-center border rounded-md shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                <div class="text-center relative">
                    <p class="text-lg text-color-2c2c2c whitespace-nowrap">Gestione guide</p>
                    <small>(Senza esame)</small>
                </div>
            </div>
        </div>
    @endif
</div>
