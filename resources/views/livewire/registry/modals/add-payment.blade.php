<div class="px-14 py-8 flex flex-col gap-4">
    <div class="w-full flex items-end justify-between">
        @if ($drivingPlanning)
            <h1 class="text-3xl font-bold text-color-17489f capitalize">Pagamento guida del
                <span class="ml-2 text-xl underline">{{date("d/m/Y H:i", strtotime($drivingPlanning->begins))}}</span>
            </h1>
        @elseif ($registration)
            <h1 class="text-3xl font-bold text-color-17489f capitalize">Pagamento iscrizione
                <span class="ml-2 text-xl underline">{{$registration->course->name}}</span>
            </h1>
        @endif

        <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer ">
            <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
            <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
        </div>
    </div>

    <div class="space-y-4">
        <x-input-text x-mask:dynamic="$money($input, '.', ' ')" wire:model="amount" width="w-fit" name="amount" placeholder="0.00" label="Importo €" />
        <textarea wire:model="note" name="note" id="" cols="30" rows="4" placeholder="Note..." class="w-full border-color-dfdfdf rounded-md"></textarea>
    </div>

    <x-submit-button wire:click='create' class="ml-auto bg-color-347af2">Inserisci</x-submit-button>
</div>
