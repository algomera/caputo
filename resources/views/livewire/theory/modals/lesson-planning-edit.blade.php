<div class="px-14 py-8 flex flex-col gap-4">
    <h1 class="text-3xl font-bold text-color-17489f capitalize">{{$lessonPlanning->training->course->name}}:
        <span class="ml-2 text-xl">{{$lessonPlanning->lesson->subject}}</span>
    </h1>

    <x-input-text type="datetime-local" min="{{now()->format('d/m/Y H:i')}}" wire:model="dateTime" width="w-fit" name="dateTime" label="Data/Ora Lezione" />
    <x-submit-button wire:click='edit' class="ml-auto bg-color-347af2">Modifica</x-submit-button>
</div>
