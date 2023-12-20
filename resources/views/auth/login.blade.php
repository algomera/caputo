<x-guest-layout>
    <div class="flex flex-col items-center justify-center gap-10">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h1 class="text-center text-5xl font-bold text-color-347af2 mb-10">Accedi</h1>

        <form id="login" method="POST" action="{{ route('login') }}" class="w-full">
            @csrf

            <!-- Email Address -->
            <div>
                <x-text-input placeholder="Email" id="email" class="block mt-1 w-full p-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-text-input placeholder="Password" id="password" class="block mt-1 w-full p-3"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            {{-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}
        </form>

        <x-primary-button form="login" class="ms-3 bg-color-347af2 w-44 justify-center !text-2xl">
            Accedi
        </x-primary-button>

        @if (Route::has('password.request'))
            <a class="underline text-base font-light text-color-347af2 hover:text-gray-900 rounded-md" href="{{ route('password.request') }}">
                Password dimenticata?
            </a>
        @endif
    </div>
</x-guest-layout>
