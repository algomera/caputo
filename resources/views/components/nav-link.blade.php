@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-base font-semibold leading-6 text-color-2c2c2c focus:outline-none group'
            : 'text-base font-light leading-6 text-color-2c2c2c focus:outline-none group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    @if ($active)
        <div class="h-[2px] w-full bg-color-2c2c2c"></div>
    @else
        <div class="h-[2px] w-0 bg-color-2c2c2c group-hover:animate-line group-hover:w-full"></div>
    @endif
</a>
