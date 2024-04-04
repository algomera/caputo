<div class="p-10 pt-5 flex flex-col relative">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <x-icons name="{{get_icon($courseForm->course->service->name)}}" class="w-12"/>
            <h1 class="text-4xl font-medium text-color-347af2 pt-2">{{$courseForm->course->service->name}}</h1>
        </div>
        <x-icons wire:click="$dispatch('closeModal')" name="x_close" class="w-8 text-gray-400 cursor-pointer hover:text-color-2c2c2c transition-all duration-200" />
    </div>

    {{-- Navigazione --}}
    <div class="sticky top-0 left-0 w-full flex items-end justify-between gap-5 pt-5 pb-2.5 border-b-2 ">

        <div class="flex flex-col justify-start items-start gap-2">
            <h2 class="text-2xl font-medium text-color-347af2"> {{$courseForm->name}}</h2>

            @if (!$courseVariants && $courseForm->course->course)
                <button wire:click="setCourseStandard({{$courseForm->course->course->id}})" class="px-8 pt-1 mr-4 flex items-center gap-3 text-white bg-color-347af2/80 rounded-md focus_none group">
                    {{$courseForm->course->course->name}}
                    <x-icons name="arrow_back" class="text-white mb-1 rotate-180 group-hover:translate-x-1 transition-all duration-300" />
                </button>
            @endif

            @if ($courseVariants)
                <button wire:click="$dispatch('openModal', { component: 'admin.courses.modals.show-variants', arguments: {courseId: {{ $courseForm->course->id }}} })" class="px-8 pt-1 mr-4 flex items-center gap-3 text-white bg-color-347af2/80 rounded-md focus_none group">
                    Varianti corso
                    <x-icons name="arrow_back" class="text-white mb-1 rotate-180 group-hover:translate-x-1 transition-all duration-300" />
                </button>
            @endif
        </div>

        <div class="w-fit shadow p-2 bg-color-fbfbfb rounded-md">
            <nav class="flex space-x-4" aria-label="Tabs">
                @foreach ($tabs as $key => $tab)
                    <span wire:click="$set('currentTab', '{{$tab}}')" class="px-3 pt-2 pb-1 font-medium uppercase text-sm rounded-md {{$currentTab == $tab ? 'bg-color-c9defa cursor-default' : 'text-color-2c2c2c hover:text-color-347af2 cursor-pointer'}}">
                        {{$tab}}
                    </span>
                @endforeach
            </nav>
        </div>
    </div>

    <div class="h-[630px] overflow-hidden overflow-y-auto no-scrollbar">
        {{-- Dati corso --}}
        <div class="py-5 mb-5 border-b-2">
            <div class="mb-5 flex items-center justify-between relative">
                <p class="text-color-2c2c2c text-xl">Modifica i dati del corso</p>
                <button wire:target="courseForm.name, courseForm.label, courseForm.type_visit, courseForm.description" wire:dirty wire:click='update' class="px-8 pt-1 mr-4 text-white bg-green-500/70 rounded-md focus_none hover:scale-105 transition-all duration-300">Salva Modifiche dati</button>
            </div>

            <div class="flex flex-col gap-4">
                <div class="flex item-center gap-4">
                    <x-input-text wire:model="courseForm.name" width="grow" name="courseForm.name" label="Nome Corso" required="true" />
                    <x-input-text wire:model="courseForm.label" width="grow" name="courseForm.label" label="Etichetta" />
                    <x-custom-select wire:model="courseForm.type_visit" name="courseForm.type_visit" label="Tipo visita" width="w-fit" required="true">
                        <option value="rilascio">Rilascio</option>
                        <option value="rinnovo">Rinnovo</option>
                    </x-custom-select>
                </div>
                {{-- <div class="flex item-center gap-4">
                    <x-input-text x-mask="99" wire:model="courseForm.absences" width="w-fit" name="courseForm.absences" label="Assenze consentite" placeholder="0" required="true" />
                    <x-input-text x-mask="99" wire:model="courseForm.guides" width="w-fit" name="courseForm.guides" label="Guide obbligatorie" placeholder="0" required="true" />
                </div> --}}
                <div>
                    <label for="courseForm.description" class="text-sm font-light text-color-2c2c2c mb-1 w-fit ml-2">Descrizione corso</label>
                    <textarea wire:model="courseForm.description" name="courseForm.description" id="" cols="30" rows="5" class="w-full border-color-dfdfdf rounded-md"></textarea>
                </div>
            </div>
        </div>

        {{-- Lezioni Corso --}}
        @if ($currentTab == 'Lezioni')
            <div>
                <div class="flex items-center justify-between mb-2 mr-4">
                    <div class="flex items-end gap-4">
                        <h3 class="text-color-2c2c2c text-xl">Lezioni del corso</h3>
                        <div class="px-6 py-1 border rounded-md space-x-4 shadow">
                            <small class="text-gray-400 font-medium pb-1">Totale lezioni: <span class="text-base font-medium text-color-2c2c2c">{{count($lessons)}}</span></small>
                            <small class="text-gray-400 font-medium pb-1">Totale Ore lezioni: <span class="text-base font-medium text-color-2c2c2c">{{$courseForm->course->getDurationAttribute()}}</span></small>
                        </div>
                    </div>
                    @if ($courseForm->course->course)
                        <button wire:click="$dispatch('openModal', { component: 'admin.courses.modals.lesson-create', arguments: {course: {{ $courseForm->course->course->id }}, variant: {{ $courseForm->course->id }}} })" class="px-8 pt-1 text-white bg-green-500/70 rounded-md focus_none hover:scale-105 transition-all duration-300">+ Aggiungi</button>
                    @else
                        <button wire:click="$dispatch('openModal', { component: 'admin.courses.modals.lesson-create', arguments: {course: {{ $courseForm->course->id }}} })" class="px-8 pt-1 text-white bg-green-500/70 rounded-md focus_none hover:scale-105 transition-all duration-300">+ Aggiungi</button>
                    @endif
                </div>

                <div x-data="{open: null}" class="w-full h-[calc(100vh-300px)] overflow-auto no-scrollbar">
                    @if (count($lessons))
                        @foreach ($lessons as $key => $lesson)
                            <div class="w-full bg-color-fbfbfb hover:bg-color-dfdfdf/50 transition-all duration-100 shadow">
                                <div class="py-2 flex items-center justify-between my-2 rounded-md">
                                    <div class="flex items-center gap-3 ml-4">
                                        <span class="font-semibold text-color-347af2 text-lg">{{$key+1}}</span>
                                        <span>{{$lesson->subject}}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <x-icons name="b-delete" class="cursor-pointer"
                                            wire:click="deleteLesson({{$lesson->id}})"
                                            wire:confirm.prompt="SEI SICURO DI VOLERE ELIMINARE QUESTA LEZIONE?\nLezione: {{$lesson->subject}}\n\nScrivi: 'ELIMINA' per confermare.\n'Scrivi in maiuscolo riportato sopra!'|ELIMINA"
                                        />

                                        <x-icons name="b-edit" class="cursor-pointer"
                                            wire:click="$dispatch('openModal', { component: 'admin.courses.modals.lesson', arguments: {lesson: {{ $lesson->id }}} })"
                                        />

                                        <div x-show="open !== {{ $key }}" x-on:click="open = {{ $key }}" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                            Apri <x-icons name="chevron_down" />
                                        </div>
                                        <div x-show="open === {{ $key }}" x-on:click="open = null" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                            Chiudi <x-icons name="chevron_down" class="rotate-180" />
                                        </div>
                                    </div>
                                </div>

                                <div x-show="open === {{ $key }}" x-transition.duration.300ms class="py-4 pr-4 border-t-2 ml-20 overflow-hidden transition-all duration-300">
                                    <div class="w-full flex item-center justify-between border-b">
                                        <div>
                                            <small class="block text-gray-400 font-medium">Tipo Lezione</small>
                                            <span class="capitalize">{{$lesson->type}}</span>
                                        </div>
                                        <div>
                                            <small class="block text-gray-400 font-medium">Durata</small>
                                            <span>{{$lesson->duration}} Min.</span>
                                        </div>
                                    </div>

                                    <div class="my-4 border-b">
                                        <small class="block text-gray-400 font-medium">Titolo</small>
                                        <p>{{$lesson->subject}}</p>
                                    </div>

                                    <div>
                                        <small class="block text-gray-400 font-medium">Descrizione</small>
                                        <p>{{$lesson->description}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Nessuna Lezione presente..</p>
                    @endif
                </div>
            </div>
        @endif

        {{-- Registrazioni corso --}}
        @if ($currentTab == 'Registrazioni')
            <div>
                <div class="flex items-center justify-between mb-2 mr-4">
                    <h3 class="text-xl font-medium text-color-2c2c2c">Registrazioni</h3>
                    <button wire:click="addRegistration" class="px-8 pt-1 text-white bg-green-500/70 rounded-md focus_none hover:scale-105 transition-all duration-300">+ Aggiungi</button>
                </div>

                <div x-data="{open: null}">
                    @if ($courseRegistrationSteps->count())
                        @foreach ($courseRegistrationSteps as $key => $registration)
                            <div class="w-full bg-color-fbfbfb transition-all duration-100 shadow">
                                <div class="py-2 flex items-center justify-between my-2 rounded-md">
                                    <div class="flex items-center gap-3 ml-4">
                                        <span class="font-semibold text-color-347af2 text-lg">{{$key+1}}</span>
                                        <span class="capitalize">{{$registration->registrationType->name}}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <x-icons name="b-delete" class="cursor-pointer"
                                            wire:click="deleteRegistration({{$registration->id}})"
                                            wire:confirm.prompt="SEI SICURO DI VOLERE ELIMINARE?\nRegistrazione: {{$registration->registrationType->name}}\n\nScrivi: 'ELIMINA' per confermare.\n'Scrivi in maiuscolo come riportato sopra!'|ELIMINA"
                                        />

                                        <x-icons name="b-edit" class="cursor-pointer"
                                            wire:click="$dispatch('openModal', { component: 'admin.courses.modals.registration', arguments: {registration: {{ $registration->id }}} })"
                                        />

                                        <div x-show="open !== {{ $key }}" x-on:click="open = {{ $key }}" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                            Apri <x-icons name="chevron_down" />
                                        </div>
                                        <div x-show="open === {{ $key }}" x-on:click="open = null" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                            Chiudi <x-icons name="chevron_down" class="rotate-180" />
                                        </div>
                                    </div>
                                </div>

                                <div x-show="open === {{ $key }}" x-transition.duration.300ms class="py-4 pr-4 border-t-2 ml-20 overflow-hidden transition-all duration-300 relative">
                                    {{-- step --}}
                                    <div>
                                        <h3 class="text-center text-lg capitalize font-medium text-color-347af2 ">Step di registrazione</h3>
                                        <div class="flex items-start justify-center gap-1 scale-75">
                                            @foreach ($registration->getSteps()->get() as $key => $step)
                                                <x-steps
                                                    color="afafaf"
                                                    currentStep="0"
                                                    number="{{$key+1}}"
                                                    step="{{$step->short_name}}"
                                                />
                                                @if ($key+1 < $registration->getSteps()->get()->count())
                                                    <div class="h-1 grow max-w-[138px] rounded-full shadow mt-4 bg-color-afafaf"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- guide --}}
                                    <div class="absolute top-5 right-5">
                                        @if ($courseForm->course->course)
                                            @if (get_guide($courseForm->course->course->id, $courseForm->course->id))
                                                @php
                                                    $guide = get_guide($courseForm->course->course->id, $courseForm->course->id);
                                                @endphp
                                                <div class="px-3 py-1 border shadow rounded-md bg-white">
                                                    <span class="text-center text-color-545454">{{ $guide->name }}</span>
                                                    <div class="mx-auto space-x-4">
                                                        <small>{{ $guide->duration }}Min.</small>
                                                        <small>{{ $guide->price }}€</small>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            @if (get_guide($courseForm->course->id))
                                                @php
                                                    $guide = get_guide($courseForm->course->id);
                                                @endphp
                                                <div class="px-3 py-1 border shadow rounded-md bg-white">
                                                    <span class="text-center text-color-545454">{{ $guide->name }}</span>
                                                    <div class="w-full flex items-center justify-center gap-3">
                                                        <small>{{ $guide->duration }}Min.</small>
                                                        <small>{{ $guide->price }}€</small>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="w-full flex gap-10 mt-5 border-t-4 border-white">
                                        {{-- opzioni e costi --}}
                                        <div class="w-1/2 border-r-4 border-white pr-10 pt-5">
                                            <h3 class="text-center text-lg capitalize font-medium text-color-347af2">Costi e opzioni inseriti</h3>

                                            <div class="mt-3 flex flex-col justify-center gap-10">
                                                <div class="p-2 min-w-[360px] border rounded-md shadow bg-white">
                                                    <h4 class="uppercase font-medium text-color-2c2c2c">costi</h4>
                                                    <ul>
                                                        @foreach ($courseForm->course->getOptions()->where('type', 'fisso')->where('registration_type_id', $registration->registration_type_id)->get() as $option)
                                                        <li>
                                                            <div class="flex items-end gap-2">
                                                                <div class="font-light text-color-545454 flex items-center gap-1">
                                                                    <x-icons name="circle" class="text-color-347af2 " />
                                                                    <span class="pt-1">{{$option->name}}</span>
                                                                </div>
                                                                <div class="grow h-[1px] bg-color-dfdfdf mb-2"></div>
                                                                <span class="font-medium text-color-2c2c2c">{{$option->price}} €</span>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <div class="p-2 min-w-[360px] border rounded-md shadow bg-white">
                                                    <h4 class="uppercase font-medium text-color-2c2c2c">Opzioni</h4>
                                                    <ul>
                                                        @foreach ($courseForm->course->getOptions()->where('type', 'opzionale')->where('registration_type_id', $registration->registration_type_id)->get() as $option)
                                                        <li>
                                                            <div class="flex items-end gap-2">
                                                                <div class="font-light text-color-545454 flex items-center gap-1">
                                                                    <x-icons name="circle" class="text-color-347af2 " />
                                                                    <span class="pt-1">{{$option->name}}</span>
                                                                </div>
                                                                <div class="grow h-[1px] bg-color-dfdfdf mb-2"></div>
                                                                <span class="font-medium text-color-2c2c2c">{{$option->price}} €</span>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- tipi di iscrizioni --}}
                                        <div class="w-1/2 pt-5">
                                            <h3 class="text-center text-lg capitalize font-medium text-color-347af2">Tipi di iscrizioni</h3>

                                            <div class="grid grid-cols-2 gap-5 mt-3">
                                                @foreach ($registration->branchCourses()->get() as $branchCourse)
                                                    <div class="bg-white flex flex-col gap-1 p-2 border rounded-md shadow text-color-545454">
                                                        <div class="flex items-end gap-2">
                                                            <div class="font-light text-color-545454">
                                                                <span class="pt-1">Ramo iscrizione</span>
                                                            </div>
                                                            <div class="grow h-[1px] bg-color-dfdfdf mb-2"></div>
                                                            <span class="font-medium text-color-2c2c2c capitalize">{{$branchCourse->branch->name}}</span>
                                                        </div>
                                                        <div class="flex items-end gap-2">
                                                            <div class="font-light text-color-545454">
                                                                <span class="pt-1">Assenze massime</span>
                                                            </div>
                                                            <div class="grow h-[1px] bg-color-dfdfdf mb-2"></div>
                                                            <span class="font-medium text-color-2c2c2c">{{$branchCourse->absences}}</span>
                                                        </div>
                                                        <div class="flex items-end gap-2">
                                                            <div class="font-light text-color-545454">
                                                                <span class="pt-1">Guide obbligatorie</span>
                                                            </div>
                                                            <div class="grow h-[1px] bg-color-dfdfdf mb-2"></div>
                                                            <span class="font-medium text-color-2c2c2c">{{$branchCourse->guides}}</span>
                                                        </div>
                                                        <div class="flex items-end gap-2">
                                                            <div class="font-light text-color-545454">
                                                                <span class="pt-1">Prezzo iscrizione</span>
                                                            </div>
                                                            <div class="grow h-[1px] bg-color-dfdfdf mb-2"></div>
                                                            <span class="font-medium text-green-500/70 ">{{$branchCourse->price}} €</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        @endforeach
                    @else
                        <p>Nessun tipo di registrazione definito</p>
                    @endif

                </div>
            </div>
        @endif

    </div>
</div>
