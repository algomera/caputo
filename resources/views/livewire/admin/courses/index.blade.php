<div class="p-10 h-[calc(100vh-96px)]">
    <div class="h-full bg-color-f7f7f7 shadow-md rounded-sm p-5">
        <div class="flex flex-col gap-4 border-b pb-5">
            <h1 class=" text-2xl font-medium text-color-347af2 ">I corsi dell'autoscuola</h1>
            <p class="text-xl text-color-2c2c2c ">Modifica o elimina i corsi delle diverse filiali dell'autoscuola</p>
        </div>


        <div x-data="{open: null}" class="w-full h-[calc(100vh-300px)] overflow-auto no-scrollbar">
            @if ($services->count() > 0)
                @foreach ($services as $service)
                    <div class="w-full bg-color-fbfbfb transition-all duration-300">
                        <div class="flex items-center justify-between my-2 rounded-md">
                            <div class="flex items-center gap-3 ml-4">
                                <x-icons class="text-color-538ef3 w-12" :name="get_icon($service->name)" />
                                <span>{{$service->name}}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                {{-- <x-icons name="b-edit"
                                    class="cursor-pointer"
                                    wire:click="$dispatch('openModal', { component: 'admin.service.modals.edit', arguments: {service: {{ $service->id }}} })"
                                /> --}}
                                {{-- <x-icons name="b-delete"
                                    class="cursor-pointer"
                                    wire:click='delete({{$service->id}})' wire:confirm.prompt="SEI SICURO DI VOLERE ELIMINARE QUESTO SERVIZIO?\n\nScrivi: ({{$service->name}}) per confermare.\n'scrivi cosi come riportato rispettando le lettere in maiuscolo'|{{$service->name}}"
                                /> --}}
                                {{-- <x-icons name="b-delete"
                                    class="cursor-pointer"
                                    wire:click="$dispatch('openModal', { component: 'admin.schools.delete', arguments: {school: {{ $service->id }}} })"
                                /> --}}
                                <div x-show="open != {{ $service->id }}" x-on:click="open = {{ $service->id }}" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                    <span>Gestione corsi</span>
                                    <div>
                                        <x-icons name="chevron_down" />
                                    </div>
                                </div>
                                <div x-show="open == {{ $service->id }}" x-on:click="open = null" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                    <span>Gestione corsi</span>
                                    <div>
                                        <x-icons name="chevron_down" class="rotate-180" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-show="open == {{ $service->id }}" class="pb-4 pr-4 border-t ml-20">
                            @if ($service->courses()->get()->count() > 0)
                                <div class="flex flex-wrap gap-x-4 gap-y-4 mt-5">
                                    @foreach ($service->courses()->get() as $course)
                                        <div class="w-[calc(25%-16px)] flex flex-col gap-2 xl:flex-row items-center justify-between border rounded-md p-3 bg-white">
                                            <span class="capitalize font-medium text-color-545454">{{$course->name}}</span>
                                            <div class="flex items-center gap-2">
                                                <x-icons name="b-edit" class="cursor-pointer hover:brightness-90"
                                                    wire:click="$dispatch('openModal', { component: 'admin.courses.modals.edit', arguments: {service: {{ $service->id }}, course: {{$course->id}}} })"
                                                />
                                                {{-- <x-icons name="b-delete" class="cursor-pointer hover:brightness-90"
                                                    wire:click="$dispatch('openModal', { component: 'admin.courses.modals.delete', arguments: {course: {{ $course->id }}} })"
                                                /> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xl font-semibold text-gray-400 uppercase text-center">Nessun corso prente!..</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <p>Nessun servizio disponibile..</p>
            @endif
        </div>

    </div>
</div>
