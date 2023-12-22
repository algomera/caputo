@props(['disabled' => false, 'required' => false, 'name', 'label' => false, 'value'])

<label class="flex items-center relative cursor-pointer">
    <input {{$attributes}} type="checkbox" value="{{$value}}" {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }}
        class="hidden checked:block checked:bg-color-7a95db hover:checked:bg-color-7a95db checked: rounded-full w-4 h-4  absolute left-1 border-none"
    >
    <div class="w-6 h-6 bg-color-f2f0eb border border-color-7a95db rounded-full focus:ring-0 !focus:outline-none focus:ring-offset-0 {{ $disabled ? 'opacity-50' : '' }}"></div>
    <span class="ml-2 text-color-2c2c2c {{ $disabled ? 'opacity-50' : '' }}">{{ $label }}</span>
</label>
