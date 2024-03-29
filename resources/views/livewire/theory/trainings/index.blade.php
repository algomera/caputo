<div class="w-full h-full py-10 px-8 2xl:px-14">
    <h1 class="text-5xl font-bold text-color-17489f capitalize mb-5">Lista corsi</h1>

    <div class="w-full flex items-end justify-between">
        <div class="flex items-center gap-3">
            <span>Cerca per:</span>
            <x-input-text wire:model.live="course" width="w-fit" name="course" placeholder="Nome corso" uppercase="shadow" />
            @if (auth()->user()->role->name != 'insegnante')
                <x-input-text wire:model.live="user" width="w-fit" name="user" placeholder="Insegnante" uppercase="shadow" />
            @endif
            @role('admin|insegnante')
                <x-input-text wire:model.live="code" width="w-fit" name="code" placeholder="Codice Autoscuola" uppercase="shadow uppercase" />
            @endrole
        </div>
        @if (auth()->user()->role->name != 'insegnante')
            <button wire:click="$dispatch('openModal', { component: 'theory.modals.school-services' })" class="w-fit px-6 py-2 bg-color-01a53a/50 text-white rounded-md font-medium">Crea corso</button>
        @endif
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5 relative">
        @if (count($trainings) > 0)
            <small class="absolute right-2 top-2 text-gray-400 font-bold">Corsi trovati: {{count($trainings)}}</small>
        @endif
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="w-20 text-center px-3 py-3.5 font-semibold hidden xl:table-cell">ID</th>
                    @role('admin|insegnante')
                        <th scope="col" class="py-3.5 px-3 font-light">Codice</th>
                    @endrole
                    <th scope="col" class="text-left  px-3 py-3.5 font-light">Corso</th>
                    <th scope="col" class="text-left px-3 py-3.5 font-light">Variante</th>
                    @role('admin|responsabile sede|segretaria')
                        <th scope="col" class="text-left px-3 py-3.5 font-light">Insegnante</th>
                    @endrole
                    <th scope="col" class="text-center px-3 py-3.5 font-light">Inizio</th>
                    <th scope="col" class="w-20 text-center px-3 py-3.5 font-light">Orario</th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light">Fine</th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light hidden xl:table-cell">N° Iscritti</th>
                    <th scope="col" colspan="2" class="py-3.5 font-light">Azioni</th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if ($trainings->count() > 0)
                    @foreach($trainings as $training)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="w-20 border-r-2 border-color-efefef py-4 px-3 text-color-17489f capitalize font-semibold hidden xl:table-cell">{{$training->id}}</td>
                            @role('admin|insegnante')
                                <td class="border-r-2 border-color-efefef py-4 px-3 font-bold text-color-347af2 uppercase">{{$training->school->code}}</td>
                            @endrole
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize text-left text-sm 2xl:text-base">{{$training->course->name}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c capitalize text-left text-sm 2xl:text-base">
                                @if ($training->courseVariant)
                                    {{$training->courseVariant->name}}
                                @endif
                            </td>
                            @role('admin|responsabile sede|segretaria')
                                <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c text-left text-sm 2xl:text-base">{{$training->user->full_name}}</td>
                            @endrole
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c text-sm 2xl:text-base">{{date("d/m/Y", strtotime($training->begins))}}</td>
                            <td class="w-20 border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c capitalize">{{$training->time_start ? date("H:i", strtotime($training->time_start)) : null}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c text-sm 2xl:text-base">
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
                                    <span class="font-medium text-color-545454">{{count($training->getRegistrationBranch(1))}}</span>
                                    <x-icons name="user" class="text-color-347af2 " />
                                </div>
                            </td>
                            <td colspan="2" class="py-4 text-color-2c2c2c">
                                <div class="w-fit m-auto flex items-center gap-1 2xl:gap-2">
                                    <button wire:click="show({{$training->id}})" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full scale-75 2xl:scale-100">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                    <button wire:click="calendar({{$training->id}})" class="bg-color-ffb205/30 flex items-center justify-center px-3 py-3 rounded-full scale-75 2xl:scale-100">
                                        <x-icons name="calendar" class="w-5" />
                                    </button>
                                    @role('admin|responsabile sede')
                                        <button wire:click="$dispatch('openModal', { component: 'theory.modals.training-delete', arguments: {training: {{ $training->id }}} })"
                                            class="bg-red-500/10 flex items-center justify-center p-2.5 border border-red-500/50 rounded-full scale-75 2xl:scale-100">
                                            <x-icons name="delete" class="w-5" />
                                        </button>
                                    @endrole
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
