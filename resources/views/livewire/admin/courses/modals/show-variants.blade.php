<div class="p-10 pb-16">
    <h2 class="text-4xl font-semibold text-color-347af2">Varianti {{$course->name}}</h2>

    <div class="m-auto flex flex-col gap-4 px-20 2xl:px-56 mt-10">
        @foreach ($variants as $key => $variant)
            <div wire:key="variant-{{$key}}" wire:click="setVariant({{$variant->id}})" class="w-full h-24 flex flex-col items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c font-semibold capitalize">{{$variant->name}}</p>
            </div>
        @endforeach
    </div>
</div>
