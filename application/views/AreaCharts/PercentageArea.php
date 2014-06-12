<script>
	$(function () {
        $('#container').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: '<?php echo $tablename ?> Percentage Area'
            },
            subtitle: {
                text: 'Source: <?php echo $tablename ?>'
            },
            xAxis: {
                categories: [<?php echo $chart_x?>],
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: 'Percent'
                }
            },
            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f})<br/>',
                shared: true
            },
            plotOptions: {
                area: {
                    stacking: 'percent',
                    lineColor: '#ffffff',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#ffffff'
                    }
                }
            },
            series: [<?php echo $chart_y?>]
        });
    });
</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>