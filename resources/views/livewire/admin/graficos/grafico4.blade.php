<div id="chart4" class="bg-white shadow-md border rounded-lg"></div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'area',
                height: 350
            },
            series: [{
                name: 'Citas Programadas',
                data: [35, 45, 50, 60, 70, 75, 90]
            }, {
                name: 'Citas Completadas',
                data: [30, 40, 45, 55, 65, 70, 85]
            }],
            xaxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul']
            },
            fill: {
                type: 'gradient',
                gradient: {
                    opacityFrom: 0.7,
                    opacityTo: 0.3
                }
            },

            title: {
                text: 'Citas',
                align: 'center',
                style: {
                    fontSize: '18px',
                    color: '#333'
                }
            },
            colors: ['#546E7A', '#26A69A'],
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