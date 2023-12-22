<div>
    <div class="flex items-center gap-5">
        <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group">
            <x-icons name="back" class="group-hover:text-color-7a95db" />
        </div>
        <h1 class="text-5xl font-bold text-color-7a95db">{{$course->name}}</h1>
    </div>

    <div class="bg-white shadow border px-16 py-9 mt-10 mx-44">
        <h3 class="text-2xl font-medium text-color-2c2c2c">Il candidato si iscrive alla prima patente A1</h3>

        <div class="flex items-end gap-2 my-8">
            <p class="text-xl font-bold text-color-7a95db">Iscrizione</p>
            <div class="grow h-[2px] bg-color-dfdfdf mb-2"></div>
            <p class="text-xl font-bold text-color-7a95db">€ ({{ number_format($total, 2 , ',', '.') }})</p>
        </div>

        @foreach ($course->getOptions()->where('type', 'Fisso')->get() as $option )
            <div class="flex items-end gap-2 my-1">
                <p class="text-color-2c2c2c">{{$option->name}}</p>
                <div class="grow h-[1px] bg-color-dfdfdf mb-2"></div>
                <p class="text-color-2c2c2c">{{$option->price}} €</p>
            </div>
        @endforeach

        @foreach ($course->getOptions()->where('type', 'opzionale')->get() as $option )
            <div class="flex items-end gap-2 my-1">
                <x-custom-checkbox wire:model.live="selectedOptions" name="option_{{ $option->id}}" value="{{ $option->id }}" label="{{$option->name}}"/>
                <div class="grow h-[1px] bg-color-dfdfdf mb-2"></div>
                <p class="text-color-2c2c2c">{{$option->price}} €</p>
            </div>
        @endforeach

        <div class="flex items-end gap-2 mt-8 mb-2">
            <p class="text-xl font-bold text-color-7a95db">Corso</p>
            <div class="grow h-[2px] bg-color-dfdfdf mb-2"></div>
            <p class="text-xl font-bold text-color-7a95db">{{$course->prices()->first()->price}} €</p>
        </div>
        <p>{{$course->description}}</p>

        <div class="mb-2 space-y-1">
            <div class="flex items-end gap-2 mt-8 mb-2">
                <p class="text-xl font-bold text-color-7a95db">Guide</p>
                <div class="grow h-[2px] bg-color-dfdfdf mb-2"></div>
                <p class="text-xl font-bold text-color-7a95db">{{$course->getOptions()->where('type', 'guide')->first()->price}} €</p>
            </div>
            <p>Non ci sono guide obbligatorie, selezionare l’opzione per il <b>cambio</b></p>
            <x-custom-radio wire:model='transmission' label="Cambio automatico" name="transmission" value="automatico" />
            <x-custom-radio wire:model='transmission' label="Cambio manuale" name="transmission" value="manuale" />
        </div>

        <small class="font-medium text-color-7a95db">N.B. é necessario che il candidato prenda confidenza con il veicolo e che sia preparato alla prova in circuito chiuso e ad un percorso cittadino</small>

        <div class="w-full flex justify-end">
            <button wire:click='next' class=" h-12 px-8 bg-color-7a95db text-white text-2xl font-bold rounded-md cursor-pointer hover:brightness-110 ">Prosegui</button>
        </div>
    </div>
</div>
