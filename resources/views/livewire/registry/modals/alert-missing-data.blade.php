<div class="px-14 py-8 flex flex-col gap-4">
    <x-icons wire:click="$dispatch('closeModal')" name="x_close" class="absolute top-5 right-5 w-8 text-gray-400 cursor-pointer hover:text-color-2c2c2c transition-all duration-200" />

    <x-icons name="alert" class="scale-150 mx-auto"/>
    <h1 class="text-5xl text-color-2c2c2c font-semibold uppercase text-center my-5">
        Dati mancanti
    </h1>

    <div x-data="{registration: null}" class="w-full h-[calc(100vh-400px)] overflow-auto no-scrollbar">
        <table class="min-w-full divide-y divide-gray-200 border-b">
            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($alertRegistrations as $registration)
                    <tr class="py-2">
                        <td class="whitespace-nowrap font-bold text-2xl uppercase {{'text-color-'. get_color($registration->course->service->name)}}">
                            @if ($registration->training->courseVariant)
                                {{$registration->training->courseVariant->name}}
                            @else
                                {{$registration->training->course->name}}
                            @endif
                        </td>
                        <td class="whitespace-nowrap text-color-2c2c2c">
                            <div x-show="registration != {{ $registration->id }}" x-on:click="registration = {{ $registration->id }}" class="flex items-center justify-end gap-2 cursor-pointer">
                                <span>Mostra</span>
                                <div>
                                    <x-icons name="chevron_down" />
                                </div>
                            </div>
                            <div x-show="registration == {{ $registration->id }}" x-on:click="registration = null" class="flex items-center justify-end gap-2 cursor-pointer">
                                <span>Nascondi</span>
                                <div>
                                    <x-icons name="chevron_down" class="rotate-180" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr x-show="registration == {{ $registration->id }}" class="duration-300 shadow-inner transition-all relative">
                        <td colspan="6">
                            <div>
                                <table class="min-w-full">
                                    <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                                        @foreach($registration->getStepSkipped() as $step)
                                            <tr class="text-center even:bg-color-f7f7f7">
                                                <td class="text-left font-medium px-3 py-4 text-color-2c2c2c">{{$step->name}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
