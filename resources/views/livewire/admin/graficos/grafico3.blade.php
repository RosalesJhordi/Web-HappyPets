<div id="chart3" class="h-full bg-white border shadow-md"></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos provenientes de PHP
        var estadosCompras = <?php echo json_encode($productosMasVendidos); ?>;

        // Procesar los datos para ApexCharts
        var estados = estadosCompras.map(function(estado) {
            return estado.nombre;
        });

        var cantidades = estadosCompras.map(function(estado) {
            return estado.cantidad;
        });

        var options = {
            chart: {
                type: 'donut',
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
            title: {
                text: 'Estado de las Compras',
                align: 'center',
                style: {
                    fontSize: '18px',
                    color: '#333'
                }
            },
            series: cantidades,
            labels: estados,
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, opts) {
                    return opts.w.config.series[opts.seriesIndex] + " unidades";
                },
                style: {
                    fontSize: '12px',
                    colors: ['#fff']
                },
                dropShadow: {
                    enabled: true
                }
            },
            legend: {
                show: true,
                position: 'bottom'
            },
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function(val) {
                        return val + " unidades";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();
    });
</script>
