<div class="px-14 py-8 flex flex-col gap-4">
    <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer w-fit">
        <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
        <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
    </div>

    <h1 class="text-3xl font-bold text-color-17489f">Note guida</h1>

    <p>{{$guide->note}}</p>
</div>
