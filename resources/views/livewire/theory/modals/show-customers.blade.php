<div class="w-full h-full py-10 px-8 2xl:px-14">
    <h1 class="text-5xl font-bold text-color-808080 mb-5">Iscritti in:
        <span @class(["text-2xl", 'text-color-'.get_color($training->course->service->name)])>{{$training->$variant->name}}</span>
    </h1>

    <div class="w-full flex flex-col-reverse items-start 2xl:flex-row 2xl:items-end gap-4 justify-between">
        <div class="flex items-center gap-3">
            <span>Cerca per:</span>
            <x-input-text wire:model.live="lastName" width="w-fit" name="lastName" placeholder="Cognome" uppercase="shadow" />
            <x-input-text wire:model.live="name" width="w-fit" name="name" placeholder="Nome" uppercase="shadow" />
        </div>

        <div class="w-fit flex items-center gap-5 p-2 pt-3 bg-color-f7f7f7 border rounded-md shadow">
            <small wire:click="changeCustomers('allCustomers')" @class(["text-color-347af2 font-bold cursor-pointer hover:underline", $customersShow == 'allCustomers' ? 'underline' : ''])>Totale iscritti: {{count($allCustomers)}}</small>
            <small wire:click="changeCustomers('currentCustomers')" @class(["text-color-017c67 font-bold cursor-pointer hover:underline" , $customersShow == 'currentCustomers' ? 'underline' : ''])>Iscrizioni aperte: {{count($currentCustomers)}}</small>
            <small wire:click="changeCustomers('oldCustomers')" @class(["text-color-808080 font-bold cursor-pointer hover:underline", $customersShow == 'oldCustomers' ? 'underline' : ''])>Iscrizioni chiuse: {{count($oldCustomers)}}</small>
        </div>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="w-20 text-center px-3 py-3.5 font-semibold">ID</th>
                    <th scope="col" class="text-center py-3.5 px-3 font-light">Cognome</th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light">Nome</th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light">Telefono</th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light">N° Presenze</th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light">Stato</th>
                    @role('admin|responsabile sede|segretaria')
                    <th scope="col" class="px-3 py-3.5 font-light">&nbsp;</th>
                    @endrole
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if (count($customerFilter) > 0)
                    @foreach($customerFilter as $customer)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="w-20 border-r-2 border-color-efefef py-4 px-3 text-color-17489f font-semibold">{{$customer->id}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize">{{$customer->lastName}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize">{{$customer->name}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-017c67 font-medium">{{$customer->phone_1}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-347af2 font-medium">{{$training->customerPresence($customer->id)}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c font-medium capitalize">
                                <div class="flex flex-col items-center justify-center">
                                    {{$customer->registrations()->where('training_id', $training->id)->first()->state}}
                                    @if (count(json_decode($training->customerMissingData($customer->id))))
                                        <span title="Mandare in accettazione" class="px-3 text-sm font-medium text-red-500 underline cursor-default">Dati Mancanti!</span>
                                    @endif
                                </div>
                            </td>
                            @role('admin|responsabile sede|segretaria')
                            <td class="px-3 py-4 text-color-2c2c2c">
                                <div class="flex items-center justify-center gap-4">
                                    <button wire:click="show({{$customer->id}})" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                    <button wire:click="presences({{$customer->id}})" class="bg-color-c9defa flex items-center justify-center px-3 rounded-full">
                                        <x-icons name="presence" class="w-5" />
                                    </button>
                                </div>
                            </td>
                            @endrole
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessuno Risultato trovato...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
