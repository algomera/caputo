@props(['disabled' => false])

<button type="submit" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['wire', 'class' => 'w-fit text-2xl inline-flex items-center px-10 pt-2 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed !border-transparent focus-visible:!border-transparent focus:!border-transparent focus-visible:!ring-0 focus:!border-transparent focus:!ring-0 focus-visible:!outline-none']) }} >
    {{ $slot }}
</button>
