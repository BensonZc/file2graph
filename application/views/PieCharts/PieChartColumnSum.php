<script>
$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '<?php echo $tablename?> Pie Chart'
            },
			subtitle: {
                text: 'The proportion of Column data sum'
            },
			legend: {
                layout: 'vertical',
                align: 'right',
				verticalAlign:'middle'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Column Sum/Total',
                data: [<?php echo $series?>]
            }]
        });
    });
    
});
</script>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>