<div class="p-10 pt-5 flex flex-col relative">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <x-icons name="{{get_icon($courseForm->course->service->name)}}" class="w-12"/>
            <h1 class="text-2xl font-medium text-color-347af2 pt-1">{{$courseForm->course->service->name}}</h1>
        </div>
        <x-icons wire:click="$dispatch('closeModal')" name="x_close" class="w-8 text-gray-400 cursor-pointer hover:text-color-2c2c2c transition-all duration-200" />
    </div>

    <div class="sticky top-0 left-0 w-full flex items-end justify-between gap-5 pt-5 pb-2.5 border-b">

        <div class="flex items-start gap-5">
            <div class="mt-2">
                <h2 class="text-2xl font-medium text-color-347af2"> {{$courseForm->name}}</h2>

                @if ($courseVariants)
                    <button wire:click="$dispatch('openModal', { component: 'admin.courses.modals.show-variants', arguments: {course: {{ $courseForm->course->id }}} })" class="px-8 pt-1 mr-4 flex items-center gap-3 text-white bg-color-347af2/80 rounded-md focus_none group">
                        Varianti corso
                        <x-icons name="arrow_back" class="text-white mb-1 rotate-180 group-hover:translate-x-1 transition-all duration-300" />
                    </button>
                @endif
            </div>
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
        <div class="my-5 flex items-center justify-between relative">
            <p class="text-color-2c2c2c text-xl">Modifica i dati del corso</p>
            <button wire:dirty wire:click='update' class="px-8 pt-1 mr-4 text-white bg-green-500/70 rounded-md focus_none hover:scale-105 transition-all duration-300">Salva Modifiche dati</button>
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

        @if ($currentTab == 'Lezioni')
            <div class="border-t pt-5">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-end gap-4">
                        <h3 class="text-xl font-semibold uppercase text-color-2c2c2c">Lezioni del corso</h3>
                        <small class="text-gray-400 font-medium pb-1">(Totale lezioni: {{count($lessons)}})</small>
                    </div>
                    <button wire:click="$dispatch('openModal', { component: 'admin.courses.modals.lesson-create', arguments: {course: {{ $courseForm->course->id }}} })" class="px-8 pt-1 text-white bg-green-500/70 rounded-md focus_none hover:scale-105 transition-all duration-300">+ Aggiungi</button>
                </div>

                <div x-data="{open: null}" class="w-full h-[calc(100vh-300px)] overflow-auto no-scrollbar">
                    @if (count($lessons))
                        @foreach ($lessons as $key => $lesson)
                            <div class="w-full bg-color-fbfbfb transition-all duration-300 shadow">
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

        @if ($currentTab == 'Registrazioni')
            <div class="border-t pt-5">
                <h3 class="text-xl font-medium text-color-2c2c2c">Registrazioni</h3>

            </div>
        @endif

        @if ($currentTab == 'Opzioni/Costi')
            <div class="border-t pt-5">
                <h3 class="text-xl font-medium text-color-2c2c2c">Opzioni/Costi</h3>

            </div>
        @endif
    </div>
</div>
