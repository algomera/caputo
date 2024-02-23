@props(['label', 'value', 'name'])

<label id="{{$value}}" for="{{$value}}" class="w-fit flex items-start justify-between gap-7 relative">
    <div class="flex gap-3 items-start">
        <input {{ $attributes }} id="{{$value}}" type="radio" name="{{$name}}" value="{{$value}}"
            class="w-6 h-6 rounded-full text-color-7a95db bg-transparent border-color-7a95db focus:ring-transparent focus:ring-0"/>
        <div class="flex flex-col">
            <span class="capitalize leading-7">{{$label}}</span>
        </div>
    </div>
    <div class="absolute -bottom-3 right-0">
        @error($name) <span class="text-[12px] text-red-500">{{ $message }}</span> @enderror
    </div>
</label>
