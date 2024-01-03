<div class="p-10 min-h-[calc(100vh-96px)]">
    <div class="h-full bg-color-f7f7f7 shadow-md rounded-sm p-5">
        <div class="flex flex-col items-stretch gap-4 border-b pb-5">
            <h1 class=" text-2xl font-medium text-color-347af2 ">Carica i propri veicoli</h1>
            <p class="text-xl text-color-2c2c2c ">Inserire i dati per la creazione dei veicoli presenti nelle autoscuole</p>
        </div>

        <button wire:click="$dispatch('openModal', { component: 'admin.vehicle.modals.create-or-update', arguments: {vehicle: null, action: 'create'} })" class="px-4 py-2 my-10 bg-color-c9defa rounded-md shadow-md text-lg text-color-2c2c2c">+ Aggiungi veicolo</button>

        <div class="w-full max-h-[calc(100vh-440px)] bg-color-fbfbfb p-5 border shadow overflow-auto no-scrollbar">
            <table x-data="{open: null}" class="min-w-full divide-y divide-gray-200 border-b">
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="w-[200px] px-5 py-2 font-light text-color-545454 sm:pl-6">
                            Tipo Veicolo
                        </th>
                        <th scope="col" class="px-5 py-2 font-light text-color-545454 sm:pl-6 max-w-[200px] 2xl:max-w-none">
                            Modello
                        </th>
                        <th scope="col" class="w-[200px] px-5 py-2 font-light text-color-545454 hidden xl:table-cell">
                            Cambio
                        </th>
                        <th scope="col" class="px-5 py-2 text-left font-light text-color-545454 hidden xl:table-cell">
                            Targa
                        </th>
                        <th colspan="2" class="px-5 pr-8 py-2 font-light text-right text-color-545454">
                            Azioni
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @if ($vehicles->count() > 0)
                        @foreach($vehicles as $vehicle)
                            <tr class="text-center even:bg-color-fbfbfb">
                                <td class="border-r whitespace-nowrap py-2 px-5 font-black text-color-347af2 sm:pl-6">{{$vehicle->type}}</td>
                                <td class="border-r whitespace-nowrap py-2 px-5 font-semibold text-color-2c2c2c sm:pl-6 capitalize max-w-[200px] 2xl:max-w-none truncate">{{$vehicle->model}}</td>
                                <td class="border-r whitespace-nowrap px-5 py-2 font-light text-color-2c2c2c capitalize hidden xl:table-cell">
                                    <div @class(["w-fit m-auto py-0 px-2 rounded-full",$vehicle->transmission == 'Manuale' ? 'bg-color-c1efb6' : 'bg-color-afe8df' ])>
                                        {{$vehicle->transmission}}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap text-left px-5 py-2 font-semibold text-color-2c2c2c hidden xl:table-cell">{{$vehicle->plate}}</td>
                                <td colspan="2" class="whitespace-nowrap px-5 py-2 font-light text-color-2c2c2c">
                                    <div class="w-fit ml-auto flex items-center justify-center gap-3">
                                        <x-icons name="b-edit"
                                            class="cursor-pointer"
                                            wire:click="$dispatch('openModal', { component: 'admin.vehicle.modals.create-or-update', arguments: {vehicle: {{ $vehicle->id }}, action: 'edit'} })"
                                        />
                                        <x-icons name="b-delete"
                                            class="cursor-pointer"
                                            wire:click="$dispatch('openModal', { component: 'admin.vehicle.modals.delete', arguments: {vehicle: {{ $vehicle->id }}} })"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessun veicolo regitrato al momento...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>
</div>
