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
    var lessons = @json($lessons);
    lessons.sort(function(a,b) {
        if (a.id === @json($trainingId)) {
            return -1;  // Metti a a.ID prima di b.ID
        } else if (b.id === @json($trainingId)) {
            return 1;   // Metti b.ID prima di a.ID
        } else {
            return a.id - b.id; // Ordina gli altri eventi per ID in modo crescente
        }
    });

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
                        var today = new Date();
                        if (!@json($trainingEnd)) {
                        } else if (data.date < today) {
                            return alert('Non è possibile programmare lezioni in date o orari passati.');
                        } else {
                            @this.new({data: data.dateStr});
                        }
                    },
                    eventDrop: function(data) {
                        var today = new Date();
                        if (data.event.start < today) {
                            data.revert();
                            alert('Non è possibile spostare le lezioni gia trascorse.');
                        } else if (moment(data.event.start, 'HH:mm:mm').format('HH:mm') < '08:00') {
                            data.revert();
                            alert('Non è possibile spostare la lezione fuori dal range del calendario.');
                        } else if (moment(data.event.start, 'HH:mm:mm').add(data.event.extendedProps.lessonDuration,'m').format('HH:mm') > '20:00') {
                            data.revert();
                            alert('Non è possibile spostare la lezione fuori dal range del calendario.');
                        } else {
                            @this.update(data.event.id, moment(data.event.start, 'YYYY-MM-DDTHH:mm').add(1, 'hours'))
                        }
                    }
                },
                timeGridWeek: {
                    eventOrder: false,
                    eventMaxStack: 1,
                    dayHeaderFormat: { weekday: 'long', day: 'numeric'},
                    titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },

                    dateClick: function(data) {
                        var today = new Date();
                        if (!@json($trainingEnd)) {
                        } else if (data.date < today) {
                            return alert('Non è possibile programmare lezioni in una data passata.');
                        }  else {
                            @this.new({data: data.dateStr});
                        }
                    },
                    eventDrop: function(data) {
                        var today = new Date();

                        if (data.event.start < today) {
                            data.revert();
                            alert('Non è possibile spostare una lezione svolta o spostare una lezione in data passata.');
                        } else if (moment(data.event.start, 'HH:mm:mm').format('HH:mm') < '08:00') {
                            data.revert();
                            alert('Non è possibile spostare la lezione fuori dal range del calendario.');
                        } else if (moment(data.event.start, 'HH:mm:mm').add(data.event.extendedProps.lessonDuration,'m').format('HH:mm') > '20:00') {
                            data.revert();
                            alert('Non è possibile spostare la lezione fuori dal range del calendario.');
                        } else {
                            @this.update(data.event.id, moment(data.event.start, 'YYYY-MM-DDTHH:mm').add(1, 'hours'))
                        }
                    }
                },
            },

            eventClick: function(info) {
                @this.call('show', {lesson: info.event.id});
            },
            events: lessons,
        });

        calendar.setOption('visibleRange', {
            start: @json($trainingStart),
            end: @json($trainingEnd),
        });

        @this.on('updateCalendar', lesson => {
            calendar.addEvent(lesson[0])
        });

        @this.on('eventRemove', function (lessonId) {
            var lesson = calendar.getEventById(lessonId);
            if (lesson) {
                lesson.remove();
            }
        });

        calendar.render();
    });
</script>
@endpush
