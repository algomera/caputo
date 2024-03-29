<div class="w-full h-full py-10 px-8 2xl:px-14">
    <div class="flex items-start justify-between">
        <h1 class="text-5xl font-bold text-color-17489f capitalize mb-5">Gestione guide</h1>

        @role('admin')
        <x-custom-select wire:model.live="schoolCode" name="schoolCode" label="" width="w-fit" >
            <option value="">tutte le scuole</option>
            @foreach ($schools as $school)
                <option value="{{$school->id}}">Scuola: {{$school->code}}</option>
            @endforeach
        </x-custom-select>
        @endrole
    </div>

    <div wire:ignore id='calendarDriving'></div>
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', function() {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendarDriving'), {
            height: 650,
            initialView: 'timeGridWeek',
            locale: 'it',
            nowIndicator: true,
            navLinks: true,
            firstDay: 1,
            hiddenDays: [0],
            weekends: true,
            slotMinTime: '8:00:00',
            slotMaxTime: '20:00:00',
            slotDuration: '00:30:00',
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
                    <div title="Istruttore: `+event.event.extendedProps.instructor+`" class="p-2 w-full fc-event-main-frame border bg-color-347af2/80">
                        <div class="fc-event-title-container">
                            <div class="fc-event-title fc-sticky">
                                <div class="flex items-center justify-between">
                                    <p class="flex font-medium gap-2 text-white">
                                        <x-icons name="time" class="text-white"/>`+moment(event.event.startStr).format('HH:mm')+`
                                    </p>
                                    @role ('admin')
                                        <p class="text-sm text-white">
                                            Scuola: <span class="uppercase">`+event.event.extendedProps.school+`</span>
                                        </p>
                                    @endrole
                                </div>
                                @role ('admin|responsabile sede|segretaria|istruttore')
                                    <p class="text-base capitalize whitespace-nowrap overflow-hidden truncate text-white">
                                        <span class="font-medium text-sm">Cliente: </span> `+event.event.extendedProps.customer+`
                                    </p>
                                @endrole
                                @role ('admin|responsabile sede|segretaria')
                                    <p class="text-base capitalize text-white">
                                        <span class="font-medium text-sm">Istruttore: </span> `+event.event.extendedProps.instructor+`
                                    </p>
                                @endrole
                                <p class="text-sm text-white">
                                    <span class="font-medium text-sm capitalize">Veicolo: </span> `+event.event.extendedProps.vehicle_type+`
                                </p>
                                <p class="text-sm text-white uppercase">
                                    <span class="font-medium text-sm capitalize">Targa: </span> `+event.event.extendedProps.plate+`
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

                        if (moment(data.date, 'HH:mm').format('HH:mm') < '08:00') {
                            return alert('Per programmare nuove guide cliccare le caselle in basso definite da orari.');
                        } else if (data.date < today) {
                            return alert('Non è possibile programmare guide in una data passata.');
                        }  else {
                            @this.openRegistration({data: data.dateStr});
                        }
                    },
                    eventDrop: function(data) {
                        var today = new Date();

                        if (data.event.start < today) {
                            data.revert();
                            alert('Non è possibile spostare una guida svolta o spostare una guida in data passata.');
                        } else if (moment(data.event.start, 'HH:mm:mm').format('HH:mm') < '08:00') {
                            data.revert();
                            alert('Non è possibile spostare la guida fuori dal range del calendario.');
                        } else if (moment(data.event.start, 'HH:mm:mm').add(data.event.extendedProps.lessonDuration,'m').format('HH:mm') > '20:00') {
                            data.revert();
                            alert('Non è possibile spostare la guida fuori dal range del calendario.');
                        } else {
                            @this.drivingUpdate(data.event.id, moment(data.event.start, 'YYYY-MM-DDTHH:mm'))
                        }
                    }
                },
                timeGridWeek: {
                    eventOrderStrict: true,
                    eventOrder: false,
                    eventMaxStack: 1,
                    dayHeaderFormat: { weekday: 'long', day: 'numeric'},
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        var today = new Date();

                        if (moment(data.date, 'HH:mm').format('HH:mm') < '08:00') {
                            return alert('Per programmare nuove guide cliccare le caselle in basso definite da orari.');
                        } else if (data.date < today) {
                            return alert('Non è possibile programmare guide in una data passata.');
                        }  else {
                            @this.openRegistration({data: data.dateStr});
                        }
                    },
                    eventDrop: function(data) {
                        var today = new Date();

                        if (data.event.start < today) {
                            data.revert();
                            alert('Non è possibile spostare una guida svolta o spostare una guida in data passata.');
                        } else if (moment(data.event.start, 'HH:mm:mm').format('HH:mm') < '08:00') {
                            data.revert();
                            alert('Non è possibile spostare la guida fuori dal range del calendario.');
                        } else if (moment(data.event.start, 'HH:mm:mm').add(data.event.extendedProps.lessonDuration,'m').format('HH:mm') > '20:00') {
                            data.revert();
                            alert('Non è possibile spostare la guida fuori dal range del calendario.');
                        } else {
                            @this.drivingUpdate(data.event.id, moment(data.event.start, 'YYYY-MM-DDTHH:mm'))
                        }

                    }
                },
            },

            eventClick: function(driving) {
                @this.call('show', {driving: driving.event.id});
            },

            events: @json($drivings),
        });

        @this.on('addDriving', driving => {
            calendar.addEvent(driving[0])
        });

        @this.on('drivingRemove', function (drivingId) {
            var driving = calendar.getEventById(drivingId);
            if (driving) {
                driving.remove();
            }
        });

        @this.on('changeSchool', function (drivings) {
            const newDrivings = drivings[0];

            calendar.removeAllEvents();
            newDrivings.forEach(driving => {
                calendar.addEvent(driving)
            });
            calendar.refetchEvents()
        });

        calendar.render();
    });
</script>
@endpush
