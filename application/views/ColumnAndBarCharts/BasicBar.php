<script>
	$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '<?php echo $tablename ?> Basic Bar'
            },
            subtitle: {
                text: 'Source: <?php echo $tablename ?>'
            },
            xAxis: {
                categories: [<?php echo $chart_x?>],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
					borderWidth: 2,
					groupPadding: 0,
                    dataLabels: {
                        enabled: false
                    }
                }
            },
			/*
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 250,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                shadow: true
            },
			/*
            credits: {
                enabled: false
            },
			*/
            series: [<?php echo $chart_y?>]
        });
    });
    

</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>