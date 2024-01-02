@props(['name', 'width' => '', 'label', 'required' => false, 'type' => 'text', 'placeholder' => ''])

<div @class(["flex flex-col relative", $width ])>
    <label for="{{ $name }}" class="text-sm font-light text-color-2c2c2c mb-1">
        {{$label}} @if ($required)*@endif
    </label>
    <input type="{{$type}}" name="{{ $name }}" {{ $attributes }} placeholder="{{$placeholder}}"
        @class(["h-[54px] px-4 rounded-md p-0 border-color-dfdfdf focus:border-dfdfdf focus:ring-0 placeholder:text-color-2c2c2c"])
    >
    <div class="absolute bottom-[-20px] right-0">
        @error($name) <span class="text-[12px] text-red-500">{{ $message }}</span> @enderror
    </div>
</div>