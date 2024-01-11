<div class="w-full h-full py-14 px-10 2xl:px-28">

    @switch($step)
        @case(0)
            <div class="px-10 2xl:px-0">
                <div class="flex items-center gap-5">
                    <div wire:click='backStep' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group transition-all duration-300">
                        <x-icons name="back" @class(["transition-all duration-300 group-hover:-translate-x-1", 'group-hover:text-color-'.get_color($course->service->name)]) />
                    </div>
                    <h1 @class(["text-5xl font-bold", 'text-color-'.get_color($course->service->name)])>{{$course->name}}</h1>
                </div>
            </div>

            <div class="border p-10 mt-11 bg-color-f7f7f7 max-w-7xl mx-auto shadow-shadow-card">
                <div class="border-b pb-5 mb-5">
                    <p class="text-2xl font-medium text-color-2c2c2c">Rinnovabile da 4 mesi prima della scadenza</p>
                </div>
                <div class="border-b pb-5">
                    <p class="text-xl text-color-2c2c2c">Ricevuta PostePay di {{ number_format($course->prices()->where('licenses', null)->first()->price, 2 , ',', '.') }}€</p>
                </div>

                <div class="mt-10 space-y-4">
                    <p class="text-2xl font-medium text-color-2c2c2c">Proseguire con la verifica dati</p>
                    <p class="text-xl text-color-2c2c2c">Inserire il numero della patente.</p>

                    <div class="flex gap-3 items-center">
                        <x-input-text wire:model="lastName" width="w-1/4" name="patent" label="Cognome" uppercase="uppercase" required="true" />
                        <x-input-text x-mask="99/99/9999" wire:model="dateOfBirth" width="w-1/4" name="patent" label="Data di nascita" uppercase="uppercase" required="true" />
                        <x-input-text x-mask="aa9999999a" wire:model.live="patent" width="w-1/4" name="patent" label="N. Patente" uppercase="uppercase" required="true" />
                        <span class="uppercase text-sm text-gray-400">{{$patent}}</span>
                    </div>
                </div>

                <div class="w-fit ml-auto">
                    <x-submit-button wire:click="dataControl" :disabled="!(count(str_split($patent)) == 10) ?? true"
                        @class(['bg-color-'.get_color($course->service->name)])>
                        Prosegui
                    </x-submit-button>
                </div>
            </div>
            @break
        @case(1)
            <div class="px-10 2xl:px-0 border">
            </div>
            @break

        @default

    @endswitch
</div>
