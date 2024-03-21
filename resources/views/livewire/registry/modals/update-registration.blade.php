<div class="px-14 py-8 flex flex-col gap-4">
    <div class="flex items-end justify-between">
        <h1 class="text-5xl font-bold text-color-17489f capitalize">Opzioni
            <span class="text-2xl">{{$registration->course->name}}</span>
        </h1>
        <p class="text-lg text-color-545454 font-semibold mt-2">Prezzo totale corso: € {{$registration->price}}</p>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th colspan="3" scope="col" class="px-3 py-3.5 font-light text-left">Opzione</th>
                    <th scope="col" class="px-3 py-3.5 font-light">Prezzo</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-left"></th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @foreach($options as $option)
                    <tr class="text-center even:bg-color-f7f7f7">
                        <td colspan="3" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c">{{$option->name}}</td>
                        <td scope="col" class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c">€ {{$option->price}}</td>
                        <td scope="col" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">
                            @if (in_array($option->id, $selectedOptions))
                                @if ($option->id == 15 && $registration->medicalPlanning->welded || $existingDocumentVisit)
                                    <div class="w-full flex items-center justify-center">
                                        <button class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-red-500/40 hover:scale-105 transition-all duration-300 cursor-not-allowed">Non removibile</button>
                                    </div>
                                @else
                                    <div class="w-full flex items-center justify-center">
                                        <button wire:click="remove({{$option->id}})" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-red-500/40 hover:scale-105 transition-all duration-300">rimuovi</button>
                                    </div>
                                @endif
                            @else
                                @if ($option->id == 15 || $existingDocumentVisit)
                                    <div class="w-full flex items-center justify-center">
                                        <button wire:click="add({{$option->id}})" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">inserisci</button>
                                    </div>
                                @else
                                    <div class="w-full flex items-center justify-center">
                                        <button wire:click="add({{$option->id}})" class="px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">inserisci</button>
                                    </div>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
