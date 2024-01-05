@props(['disabled' => false])

<button type="submit" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['wire', 'class' => 'w-fit text-2xl inline-flex items-center px-6 py-2 border border-transparent rounded-md font-bold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed']) }} >
    {{ $slot }}
</button>
