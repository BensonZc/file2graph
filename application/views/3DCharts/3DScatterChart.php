<script>
$(function () {
	/*
	// Give the points a 3D feel by adding a radial gradient
    Highcharts.getOptions().colors = $.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.4,
                cy: 0.3,
                r: 0.5
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.2).get('rgb')]
            ]
        };
    });
	*&/
	*/
    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'scatter',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 30,
                depth: 250,
                viewDistance: 5,

                frame: {
                    bottom: { size: 1, color: 'rgba(0,0,0,0.02)' },
                    back: { size: 1, color: 'rgba(0,0,0,0.04)' },
                    side: { size: 1, color: 'rgba(0,0,0,0.06)' }
                }
            }
        },
        title: {
            text: '<?php echo $tablename?> Scatter plot chart'
        },
        subtitle: {
            text: 'You can click and drag the plot area to rotate in space'
        },
		//this.userOptions.tooltip.pointFormat:'aaaaaaaaa',
		
		tooltip: {
			//enabled:true,
			
			formatter: function(){
			
				<?php foreach ($x_array as $x_array_key => $x_array_value):?>
					if(this.x == <?php echo $x_array_key?>){
						this.x = <?php echo $x_array_value?>;
					}
				<?php endforeach; ?>
				
				<?php foreach ($y_array as $y_array_key => $y_array_value):?>					
					if(this.y == <?php echo $y_array_key?>){
						this.y = '<?php echo $y_array_value?>';
					}
				<?php endforeach; ?>
				

				return "<b>X</b>: "+ this.x + ",<br><b>Y</b>: "+ this.y + ",<br><b>Z</b>: " + this.point.z;
			},
			
			pointFormat: '{series.name}: aaaaaaa<b>{point.x}{point.y}{point.z}</b><br/>',
			shared: true,
        },
        yAxis: {
            categories: [<?php echo $chart_y ?>]
        },
        xAxis: {
            categories: [<?php echo $chart_x ?>],
            gridLineWidth: 1
        },
        zAxis: {
            min: <?php echo $min ?>,
            max: <?php echo $max ?>
        },
        legend: {
            enabled: false
        },
        
        series: [{
            name: 'Point',
            colorByPoint: true,
            data: [<?php echo $pointData?>] 
        }]
    });

    // Add mouse events for rotation
    $(chart.container).bind('mousedown.hc touchstart.hc', function (e) {
        e = chart.pointer.normalize(e);

        var posX = e.pageX,
            posY = e.pageY,
            alpha = chart.options.chart.options3d.alpha,
            beta = chart.options.chart.options3d.beta,
            newAlpha,
            newBeta,
            sensitivity = 5; // lower is more sensitive

        $(document).bind({
            'mousemove.hc touchdrag.hc': function (e) {
                // Run beta
                newBeta = beta + (posX - e.pageX) / sensitivity;
                newBeta = Math.min(100, Math.max(-100, newBeta));
                chart.options.chart.options3d.beta = newBeta;

                // Run alpha
                newAlpha = alpha + (e.pageY - posY) / sensitivity;
                newAlpha = Math.min(100, Math.max(-100, newAlpha));
                chart.options.chart.options3d.alpha = newAlpha;

                chart.redraw(false);
            },                            
            'mouseup touchend': function () { 
                $(document).unbind('.hc');
            }
        });
    });
    
});
</script>
<div id="container" style="height: 400px; min-width: 310px; max-width: 800px; margin: 0 auto;"></div>