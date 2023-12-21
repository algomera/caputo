@props(['name'])

@switch($name)
    @case('Servizi al conducente')
        @php([$icon = 'drive', $color = 'bg-color-5e53dd'])
        @break
    @case('Patenti')
        @php([$icon = 'patent', $color = 'bg-color-7a95db'])
        @break
    @case('Formazione professionale')
        @php([$icon = 'prof_training', $color = 'bg-color-74d4ff'])
        @break
    @case('Nautica')
        @php([$icon = 'boat', $color = 'bg-color-a6cb0d'])
        @break
    @case('Patenti professionali')
        @php([$icon = 'prof_patent', $color = 'bg-color-01bca0'])
        @break
    @case('Corsi')
        @php([$icon = 'courses', $color = 'bg-color-017c67'])
        @break
    @default
        @php([$icon = 'drive', $color = 'bg-color-5e53dd'])
@endswitch

<div {{$attributes}} class="w-80 h-44 shadow-shadow-card flex flex-col items-center justify-between cursor-pointer hover:scale-105 transition-all duration-300">
    <div class="grow flex items-center justify-center">
        <x-icons name="{{$icon}}"/>
    </div>
    <p class="text-2xl text-color-2c2c2c pb-5">{{$name}}</p>
    <div @class(["w-4/5 h-1 rounded-full", $color])></div>
</div>
