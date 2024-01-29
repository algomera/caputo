<div class="px-14 py-8 pb-16 flex flex-col gap-4">
    @if ($type && count($this->drivings))
        <div wire:click='$set("type", null)' class="flex items-center gap-2 group cursor-pointer ">
            <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
            <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
        </div>
    @endif


    <div class="w-full flex items-end justify-between ">
        <h1 class="text-5xl font-bold text-color-17489f capitalize">Pagamenti
            <span class="text-2xl">{{$registration->course->name}}</span>
            @if ($type)
                <span class="text-xl">({{$type}})</span>
            @endif
        </h1>
    </div>

    @if (!$type)
        <div class="w-full m-auto flex justify-center items-center gap-5 px-28 mt-10">
            <div wire:click='$set("type", "iscrizione")' class="w-fit px-20 h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg font-semibold uppercase text-color-2c2c2c">Iscrizione</p>
            </div>
            @if ($drivings->count() > 0)
            <div wire:click='$set("type", "guide")' class="w-fit px-20 h-24 flex items-center justify-center border rounded-md shadow-shadow-card hover:scale-105 transition-all duration-300 cursor-pointer">
                <p class="text-lg font-semibold uppercase text-color-2c2c2c">Guide prenotate</p>
            </div>
            @endif
        </div>
    @endif


    @if ($type == 'iscrizione')
        <div class="mt-2 px-2 w-full flex justify-end">
            <button wire:click="$dispatch('openModal', { component: 'registry.modals.add-payment', arguments: {registration: {{$registration->id}}} })" class="ml-auto px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">+ Pagamento</button>
        </div>

        <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card">
            <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
                <thead class="customHead">
                    <tr class="text-center text-color-545454">
                        <th scope="col" class="py-3.5 px-3 font-light">Data/Ora</th>
                        <th colspan="3" scope="col" class="px-3 py-3.5 font-light text-left">Note</th>
                        <th scope="col" class="px-3 py-3.5 font-light">Metodo</th>
                        <th scope="col" class="px-3 py-3.5 font-light">Importo</th>
                        <th scope="col" class="px-3 py-3.5 font-light">Allegato</th>
                        <th scope="col" class="px-3 py-3.5 font-light">&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                    @if ($registrationPayments->count() > 0)
                        @foreach($registrationPayments as $payment)
                            <tr class="text-center even:bg-color-f7f7f7">
                                <td class="border-r-2 border-color-efefef py-4 px-3 text-sm">
                                    <div class="flex items-center justify-center gap-1">
                                        <span>{{date("d/m/Y", strtotime($payment->updated_at))}}</span>-
                                        <span class=" text-color-01a53a">{{date("H:i", strtotime($payment->updated_at))}}</span>
                                    </div>
                                </td>
                                <td colspan="3" class="border-r-2 border-color-efefef py-4 px-3 text-sm text-left">{{$payment->note ?? 'Nessuna'}}</td>
                                <td class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c capitalize">{{$payment->type}}</td>
                                <td class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c capitalize">€ {{$payment->amount}}</td>
                                <td class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c">
                                    <div class="flex items-center justify-center">
                                        @if ($payment->document()->first())
                                            <button wire:click="$dispatch('openModal', { component: 'registry.modals.showScan', arguments: {scan: {{$payment->document()->first()->id}}} })" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                                <x-icons name="show" class="w-5" />
                                            </button>
                                        @else
                                            Nessuno
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <button wire:click="$dispatch('openModal', { component: 'registry.modals.show-payment', arguments: {payment: {{$payment->id}}} })" class="hover:underline cursor-pointer">
                                        Apri
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun pagamento trovato...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @endif

    @if ($type == 'guide')
        <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
            <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
                <thead class="customHead">
                    <tr class="text-center text-color-545454">
                        <th scope="col" class="py-3.5 px-3 font-light">Prenotata il</th>
                        <th colspan="3" scope="col" class="px-3 py-3.5 font-light text-left">Descrizione</th>
                        <th scope="col" class="px-3 py-3.5 font-light">Prezzo</th>
                        <th scope="col" class="px-3 py-3.5 font-light">Stato</th>
                        <th scope="col" class="px-3 py-3.5 font-light"></th>
                    </tr>
                </thead>
                <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                    @if ($drivings->count() > 0)
                        @foreach($drivings as $driving)
                            <tr class="text-center even:bg-color-f7f7f7">
                                <td class="border-r-2 border-color-efefef py-4 px-3 text-sm">
                                    <div class="flex items-center justify-center gap-1">
                                        <span>{{date("d/m/Y", strtotime($driving->updated_at))}}</span>-
                                        <span class=" text-color-01a53a">{{date("H:i", strtotime($driving->updated_at))}}</span>
                                    </div>
                                </td>
                                <td colspan="3" class="border-r-2 border-color-efefef py-4 px-3 text-left text-sm capitalize">Guida: {{$driving->type}}</td>
                                <td class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c">€ {{$drivingPrice}}</td>
                                <td class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c capitalize">
                                    <div class="flex items-center justify-center gap-2 px-5">
                                        @if (!$driving->welded)
                                            <span class="text-red-500/70">Da Saldare</span>
                                        @else
                                            <span class="text-color-01a53a">Saldato</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c capitalize">
                                    @if (!$selectedDriving)
                                        <div wire:click="$set('selectedDriving', {{$driving->id}})" class="flex items-center justify-center gap-2 cursor-pointer">
                                            visiona
                                            <x-icons name="chevron_down" class="h-2" />
                                        </div>
                                    @else
                                        <div  wire:click="$set('selectedDriving', null)" class="flex items-center justify-center gap-2 cursor-pointer">
                                            visiona
                                            <x-icons name="chevron_down" class="rotate-180 h-2" />
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @if ($selectedDriving == $driving->id)
                                <tr class="bg-gradient-to-b from-white to-gray-50 duration-300 shadow-inner transition-all relative">
                                    <td colspan="6">
                                        @if (!$driving->welded)
                                        <div class="mt-2 px-2 w-full flex justify-end">
                                            <button wire:click="$dispatch('openModal', { component: 'registry.modals.add-payment', arguments: {drivingPlanning: {{$driving->id}}} })" class="ml-auto px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300">+ Pagamento</button>
                                        </div>
                                        @endif

                                        <table class="min-w-full divide-y-2 divide-color-efefef">
                                            <thead class="customHead">
                                                <tr class="text-center text-color-545454">
                                                    <th scope="col" class="py-3.5 px-3 font-light">Data</th>
                                                    <th colspan="3" scope="col" class="px-3 py-3.5 font-light text-left">Note</th>
                                                    <th scope="col" class="px-3 py-3.5 font-light">Metodo</th>
                                                    <th scope="col" class="px-3 py-3.5 font-light">Importo</th>
                                                    <th scope="col" class="px-3 py-3.5 font-light">Allegato</th>
                                                    <th scope="col" class="px-3 py-3.5 font-light">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                                                @if (count($driving->payments()->get()) > 0)
                                                    @foreach ($driving->payments()->get() as $payment)
                                                        <tr class="text-center even:bg-color-f7f7f7">
                                                            <td class="border-r-2 border-color-efefef py-4 px-3 text-sm">{{date("d/m/Y H:i", strtotime($payment->created_at))}}</td>
                                                            <td colspan="3" class="border-r-2 border-color-efefef py-4 px-3 text-sm text-left">{{$payment->note ?? 'nessuna'}}</td>
                                                            <td class="border-r-2 border-color-efefef py-4 px-3 text-sm capitalize">{{$payment->type}}</td>
                                                            <td class="border-r-2 border-color-efefef py-4 px-3 text-sm">€ {{$payment->amount}}</td>
                                                            <td class="border-r-2 border-color-efefef py-4 px-3 text-sm">
                                                                <div class="flex items-center justify-center">
                                                                    @if ($payment->document()->first())
                                                                        <button wire:click="$dispatch('openModal', { component: 'registry.modals.showScan', arguments: {scan: {{$payment->document()->first()->id}}} })" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                                                            <x-icons name="show" class="w-5" />
                                                                        </button>
                                                                    @else
                                                                        Nessuno
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button wire:click="$dispatch('openModal', { component: 'registry.modals.show-payment', arguments: {payment: {{$payment->id}}} })" class="hover:underline cursor-pointer">
                                                                    Apri
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun pagamento...</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessuna guida prenotata...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @endif
</div>
