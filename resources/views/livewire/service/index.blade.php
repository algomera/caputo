<div class="w-full h-full py-14 2xl:px-28">

    @if (!$selectedService)
        <h1 class="text-5xl font-bold text-color-2c2c2c capitalize text-center">Servizi</h1>

        <div class="flex flex-wrap items-center justify-center gap-10 2xl:gap-20 mt-28">
            @foreach ($services as $service )
                <x-service-card wire:click='setService({{$service->id}})' name="{{$service->name}}"/>
            @endforeach
        </div>
    @endif

    @if ($selectedService)
        <div class="px-10 2xl:px-0">
            <div class="flex items-center gap-5">
                <div wire:click='resetService' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group">
                    <x-icons name="back" class="group-hover:text-color-7a95db" />
                </div>
                <h1 class="text-5xl font-bold text-color-7a95db">{{$selectedService->name}}</h1>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-x-7 gap-y-12 mt-28">
                @foreach ($courses as $course )
                    <div class="min-w-[345px] h-24 shadow-shadow-card flex items-center justify-center">
                        <span class="text-2xl font-light text-color-2c2c2c">{{$course->name}}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
