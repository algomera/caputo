<div class="h-full bg-white shadow-md rounded-sm p-5">
    <div class="flex flex-col gap-4 border-b pb-5">
        <h1 class=" text-2xl font-medium text-color-347af2 ">Creare la filiale dell’autoscuola</h1>
        <p class="text-xl text-color-2c2c2c ">Inserire i dati per la creazione delle filiali dell’autoscuola, sarà possibile aggiungere un’altra filiale, o modificare quelle esistenti.</p>
    </div>

    <div class="flex flex-col gap-5 items-start pt-5 h-[calc(100vh-313px)] overflow-y-auto no-scrollbar">
        <button wire:click="$dispatch('openModal', { component: 'admin.schools.create-or-update', arguments: {school: null, action: 'create'} })" class="px-4 py-2 bg-color-c9defa rounded-md shadow-md text-lg text-color-2c2c2c">+ Aggiungi Autoscuola</button>

        <div class="min-w-full p-5 border shadow">
            <table x-data="{open: null}" class="min-w-full divide-y divide-gray-200 border-b">
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="py-3.5 pl-4 pr-3 font-light text-color-545454 sm:pl-6">
                            Codice Autoscuola
                        </th>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left font-light text-color-545454 sm:pl-6 max-w-[200px] 2xl:max-w-none">
                            Indirizzo
                        </th>
                        <th scope="col" class="px-3 py-3.5 font-light text-color-545454">
                            Cap
                        </th>
                        <th scope="col" class="px-3 py-3.5 font-light text-color-545454">
                            Città
                        </th>
                        <th scope="col" class="px-3 py-3.5 font-light text-color-545454">
                            Azioni
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left font-light text-color-545454">&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @if ($schools->count() > 0)
                        @foreach($schools as $school)
                            <tr class="text-center">
                                <td class="border-r whitespace-nowrap py-4 pl-4 pr-3 font-bold text-color-347af2 sm:pl-6 uppercase">{{$school->code}}</td>
                                <td class="border-r whitespace-nowrap text-left py-4 pl-4 pr-3 font-light text-color-2c2c2c sm:pl-6 capitalize max-w-[200px] 2xl:max-w-none truncate">{{$school->address}}</td>
                                <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c capitalize">{{$school->postcode}}</td>
                                <td class="border-r whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c">{{$school->city}}</td>
                                <td class="whitespace-nowrap px-3 py-4 font-light text-color-2c2c2c">
                                    <div class="flex items-center justify-center gap-3">
                                        <x-icons name="b-edit"
                                            class="cursor-pointer"
                                            wire:click="$dispatch('openModal', { component: 'admin.schools.create-or-update', arguments: {school: {{ $school->id }}, action: 'edit'} })"
                                        />
                                        <x-icons name="b-delete"
                                            class="cursor-pointer"
                                            wire:click="$dispatch('openModal', { component: 'admin.schools.delete', arguments: {school: {{ $school->id }}} })"
                                        />
                                        {{-- <x-icons name="b-delete"
                                            class="cursor-pointer"
                                            wire:click='delete({{$school->id}})' wire:confirm.prompt="Sei sicuro di volere eliminare questa autoscuola?\n\nScrivi ELIMINA per confermare|elimina"
                                        /> --}}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm font-light text-color-2c2c2c">
                                    <div x-show="open != {{ $school->id }}" x-on:click="open = {{ $school->id }}" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                        <span>Gestione utenti</span>
                                        <div>
                                            <x-icons name="chevron_down" />
                                        </div>
                                    </div>
                                    <div x-show="open == {{ $school->id }}" x-on:click="open = null" class="flex items-center justify-end gap-2 px-5 cursor-pointer">
                                        <span>Gestione utenti</span>
                                        <div>
                                            <x-icons name="chevron_down" class="rotate-180" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr x-show="open == {{ $school->id }}" class="bg-gradient-to-b from-white to-gray-50 duration-300 shadow-inner transition-all">
                                <td colspan="6" class="px-8 py-5">
                                    <button class="px-4 py-2 bg-color-c9defa rounded-md shadow-md text-lg text-color-2c2c2c"
                                        wire:click="$dispatch('openModal', { component: 'admin.schools.users.create-or-update', arguments: {user: null, school: {{$school->id}}, action: 'store'} })"
                                    >+ Aggiungi utente</button>

                                    @if ($school->users()->get()->count() > 0)
                                        <div class="flex flex-wrap gap-x-8 gap-y-4 mt-5">
                                            @foreach ($school->users()->get() as $user)
                                                <div class="relative border p-3 pr-10 shadow bg-white">
                                                    <x-icons name="b-edit" class="absolute top-3 right-3"
                                                        wire:click="$dispatch('openModal', { component: 'admin.schools.users.create-or-update', arguments: {user: {{ $user->id }}, school: {{$school->id}}, action: 'edit'} })"
                                                    />
                                                    <x-icons name="delete" class="absolute top-10 right-3"
                                                        wire:click="$dispatch('openModal', { component: 'admin.schools.users.delete', arguments: {user: {{ $user->id }}} })"
                                                    />
                                                    <p class="capitalize font-medium text-color-545454 mb-2">{{$user->name}} {{$user->lastName}}</p>
                                                    <p class="capitalize font-light text-color-545454">{{$user->role->name}}</p>
                                                    <p class="font-light text-color-545454">{{$user->email}}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-2xl font-semibold text-gray-400 uppercase text-center">Clicca sul pulsante per registrare utenti in questa autoscuola.</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-gray-400 font-bold text-lg py-5 underline">Nessusa Scuola Regitrata al momento...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
