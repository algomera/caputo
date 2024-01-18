<div class="w-full h-full py-10 px-8 2xl:px-14">
    <h1 class="text-5xl font-bold text-color-17489f capitalize mb-5">Anagrafica</h1>

    <div class="w-full flex items-end justify-between">
        <div class="flex items-center gap-3">
            <span>Cerca per:</span>
            <x-input-text wire:model.live="lastName" width="w-fit" name="lastName" placeholder="Cognome" uppercase="shadow" />
            <x-input-text wire:model.live="name" width="w-fit" name="name" placeholder="Nome" uppercase="shadow" />
            <x-input-text x-mask="999 9999999" wire:model.live="phone" width="w-fit" name="phone" placeholder="Telefono" uppercase="shadow" />
            @role('admin')
            <x-input-text wire:model.live="code" width="w-fit" name="code" placeholder="Codice" uppercase="shadow" />
            @endrole
        </div>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5 relative">
        @if (count($customers) > 0)
            <small class="absolute right-2 top-2 text-gray-400 font-bold">Record trovati: {{count($customers)}}</small>            
        @endif
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    @role('admin')
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Codice
                    </th>
                    @endrole
                    <th scope="col" class="py-3.5 px-3 font-light">
                        Cognome
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Nome
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Data di nascita
                    </th>
                    <th scope="col" class="px-3 py-3.5 font-light">
                        Cronologia
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
                        Utente
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]"> 
                @if ($customers->count() > 0)
                    @foreach($customers as $customer)
                        <tr class="text-center even:bg-color-f7f7f7">
                            @role('admin')
                            <td class="border-r-2 border-color-efefef py-4 px-3 font-bold text-color-347af2 uppercase">{{$customer->school->code}}</td>
                            @endrole
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize">{{$customer->lastName}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c capitalize">{{$customer->name}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3">{{date("d/m/Y", strtotime($customer->date_of_birth))}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">
                                <div class="w-fit m-auto"> 
                                    <button class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                </div>
                            </td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c">{{$customer->phone_1}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c hidden xl:table-cell">{{$customer->phone_2}}</td>
                            <td class="border-r-2 px-3 py-4 text-color-2c2c2c hidden xl:table-cell">
                                <div class="w-fit m-auto">
                                    <button class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="message" class="w-5" />
                                    </button>
                                </div>
                            </td>
                            <td class="px-3 py-4 text-color-2c2c2c hidden xl:table-cell">
                                <div class="w-fit m-auto">
                                    <button wire:click="show({{$customer->id}})" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                </div>
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
 