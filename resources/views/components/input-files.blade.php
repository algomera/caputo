@props(['text', 'color', 'name', 'preview', 'icon'])

<div class="relative">
    <div class="w-fit flex items-start gap-5 relative text-gray-400">
        <label for="{{$name}}" @class(["p-3 rounded-md flex items-center gap-8 cursor-pointer", 'bg-color-'.$color.'/20'])>
            <span class="text-color-2c2c2c font-light">{{$text}}</span>
            <x-icons name="{{$icon}}" class="h-5" />
        </label>
        <input {{$attributes}} type="file" name="{{$name}}" id="{{$name}}" class="block mt-1 w-full opacity-0 z-[-1] absolute">
        {{-- <div id="{{$preview}}" class="absolute -right-60 top-0 flex flex-col gap-2 mt-1"></div> --}}
    </div>
    <div class="absolute bottom-[-20px] right-0">
        @error($name) <span class="text-[12px] text-red-500">{{ $message }}</span> @enderror
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById(@json($name)).addEventListener('change', preview);

        function preview(event) {
            const files = event.target.files;
            document.getElementById(@json($preview)).innerHTML = '';
            for (let f = 0; f < files.length; f++) {
                let p = document.createElement("p");
                p.textContent = files[f].name;
                p.classList.add('font-medium','text-gray-400');
                document.getElementById(@json($preview)).appendChild(p);
            }
        }
    </script>
@endpush
