<div class="w-full h-full py-10 px-8 2xl:px-14">
    <h1 class="text-5xl font-bold text-color-17489f capitalize mb-5">Visite mediche</h1>

    <div class="w-full flex items-end justify-between">
        <div class="flex items-center gap-3">
            <span>Cerca per:</span>
            <x-input-text wire:model.live="name" width="w-fit" name="name" placeholder="Nome" uppercase="shadow" />
            <x-input-text wire:model.live="lastName" width="w-fit" name="lastName" placeholder="Cognome" uppercase="shadow" />
            <x-input-text x-mask="999 9999999" wire:model.live="phone" width="w-fit" name="phone" placeholder="Telefono" uppercase="shadow" />
            <x-input-text wire:model.live="course" width="w-fit" name="course" placeholder="Corso" uppercase="shadow" />
            @role('admin')
            <x-input-text wire:model.live="code" width="w-fit" name="code" placeholder="Codice" uppercase="shadow" />
            @endrole
        </div>
        <button class="px-4 py-1 bg-color-17489f text-white font-bold rounded-md hover:scale-105 transition-all duration-300">Vai al calendario</button>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    @role('admin')
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Codice
                    </th>
                    @endrole
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
                        Stato visita
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        N° Protocollo
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Telefono 1
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light hidden xl:table-cell">
                        Telefono 2
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light hidden xl:table-cell">
                        Scadenza
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if ($medicalVisits->count() > 0)
                    @foreach($medicalVisits as $visit)
                        <tr class="text-center even:bg-color-f7f7f7">
                            @role('admin')
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-bold text-color-347af2 uppercase">{{$visit->school->code}}</td>
                            @endrole
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-bold text-sm">{{$visit->course->name}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize">{{$visit->customer->lastName}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c capitalize">{{$visit->customer->name}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c capitalize">{{$visit->course->type_visit}}</td>
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
                                @if ($visit->medicalPlanning->booked)
                                    @if (now() > $visit->medicalPlanning->booked)
                                        <p class="font-medium">Eseguita</p>
                                    @else
                                        <div>
                                            <small class="block">Fissata il</small>
                                            <span class="text-color-17489f text-sm font-medium ">{{date("d/m/Y - H:i", strtotime($visit->medicalPlanning->booked))}}</span>
                                        </div>
                                    @endif
                                @else
                                    <p class="font-medium">Da Fissare</p>
                                @endif
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">
                                @if ($visit->medicalPlanning->protocol)
                                    <div>
                                        <small class="block">N° Protocollo</small>
                                        <span class="text-color-17489f text-sm font-medium ">{{$visit->medicalPlanning->protocol}}</span>
                                    </div>
                                @endif
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">{{$visit->customer->phone_1}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell">{{$visit->customer->phone_2}}</td>
                            <td class="px-3 py-4 text-color-2c2c2c hidden xl:table-cell">
                                @if ($visit->medicalPlanning->expiration)
                                    {{date("d/m/Y", strtotime($visit->medicalPlanning->expiration))}}                                    
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun record trovato...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
