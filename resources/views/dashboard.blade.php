<x-app-layout>

<div class="container">
    <div class="modul">
        <canvas id="myChart"></canvas>
    </div>

    <div class="modul">
        <canvas id="myChart2"></canvas>
    </div>
</div>

<style>
    .container {
        display: flex;
        justify-content: space-around;
    }
    .modul {
        flex: 1;
        margin: 10px;
        max-width: 45%; /* Limita el ancho para evitar que las gráficas se estiren demasiado */
    }
    canvas {
        width: 100%;
        height: auto;
    }
</style>

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
            labels: ['Finalizadas', 'Pendents'],
            datasets: [{
                data: [@json($averiasFinalizadas), @json($averiasNoFinalizadas)],
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        }
    });
</script>

</x-app-layout>