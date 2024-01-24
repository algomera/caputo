<div class="p-5 flex flex-col gap-5 items-center justify-center">
    <h1 class="text-5xl font-bold text-color-347af2/50">{{$scan->type}}</h1>

    @if (!str_contains($scan->type,'firma'))
    <object data="{{ Vite::asset($scan->path) }}" type="application/pdf" width="100%" height="600px"></object>
    @else
    <object data="{{ Vite::asset($scan->path) }}" type="application/pdf" width="100%" height="300px"></object>
    @endif

    <div class="w-full flex justify-between">
        <x-submit-button wire:click="$dispatch('closeModal')" class="bg-slate-400">Indietro</x-submit-button>
        @if (!str_contains($scan->type,'firma'))
        <x-submit-button wire:click='update' class="bg-color-347af2/50">Aggiorna</x-submit-button>
        @endif
    </div>
</div>
