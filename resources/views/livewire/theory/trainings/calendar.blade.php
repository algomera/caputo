<div class="p-10 relative">
    <p wire:click='back' class="underline text-color-808080 cursor-pointer mb-5">Indietro</p>

    <div class="px-10 absolute top-9 left-1/2 transform -translate-x-1/2">
        <h1 class="text-3xl font-bold text-[#01a53a]">{{$training->$variant->name}}</h1>
    </div>

    <div wire:ignore id='calendarLesson'></div>
</div>

@push('scripts')

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', function() {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendarLesson'), {
            height: 680,
            initialView: 'timeGridWeek',
            locale: 'it',
            nowIndicator: true,
            navLinks: true,
            firstDay: 1,
            hiddenDays: [0],
            weekends: true,
            slotMinTime: '8:00:00',
            slotMaxTime: '20:00:00',
            slotDuration: '00:15:00',
            slotLabelInterval: '00:15:00',
            navLinks: true,
            editable: true,
            selectable: true,
            nowIndicator: true,
            showNonCurrentDates: false,
            buttonText: {
                today:    'Oggi',
                month:    'Mese',
                week:     'Settimana',
                day:      'Giorno',
            },
            headerToolbar: {
                left: 'prev next today',
                center: 'title',
                right: 'timeGridDay timeGridWeek dayGridMonth'
            },
            validRange: {
                start: @json($trainingStart),
                end: @json($trainingEnd),
            },
            eventContent: function(event) {
                var main = {html:`
                    <div class="p-2 w-full fc-event-main-frame border border-[`+event.event.extendedProps.customBorderColor+`] bg-[`+event.event.backgroundColor+`]">
                        <div class="fc-event-title-container">
                            <div class="fc-event-title fc-sticky">
                                <p class="flex font-medium gap-2 text-[`+event.event.extendedProps.customBorderColor+`]">
                                    <x-icons name="time" class="!text-[`+event.event.extendedProps.customBorderColor+`]"/>
                                    `+moment(event.event.startStr).format('HH:mm')+ ' - ' +moment(event.event.endStr).format('HH:mm')+`
                                </p>
                                @role ('admin|responsabile sede|segretaria')
                                    <p class="text-lg font-medium capitalize text-color-2c2c2c">
                                        <span class="font-semibold text-base">Insegnate: </span> `+event.event.extendedProps.teacher+`
                                    </p>
                                @endrole
                                <p class="text-base font-medium text-color-2c2c2c">
                                    <span class="font-semibold text-base">Corso: </span> `+event.event.title+`
                                </p>
                                <p class="text-lg font-medium text-color-2c2c2c">
                                    <span class="font-semibold text-base">Lezione: </span> `+event.event.extendedProps.argument+`
                                </p>
                            </div>
                        </div>
                    </div>`
                }
                return main;
            },
            views: {
                dayGridMonth: {
                    dayMaxEventRows: 5,
                    eventMaxStack: 2,
                    dayHeaderFormat: { weekday: 'long'},
                    titleFormat: { month: 'long', year: 'numeric' },
                },
                timeGridDay: {
                    dayHeaderFormat: { weekday: 'long', day: 'numeric'},
                    dayMaxEventRows: 10,
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        @this.call('new', {data: data.dateStr});
                    },
                },
                timeGridWeek: {
                    dayHeaderFormat: { weekday: 'long', day: 'numeric'},
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        @this.new({data: data.dateStr});
                    },

                    eventDrop: function(data) {
                        @this.update(data.event.id, data.event.start)
                    }
                },
            },

            eventClick: function(info) {
                @this.call('show', {lesson: info.event.id});
            },

            events: @json($lessons),
        });

        calendar.setOption('visibleRange', {
            start: @json($trainingStart),
            end: @json($trainingEnd),
        });

        calendar.render();

        @this.on('updateCalendar', () => {
            console.log('si');
            calendar.refetchEvents()
        });
    });
</script>
@endpush
