<div class="w-full h-full py-10 px-8 2xl:px-14">
    <h1 class="text-5xl font-bold text-color-17489f capitalize mb-5">Gestione guide</h1>

    <div wire:ignore id='calendarDriving'></div>
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', function() {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendarDriving'), {
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
            slotDuration: '00:60:00',
            slotLabelInterval: '00:60:00',
            navLinks: true,
            editable: true,
            eventOrderStrict: true,
            eventDrop: function(info) {
                if (info.view.type == 'dayGridMonth') {
                    info.revert(); // Annulla il trascinamento se si trova nella visualizzazione mensile
                    alert('Non è consentito trascinare eventi nella visualizzazione mensile.');
                }
            },
            eventChange: function(info) {
                // Verifica se la visualizzazione corrente è 'timeGridWeek'
                if (info.view.type == 'timeGridDay' || info.view.type == 'timeGridWeek') {
                    // Calcola la durata originale dell'evento
                    var originalDuration = info.oldEvent.end - info.oldEvent.start;
                    // Imposta la data di fine dell'evento in base alla durata originale
                    info.event.setEnd(info.event.start.clone().add(originalDuration));
                }
            },
            selectable: true,
            selectConstraint: {
                start: '08:00',
                end: '20:00'
            },
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
            eventContent: function(event) {
                var main = {html:`
                    <div class="p-2 w-full fc-event-main-frame border">
                        <div class="fc-event-title-container">
                            <div class="fc-event-title fc-sticky">
                                <p class="flex font-medium gap-2">
                                    <x-icons name="time"/>`+moment(event.event.startStr).format('HH:mm')+`
                                </p>
                                @role ('admin|responsabile sede|segretaria')
                                    <p class="text-lg font-medium capitalize text-color-2c2c2c">
                                        <span class="font-semibold text-base">Cliente: </span> `+event.event.extendedProps.customer+`
                                    </p>
                                    <p class="text-lg font-medium capitalize text-color-2c2c2c">
                                        <span class="font-semibold text-base">Istruttore: </span> `+event.event.extendedProps.Instructor+`
                                    </p>
                                @endrole
                                <p class="text-base font-medium text-color-2c2c2c">
                                    <span class="font-semibold text-base">Veicolo: </span> `+event.event.extendedProps.vehicle_type+`
                                </p>
                                <p class="text-lg font-medium text-color-2c2c2c">
                                    <span class="font-semibold text-base">Targa: </span> `+event.event.extendedProps.plate+`
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
                    eventOrder: false,
                    dayHeaderFormat: { weekday: 'long'},
                    titleFormat: { month: 'long', year: 'numeric' },
                },
                timeGridDay: {
                    dayHeaderFormat: { weekday: 'long', day: 'numeric'},
                    dayMaxEventRows: 10,
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        var today = new Date();

                        @this.new({data: data.dateStr});
                    },
                    eventDrop: function(data) {
                        @this.update(data.event.id, moment(data.event.start, 'YYYY-MM-DDTHH:mm').add(1, 'hours'))
                    }
                },
                timeGridWeek: {
                    eventOrderStrict: true,
                    eventOrder: false,
                    eventMaxStack: 1,
                    dayHeaderFormat: { weekday: 'long', day: 'numeric'},
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        @this.new({data: data.dateStr});
                    },
                    eventDrop: function(data) {
                        var today = new Date();

                        @this.update(data.event.id, moment(data.event.start, 'YYYY-MM-DDTHH:mm').add(1, 'hours'))
                    }
                },
            },

            eventClick: function(info) {
                @this.call('show', {lesson: info.event.id});
            },
            events: @json($drivings),
        });

        @this.on('updateCalendar', driving => {
            calendar.addEvent(driving[0])
        });

        @this.on('eventRemove', function (drivingId) {
            var driving = calendar.getEventById(drivingId);
            if (driving) {
                driving.remove();
            }
        });

        calendar.render();
    });
</script>
@endpush
