<x-app-layout>
    
    <div class="container">
        <div class="modul" style="max-width: 100%;">
            <div class="calendar-container">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="modul">
            <canvas id="myChart"></canvas>
        </div>

        <div class="modul">
            <canvas id="myChart2"></canvas>
        </div>
    </div>

    <link href="https://unpkg.com/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/fullcalendar@5.10.1/main.min.js"></script>

    <script>

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie', // Cambiado de 'bar' a 'line'
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Numero de averías',
                    data: @json($data),
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            }
        });

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Finalitzades', 'Pendents'],
                datasets: [{
                    data: [@json($averiasFinalizadas), @json($averiasNoFinalizadas)],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: '{{ route('calendar.events') }}', // Usa la ruta a la función calendarEvents
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                navLinks: true, // Puede hacer clic en el día/semana para navegar a una vista detallada
                editable: false,
                dayMaxEvents: true // Permite el límite de eventos "más"
            });
            calendar.render();
        });
    </script>

    

<style>
        .container {
            display: flex;
            justify-content: space-around;
        }

        .modul {
            flex: 1;
            margin: 10px;
            max-width: 45%;
            /* Limita el ancho para evitar que las gráficas se estiren demasiado */
        }

        canvas {
            width: 100%;
            height: auto;
        }

        .calendar-container {
            width: 100%;
            /* Ajusta el ancho del calendario al 100% */
            margin-top: 20px;
            /* Añade un margen en la parte superior para separarlo de los gráficos */
        }

        #calendar {
            width: 100%;
            height: auto;
            position: center;
        }
    </style>
</x-app-layout>