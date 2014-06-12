<script>
	$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $tablename ?> Basic Column'
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
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [<?php echo rtrim($chart_y, ",")?>]
        });
    });
    

</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>