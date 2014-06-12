<script>
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $tablename ?> Stacked Percentage Column'
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
                    text: ''
                }
            },
            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: 'percent'
                }
            },
            series: [<?php echo $chart_y ?>]
        });
    });
    

</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>