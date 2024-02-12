<div class="w-full h-full py-10 px-8 2xl:px-14">
    <div class="px-10 2xl:px-0 mb-5">
        <div class="flex items-center gap-5">
            <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group transition-all duration-300">
                <x-icons name="back" @class(["transition-all duration-300 group-hover:-translate-x-1", 'group-hover:text-color-'.get_color($training->course->service->name)]) />
            </div>
            <h1 @class(["text-5xl font-bold", 'text-color-'.get_color($training->course->service->name)])> {{$training->$variant->name}}</h1>
        </div>
    </div>

    <div class="w-full flex justify-end">
        <button wire:click="calendar({{$training->id}})" class="px-4 py-1 bg-color-17489f text-white font-bold rounded-md hover:scale-105 transition-all duration-300">Vai al calendario</button>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5 relative">
        @if (count($training->$variant->lessons) > 0)
            <small class="absolute right-2 top-2 text-gray-400 font-bold">N° Lezioni: {{count($training->$variant->lessons)}}</small>
        @endif
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="w-20 text-center px-3 py-3.5 font-semibold">
                        ID
                    </th>
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Tipologia
                    </th>
                    <th scope="col" class="text-left  px-3 py-3.5 font-light">
                        Lezione
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
                    @foreach($training->$variant->lessons as $lesson)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="w-20 border-r-2 border-color-efefef py-4 px-3 text-color-17489f capitalize font-semibold">{{$lesson->id}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-bold text-color-2c2c2c uppercase">{{$lesson->type}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize text-left">{{$lesson->subject}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-017c67 font-medium  w-28">{{$lesson->duration}} Min.</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell">
                                <div class="flex items-center justify-center gap-1">
                                    @if ($lesson->planning->begin)
                                        <span>{{date("d/m/Y", strtotime($lesson->planning->begin))}}</span>-
                                        <span class="text-color-01a53a">{{date("H:i", strtotime($lesson->planning->begin))}}</span>
                                        @if ($training->ends)
                                            <x-icons wire:click="$dispatch('openModal', { component: 'theory.modals.lesson-planning-edit', arguments: {planningId: {{ $lesson->planning->id }}} })" name="b-edit" class="w-5 ml-4 cursor-pointer hover:scale-105" />
                                        @endif
                                    @else
                                        Nessuna lezione programmata
                                    @endif
                                </div>
                            </td>
                            <td class="px-3 py-4 text-color-2c2c2c">
                                <div class="w-fit m-auto">
                                    <button wire:click="$dispatch('openModal', { component: 'theory.modals.show-lesson', arguments: {lessonId: {{ $lesson->id }}} })" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
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
