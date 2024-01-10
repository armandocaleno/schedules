<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <div class="pt-4 pb-28 sm:pb-4">
        <div class=" mx-auto sm:px-6 md:pl-20">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="calendar" class=" p-4"></div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function() {
            var events = @json($events);
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                weekNumbers: true,
                weekText: 'S',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay,dayGridMonth,listWeek'
                },
                // dayMinWidth: 80,
                stickyFooterScrollbar: 'auto',
                views: {
                    dayGridMonth: { // name of view
                        displayEventEnd: true,
                        eventTimeFormat: { // like '14:30:00'
                            hour: '2-digit',
                            minute: '2-digit',
                            meridiem: false
                        },
                        // eventContent: function(arg, createElement) {
                        //     var innerText

                        //     if (arg.event.extendedProps.rol_id) {
                        //         innerText = arg.event.title 
                        //         innerText += '\n Rol'
                        //     } else {
                        //         innerText = 'normal event'
                        //     }

                        //     return createElement('i', {}, innerText)
                        // },
                        // other view-specific options here
                    }
                },
                events: events,
                eventClick: function(event) {
                    console.log(event.event.extendedProps);
                }
            });
            calendar.render();
        });
    </script>
    @endpush
</x-app-layout>