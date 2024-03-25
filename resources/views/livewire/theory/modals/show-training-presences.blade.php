<div class="px-14 py-8 flex flex-col gap-4 relative">

    <div class="w-full flex items-end justify-between">
        <h1 class="text-3xl font-bold text-color-17489f capitalize">Presenze in: {{$training->course->name}}</h1>
        <div class="flex items-center gap-3">
            <span>Cerca per:</span>
            <x-input-text wire:model.live="name" width="w-fit" name="name" placeholder="Nome" uppercase="shadow" />
            <x-input-text wire:model.live="lastName" width="w-fit" name="lastName" placeholder="Cognome" uppercase="shadow" />
        </div>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card">
        <div class="w-full flex">
            <div class="w-1/3">
                <table class="divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
                    <thead class="customHead">
                        <tr class="text-center text-color-545454">
                            <th colspan="4" class="px-3 py-3.5 font-light text-left">Iscritto</th>
                            <th scope="col" class="px-3 py-3.5 font-light">Presenze</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white customBody no-scrollbar !max-h-none">
                        @if (count($customers))
                            @foreach($customers as $customer)
                                <tr class="text-center even:bg-color-f7f7f7">
                                    <td colspan="4" class="border-r-2 border-color-efefef text-left px-3 py-4 text-color-2c2c2c capitalize">
                                        <div class="flex items-center justify-between">
                                            {{$customer->full_name}}
                                            @if (count($training->customerMissingData($customer->id)))
                                                <span title="Mandare in accettazione" class="px-3 pt-1 text-sm font-medium text-red-500 underline cursor-default">Dati Mancanti!</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td scope="col" class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-347af2">{{$training->customerPresence($customer->id)}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun iscritto trovato...</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="w-2/3 overflow-x-auto">
                <table class="divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
                    <thead>
                        <tr class="text-center text-color-545454">
                            @foreach ($lessonPlannings as $lessonPlanning)
                                <th scope="col" class="px-3 py-3.5 font-light">{{date("d/m/Y", strtotime($lessonPlanning->begin))}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white no-scrollbar !max-h-none">
                        @if (count($customers))
                            @foreach($customers as $customer)
                                <tr class="text-center even:bg-color-f7f7f7">
                                    @foreach ($lessonPlannings as $lessonPlanning)
                                        @if (count($lessonPlanning->presences()->where('customer_id', $customer->id)->get()) > 0)
                                            @foreach ($lessonPlanning->presences()->where('customer_id', $customer->id)->get() as $presence )
                                                <td scope="col" class="border-r-2 border-color-efefef text-left font-medium px-3 pt-5 pb-4 text-color-2c2c2c capitalize">
                                                    <div class="w-full flex items-center justify-center gap-4">
                                                        @if ($presence->followed)
                                                            <x-icons name="check_presence" />
                                                        @else
                                                            <x-icons name="null_presence" />
                                                        @endif
                                                    </div>
                                                </td>
                                            @endforeach
                                        @else
                                            <td scope="col" class="border-r-2 border-color-efefef text-left font-medium px-3 pt-5 pb-4 text-color-2c2c2c capitalize"></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{count($training->plannings()->whereNotNull('begin')->get())}}" class="text-center text-gray-400 font-bold text-lg py-[34px] underline"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
