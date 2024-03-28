<div class="px-14 py-8 flex flex-col gap-4">
    <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer ">
        <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
        <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
    </div>

    <div wire:dirty class="absolute top-10 right-14 text-red-500/70 font-medium">Modifiche non salvate...</div>

    <div class="flex gap-4 min-w-min ">
        <div class="grow">
            <h1 class="text-3xl font-bold text-color-17489f capitalize">Pagamento del
                <span class="ml-2 text-lg font-medium">{{date("d/m/Y H:i", strtotime($payment->updated_at))}}</span>
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

            <div class="grow relative flex justify-start">
                <x-input-files wire:model="newScan" text="Carica File" color="347af2" name="newScan"  preview="scans_uploaded" icon="upload" />
                @if ($newScan)
                    <small class="absolute -bottom-5 left-0 text-color-017c67 font-medium">{{$newScan->getClientOriginalName()}}</small>
                @endif
            </div>

            <textarea wire:model="note" name="note" id="" cols="30" rows="5" placeholder="Note..." class="w-full border-color-dfdfdf rounded-md mt-5"></textarea>
        </div>

        @if ($document)
            <div class="w-1/2 border">
                @if ($document->path)
                    <iframe src="{{ asset($document->path) }}" width="100%" height="100%" frameborder="0"></iframe>
                @endif
            </div>
        @endif
    </div>

    <div class="flex items-center justify-between">
        <x-submit-button wire:click='delete' wire:confirm="SEI SICURO DI VOLERE ELIMINARE QUESTO PAGAMENTO?" class="bg-red-500/70 ">Elimina</x-submit-button>
        <x-submit-button wire:click='update' class="bg-color-347af2">Salva</x-submit-button>
    </div>
</div>
