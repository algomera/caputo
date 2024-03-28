<div class="p-4 pb-16">
    @if (!$selectedOption)
        <div class="w-full flex justify-between">
            <h1 @class(["text-4xl font-semibold", 'text-color-'.get_color($course->service->name)])>Registrazione al corso</h1>
            <small class="text-gray-400 font-bold">{{$course->name}}</small>
        </div>

        <div class="m-auto flex flex-col gap-4 px-20 xl:px-56 mt-16">
            @if (count($trainings) > 0)
                <div wire:click='setOption("esistente")' class="w-full h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                    <p class="text-lg text-color-2c2c2c">Iserisci a <b>corso esistente</b></p>
                </div>
            @else
                <div wire:click='setOption("nuovo")' class="w-full h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                    <p class="text-lg text-color-2c2c2c">Crea un nuovo <b>corso ({{$course->name}})</b></p>
                </div>
            @endif
            {{-- @if (count($course->variants()->get()) > 0)
                <div wire:click='setOption("interessato")' class="w-full h-24 flex flex-col gap-1 items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                    <p class="text-lg text-color-2c2c2c">Inserisci come <b>interessato al corso</b></p>
                    <small>(Verranno salvati solo i dati relativi al cliente)</small>
                </div>
            @else
            @endif --}}
            <div wire:click="putRegistration({{$course->id}}, 'interessato')" class="w-full h-24 flex flex-col gap-1 items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg text-color-2c2c2c">Inserisci come <b>interessato al corso ({{$course->name}})</b></p>
                <small>(Verranno salvati solo i dati relativi al cliente)</small>
            </div>
        </div>
    @endif

    @if ($selectedOption == 'esistente')
        <div class="flex flex-col gap-5">
            <div wire:click='resetOption' class="flex items-center gap-2 group cursor-pointer ">
                <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
                <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
            </div>

            <div class="w-full flex justify-between">
                <h1 @class(["text-4xl font-semibold", 'text-color-'.get_color($course->service->name)])>Seleziona il corso</h1>
                <button wire:click='setOption("nuovo")' class="ml-auto w-fit px-6 py-2 bg-color-01a53a/60 text-white rounded-md font-semibold">+ corso</button>
            </div>

            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                    <tr class="text-center text-color-545454">
                        <th scope="col" class="border-r py-3.5 px-3 hidden xl:table-cell">ID</th>
                        <th scope="col" class="border-r py-3.5 px-3 2xl:max-w-none">Corso</th>
                        <th scope="col" class="border-r py-3.5 px-3 2xl:max-w-none">Insegnante</th>
                        <th scope="col" class="border-r px-3 py-3.5">Inizio</th>
                        <th scope="col" class="border-r px-3 py-3.5">Orario</th>
                        <th scope="col" class="border-r px-3 py-3.5">Fine</th>
                        <th scope="col" class="border-r px-3 py-3.5 hidden xl:table-cell">N° Lezioni</th>
                        <th scope="col" class="border-r px-3 py-3.5 hidden xl:table-cell">Tot. (H:M)</th>
                        <th scope="col" class="border-r px-3 py-3.5">Ass. max</th>
                        <th scope="col" class="border-r px-3 py-3.5">Iscritti Guide</th>
                        <th scope="col" class="border-r px-3 py-3.5">Iscritti Teoria</th>
                        <th scope="col" class="px-3 py-3.5 text-center">Azioni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach($trainings as $training)
                        <tr class="text-center">
                            <td class="border-r whitespace-nowrap py-4 pl-4 pr-3 font-bold text-color-347af2 uppercase hidden xl:table-cell">{{$training->id}}</td>
                            <td class="border-r whitespace-nowrap py-4 pl-4 pr-3 font-light text-color-2c2c2c capitalize 2xl:max-w-none truncate">
                                @if ($training->variant_id != null)
                                    {{$training->courseVariant->name}}
                                @else
                                    {{$training->course->name}}
                                @endif
                            </td>
                            <td class="border-r whitespace-nowrap py-4 pl-4 pr-3 font-light text-color-2c2c2c capitalize 2xl:max-w-none truncate">{{$training->user->full_name}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c capitalize">{{date("d/m/Y", strtotime($training->begins))}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c capitalize">{{$training->time_start ? date("H:i", strtotime($training->time_start)) : null}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c">
                                @if ($training->ends)
                                    {{date("d/m/Y", strtotime($training->ends))}}
                                @else
                                    <x-icons name="loop" class="m-auto h-5 w-6" />
                                @endif
                            </td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c hidden xl:table-cell">{{count($training->course->lessons)}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c hidden xl:table-cell">{{$training->course->duration}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c">{{$branchCourse->absences}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c">{{count($training->getRegistrationBranch(2))}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c">{{count($training->getRegistrationBranch(1))}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-light text-color-2c2c2c">
                                <div class="flex items-center justify-center gap-2 px-5">
                                    <button wire:click="putRegistration({{$training->id}}, '{{$selectedOption}}')" @class(["px-6 pt-1 text-lg font-medium text-white rounded-full ", 'bg-color-'.get_color($course->service->name)])>Aggiungi</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($selectedOption == 'interessato')
        <div class="flex flex-col gap-5">
            <div wire:click='resetOption' class="flex items-center gap-2 group cursor-pointer ">
                <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
                <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
            </div>

            <h1 @class(["text-4xl font-semibold", 'text-color-'.get_color($course->service->name)])>Seleziona il corso</h1>

            <table class="min-w-full divide-y divide-gray-200 border mt-5">
                <thead>
                    <tr class="text-center text-color-545454">
                        <th scope="col" class="text-left border-r py-3.5 px-3 2xl:max-w-none">Corso</th>
                        <th scope="col" class="border-r px-3 py-3.5 hidden xl:table-cell">N° Lezioni</th>
                        <th scope="col" class="border-r px-3 py-3.5">Tot. (H:M)</th>
                        <th scope="col" class="border-r px-3 py-3.5 hidden xl:table-cell">Ass. consentite</th>
                        <th scope="col" class="px-3 py-3.5 text-center">Azioni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr class="text-center">
                        <td class="border-r whitespace-nowrap text-left py-4 pl-4 pr-3 font-light text-color-2c2c2c capitalize 2xl:max-w-none truncate">{{$course->name}}</td>
                        <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c hidden xl:table-cell">{{count($course->lessons)}}</td>
                        <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c">{{$course->duration}}</td>
                        <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c hidden xl:table-cell">{{$course->absences}}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm font-light text-color-2c2c2c">
                            <div class="flex items-center justify-center gap-2 px-5">
                                <button wire:click="putRegistration({{$course->id}}, '{{$selectedOption}}')" @class(["px-6 py-1 text-lg font-semibold text-white rounded-full ", 'bg-color-'.get_color($course->service->name)])>Inserisci</button>
                            </div>
                        </td>
                    </tr>
                    {{-- @foreach($course->variants()->get() as $variant)
                        <tr class="text-center">
                            <td class="border-r whitespace-nowrap text-left py-4 pl-4 pr-3 font-light text-color-2c2c2c capitalize 2xl:max-w-none truncate">{{$variant->name}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c hidden xl:table-cell">{{count($variant->lessons)}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c">{{$variant->duration}}</td>
                            <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c hidden xl:table-cell">{{$variant->absences}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-light text-color-2c2c2c">
                                <div class="flex items-center justify-center gap-2 px-5">
                                    <button wire:click="putRegistration({{$variant->id}}, '{{$selectedOption}}', 'variant')" @class(["px-6 py-1 text-lg font-semibold text-white rounded-full ", 'bg-color-'.get_color($course->service->name)])>Inserisci</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    @endif

    @if ($selectedOption == 'nuovo')
        <div x-data="{ loopTraining: false }" class="flex flex-col gap-5">
            <div wire:click='resetOption' class="flex items-center gap-2 group cursor-pointer ">
                <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
                <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
            </div>

            <div class="w-full flex items-end justify-between">
                <h1 @class(["text-4xl font-semibold", 'text-color-'.get_color($course->service->name)])>Seleziona e compila i campi</h1>
                <button x-on:click="loopTraining = !loopTraining, $wire.setLoop()" class="py-2 px-6 bg-color-dfdfdf border border-gray-200 text-gray-600 rounded hover:bg-gray-200 active:bg-gray-200 disabled:opacity-50 shadow-md">
                    Corso in loop
                </button>
            </div>

            <div class="flex gap-2 border rounded-md relative p-4 bg-color-f7f7f7">
                <x-custom-select wire:model="trainingUser" name="trainingUser" label="Insegnante" width="grow" required="true">
                    <option value="">Seleziona</option>
                    @foreach ($users as $user )
                        <option value="{{$user->id}}" class="capitalize">{{$user->name}} {{$user->lastName}}</option>
                    @endforeach
                </x-custom-select>
                <x-input-text type="date" wire:model="trainingBegins" width="grow" name="trainingBegins" label="Inizio corso" required="true" />

                <div x-show="loopTraining" class="grow">
                    <x-input-text type="time" wire:model.live="trainingTimeStart" width="grow" name="trainingTimeStart" label="Orario lezioni"  />
                </div>
                <div x-show="!loopTraining" class="grow">
                    <x-input-text type="date" wire:model.live="trainingEnds" width="grow" name="trainingEnds" label="Fine corso"  />
                </div>
            </div>

            <x-submit-button wire:click='createTraining' @class(["ml-auto",'bg-color-'.get_color(session()->get('serviceName'))])>Crea corso</x-submit-button>
        </div>
    @endif
</div>
