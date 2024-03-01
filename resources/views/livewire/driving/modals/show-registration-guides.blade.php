<div class="px-14 py-8 flex flex-col gap-4">
    <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer w-fit">
        <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
        <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
    </div>

    <div class="flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-bold text-color-17489f">{{$registration->customer->full_name}}</h1>
            <h3 class="text-lg text-color-545454 font-medium">{{$registration->course->name}}</h3>
        </div>
        <button wire:click="$dispatch('openModal', { component: 'driving.modals.add-guide', arguments: { registration: {{$registration->id}} }})" class="w-fit px-6 py-2 bg-color-01a53a/50 text-white rounded-md font-medium">Aggiungi Guida</button>
    </div>


    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card relative">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="w-20 py-3.5 px-3 font-light text-center">Numero</th>
                    <th scope="col" class="py-3.5 px-3 font-light text-center">Data</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Istruttore</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Targa</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Tipo guida</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center hidden xl:table-cell">Note</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Pagamento</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-center">Stato</th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[340px] 2xl:!max-h-[500px]">
                @if (count($guides) > 0)
                    @foreach($guides as $key => $guide)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="w-20 border-r-2 border-color-efefef py-4 px-3 text-color-17489f capitalize font-semibold text-center">{{$key+1}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c uppercase text-center">
                                <div class="flex flex-col items-center justify-center gap-1">
                                    <span>{{date("d/m/Y", strtotime($guide->begins))}}</span>
                                    <span class="text-color-01a53a">{{date("H:i", strtotime($guide->begins))}}</span>
                                </div>
                            </td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c text-center">{{$guide->instructor->full_name}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-347af2 text-center">{{$guide->vehicle->plate}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-center capitalize">
                                <div class="flex items-center justify-center gap-2 text-sm">
                                    <x-icons name="{{get_guide($guide->type)}}" />
                                    {{$guide->type}}
                                </div>
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell">
                                <div class="w-fit m-auto">
                                    @if ($guide->note)
                                        <button wire:click="$dispatch('openModal', { component: 'driving.modals.show-note-guide', arguments: { guide: {{ $guide->id }} }})" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                            <x-icons name="show" class="w-5" />
                                        </button>
                                    @else
                                        Nessuna
                                    @endif
                                </div>
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-017c67 text-center">
                                <div class="w-fit m-auto">
                                    @if ($guide->welded)
                                        <span class="px-5 pt-1 text-sm font-medium text-white rounded-full bg-color-01a53a/50">Saldato</span>
                                    @else
                                        @role('admin|responsabile sede|segretaria')
                                        <span wire:click="$dispatch('openModal', { component: 'driving.modals.payment-guide', arguments: { guide: {{ $guide->id }} }})" class="px-3 font-medium hover:underline cursor-pointer">Paga</span>
                                        @elserole('istruttore')
                                        <span class="px-3 font-medium text-red-500/70">Da Saldare</span>
                                        @endrole
                                    @endif
                                </div>
                            </td>
                            <td class="px-3 py-4 text-white text-sm text-center">
                                <div class="w-fit m-auto">
                                    @if ($guide->performed == 'Da svolgere')
                                        <button wire:click="performed({{ $guide->id }})" wire:confirm="Confermi lo svolgimento della guida?" class="bg-color-347af2/50 flex items-center justify-center px-5 py-2 rounded-full">
                                            {{$guide->performed}}
                                        </button>
                                        @else
                                        <div class="bg-color-01a53a/50 flex items-center justify-center px-5 py-2 rounded-full">
                                            {{$guide->performed}}
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun Guida trovata...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
