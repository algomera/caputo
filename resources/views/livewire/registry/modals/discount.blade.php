<div class="p-8 flex flex-col gap-5">
    <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer w-fit">
        <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
        <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
    </div>

    <div class="w-full flex items-end justify-between">
        <h1 class="text-2xl font-bold text-color-17489f capitalize">{{$registration->course->name}}
            <span class="ml-3 text-xl">({{$registration->customer->name}} {{$registration->customer->lastName}})</span>
        </h1>
    </div>

    <div class="flex items-center gap-5">
        <h2 class="text-xl font-medium text-color-545454 uppercase">Prezzo del corso: € {{$registration->price}}</h2>
        <h3 class="text-base font-medium text-color-545454 capitalize">Attuale sconto: € {{$registration->discount}}</h3>
    </div>
    <h3 class="text-base font-medium text-color-545454 capitalize">Prezzo scontato:
        @if ($discount)
            <span class="text-color-017c67/90">€ {{(double)$registration->price - (double)$discount}}</span>
        @else
            <span class="text-color-017c67/90">€ {{(double)$registration->price - (double)$registration->discount}}</span>
        @endif
    </h3>
    <x-input-text x-mask:dynamic="$money($input, '.', ' ')" wire:model.live="discount" width="w-fit" name="discount" placeholder="0.00" label="Sconto €" />

    <x-submit-button wire:click='save' class="ml-auto bg-color-347af2">Inserisci</x-submit-button>
</div>
