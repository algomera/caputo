<div class="px-14 py-8 flex flex-col gap-4 relative">
    <h1 class="text-3xl font-bold text-color-17489f capitalize">{{$training->course->name}}</h1>

    <div class="p-11 pt-5 bg-color-f7f7f7 shadow-shadow-card">
        <div class="w-full flex">
            <div class="w-1/3 2xl:w-1/2">
                <table class="divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
                    <thead class="customHead">
                        <tr class="text-center text-color-545454">
                            <th scope="col" class="px-3 py-3.5 font-light text-left">Iscritto</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white customBody no-scrollbar !max-h-[470px]">
                        @foreach($training->customers()->get() as $customer)
                            <tr class="text-center even:bg-color-f7f7f7">
                                <td scope="col" class="border-r-2 border-color-efefef text-left font-medium px-3 py-4 text-color-2c2c2c capitalize">{{$customer->full_name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="w-2/3 overflow-x-auto">
                <table class="divide-y-2 divide-color-efefef border-b-2 border-color-efefef">
                    <thead>
                        <tr class="text-center text-color-545454">
                            @foreach ($training->plannings()->whereNotNull('begin')->get() as $lessonPlanning )
                                <th scope="col" class="px-3 py-3.5 font-light text-left">{{date("d/m/Y", strtotime($lessonPlanning->begin))}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white no-scrollbar !max-h-[470px]">
                        @foreach($training->customers()->get() as $customer)
                            <tr class="text-center even:bg-color-f7f7f7">
                                @foreach ($training->plannings()->whereNotNull('begin')->get() as $lessonPlanning )
                                    @foreach ($lessonPlanning->presences()->where('customer_id', $customer->id)->get() as $presence )
                                        <td scope="col" class="border-r-2 border-color-efefef text-left font-medium px-3 pt-5 pb-4 text-color-2c2c2c capitalize">
                                            <div class="w-full flex items-center justify-center gap-4">
                                                @if ($presence->followed)
                                                    <x-icons name="check_presence" />
                                                @else
                                                    <x-icons name="null_presence" />
                                                @endif
                                            </div>
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="w-full flex justify-end relative">
        <x-submit-button wire:click='save' class="ml-auto bg-color-17489f">Salva</x-submit-button>
    </div>
</div>
