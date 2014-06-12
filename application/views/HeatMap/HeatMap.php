<script>
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'heatmap',
            marginTop: 70,
            marginBottom: 40
        },
        title: {
            text: '<?php echo $tablename?> Heat Map'
        },
		subtitle: {
            text: 'Source: <?php echo $tablename ?>'
        },
        xAxis: {
            categories: [<?php echo $chart_x?>]
        },

        yAxis: {
            categories: [<?php echo $chart_y?>],
            title: null
        },

        colorAxis: {
            min: 0,
            minColor: '#FFFFFF',
            maxColor: Highcharts.getOptions().colors[0]
        },

        legend: {
            align: 'right',
            layout: 'vertical',
            margin: 0,
            verticalAlign: 'top',
            y: 25,
            symbolHeight: 320
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.series.xAxis.categories[this.point.x] + '</b><br><b>' +
                    this.point.value + '</b> items on <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
            }
        },

        series: [{
            name: 'Sales per employee',
            borderWidth: 1,
            data: [<?php echo $pointData?>],
            dataLabels: {
                enabled: true,
                color: 'black',
                style: {
                    textShadow: 'none',
                    HcTextStroke: null
                }
            }
        }]

    });
});
</script>

<div id="container" style="height: 400px; min-width: 310px; max-width: 800px; margin: 0 auto"></div>