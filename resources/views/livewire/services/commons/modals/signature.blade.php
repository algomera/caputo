<div x-data="signaturePad()" class="hidden py-5 px-5 xl:px-0 lg:flex flex-col items-center gap-5 max-w-3xl xl:max-w-4xl mx-auto">
    <div class="w-full">
        <h1 @class(["text-4xl font-semibold", 'text-color-'.get_color(session()->get('serviceName'))])>Carica Firma</h1>
        <p class="mt-5 mb-1">Firma all’interno del riquadro</p>
        <canvas x-ref="signature_canvas" width=900 height=200 class="bg-white border border-dashed border-color-545454 mr-auto aspect-auto"></canvas>
    </div>

    <div class="w-full flex items-center justify-between mt-5">
        <button wire:click="$dispatch('closeModal')" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-light text-color-545454 tracking-widest bg-color-dfdfdf hover:bg-gray-700 hover:text-white active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
            Indietro
        </button>

        <div class="flex gap-5">
            <button x-on:click="clearSignature" class="w-fit text-2xl inline-flex items-center px-6 py-2 border border-color-545454 rounded-md font-light tracking-widest hover:bg-color-dfdfdf active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                Cancella
            </button>

            <x-submit-button x-on:click="uploadSignature" @class(["bg-color-".get_color(session()->get('serviceName'))])>
                Salva
            </x-submit-button>
        </div>
    </div>
</div>


