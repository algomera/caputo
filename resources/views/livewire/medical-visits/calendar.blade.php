<div class="p-10">
    <div wire:ignore id='calendar'></div>
</div>

@push('scripts')

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

<script>
    document.addEventListener('livewire:initialized', function() {
        const calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            height: 730,
            initialView: 'timeGridWeek',
            locale: 'it',
            timeZone: 'Europe/Rome',
            nowIndicator: true,
            navLinks: true,
            firstDay: 1,
            weekends: false,
            slotMinTime: '8:00:00',
            slotMaxTime: '20:00:00',
            slotDuration: '00:60:00',
            slotLabelInterval: '00:60:00',
            navLinks: true,
            editable: true,
            selectable: true,
            nowIndicator: true,
            dayMaxEvents: true,
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
                    titleFormat: { month: 'long', year: 'numeric' },
                },
                timeGridDay: {
                    dayMaxEventRows: 5,
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        @this.call('new', {data: data.dateStr});
                    },
                },
                timeGridWeek: {
                    dayMaxEventRows: 5,
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
                @this.call('show', {visit: info.event.id});
            },

            events: @json($visits),
        });

        calendar.render()
        @this.on('updateCalendar', () => {
            console.log('si');
            calendar.addEvent(@json($visits))
        });
    });
</script>
@endpush
