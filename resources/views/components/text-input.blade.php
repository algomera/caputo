@props(['disabled' => false, 'placeholder' => ''])

<input placeholder="{{$placeholder}}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-transparent focus:ring-color-347af2 rounded-md shadow-sm']) !!}>
