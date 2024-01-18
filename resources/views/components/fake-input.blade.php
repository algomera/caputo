@props([ 'width' => '', 'label' => '', 'uppercase' => false])

<div @class(["flex flex-col relative", $width ])>
    <span class="text-sm font-light text-color-2c2c2c mb-1 w-fit">
        {{$label}}
    </span>
    <div @class(["h-[54px] flex items-center bg-white border px-4 rounded-md p-0 border-color-dfdfdf focus:border-dfdfdf focus:ring-0 placeholder:text-color-afafaf", $uppercase])>
        {{$slot}}
    </div>
</div>
