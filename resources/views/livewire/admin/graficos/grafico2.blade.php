<div id="chart2" class="bg-white border shadow-md "></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos provenientes de PHP
        var productosMasVendidos = <?php echo json_encode($productosMasVendidos); ?>;

        // Procesar los datos para ApexCharts
        var categorias = productosMasVendidos.map(function(producto) {
            return producto.nombre;
        });

        var cantidades = productosMasVendidos.map(function(producto) {
            return producto.cantidad;
        });

        var options = {
            chart: {
                type: 'bar',
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
                text: 'Productos Más Vendidos',
                align: 'center',
                style: {
                    fontSize: '18px',
                    color: '#333'
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    borderRadius: 4,
                    colors: {
                        backgroundBarColors: ['#f8f9fa'],
                        backgroundBarOpacity: 0.5
                    }
                }
            },
            series: [{
                name: 'Ventas',
                data: cantidades,
                colors: ['#FF5733']
            }],
            xaxis: {
                categories: categorias,
                labels: {
                    style: {
                        colors: '#6c757d',
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#6c757d',
                        fontSize: '12px'
                    }
                },
                title: {
                    text: 'Ventas en unidades',
                    style: {
                        fontSize: '14px',
                        color: '#333'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '12px',
                    colors: ['#fff']
                },
                offsetY: -5
            },
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function(val) {
                        return val + " unidades";
                    }
                }
            },
            grid: {
                show: true,
                borderColor: '#e7e7e7',
                strokeDashArray: 4
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
    });
</script>
