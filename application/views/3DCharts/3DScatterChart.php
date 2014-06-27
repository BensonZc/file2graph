<script>
$(function () {
    // Set up the chart
	<?php echo $threedscatterchart ?>
    /*
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
		
		tooltip: {
			//enabled:true,
			formatter:function(){
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
	*/
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