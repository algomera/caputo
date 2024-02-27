<div class="px-14 py-8 flex flex-col gap-4">
    <h1 class="text-3xl font-bold text-color-17489f">Iscritti ai corsi</h1>

    <div class="flex items-center gap-3 my-3">
        <span>Cerca per:</span>
        <x-input-text wire:model.live="lastName" width="w-fit" name="lastName" placeholder="Cognome" uppercase="shadow" />
        <x-input-text wire:model.live="name" width="w-fit" name="name" placeholder="Nome" uppercase="shadow" />
        <x-input-text wire:model.live="course" width="w-fit" name="course" placeholder="Iscrizione" uppercase="shadow" />
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card relative">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="py-3.5 px-3 font-light text-center">Cliente</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Iscrizione</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center hidden xl:table-cell">Guide obbligatorie</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Guide effettuate</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[340px] 2xl:!max-h-[500px]">
                @if (count($registrations) > 0)
                    @foreach($registrations as $registration)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-17489f capitalize font-semibold text-center">{{$registration->customer->full_name}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-medium text-color-2c2c2c uppercase text-center">{{$registration->course->name}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c text-center">{{$registration->course->guides}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-017c67 text-center hidden xl:table-cell">{{count($registration->drivingPlanning)}}</td>
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
