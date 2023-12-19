@props(['icon', 'contents'])

<div {{ $attributes->merge(['class']) }} class="relative capitalize" x-data="{ dropOpen: false}">
    <button
        @click="dropOpen = !dropOpen"
        @keydown.escape="dropOpen = false"
        @click.outside="dropOpen = false"
        @close.stop="dropOpen = false"
        class="group"
    >
        <div class="flex items-center space-x-1">
            <x-icons name="{{$icon}}" class="text-color-2c2c2c" />
        </div>
    </button>

    <div :class="{'!h-fit py-2 rounded-b': dropOpen}"
        class="absolute top-[60px] h-0 -right-8 z-20 min-w-[240px] text-sm font-medium bg-white shadow-shadow-b overflow-hidden flex flex-col gap-1 duration-300 transition-all"
    >
        @foreach ($contents as $content )
            <div>

            </div>
        @endforeach
    </div>
</div>
