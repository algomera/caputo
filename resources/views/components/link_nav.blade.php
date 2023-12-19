@props(['routeName', 'name', 'icon'])

<a {{$attributes}} @class(['bg-color-f4f8ff text-color-347af2' => request()->routeIs($routeName), 'w-56 font-medium text-color-2c2c2c capitalize flex items-center gap-2 p-4 rounded-md'])>
    <x-icons name="{{$icon}}" />
    {{$name}}
</a>
