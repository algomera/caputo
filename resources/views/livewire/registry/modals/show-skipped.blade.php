<div class="px-14 py-8 flex flex-col gap-4">
    <h1 class="text-5xl font-bold text-color-17489f capitalize">Documenti Mancanti
        <span class="text-2xl">{{$registration->course->name}}</span>
    </h1>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th colspan="3" scope="col" class="px-3 py-3.5 font-light text-left">Descrizione</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-left"></th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if (count(json_decode($registration->step_skipped)) > 0)
                    @foreach(json_decode($registration->step_skipped) as $step)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td colspan="3" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">{{get_step($step)}}</td>
                            <td class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">
                                @if ($step != 'documenti' && $step != 'fototessera')
                                    <div class="w-full flex items-center justify-center">
                                        <button wire:click="" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">inserisci</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun documento mancante...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
