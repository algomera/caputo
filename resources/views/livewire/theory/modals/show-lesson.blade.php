<div class="px-14 py-8 flex flex-col gap-4">
    <x-icons wire:click="$dispatch('closeModal')" name="x_close" class="absolute top-5 right-5 w-8 text-gray-400 cursor-pointer hover:text-color-2c2c2c transition-all duration-200" />

    <h1 class="text-3xl font-bold text-color-17489f capitalize">
        Lezione:
        <span class="ml-2 text-xl">{{$lesson->subject}}</span>
    </h1>

    <p class="text-color-2c2c2c">
        <span class="font-semibold uppercase">Descrizione:</span>
        {{$lesson->description}}
    </p>
</div>
