<div class="w-full h-full py-10 px-8 2xl:px-14">
    <h1 class="text-5xl font-bold text-color-808080 mb-5">Iscritti in:
        <span @class(["text-2xl", 'text-color-'.get_color($training->course->service->name)])>{{$training->$variant->name}}</span>
    </h1>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5 relative">
        @if (count($customers) > 0)
            <small class="absolute right-2 top-2 text-gray-400 font-bold">N° Iscritti: {{count($customers)}}</small>
        @endif
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-color-545454">
                    <th scope="col" class="w-20 text-center px-3 py-3.5 font-semibold">
                        ID
                    </th>
                    <th scope="col" class="text-center py-3.5 px-3 font-light">
                        Cognome
                    </th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light">
                        Nome
                    </th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light hidden xl:table-cell">
                        Telefono
                    </th>
                    <th scope="col" class="text-center px-3 py-3.5 font-light">
                        N° Presenze
                    </th>
                    @role('admin|responsabile sede|segretaria')
                    <th scope="col" class="px-3 py-3.5 font-light">
                        &nbsp;
                    </th>
                    @endrole
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if (count($customers) > 0)
                    @foreach($customers as $customer)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="w-20 border-r-2 border-color-efefef py-4 px-3 text-color-17489f font-semibold">{{$customer->id}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize">{{$customer->lastName}}</td>
                            <td class="border-r-2 border-color-efefef py-4 px-3 text-color-2c2c2c capitalize">{{$customer->name}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-017c67 font-medium">{{$customer->phone_1}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c font-medium">??</td>
                            @role('admin|responsabile sede|segretaria')
                            <td class="px-3 py-4 text-color-2c2c2c">
                                <div class="w-fit m-auto">
                                    <button wire:click="show({{$customer->id}})" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                </div>
                            </td>
                            @endrole
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessuno Iscritto al momento...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
