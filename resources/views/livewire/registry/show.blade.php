<div class="w-full h-full py-10 px-8 2xl:px-14">

    <div class="flex items-center gap-5">
        <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group">
            <x-icons name="back" class="transition-all duration-300 group-hover:-translate-x-1" />
        </div>
        <h1 class="text-5xl font-bold text-color-17489f capitalize">{{$customerForm->name}}</h1>
    </div>

    <div class="mt-10 p-4 w-full shadow-shadow-card bg-color-f7f7f7">
        <div class="flex items-center gap-4">
            <x-fake-input width="w-48" label="Codice autoscuola" uppercase="">{{$customerForm->customer->school->code}}</x-fake-input>
            <x-fake-input width="w-fit" label="Sede" uppercase="">{{$customerForm->customer->school->address}}</x-fake-input>
            <x-fake-input width="w-48" label="Data acquisizione" uppercase="">{{date("d/m/Y", strtotime($customerForm->customer->created_at))}}</x-fake-input>
        </div>
        <x-input-text wire:model="customerForm.lastName" width="w-fit" name="customerForm.lastName" label="Cognome" uppercase="capitalize" />
    </div>
</div>
