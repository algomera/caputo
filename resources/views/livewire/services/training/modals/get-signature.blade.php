<div class="p-12 flex flex-col gap-5 bg-color-f7f7f7">
    <p class="text-xl font-light text-color-2c2c2c">
        Caricare la firma del cliente e salvare, per proseguire.
    </p>

    <div class="w-fit flex items-start gap-5 relative text-gray-400">
        <button wire:click="$dispatch('openModal', { component: 'services.commons.modals.signature'})"
        @class(["p-3 rounded-md flex items-center gap-8 cursor-pointer w-fit", 'bg-color-'.get_color(session()->get('serviceName')).'/20'])>
            @if ($signature)
                <span class="text-color-2c2c2c font-light">Firma Caricata</span>
                <x-icons name="check" />
            @else
                <span class="text-color-2c2c2c font-light">Carica Firma</span>
                <x-icons name="image" />
            @endif
        </button>
    </div>

    <div class="flex justify-between">
        <button wire:click="$dispatch('closeModal')" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
            Indietro
        </button>
        @if ($signature)
            <x-submit-button wire:click='next' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
        @endif
    </div>
</div>
