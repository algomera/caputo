<div class="p-10 flex flex-col gap-6">
    @if ($action == 'edit')
    <h2 class="text-2xl font-medium text-color-347af2">Modifica Utente</h2>
    @else
    <h2 class="text-2xl font-medium text-color-347af2">Crea Utente</h2>
    @endif

    <p class="text-color-2c2c2c text-xl">
        Inserire i dati per la creazione degli utenti che avranno accesso al portale.
    </p>

    <div class="flex item-center gap-4">
        <x-custom-select wire:model="userForm.role" name="userForm.role" label="Ruolo" width="w-1/4" required="true">
            <option value="">Seleziona ruolo</option>
            @foreach ($roles as $role)
                <option value="{{$role->name}}" class="capitalize">{{$role->name}}</option>
            @endforeach
        </x-custom-select>
        <x-input-text wire:model="userForm.name" width="w-1/4" name="userForm.name" label="Nome" required="true" />
        <x-input-text wire:model="userForm.lastName" width="w-1/4" name="userForm.lastName" label="Cognome" />
        <x-input-text wire:model="userForm.email" type="email" width="w-1/4" name="userForm.email" label="Email" required="true" />
    </div>

    <div class="ml-auto">
        <x-submit-button wire:click='next' class="bg-color-347af2">Salva</x-submit-button>
    </div>
</div>
