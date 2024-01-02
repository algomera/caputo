@props(['routeName', 'name', 'icon', 'options' => null])

@php
    $active = false;

    foreach ($options as $option) {
        if (request()->route()->getName() == $option['route']) {
            $active = true;
        }
    }
@endphp

<div x-data="{ dropOpen: false}">
    <button
        @click="dropOpen = !dropOpen"
        @keydown.escape="dropOpen = false"
        @click.outside="dropOpen = false"
        @close.stop="dropOpen = false"
        {{-- :class="{'bg-color-f4f8ff text-color-347af2': dropOpen}" --}}
        @class(['bg-color-f4f8ff text-color-347af2' => $active, 'w-56 font-medium text-color-2c2c2c flex items-center gap-2 p-4 rounded-md group'])
    >
        <div class="w-full flex items-center gap-2">
            <x-icons name="{{$icon}}" />
            <span class="text-base font-light leading-6 focus:outline-none">{{ $name }}</span>
            <div :class="{'rotate-180': dropOpen}" class="duration-300 transition-all !ml-auto">
                <x-icons name="chevron_down" class="ml-auto" />
            </div>
        </div>
    </button>

    <div :class="{'!h-fit': dropOpen}" class="h-0 duration-500 transition-all overflow-hidden ml-8">
        @if ($options)
            @foreach ($options as $option)
                <a href="{{route($option['route'])}}" @class(['text-color-347af2' => request()->route()->getName() == $option['route'], 'w-56 text-color-2c2c2c flex items-center gap-2 p-2 hover:text-color-347af2'])>
                    <x-icons name="circle" />
                    {{$option['name']}}
                </a>
            @endforeach
        @else
            <x-icons name="circle" />
            <p class="underline">Nessuna voce in lista.</p>
        @endif
    </div>
</div>
