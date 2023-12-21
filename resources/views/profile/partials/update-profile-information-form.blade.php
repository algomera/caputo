<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informazioni Profilo
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Aggiorna le informazioni del profilo e l'indirizzo email del tuo account.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <p class="font-extrabold uppercase text-xs text-gray-400 tracking-[.75px]">Imagine profilo</p>
            <div class="h-[125px] w-[125px] mb-[10px] border flex items-center justify-center overflow-hidden bg-color-efefef shadow-inner">
                <img id="load" src="{{ Vite::asset('storage/app/public/'. Auth::user()->image) }}" alt="">
            </div>
            <div class="flex gap-5 relative">
                <label for="image" class="w-[125px] bg-color-347af2/80 hover:bg-color-347af2 h-[36px] py-2 px-6 text-white text-[12px] font-bold uppercase cursor-pointer">
                    CARICA FILE
                </label>
                <input id="image" type="file" name="image" onchange="preview()" :value="old('image')" class="block mt-1 w-full opacity-0 z-[-1] absolute" />
                <span id="nameFile" class="block mt-1"></span>
            </div>
            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
        </div>


        <div>
            <x-input-label for="name" value="Nome" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button form="profile">Salva</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Profilo Aggiornato</p>
            @endif
        </div>
    </form>
</section>

@push('scripts')
    <script>
        function preview() {
            load.src = URL.createObjectURL(event.target.files[0]);
            var file = document.getElementById("image").value;
            if (file) {
                document.querySelector("#nameFile").innerHTML = '';
                document.querySelector("#nameFile").innerHTML = file;
            }
        }
    </script>
@endpush
