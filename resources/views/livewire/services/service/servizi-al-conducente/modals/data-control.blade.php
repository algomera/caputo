<div class="p-10 flex flex-col text-center justify-center gap-5 relative">
    <h1 class="text-4xl font-medium text-color-2c2c2c">{{$title}}</h1>
    <p class="text-xl font-light">
        La patente n. <span class="font-medium uppercase">{{$patent}}</span>
        emessa il {{$customer['release']}} di {{$customer['fullName']}}, <br>
        di sesso “{{$customer['sex']}}”, nata il {{$customer['dateOfBirth']}}
        <span @class(["font-medium text-green-500"])>{{$message}}</span>
    </p>

    <p @class(["font-medium", 'text-color-'.get_color($course->service->name)])>{{$label}}</p>

    @switch($result)
        @case('next')
            <x-submit-button wire:click="nextControl"
                @class(["m-auto", 'bg-color-'.get_color($course->service->name)])>
                Prosegui
            </x-submit-button>
            @break
        @case('experiment')
            <x-submit-button wire:click="$dispatch('openModal', { component: 'services.service.servizi-al-conducente.modals.data-control', arguments: {patent: '{{ $patent }}'} })"
                @class(["m-auto", 'bg-color-'.get_color($course->service->name)])>
                Esperimento di guida
            </x-submit-button>

            @break
        @case('end')
            <x-submit-button wire:click="$dispatch('openModal', { component: 'services.service.servizi-al-conducente.modals.data-control', arguments: {patent: '{{ $patent }}'} })"
                @class(["m-auto", 'bg-color-'.get_color($course->service->name)])>
                Fine
            </x-submit-button>

            @break
        @case('incomplete')
            <x-submit-button wire:click="$dispatch('openModal', { component: 'services.service.servizi-al-conducente.modals.data-control', arguments: {patent: '{{ $patent }}'} })"
                @class(["m-auto", 'text-color-'.get_color($course->service->name)])>
                Presenta domanda
            </x-submit-button>

            <x-submit-button wire:click="$dispatch('openModal', { component: 'services.service.servizi-al-conducente.modals.data-control', arguments: {patent: '{{ $patent }}'} })"
                @class(["m-auto", 'text-color-'.get_color($course->service->name)])>
                Declassamento
            </x-submit-button>
            @break
    @endswitch
</div>
