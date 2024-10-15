<div id="chart" class="bg-white shadow-md border"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'line',
                toolbar: {
                    show: true 
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800 
                }
            },
            stroke: {
                curve: 'smooth', 
                width: 3,  
                colors: ['#1E90FF'] 
            },
            markers: {
                size: 5, 
                colors: ['#1E90FF'],  
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: {
                    size: 7
                }
            },
            title: {
                text: 'Ventas Mensuales',
                align: 'center',
                style: {
                    fontSize: '20px',
                    color: '#333'
                }
            },
            grid: {
                show: true,
                borderColor: '#e7e7e7',
                strokeDashArray: 5  
            },
            series: [{
                name: 'Ganancias',
                data: [30, 10, 30, 65, 90, 80, 85, 40, 35, 50, 33, 49, 60, 70],
                color: '#1E90FF'  
            }],
            xaxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul'],
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
                    text: 'Ganancias',
                    style: {
                        fontSize: '14px',
                        color: '#333'
                    }
                }
            },
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function (val) {
                        return val + "k"; 
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -20,
                offsetX: -5,
                labels: {
                    colors: '#333'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    });
</script>