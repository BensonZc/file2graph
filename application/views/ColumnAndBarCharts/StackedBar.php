<script>
	$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '<?php echo $tablename ?> Stacked Bar'
            },
			subtitle: {
                text: 'Source: <?php echo $tablename ?>'
            },
            xAxis: {
                categories: [<?php echo $chart_x?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total fruit consumption'
                }
            },
            legend: {
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: [<?php echo rtrim($chart_y, ",")?>]
        });
    });
    

</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>