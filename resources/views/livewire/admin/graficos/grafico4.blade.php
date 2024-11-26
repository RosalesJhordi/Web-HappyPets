<div id="chart4" class="h-full bg-white border shadow-md"></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos provenientes de PHP
        var citasTerminadas = <?php echo json_encode(array_values($this->citasTerminadas)); ?>;
        var citasCanceladas = <?php echo json_encode(array_values($this->citasCanceladas)); ?>;
        var citasPendientes = <?php echo json_encode(array_values($this->citasPendientes)); ?>;
        var fechas = <?php echo json_encode(array_keys($this->citasTerminadas)); ?>; // Suponemos que todas tienen las mismas fechas

        var options = {
            chart: {
                type: 'area',
                height: 500,
                toolbar: {
                    show: true
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            series: [{
                name: 'Citas Terminadas',
                data: citasTerminadas
            }, {
                name: 'Citas Canceladas',
                data: citasCanceladas
            }, {
                name: 'Citas Pendientes',
                data: citasPendientes
            }],
            xaxis: {
                categories: fechas
            },
            fill: {
                type: 'gradient',
                gradient: {
                    opacityFrom: 0.7,
                    opacityTo: 0.3
                }
            },
            title: {
                text: 'Estado de las Citas por Fecha',
                align: 'center',
                style: {
                    fontSize: '18px',
                    color: '#333'
                }
            },
            colors: ['#28a745', '#6c757d', '#dc3545'], // Verde, Gris, Rojo
            stroke: {
                curve: 'smooth'
            },
            legend: {
                position: 'top'
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart4"), options);
        chart.render();
    });
</script>
