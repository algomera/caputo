<div class="px-14 py-8 flex flex-col gap-4">
    <div wire:click="$dispatch('closeModal')" class="flex items-center gap-2 group cursor-pointer ">
        <x-icons name="arrow_back" class="group-hover:-translate-x-1 transition-all duration-300" />
        <span class="text-lg text-color-808080 group-hover:underline">Indietro</span>
    </div>

    <h1 class="text-3xl font-bold text-color-17489f capitalize">Pagamento guida del
        <span class="ml-2 text-xl underline">{{date("d/m/Y H:i", strtotime($drivingPlanning->begins))}}</span>
    </h1>

    <div>
        <p>Prezzo: € {{$drivingPrice}}</p>
        <p>Pagato: € {{$drivingPlanning->sumPayments}}</p>
        <p>Da Pagare: € {{$drivingPrice - $drivingPlanning->sumPayments}}</p>
    </div>

    <div class="space-y-7">
        <div class="flex items-end justify-between">
            <div class="flex items-end gap-3">
                <x-custom-select wire:model="type" name="type" label="metodo di pagamento" width="w-fit" >
                    <option value="">Seleziona</option>
                    <option value="contanti" class="capitalize">contanti</option>
                    <option value="carta" class="capitalize">carta</option>
                    <option value="bonifico" class="capitalize">bonifico</option>
                    <option value="ricarica postePay" class="capitalize">ricarica postePay</option>
                </x-custom-select>
                <x-input-text x-mask:dynamic="$money($input, '.', ' ')" wire:model="amount" width="w-fit" name="amount" placeholder="0.00" label="Importo €" />
            </div>
            <div class="grow relative flex justify-end">
                <x-input-files wire:model="newScan" text="Carica File" color="347af2" name="newScan"  preview="scans_uploaded" icon="upload" />
                @if ($newScan)
                    <small class="absolute -bottom-5 right-0 text-color-017c67 font-medium">{{$newScan->getClientOriginalName()}}</small>
                @endif
            </div>
        </div>
        <textarea wire:model="note" name="note" id="" cols="30" rows="4" placeholder="Note..." class="w-full border-color-dfdfdf rounded-md"></textarea>
    </div>

    <x-submit-button wire:click='create' class="ml-auto bg-color-347af2">Inserisci</x-submit-button>
</div>
