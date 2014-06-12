<script>
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: '<?php echo $tablename ?> Stacked Area Chart'
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
                    text: ''
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ''
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }
                }
            },
            series: [<?php echo $chart_y?>]
        });
    });
</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>