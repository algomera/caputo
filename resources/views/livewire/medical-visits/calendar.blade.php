<div class="p-10">
    <div wire:ignore id='calendar'></div>
</div>

@push('scripts')

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', function() {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            height: 730,
            initialView: 'timeGridWeek',
            locale: 'it',
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
            eventDrop: function(info) {
                if (info.view.type == 'dayGridMonth') {
                    info.revert();
                    alert('Non è consentito trascinare le visite nella visualizzazione mensile.');
                }
            },
            eventChange: function(info) {
                if (info.view.type == 'timeGridDay' || info.view.type == 'timeGridWeek') {
                    var originalDuration = info.oldEvent.end - info.oldEvent.start;
                    info.event.setEnd(info.event.start.clone().add(originalDuration));
                }
            },
            eventContent: function(event) {
                var main = {html:`
                    <div class="p-2 w-full fc-event-main-frame">
                        <div class="fc-event-title-container">
                            <div class="fc-event-title fc-sticky">
                                <div class="flex gap-2">
                                    <p class="flex font-medium gap-2">
                                        <x-icons name="time"/> `+moment(event.event.startStr).format('HH:mm')+`
                                    </p>
                                    @role ('admin')
                                        <p class="uppercase">
                                            <span class="capitalize">Scuola: </span> `+event.event.extendedProps.school+`
                                        </p>
                                    @endrole
                                </div>
                                @role ('admin|responsabile sede|segretaria')
                                    <p class="capitalize">
                                        <span>Medico: </span> `+event.event.extendedProps.doctor+`
                                    </p>
                                @endrole
                                <p>
                                    <span>Paziente: </span> `+event.event.title+`
                                </p>
                            </div>
                        </div>
                    </div>`
                }
                return main;
            },
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
                right: 'timeGridDay timeGridWeek dayGridMonth'
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
                        var today = new Date();
                        if (data.date < today) {
                            return alert('Non è possibile prenotare visite in date o orari passati.');
                        } else {
                            @this.new({data: data.dateStr});
                        }
                    },

                    eventDrop: function(data) {
                        var today = new Date();
                        if (data.event.start < today) {
                            data.revert();
                            alert('Non è possibile spostare le visite gia trascorse.');
                        } else {
                            @this.update(data.event.id, data.event.start)
                        }
                    }
                },
                timeGridWeek: {
                    dayMaxEventRows: 3,
                    eventMaxStack: 1,
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        var today = new Date();
                        if (data.date < today) {
                            return alert('Non è possibile prenotare visite in date o orari passati.');
                        } else {
                            @this.new({data: data.dateStr});
                        }
                    },

                    eventDrop: function(data) {
                        var today = new Date();
                        if (data.event.start < today) {
                            data.revert();
                            alert('Non è possibile spostare una visita svolta o spostare una visita in una data passata.');
                        } else {
                            @this.update(data.event.id, data.event.start)
                        }
                    }
                },
            },

            eventClick: function(info) {
                @this.call('show', {visit: info.event.id});
            },

            events: @json($visits),
        });

        @this.on('updateCalendar', events => {
            events.forEach(array => {
                array.forEach(event => {
                    calendar.addEvent(event);
                });
            });
        });

        @this.on('eventRemove', function (visitId) {
            var visit = calendar.getEventById(visitId);
            if (visit) {
                visit.remove();
            }
        });

        calendar.render()
    });
</script>
@endpush
