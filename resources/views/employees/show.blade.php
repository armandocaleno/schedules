<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $employee->name }} {{ $employee->lastname }}
        </h2>
    </x-slot>

    <div class="pt-4 pb-28 sm:pb-4">
        <div class="mx-auto sm:px-6 md:pl-20">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-2 gap-4 p-4">
                    {{-- INFORMACION BASICA --}}
                    <div class=" p-4 border-2 shadow-lg">
                        <table class="w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="thead" colspan="2">INFORMACIÓN BÁSICA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Nombres</td>
                                    <td class="py-2">{{ $employee->name }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Apellidos</td>
                                    <td class="py-2">{{ $employee->lastname }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Identificación</td>
                                    <td class="py-2">{{ $employee->id_number }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Cargo</td>
                                    <td class="py-2">{{ $employee->position->name }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Email</td>
                                    <td class="py-2">{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">F. Nacimiento</td>
                                    <td class="py-2">{{ $employee->birthdate }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Edad</td>
                                    <td class="py-2">{{ $employee->age() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- HOARIO PARA HOY --}}
                    <div class=" p-4 border-2 shadow-lg">
                        <table class="w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="thead" colspan="2">HORARIO PARA HOY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Horario</td>
                                    <td class="py-2">
                                        @if ($shift_today)
                                            {{ $shift_today->schedule->name }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Inicio</td>
                                    <td class="py-2">
                                        @if ($shift_today)
                                            {{ $shift_today->schedule->start }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Fin</td>
                                    <td class="py-2">
                                        @if ($shift_today)
                                            {{ $shift_today->schedule->end }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Área</td>
                                    <td class="py-2">
                                        @if ($shift_today)
                                            @if ($shift_today->area)
                                                {{ $shift_today->area->name }}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold pl-2">Descanso</td>
                                    <td class="py-2">
                                        @if ($shift_today)
                                            @if ($shift_today->recess)
                                                {{ $shift_today->recess->name }} ({{ $shift_today->recess->start }} -
                                                {{ $shift_today->recess->end }})
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- BALANCE DEL MES --}}
                    <div>
                        <section>
                            <table class="table w-full">
                                <thead>
                                    <tr>
                                        <th class="thead">Balance del mes actual</th>
                                    </tr>
                                </thead>

                            </table>
                            <canvas id="myChart"></canvas>
                        </section>
                    </div>

                    {{-- HORARIO PERSONAL --}}
                    <div class="p-4 border-2 shadow-lg col-span-2">
                        <div id="personal_calendar" class=" p-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
            integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            //grafico miembros por departamento
            const ctx = document.getElementById('myChart');
            var chart1 = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Miembros por departamentos',
                        data: [],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 205, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)'
                        ],
                        datalabels: {
                            color: 'gray',
                            anchor: 'end',
                            align: 'top',
                            offset: 5
                        }
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    layout: {
                        padding: 30
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            var chartDepartments = function(id) {
                $.ajax({
                    url: '/grafico1',
                    method: 'get',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        const work_night_days = data.work_night_days;
                        const work_day_days = data.work_day_days;
                        const work_month_days = data.work_month_days;
                        const recess_month_days = data.recess_month_days;

                        chart1.data.labels = ['Día', 'Noche', 'Mes', 'Libre'];
                        chart1.data.datasets[0].data = [work_day_days, work_night_days, work_month_days, recess_month_days];
                        chart1.update();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                    }
                })
            }

            $(document).ready(function() {
                var employee = @json($employee);
                chartDepartments(employee['id']);

                var events = @json($events);
                const calendarEl = document.getElementById('personal_calendar')
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es',
                    weekNumbers: true,
                    weekText: 'S',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'timeGridWeek,timeGridDay,dayGridMonth,listWeek'
                    },
                    stickyFooterScrollbar: 'auto',
                    views: {
                        dayGridMonth: { // name of view
                            displayEventEnd: true,
                            eventTimeFormat: { // like '14:30:00'
                                hour: '2-digit',
                                minute: '2-digit',
                                meridiem: false
                            },
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
