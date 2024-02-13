@props(['title', 'options', 'active'])

<div class="relative capitalize" x-data="{ dropOpen: false}">
    <button
        @click="dropOpen = !dropOpen"
        @keydown.escape="dropOpen = false"
        @click.outside="dropOpen = false"
        @close.stop="dropOpen = false"
        class="group"
    >
        <div class="flex items-center space-x-1">
            <span @class(["text-base font-light leading-6 text-color-2c2c2c focus:outline-none", $active ? 'font-semibold' : ''])>{{ $title }}</span>
            <div :class="{'rotate-180': dropOpen}" class="duration-300 transition-all">
                <x-icons name="chevron_down" class="text-color-2c2c2c" />
            </div>
        </div>

        @if (!$active)
            <div :class="{'h-[2px] w-full bg-color-2c2c2c': dropOpen}" class="duration-300 transition-all w-0"></div>
        @endif
    </button>

    <div :class="{'!h-fit py-2 rounded-b': dropOpen}"
        class="absolute top-[60px] h-0 left-[-30px] z-20 min-w-[240px] text-sm font-medium bg-white shadow-shadow-b overflow-hidden flex flex-col gap-1 duration-300 transition-all"
    >
        @foreach ($options as $option )
            <a href="{{route($option['route'])}}"
                @class(["w-full text-color-2c2c2c px-4 py-3 cursor-pointer whitespace-nowrap group", request()->route()->getName() == $option['route'] ? 'bg-slate-100 font-semibold' : ''])>
                <span class="group-hover:pl-3 transition-all duration-300">{{$option['name']}}</span>
            </a>
        @endforeach
    </div>

    @if ($active)
        <div class="h-[2px] w-full bg-color-2c2c2c"></div>
    @else
        <div class="h-[2px] w-0 bg-color-2c2c2c group-hover:animate-line group-hover:w-full"></div>
    @endif
</div>
