<div class="px-14 py-8 flex flex-col gap-4">
    <h1 class="text-5xl font-bold text-color-17489f capitalize">Cronologia
        <span class="text-2xl">{{$registration}}</span>
    </h1>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th scope="col" class="py-3.5 px-3 font-light">Data/Ora</th>
                    <th colspan="3" scope="col" class="px-3 py-3.5 font-light text-left">Descrizione</th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if ($chronologies->count() > 0)
                    @foreach($chronologies as $chronology)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="border-r-2 border-color-efefef py-4 px-3  text-sm">
                                <div class="flex items-center justify-center gap-1">
                                    <span>{{date("d/m/Y", strtotime($chronology->updated_at))}}</span>-
                                    <span class=" text-color-01a53a">{{date("H:i", strtotime($chronology->updated_at))}}</span>
                                </div>
                            </td>
                            <td colspan="3" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">{{$chronology->title}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessuna cronologia trovata...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
