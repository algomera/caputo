@props(['name', 'width' => '', 'height' => '', 'required' => false, 'label' => false, 'disabled' => false])

<div @class(["flex flex-col relative", $width])>
    <label for="{{ $name }}" class="text-sm font-light text-color-2c2c2c mb-1 ml-2">
        {{ $label }}@if ($required)*@endif
    </label>

    <div @class(["relative", $height])>
        <select name="{{ $name }}" {{ $attributes }} @if($disabled) disabled @endif
            @class(['h-[54px] w-full pl-4 pr-8 rounded-md p-0 border-color-dfdfdf focus:border-dfdfdf focus:ring-0 placeholder:text-color-2c2c2c capitalize', $height])
        >
            {{ $slot }}
        </select>
    </div>
    <div class="absolute bottom-[-20px] right-0">
        @error($name) <span class="text-[12px] text-red-500">{{ $message }}</span> @enderror
    </div>
</div>
