<script>
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Combination chart(Column,Line,Pie)'
        },
		subtitle: {
                text: 'Source: <?php echo $tablename ?>'
        },
        xAxis: {
            categories: [<?php echo $chart_column_x ?>]
        },
        labels: {
            items: [{
                html: 'Total Rows',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [<?php echo $chart_column_y ?> 
			{<?php echo $chart_avg_line ?>
            marker: {
            	lineWidth: 2,
            	lineColor: Highcharts.getOptions().colors[3],
            	fillColor: 'white'
            }
        }, <?php echo $chart_pie_data ?>
            center: [100, 80],
            size: 100,
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }]
    });
});
</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

