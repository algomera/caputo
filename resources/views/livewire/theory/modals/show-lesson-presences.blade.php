<div class="px-14 py-8 flex flex-col gap-4 relative">
    <div>
        <h1 class="text-3xl font-bold text-color-17489f capitalize">{{$lessonPlanning->training->course->name}}</h1>
        <h3 class="text-xl font-bold text-color-2c2c2c capitalize">Presenze Lezione: <span class="ml-2 text-lg">{{$lessonPlanning->lesson->subject}}</span></h3>
    </div>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th scope="col" class="px-3 py-3.5 font-light">ID</th>
                    <th colspan="3" class="px-3 py-3.5 font-light text-left">Iscritto</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-left"></th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @foreach($lessonPlanning->training->customers()->get() as $customer)
                    <tr class="text-center even:bg-color-f7f7f7">
                        <td scope="col" class="border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c">{{$customer->id}}</td>
                        <td colspan="3" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">{{$customer->full_name}}</td>
                        <td scope="col" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">
                            <div class="w-full flex items-center justify-center gap-5">
                                <div class="w-full flex items-center justify-center">
                                    <button wire:click="remove({{$customer->id}})" @class(["px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-red-500/40 hover:scale-105 transition-all duration-300", in_array($customer->id, $selected) ? 'border-2' : ''])>
                                        <x-icons name="null_presence" />
                                    </button>
                                </div>
                                <div class="w-full flex items-center justify-center">
                                    <button wire:click="add({{$customer->id}})" @class(["px-4 py-1 text-color-2c2c2c font-medium capitalize rounded-full bg-color-01a53a/30 hover:scale-105 transition-all duration-300", !in_array($customer->id, $selected) ? 'border-2' : ''])>
                                        <x-icons name="check_presence" />
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="w-full flex justify-end relative">
        <x-submit-button wire:click='save' class="ml-auto bg-color-17489f">Salva</x-submit-button>
    </div>
</div>
