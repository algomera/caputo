<div class="w-full h-full py-14 px-8 2xl:px-28">
    <h1 class="text-5xl font-bold text-color-17489f capitalize mb-5">Visite mediche</h1>

    <div class="w-full flex items-center justify-between">
        <div class="flex items-center gap-5">
            <span>Cerca per:</span>
            <x-input-text wire:model.live="name" width="w-fit" name="name" placeholder="Nome" uppercase="shadow" />
            <x-input-text wire:model.live="lastName" width="w-fit" name="lastName" placeholder="Cognome" uppercase="shadow" />
            <x-input-text x-mask="999 9999999" wire:model.live="phone" width="w-fit" name="phone" placeholder="Telefono" uppercase="shadow" />
            <x-input-text wire:model.live="course" width="w-fit" name="course" placeholder="Corso" uppercase="shadow" />
        </div>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Codice
                    </th>
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Corso/servizio
                    </th>
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Cognome
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Nome
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Tipo di visita
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Pago Pa
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        1° Fase
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Esito visita
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Telefono 1
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light hidden xl:table-cell">
                        Telefono 2
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Messaggio
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light hidden xl:table-cell">
                        Scadenza
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar">
                @if ($medicalVisits->count() > 0)
                    @foreach($medicalVisits as $visit)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-bold text-color-347af2 uppercase">{{$visit->customer->school->code}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-bold">{{$visit->course->name}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize">{{$visit->customer->lastName}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c capitalize">{{$visit->customer->name}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">Rilascio</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">
                                <div>
                                    @if ($visit->medicalPlanning)
                                        @if ($visit->medicalPlanning->welded)
                                            <div class="w-fit mx-auto font-medium text-color-2c2c2c bg-color-01a53a/30 rounded-full px-3 py-1">Pagato</div>
                                        @else
                                            <button wire:click="$dispatch('openModal', { component: 'medical-visits.modals.payment-visit', arguments: {registration: {{$visit->id}}} })" class="underline font-light text-color-2c2c2c bg-color-347af2/30 rounded-full px-3 py-1">Genera</button>
                                        @endif
                                        
                                    @endif
                                </div>
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">
                                <div>
                                    <button class="underline font-light text-color-2c2c2c bg-color-347af2/30 rounded-full px-3 py-1">Genera</button>
                                </div>
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">
                                @if ($visit->medicalPlanning)
                                    @if ($visit->medicalPlanning->protocol)
                                        {{$visit->medicalPlanning->protocol}}
                                    @else 
                                        ---
                                    @endif
                                @else
                                    Da Fissare
                                @endif
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">{{$visit->customer->phone_1}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell">{{$visit->customer->phone_2}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">
                                <div class="w-fit m-auto">
                                    <button class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="message" class="w-5" />
                                    </button>
                                </div>
                            </td>
                            <td class="px-3 py-4 text-color-2c2c2c hidden xl:table-cell">?</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessus record trovato...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
