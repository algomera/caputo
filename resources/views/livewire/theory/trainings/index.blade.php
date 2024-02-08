<div class="w-full h-full py-10 px-8 2xl:px-14">
    <h1 class="text-5xl font-bold text-color-17489f capitalize mb-5">Lista corsi</h1>

    <div class="w-full flex items-end justify-between">
        <div class="flex items-center gap-3">
            <span>Cerca per:</span>
            <x-input-text wire:model.live="course" width="w-fit" name="course" placeholder="Nome corso" uppercase="shadow" />
            @if (auth()->user()->role->name != 'insegnante')
            <x-input-text wire:model.live="user" width="w-fit" name="user" placeholder="Insegnante" uppercase="shadow" />
            @endif
            @role('admin')
            <x-input-text wire:model.live="code" width="w-fit" name="code" placeholder="Codice" uppercase="shadow" />
            @endrole
        </div>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5 relative">
        @if (count($trainings) > 0)
            <small class="absolute right-2 top-2 text-gray-400 font-bold">Corsi trovati: {{count($trainings)}}</small>
        @endif
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="w-20 text-center px-3 py-3.5 font-semibold">
                        ID
                    </th>
                    @role('admin')
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Codice
                    </th>
                    @endrole
                    <th scope="col" class="text-left  px-3 py-3.5 font-light">
                        Nome corso
                    </th>
                    <th scope="col" class="text-left px-3 py-3.5 font-light hidden xl:table-cell">
                        Variante corso
                    </th>
                    <th scope="col" class="text-left px-3 py-3.5 font-light">
                        Insegnante
                    </th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light">
                        Inizio
                    </th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light hidden xl:table-cell">
                        Fine
                    </th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light hidden xl:table-cell">
                        N° Iscritti
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if ($trainings->count() > 0)
                    @foreach($trainings as $training)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="w-20 border-r-2 border-color-efefef py-4 px-3 text-color-17489f capitalize font-semibold">{{$training->id}}</td>
                            @role('admin')
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-bold text-color-347af2 uppercase">{{$trainings->school->code}}</td>
                            @endrole
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize text-left">{{$training->course->name}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c capitalize text-left">
                                @if ($training->courseVariant)
                                    {{$training->courseVariant->name}}
                                @endif
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c text-left">{{$training->user->full_name}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell">{{date("d/m/Y", strtotime($training->begins))}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell">
                                <div class="flex justify-center">
                                    @if (!$training->ends)
                                        <x-icons name="pay_other" />
                                    @else
                                        {{date("d/m/Y", strtotime($training->ends))}}
                                    @endif
                                </div>
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell">
                                <div class="flex items-start justify-center gap-1">
                                    <span class="font-medium text-color-545454">{{count($training->registrations()->get())}}</span>
                                    <x-icons name="user" class="text-color-347af2 " />
                                </div>
                            </td>
                            <td class="px-3 py-4 text-color-2c2c2c">
                                <div class="w-fit m-auto">
                                    <button wire:click="show({{$training->id}})" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun corso trovato...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
