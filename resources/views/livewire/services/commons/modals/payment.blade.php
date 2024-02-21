<div class="px-16 py-8">
    <div class="w-full flex gap-4 mb-5">
        <div class="w-full flex flex-wrap gap-8">
            <div class="space-y-5">
                <div class="flex items-end gap-5">
                    <h1 class="text-2xl 2xl:text-3xl text-color-2c2c2c font-semibold">Pagamento Iscrizione</h1>
                    <span wire:click="skip" class="text-color-2c2c2c underline cursor-pointer">Salta questa procedura</span>
                </div>

                <p class="text-lg 2xl:text-xl text-color-2c2c2c">Scegliere il metodo di pagamento e inserire l'importo.</p>

                <p @class(["text-xl", 'text-color-'.get_color($registration->course->service->name)])>Totale da pagare:
                    <span class="font-semibold">€ {{(double)$registration->price - (double)$amount}}</span>
                </p>
            </div>

            <div class="w-full flex flex-wrap gap-5 justify-between">
                @foreach ($paymentTypes as $paymentType)
                    <div wire:click="$set('paymentSelected', '{{$paymentType['name']}}')"
                        @class(["w-[calc(50%-32px)] h-fit px-6 2xl:px-8 whitespace-nowrap py-4 rounded-md flex flex-col gap-4 items-center justify-between cursor-pointer border-2 hover:scale-105 transition-all duration-300",
                        'bg-color-'. get_color($registration->course->service->name).'/30',
                        'border-color-'. get_color($registration->course->service->name).'/30',
                        $paymentSelected == $paymentType['name'] ? '!border-green-500/50' : ''])
                    >
                        <x-icons name="{{$paymentType['icon']}}" class="{{'text-color-'. get_color($registration->course->service->name).'/30'}}" />
                        <span @class(["text-xl", 'text-color-'.get_color($registration->course->service->name)])>{{$paymentType['name']}}</span>
                    </div>
                @endforeach
            </div>

            <div class="w-full space-y-5">
                <div class="flex items-end gap-10">
                    <x-input-text x-mask:dynamic="$money($input, '.', ' ')" wire:model.live="amount" width="w-fit" name="amount" placeholder="0.00" label="Importo €" />
                    <div class="grow relative flex justify-start">
                        <x-input-files wire:model="newScan" text="Carica File" color="347af2" name="newScan"  preview="scans_uploaded" icon="upload" />
                        @if ($newScan)
                            <small class="absolute -bottom-5 left-0 text-color-017c67 font-medium">{{$newScan->getClientOriginalName()}}</small>
                        @endif
                    </div>
                </div>
                <textarea wire:model="note" name="note" id="" cols="30" rows="4" placeholder="Note..." class="w-full border-color-dfdfdf rounded-md"></textarea>
            </div>
        </div>

        {{-- <div class="grow border shadow">
            @if ($newScan)
                <iframe src="{{ $newScan->temporaryUrl() }}" width="100%" height="662px" frameborder="0"></iframe>
            @endif
        </div> --}}
    </div>

    <div class="w-full flex justify-end relative">
        <x-submit-button wire:click="create" @class(["ml-auto", 'bg-color-'.get_color($registration->course->service->name) ])>Inserisci</x-submit-button>

        <div class="absolute bottom-[-20px] right-0">
            @error('paymentSelected') <span class="text-[12px] text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
