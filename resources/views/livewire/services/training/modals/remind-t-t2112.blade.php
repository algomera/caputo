<div class="py-14 flex flex-col gap-5 items-center justify-center">
    <x-icons name="alert" />

    <h1 class="text-3xl">Attenzione</h1>
    <p>Richiedere il <span class="font-bold">TT2112</span> prima di proseguire</p>

    <x-submit-button
        wire:click="$dispatch('openModal', { component: 'services.training.modals.get-fiscal-code'})"
        @class(['bg-color-'.get_color(session('serviceName'))])
        >Prosegui
    </x-submit-button>
</div>
