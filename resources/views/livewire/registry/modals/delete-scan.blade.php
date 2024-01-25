<div class="p-8 flex flex-col items-center">
    <x-icons name="alert"/>
    <h1 class="text-xl text-gray-400 font-semibold text-center mt-5">
        Sei sicuro di volere eliminare
    </h1>
    <span class="text-xl text-gray-800 font-semibold text-center uppercase mb-5">
        {{$scan->type}} ?
    </span>
    <div class="w-fit m-auto space-x-5">
        <button wire:click="delete" type="button" class="focus:border-transparent focus:ring-0 py-2 px-6 bg-red-500 text-white border border-gray-200 rounded hover:bg-red-500/80 active:bg-gray-200 disabled:opacity-50">
            Elimina
        </button>
        <button wire:click="$dispatch('closeModal')" class="py-2 px-6 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-200 active:bg-gray-200 disabled:opacity-50">
            Annulla
        </button>
    </div>
</div>
