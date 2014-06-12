<script>
	//Basic Line
	$(function () {
        $('#container').highcharts({
			title: {
                text: '<?php echo $tablename ?> Basic Line Chart',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: <?php echo $tablename ?>',
                x: -20
            },
			/*
			credits:{//右下角的文本  
				enabled: true,  
					position: {//位置设置  
					align: 'right',  
					x: -10,  
					y: -10  
				},  
				//href: "http://www.highcharts.com",//点击文本时的链接  
				style: {  
					color:'RGB(144,144,144)' 
				},  
				text: "Highcharts Demo"//显示的内容  
			},
			*/
            xAxis: {
                categories: [<?php echo $chart_x ?>]
            },
            yAxis: {
                title: {
                    text: 'y(description)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                //layout: 'vertical',
                //align: 'bottom',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
            series: [<?php echo $chart_y ?>]
        });
    });
</script>
<div id="container" class="content" style="min-width:310px;height:400px;margin:0 auto">
</div>
<!--
<?php echo $chart_x ?>
<br>
<?php echo $chart_y ?>
-->