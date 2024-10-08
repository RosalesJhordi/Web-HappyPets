<div id="chart3" class="bg-white shadow-md border"></div>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        var options = {
            chart: {
                type: 'donut'  
            },
            title: {
                text: 'Productos por Categoría',
                align: 'center',
                style: {
                    fontSize: '18px',
                    color: '#333'
                }
            },
            series: [44, 55, 13, 43, 22], 
            labels: ['A', 'B', 'C', 'D', 'E'], 
            colors: ['#FF4560', '#00E396', '#008FFB', '#FF6D00', '#775DD0'], 
            legend: {
                position: 'bottom'  
            },
            dataLabels: {
                enabled: true  
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();
    });
</script>