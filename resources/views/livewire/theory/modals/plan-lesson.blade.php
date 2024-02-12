<div class="px-14 py-8 flex flex-col gap-4">
    <h1 class="text-4xl font-bold text-color-17489f capitalize">
        Corso: <span class="ml-2 text-2xl">{{$training->course->name}}</span>
    </h1>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th scope="col" class="px-3 py-3.5 font-light">Lezione</th>
                    <th colspan="3" class="px-3 py-3.5 font-light text-left">Argomento</th>
                    <th scope="col" class="px-3 py-3.5 font-light">Durata</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-left"></th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @foreach($lessonPlannings as $key => $lessonPlanning)
                    <tr class="text-center even:bg-color-f7f7f7">
                        <td scope="col" class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c">{{$key+1}}</td>
                        <td colspan="3" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">{{$lessonPlanning->lesson->subject}}</td>
                        <td scope="col" class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c">{{$lessonPlanning->lesson->duration}} Min.</td>
                        <td scope="col" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">
                            <div class="w-full flex items-center justify-center">
                                @if ($lessonPlanning->begin)
                                    <div class="flex flex-col items-center">
                                        <small class="block">Programmata il</small>
                                        <span class="text-color-17489f text-sm font-medium ">{{date("d/m/Y - H:i", strtotime($lessonPlanning->begin))}}</span>
                                    </div>
                                @else
                                    <button wire:click="schedule({{$lessonPlanning->id}})" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">inserisci</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
