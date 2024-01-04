@props(['name'])

<div {{$attributes}} @class(["w-80 h-44 shadow-shadow-card flex flex-col items-center justify-between cursor-pointer hover:scale-105 transition-all duration-300 group"])>
    <div class="grow flex items-center justify-center">
        <x-icons name="{{get_icon($name)}}"/>
    </div>
    <p class="text-2xl text-color-2c2c2c pb-5">{{$name}}</p>
    <div @class(["w-4/5 h-1 rounded-full group-hover:w-full group-hover:rounded-none transition-all duration-300", 'bg-color-'.get_color($name)])></div>
</div>
