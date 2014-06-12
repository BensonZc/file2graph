<script>
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: '<?php echo $tablename ?> Basic Area Chart'
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
                        return this.value;
                    }
                }
            },
            tooltip: {
                 formatter: function() {  
                    return '<b>'+ this.series.name +'</b><br/>'+  
                    this.x +': '+ this.y +'';  
            } 
            },
            plotOptions: {
                area: {
                    pointStart: 0,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: [<?php echo $chart_y?>]
        });
    });
    

</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
