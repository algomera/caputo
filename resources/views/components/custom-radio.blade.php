@props(['label', 'value', 'name'])

<label id="{{$value}}" for="{{$value}}" class="flex items-start justify-between gap-7">
    <div class="flex gap-3 items-start">
        <input {{ $attributes }} id="{{$value}}" type="radio" name="{{$name}}" value="{{$value}}"
            class="w-6 h-6 rounded-full text-color-7a95db bg-transparent border-color-7a95db focus:ring-transparent focus:ring-0"/>
        <div class="flex flex-col">
            <span class="capitalize leading-[20px]">{{$label}}</span>
        </div>
    </div>
</label>
