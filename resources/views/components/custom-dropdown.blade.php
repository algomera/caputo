@props(['title', 'options'])

<div class="relative capitalize" x-data="{ dropOpen: false}">
    <button
        @click="dropOpen = !dropOpen"
        @keydown.escape="dropOpen = false"
        @click.outside="dropOpen = false"
        @close.stop="dropOpen = false"
        class="group"
    >
        <div class="flex items-center space-x-1">
            <span class="text-base font-light leading-6 text-color-2c2c2c focus:outline-none">{{ $title }}</span>
            <div :class="{'rotate-180': dropOpen}" class="duration-300 transition-all">
                <x-icons name="arrow-down-bold" />
            </div>
        </div>

        <div :class="{'h-[2px] w-full bg-color-2c2c2c': dropOpen}" class="duration-300 transition-all w-0"></div>
    </button>

    <div :class="{'!h-fit py-2': dropOpen}"
        class="absolute top-[60px] h-0 left-[-30px] z-20 min-w-[240px] text-sm font-medium bg-white shadow-shadow-b overflow-hidden rounded-b flex flex-col gap-1 duration-300 transition-all"
    >
        @foreach ($options as $option )
            <a href="{{route($option['route'], ['country_code' => session('country_code')])}}" class="w-full text-slate-300 px-4 py-3 hover:bg-color-2c2c2c hover:text-white cursor-pointer whitespace-nowrap group">
                <span class="group-hover:pl-3 transition-all duration-300">{{$option['name']}}</span>
            </a>
        @endforeach
    </div>
</div>