<div class="px-14 py-8 flex flex-col gap-4 relative">
    <div>
        <h1 class="text-3xl font-bold text-color-17489f capitalize">{{$lessonPlanning->training->course->name}}</h1>
        <div class="flex items-center gap-4">
            <h3 class="text-xl font-bold text-color-2c2c2c capitalize">Lezione: <span class="ml-2 text-lg">{{$lessonPlanning->lesson->subject}}</span></h3>
            <small class="text-color-808080 font-semibold">Durata: {{$lessonPlanning->lesson->duration}} Min.</small>
        </div>
    </div>
    <div class="absolute top-8 right-14 flex flex-col items-center font-medium">
        <span class="font-semibold text-xl">{{date("d/m/Y", strtotime($lessonPlanning->begin))}}</span>
        <span class=" text-color-17489f text-lg">{{date("H:i", strtotime($lessonPlanning->begin))}} - {{date("H:i", strtotime($endLesson))}}</span>
    </div>


    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card">
        <table class="min-w-full divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
            <thead class="customHead">
                <tr class="text-center text-color-545454">
                    <th scope="col" class="w-20 px-3 py-3.5 font-light">ID</th>
                    <th colspan="3" class="px-3 py-3.5 font-light text-left">Iscritto</th>
                    <th scope="col" class="px-3 py-3.5 font-light text-left"></th>
                </tr>
            </thead>
            <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                @foreach($lessonPlanning->training->customers()->where('branch_id', 1)->get() as $customer)
                    <tr class="text-center even:bg-color-f7f7f7">
                        <td scope="col" class="w-20 border-r-2 border-color-efefef font-medium px-3 py-4 text-color-2c2c2c">{{$customer->id}}</td>
                        <td colspan="3" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">{{$customer->full_name}}</td>
                        <td scope="col" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">
                            <div class="w-full flex items-center justify-center gap-4">
                                <button wire:click="add({{$customer->id}})" @class(["px-2 py-3 rounded-full border-2 border-transparent", $presences[$customer->id]['followed'] === 1 ? '!border-green-500' : ''])>
                                    <x-icons name="check_presence" />
                                </button>
                                <button wire:click="remove({{$customer->id}})" @class(["p-2 rounded-full border-2 border-transparent", $presences[$customer->id]['followed'] === 0 ? '!border-red-500' : ''])>
                                    <x-icons name="null_presence" />
                                </button>
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
