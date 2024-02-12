<div class="p-10">
    <div class="px-10 2xl:px-0 mb-5">
        <div class="flex items-center gap-5">
            <div wire:click='back' class="w-12 h-12 rounded-full shadow-shadow-card flex items-center justify-center cursor-pointer group transition-all duration-300">
                <x-icons name="back" @class(["transition-all duration-300 group-hover:-translate-x-1", 'group-hover:text-color-'.get_color($training->$variant->service->name)]) />
            </div>
            <h1 @class(["text-5xl font-bold", 'text-color-'.get_color($training->$variant->service->name)])> {{$training->$variant->name}}</h1>
        </div>
    </div>

    <div wire:ignore id='calendarLesson'></div>
</div>

@push('scripts')

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', function() {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendarLesson'), {
            height: 650,
            initialView: 'timeGridWeek',
            locale: 'it',
            // timeZone: 'Europe/Rome',
            nowIndicator: true,
            navLinks: true,
            firstDay: 1,
            weekends: false,
            slotMinTime: '8:00:00',
            slotMaxTime: '20:00:00',
            slotDuration: '00:15:00',
            slotLabelInterval: '00:15:00',
            navLinks: true,
            editable: true,
            selectable: true,
            nowIndicator: true,
            dayMaxEvents: true,
            eventMaxStack: true,
            dayHeaderFormat: { weekday: 'long', day: 'numeric'},
            buttonText: {
                today:    'Oggi',
                year:     'Anno',
                month:    'Mese',
                week:     'Settimana',
                day:      'Giorno',
                list:     'Agenda settimanale'
            },
            headerToolbar: {
                left: 'prev next today',
                center: 'title',
                right: 'timeGridDay timeGridWeek dayGridMonth multiMonthYear'
            },
            views: {
                dayGridMonth: {
                    dayMaxEventRows: 5,
                    eventMaxStack: 2,
                    titleFormat: { month: 'long', year: 'numeric' },
                },
                timeGridDay: {
                    dayMaxEventRows: 10,
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        @this.call('new', {data: data.dateStr});
                    },
                },
                timeGridWeek: {
                    dayMaxEventRows: 3,
                    eventMaxStack: 1,
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    // eventAfterAllRender: function(view) {
                    //     let title = document.getElementById('fc-dom-1');
                    //     console.log(title);
                    //     title.before('<div class="label">test</div>');
                    // },

                    eventContent: function(event) {
                        var main = {html:
                            `<div class="p-2">
                                <p class="flex items-center gap-2"><x-icons name="time" class="!text-white" /> `+moment(event.event.startStr).format('HH:mm')+ ' - ' +moment(event.event.endStr).format('HH:mm')+`</p>
                                <p>Corso: `+event.event.title+`</p>
                                <p>Lezione: `+event.event.extendedProps.argument+`</p>
                            </div>`
                        }
                        return main;
                    },

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

        calendar.render()
        @this.on('updateCalendar', () => {
            console.log('si');
            calendar.refetchEvents()
        });
    });
</script>
@endpush
