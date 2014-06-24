<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Graph</title>

		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/jquery-migrate-1.1.1.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/highcharts-3d.js"></script>
		<script src="http://code.highcharts.com/modules/data.js"></script>
		<script src="http://code.highcharts.com/modules/heatmap.js"></script>
		<script src="http://code.highcharts.com/modules/drilldown.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<script type="text/javascript" src="../../js/slide.js"></script>
		<link href="../../css/common.css" rel="stylesheet" type="text/css">
		<link href="../../css/upload_data_graph.css" rel="stylesheet" type="text/css">
		
		<script type="text/javascript">
		$(window).load(function(){
			//click sub item to change chart
			$("#sub_01 li a").click(function(){
				var controller = $(this).attr('id').replace("3", "Three").toLocaleLowerCase();
				var method = $(this).attr('id').replace("3", "Three");
				var data = {
					tablename:"<?php echo $tablename?>",
					isuserdefine:"<?php echo $isuserdefine?>",
					filed:"<?php echo $filed?>",
					rows:"<?php echo $rows?>"};  
			
					$.ajax({  
					type : "POST", 
					async : false,
					url : '../' + controller + '/' + method,
					data : data, 
					timeout:1000,
					success:function(dates){  
						$("#maincontainer").html(dates);
					},  
					error: function(e) {  
						alert('../' + controller + '/' + method);  
					}  
				});  
			});
		});
		</script>
	</head>
	<body>
		
		<!--<div><?php echo $highchart ?></div>-->
		
		<div class="header">
			<div class="header_icon">
				<h1>
					<a href="javascript:void(0);">File2Graph</a>
				</h1>
			</div>
			<div class="header_content">
				<p><a href="http://www.highcharts.com/">HIGHCHARTS</a> Create interactive charts easily for your web projects.Used by tens of thousands of developers and 59 out of the world's 100 largest companies, Highcharts is the simplest yet most flexible charting API on the market.</p>		
			</div>		        
		</div>
		<div class="content">
			<div class="stepthree">
				<h3><a href="javascript:void(0);">Step 3</a></h3>
		
				<div class="title">
					<p>Graph introduction:</p>
				</div>
				<ul>
					<li><p>1.Charts include line, area, column, bar, pie...</p></li>
					<li><p>2.Porvide 3D graphics,it's cool.</p></li>
					<li><p>3.User can print chart and download PNG/JPEG/PDF/SVG image.</p></li>
					<li><p>4.Please switch tap and find graph you needs.</p></li>
				</ul>
			</div>
			
			<div id="graph">
				<ul id="nav">
					<?php foreach($sliderbar as $sliderbar_key => $sliderbar_value): ?>
						<li class="mainlevel" id="mainlevel_01"><a href="javascript:void(0);" target="_blank"><?php echo $sliderbar_key ?></a>
							<ul id="sub_01">
								<?php foreach($sliderbar_value as $sliderbar_item_item): ?>
									<li>
										<a id="<?php echo str_replace(' ', '', $sliderbar_item_item)?>" href="javascript:void(0);"><?php echo $sliderbar_item_item ?></a>
									</li>
								<?php endforeach; ?>
							</ul>	
						</li>
					<?php endforeach; ?>	
					<div class="clear"></div>
				</ul>
				<div id="maincontainer" style="width:1410px;height:400px;z-index:5;margin-top:3%">
				</div>
				<!--Basic Line-->
				<script type="text/javascript"><?php echo $basicline ?></script>
			</div>
		</div>
	</body>
</html>