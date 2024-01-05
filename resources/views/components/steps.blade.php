@props(['color', 'number', 'step', 'currentStep'])

<div class="flex flex-col gap-3 items-center w-9">
    @if ($currentStep < $number+1)
        <div @class(["w-full h-9 rounded-full text-white flex items-center justify-center border", 'border-color-'.$color, 'bg-color-'.$color])>
            {{$number}}
        </div>
    @else
        <div @class(["w-full h-9 rounded-full text-white flex items-center justify-center border bg-white", 'border-color-'.$color])>
            <x-icons name="check" @class(['text-color-'.$color]) />
        </div>
    @endif
    <span @class(["capitalize whitespace-nowrap", 'text-color-'.$color])>{{$step}}</span>
</div>
