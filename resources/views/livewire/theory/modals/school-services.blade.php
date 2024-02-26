<div class="px-14 py-8 flex flex-col gap-4 relative">
    <div class="h-full bg-color-f7f7f7 shadow-md rounded-sm p-5">
        <div class="flex items-end justify-between gap-4 border-b pb-5">
            @if ($school)
                <h1 class="text-2xl font-medium text-color-347af2 ">I corsi dell'autoscuola</h1>
            @else
                <h1 class="text-2xl font-medium text-color-347af2 ">Seleziona autoscuola</h1>
            @endif

            @role('admin')
                <x-custom-select wire:model.live="selectedSchool" name="selectedSchool" label="" width="w-fit">
                    <option value="">seleziona scuola</option>
                    @foreach ($schools as $school )
                        <option value="{{$school->id}}" class="capitalize">Code: {{$school->code}}</option>
                    @endforeach
                </x-custom-select>
            @endrole
        </div>


        <div x-data="{open: null}" class="w-full overflow-auto no-scrollbar">
            @if ($school && $services)
                @if ($services->count() > 0)
                    @foreach ($services as $service)
                        <div class="w-full bg-color-fbfbfb transition-all duration-300">
                            <div class="flex items-center justify-between my-2 rounded-md">
                                <div class="flex items-center gap-3 ml-4">
                                    <x-icons class="text-color-538ef3 w-12" :name="get_icon($service->name)" />
                                    <span>{{$service->name}}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div x-show="open != {{ $service->id }}" x-on:click="open = {{ $service->id }}" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                        <div>
                                            <x-icons name="chevron_down" />
                                        </div>
                                    </div>
                                    <div x-show="open == {{ $service->id }}" x-on:click="open = null" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
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
                                            <div wire:click="$dispatch('openModal', { component: 'theory.modals.training-create', arguments: {school: {{$selectedSchool}}, course: {{$course->id}}} })"
                                                class="w-[calc(25%-16px)] flex flex-col gap-2 xl:flex-row items-center justify-between border rounded-md p-3 bg-white cursor-pointer hover:scale-105 transition-all duration-300 group">
                                                <span class="capitalize font-medium text-color-545454 group-hover:text-color-017c67/70 transition-all duration-150">{{$course->name}}</span>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xl font-medium text-color-545454 group-hover:text-color-017c67/70 transition-all duration-150">+</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="pt-4 text-xl font-semibold text-gray-400 uppercase text-center">Nessun corso prente!..</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Nessun servizio disponibile..</p>
                @endif
            @endif
        </div>

    </div>
</div>
