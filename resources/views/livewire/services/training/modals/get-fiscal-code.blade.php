<div class="p-12 flex flex-col gap-5 bg-color-f7f7f7">
    <h2 class="text-xl font-medium mb-2 capitalize">Inserire il codice fiscale per verificare la presenza di una marca operativa</h2>
    <x-input-text x-mask="aaaaaa99a99a999a" wire:model="fiscalCode" width="w-1/4" name="fiscalCode" label="Codice Fiscale" uppercase="uppercase" required="true" />
    @if ($message)
    <div class="flex items-center gap-1">
        <x-icons name="check" @class(['text-color-'.get_color(session('serviceName'))]) />
        <span class="text-color-01a53a text-sm font-medium">{{$message}}</span>
    </div>
    @endif

    <div class="ml-auto mt-5">
        <x-submit-button wire:click="verifyData" @class(['bg-color-'.get_color(session('serviceName'))])>
            @if ($message) Continua @else Verifica @endif
        </x-submit-button>
    </div>
</div>
