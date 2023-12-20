<button {{ $attributes->merge(['type' => 'submit', 'form' => '', 'class' => 'inline-flex items-center px-6 py-2 bg-color-347af2 border border-transparent rounded-md font-bold text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
