<div class="w-full h-full py-10 px-8 2xl:px-14">
    <div class="px-10 2xl:px-0">
        <div class="flex items-center gap-5">
            <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group transition-all duration-300">
                <x-icons name="back" @class(["transition-all duration-300 group-hover:-translate-x-1", 'group-hover:text-color-'.get_color($training->course->service->name)]) />
            </div>
            <h1 @class(["text-5xl font-bold", 'text-color-'.get_color($training->course->service->name)])>{{$training->course->name}}</h1>
        </div>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5 relative">
        @if (count($training->course->lessons) > 0)
            <small class="absolute right-2 top-2 text-gray-400 font-bold">N° Lezioni: {{count($training->course->lessons)}}</small>
        @endif
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="w-20 text-center px-3 py-3.5 font-semibold">
                        ID
                    </th>
                    @role('admin')
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Tipologia
                    </th>
                    @endrole
                    <th scope="col" class="text-left  px-3 py-3.5 font-light">
                        Argomento
                    </th>
                    <th scope="col" class="w-28 px-3 py-3.5 font-light hidden xl:table-cell">
                        Durata
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Data lezione
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if (count($training->course->lessons) > 0)
                    @foreach($training->course->lessons as $lesson)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="w-20 border-r-2 border-color-efefef py-4 px-3 text-color-17489f capitalize font-semibold">{{$lesson->id}}</td>
                            @role('admin')
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-bold text-color-347af2 uppercase">{{$lesson->type}}</td>
                            @endrole
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize text-left">{{$lesson->subject}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-017c67 font-medium  w-28">{{$lesson->duration}} Min.</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell"></td>
                            <td class="px-3 py-4 text-color-2c2c2c">
                                <div class="w-fit m-auto">
                                    <button wire:click="" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun Lezione trovata...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
