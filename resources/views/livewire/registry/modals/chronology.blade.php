<div class="px-14 py-8 flex flex-col gap-4">
    <h1 class="text-5xl font-bold text-color-17489f capitalize">Cronologia
        <span class="text-2xl">{{$registration}}</span>
    </h1>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th scope="col" class="py-3.5 px-3 font-light">Data</th>
                    <th scope="col" class="py-3.5 px-3 font-light"></th>
                    <th colspan="3" scope="col" class="px-3 py-3.5 font-light">Contenuto</th>
                    <th scope="col" class="px-3 py-3.5 font-light">Apri</th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if ($chronologies->count() > 0)
                    @foreach($chronologies as $chronology)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="border-r-2 border-color-efefef py-4 px-3  text-sm">{{date("d/m/Y", strtotime($chronology->created_at))}}</td>
                            <td class="border-r-2 border-color-efefef text-color-17489f font-semibold py-4 px-3 capitalize">{{$chronology->registration->course->name}}</td>
                            <td colspan="3" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">{{$chronology->title}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c capitalize">
                                <div class="w-fit m-auto">
                                    <button class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessuna cronologia trovata...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
