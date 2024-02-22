<div class="p-5 flex flex-col gap-5 items-center justify-center">
    <h1 @class(["text-5xl font-bold", 'text-color-'.get_color(session()->get('serviceName'))])>Documento supporto audio</h1>

    <object data="{{ asset('supp_audio.pdf') }}" type="application/pdf" width="100%" height="600px"></object>

    <div class="w-full flex justify-between">
        <x-submit-button wire:click='cancel' @class(['bg-color-dfdfdf'])>Annulla</x-submit-button>
        <x-submit-button wire:click="$dispatch('closeModal')" @class(['bg-color-'.get_color(session()->get('serviceName'))])>Prosegui</x-submit-button>
    </div>
</div>
