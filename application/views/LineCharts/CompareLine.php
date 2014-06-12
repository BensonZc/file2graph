<script>
	$(function () {
        $('#container').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '<?php echo $tablename ?> Compare Line Chart'
            },
            subtitle: {
                text: 'Source: <?php echo $tablename ?>'
            },
            xAxis: {
                categories: [<?php echo $chart_x?>],
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    formatter: function() {
                        return this.value
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [<?php echo $chart_y?>]
        });
    });
    

</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>