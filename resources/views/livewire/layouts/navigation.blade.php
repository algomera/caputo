<nav x-data="{ open: false }" class="bg-white shadow-md z-10 fixed top-0 w-screen">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:flex items-center">
                    @role('admin|responsabile sede|segretaria')
                    <x-nav-link :href="route('service')" :active="request()->routeIs('service*')">
                        Servizi
                    </x-nav-link>
                    @endrole
                    @role('admin|responsabile sede|segretaria')
                    <x-nav-link :href="route('registry.index')" :active="request()->routeIs('registry*')">
                        Anagrafica
                    </x-nav-link>
                    @endrole

                    @role('admin|responsabile sede|segretaria')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('')">
                        Registro iscritti
                    </x-nav-link>
                    @endrole

                    @role('admin|responsabile sede|segretaria|medico')
                    <x-nav-link :href="route('visits.index')" :active="request()->routeIs('visits*')">
                        Visite mediche
                    </x-nav-link>
                    @endrole

                    @role('admin|responsabile sede|segretaria|istruttore')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('')">
                        Gestione Guide
                    </x-nav-link>
                    @endrole

                    @role('admin|responsabile sede|segretaria|insegnante')
                    <x-nav-link :href="route('theory.trainings.index')" :active="request()->routeIs('theory*')">
                        Gestione Corsi
                    </x-nav-link>
                    @endrole

                    {{-- @role('admin|responsabile sede|segretaria|insegnante')
                    <x-custom-dropdown title="Gestione teoria" icon="chevron_down" :options="$theory" :active="request()->routeIs('theory*')"/>
                    @endrole --}}
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="relative flex items-center">

                <div class="flex items-center gap-6">
                    <x-icon-dropdown icon="notify" :contents="[]"/>

                    <div class="flex items-center gap-2">
                        <div class="w-12 h-12 rounded-full bg-color-efefef border overflow-hidden flex items-center justify-center shadow-inner">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/'. Auth::user()->image) }}" class="w-full" alt="">
                            @endif
                        </div>

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center py-2 border border-transparent text-base leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div class="flex flex-col gap-1">
                                        <span>{{ Auth::user()->name }}</span>
                                        <small class="whitespace-nowrap text-color-808080 font-semibold capitalize">{{auth()->user()->role->name}}</small>
                                    </div>
                                    <x-icons name="chevron_down" class="text-color-2c2c2c ml-2" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    Profilo
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        Esci
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
