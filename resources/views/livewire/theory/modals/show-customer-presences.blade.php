<div class="px-14 py-8 flex flex-col gap-4 relative">
    <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer ">
        <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
        <span class="pt-1 text-lg text-color-808080 group-hover:underline">Indietro</span>
    </div>

    <div class="flex flex-col items-start gap-3">
        <h1 class="text-3xl font-bold text-color-17489f capitalize">{{$customer->full_name}}</h1>
        <h3 class="text-xl font-medium text-color-808080">Corso:
            @if ($training->courseVariant)
                {{$training->courseVariant->name}}
            @else
                {{$training->course->name}}
            @endif
        </h3>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card">
        <div class="w-full overflow-x-auto">
            <table class="divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
                <thead>
                    <tr class="text-center text-color-545454">
                        <th scope="col" class="px-3 py-3.5 font-medium"></th>
                        <th scope="col" class="px-3 py-3.5 font-medium">Totale</th>
                        @foreach ($lessons as $key => $lesson)
                            <th scope="col" title="{{$lesson->subject}}" class="px-3 py-3.5 font-light whitespace-nowrap hover:underline cursor-pointer">Lezione-{{$key+1}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white no-scrollbar !max-h-none">
                    <tr class="text-center even:bg-color-f7f7f7">
                        <td scope="col" class="border-r-2 border-color-efefef font-medium px-3 pt-5 pb-4 text-color-2c2c2c capitalize">Presenze</td>
                        <td scope="col" class="border-r-2 border-color-efefef font-medium px-3 pt-5 pb-4 text-color-347af2 capitalize">{{$totalPresences}}/{{count($lessons)}}</td>
                        @foreach ($lessons as $lesson)
                            <td scope="col" class="border-r-2 border-color-efefef text-center px-3 pt-5 pb-4 text-color-2c2c2c capitalize">
                                @foreach ($presences as $presence)
                                    @if ($presence->lesson_id == $lesson->id && $presence->followed)
                                        @if ($presence->begin)
                                            {{date("d/m/Y", strtotime($presence->begin))}}
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
