<div class="px-14 py-8 flex flex-col gap-4">
    <h1 class="text-3xl font-bold text-color-17489f">Iscritti ai corsi</h1>

    <div class="flex items-center justify-between my-3">
        <div class="flex items-center gap-3">
            <span>Cerca per:</span>
            <x-input-text wire:model.live="lastName" width="w-fit" name="lastName" placeholder="Cognome" uppercase="shadow" />
            <x-input-text wire:model.live="name" width="w-fit" name="name" placeholder="Nome" uppercase="shadow" />
            <x-input-text wire:model.live="course" width="w-fit" name="course" placeholder="Iscrizione" uppercase="shadow" />
        </div>

        @role('admin|istruttore')
            <x-custom-select wire:model.live="schoolCode" name="schoolCode" label="" width="w-fit" >
                <option value="">tutte le scuole</option>
                @foreach ($schools as $school)
                    <option value="{{$school->code}}">Scuola: {{$school->code}}</option>
                @endforeach
            </x-custom-select>
        @endrole
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card relative">
        <span class="absolute top-4 right-4 text-sm font-medium text-color-545454/70">N° Iscrizioni aperte: {{count($registrations)}}</span>
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="py-3.5 px-3 font-light text-center">Cliente</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Iscrizione</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Guide obbligatorie</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Guide prenotate</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Guide svolte</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[340px] 2xl:!max-h-[500px]">
                @if (count($registrations) > 0)
                    @foreach($registrations as $registration)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-17489f capitalize font-semibold text-center">
                                @role('admin|responsabile sede|segretaria')
                                <span wire:click="showCustomer({{$registration->customer->id}})" class="hover:underline cursor-pointer">{{$registration->customer->full_name}}</span>
                                @elserole('istruttore')
                                <span>{{$registration->customer->full_name}}</span>
                                @endrole
                            </td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-medium text-color-2c2c2c uppercase text-center">
                                @if ($registration->courseVariant)
                                    {{$registration->courseVariant->name}}
                                @else
                                    {{$registration->course->name}}
                                @endif
                            </td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c text-center">{{$registration->course->guides}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c text-center">{{count($registration->drivingPlanning)}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-017c67 text-center">{{count($registration->performedGuides)}}</td>
                            <td class="px-3 py-4 text-color-2c2c2c">
                                <div class="w-fit m-auto">
                                    <button wire:click="$dispatch('openModal', { component: 'driving.modals.show-registration-guides', arguments: { registration: {{ $registration->id }} }})" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun Iscrizione trovata...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
