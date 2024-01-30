<div class="px-14 py-8 flex flex-col gap-4">
    <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer ">
        <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
        <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
    </div>

    <div class="flex gap-4 min-w-min ">
        <div>
            <h1 class="text-3xl font-bold text-color-17489f capitalize">Pagamento
                {{-- <span class="ml-2 text-xl underline">{{date("d/m/Y H:i", strtotime($drivingPlanning->begins))}}</span> --}}
            </h1>
            <div class="flex items-center gap-3 mb-10 mt-5">
                <x-custom-select wire:model="type" name="type" label="metodo di pagamento" width="grow" >
                    <option value="">Seleziona</option>
                    <option value="contanti" class="capitalize">contanti</option>
                    <option value="carta" class="capitalize">carta</option>
                    <option value="bonifico" class="capitalize">bonifico</option>
                    <option value="ricarica postePay" class="capitalize">ricarica postePay</option>
                </x-custom-select>
                <x-input-text x-mask:dynamic="$money($input, '.', ' ')" wire:model="amount" width="w-1/3" name="amount" placeholder="0.00" label="Importo €" />
            </div>
            <x-input-files wire:model="newScan" text="Carica File" color="347af2" name="newScan"  preview="scans_uploaded" icon="upload" />
            <textarea wire:model="note" name="note" id="" cols="30" rows="5" placeholder="Note..." class="w-full border-color-dfdfdf rounded-md mt-5"></textarea>
        </div>
        @if ($newScan)
            <div class="w-1/2 border">
                <embed class="h-full w-full" src="{{ $newScan->temporaryUrl() }}" alt="">
            </div>
        @elseif ($document)
            <div class="w-1/2 border">
                <embed class="h-full w-full" src="{{ Vite::asset($document->path) }}" alt="">
            </div>
        @else
            <div class="w-1/2 border flex items-center justify-center">
                <x-icons name="default_photo" class="w-14 h-14" />
            </div>
        @endif
    </div>

    <div class="flex items-center justify-between">
        <x-submit-button wire:click='delete' wire:confirm="SEI SICURO DI VOLERE ELIMINARE QUESTO PAGAMENTO?" class="bg-red-500/70 ">Elimina</x-submit-button>
        <x-submit-button wire:click='update' class="bg-color-347af2">Salva</x-submit-button>
    </div>
</div>