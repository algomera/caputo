<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Hai dimenticato la password? Nessun problema. Comunicaci semplicemente il tuo indirizzo e-mail e ti invieremo via e-mail un collegamento per reimpostare la password che ti consentirà di sceglierne una nuova.    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="link" method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button form="link">
                Invia link
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
