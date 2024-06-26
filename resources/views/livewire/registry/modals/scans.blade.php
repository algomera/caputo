<div class="px-14 py-8 flex flex-col">

    <div class="flex items-end justify-between">
        <h1 class="text-5xl font-bold text-color-17489f capitalize">Scansioni
            <span class="text-2xl">{{$courseName}}</span>
        </h1>

        <div class="flex items-center gap-4">
            <x-input-files wire:model="newScan" text="Carica Scansione" color="7a95db" name="scans"  preview="scans_uploaded" icon="upload" />
        </div>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card mt-5">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th scope="col" class="py-3.5 px-3 font-light">Data inserimento</th>
                    <th colspan="5" scope="col" class="px-3 py-3.5 font-light text-left">Contenuto</th>
                    <th scope="col" class="px-3 py-3.5 font-light">Apri</th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @if ($scans->count() > 0)
                    @foreach($scans as $scan)
                        <tr class="text-center even:bg-color-f7f7f7">
                            <td class="border-r-2 border-color-efefef py-4 px-3  text-sm">{{date("d/m/Y H:i", strtotime($scan->updated_at))}}</td>
                            <td colspan="5" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">{{$scan->type}}</td>
                            <td class="border-r-2 border-color-efefef px-3 py-4 text-color-2c2c2c capitalize">
                                <div class="w-fit flex items-center gap-5 m-auto">
                                    <button wire:click="$dispatch('openModal', { component: 'registry.modals.showScan', arguments: {scan: {{$scan->id}}} })" class="bg-color-347af2/30 flex items-center justify-center px-3 py-2 rounded-full">
                                        <x-icons name="show" class="w-5" />
                                    </button>
                                    @role('admin|responsabile sede')
                                        @if (!$scan->step_id)
                                            <button wire:click="$dispatch('openModal', { component: 'registry.modals.delete-scan', arguments: {scan: {{$scan->id}}} })" class="flex items-center justify-center">
                                                <x-icons name="delete" class="h-5 w-5" />
                                            </button>
                                        @endif
                                    @endrole
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessuna scansione trovata...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
