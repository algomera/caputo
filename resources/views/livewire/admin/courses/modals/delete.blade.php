<div class="p-8 flex flex-col">
    <h1 class="text-2xl font-semibold text-color-e9863e">Elimina corso</h1>
    <h2 class="text-lg my-5">
        Sei sicuro di volere eliminare il corso
        <span class="text-gray-800 font-bold">
            {{$course->name}} ?
        </span>
        <div>
            <small class="text-gray-400 font-light">La cancelllazione riguarda anche tutti i dati ad essa legati!</small>
        </div>
    </h2>
    <div class="w-fit ml-auto space-x-5">
        <button wire:click="$dispatch('closeModal')" class="py-2 px-6 bg-color-dfdfdf border border-gray-200 text-gray-600 rounded hover:bg-gray-200 active:bg-gray-200 disabled:opacity-50 shadow-md">
            Annulla
        </button>
        <button wire:click="delete" type="button" class="focus:border-transparent focus:ring-0 py-2 px-6 bg-color-e9863e text-white border border-gray-200 rounded hover:bg-color-e9863e/80 active:bg-gray-200 disabled:opacity-50 shadow-md">
            Elimina
        </button>
    </div>
</div>
