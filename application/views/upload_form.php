<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>File2Graph</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<base href = "<?php echo base_url();?>"/>
<link href="css/home/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/home/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="css/home/slider.css" />
<script src="js/homejs/jquery.min.js"></script>
<script>
function showfilename(){
	$('#file_name').html($('#choose_file').val());
}

$(document).ready(function() {
	$("#feedback").click(function(){
		var email = $("input[name='email']").val();
		if(email.match(/^[a-z0-9]+([._]*[a-z0-9]+)*@[a-z0-9]+([_.][a-z0-9]+)+$/gi)){
			url='index.php/feedback/sendFeedBack';
			var data = {
				name:$("input[name='name']").val(),
				email:$("input[name='email']").val(),
				message:$("textarea[name='message']").val()
			};  
			
			$.ajax({  
				type : "POST",  
				async : false,  
				url : url,  
				data : data,  
				timeout:1000,  
				success:function(dates){  
					alert('thanks your feedback.')
				},  
				error: function(e) {  
					alert('feedback error.');  
				}  
			});  
		}else{
			alert("email format is not correct,please fill in again."); 
		}
	});
});
</script>
</head>
<body>
<div class="content" id="home">
	<div class="header">
		<div class="wrap">
		    <div id="topnav">
			    <nav id="nav">
			        <ul>
			       		<li class="active"><a href="#home" class="scroll">Home</a></li>
						<li><a href="#Try" class="scroll">Try</a></li>
						<li><a href="#wif" class="scroll">What is file2graph</a></li>
						<li><a href="#htui" class="scroll">How to use it</a></li>
						<li><a href="#contact" class="scroll">Contact</a></li>								
					</ul>
		        </nav>
			    <h1 id="main_h1"><a id="main_index" href="index.html">File2Graph</a></h1>
			        <a href="#" id="navbtn">Nav Menu</a>
		    </div>
		</div>
	</div>
	<!-----script------------->
	<script type="text/javascript"  src="js/homejs/menu.js"></script>

	<div class="slider" id="home"> 	
		<div class="wrap">
			<!---start-da-slider----->
			<div id="da-slider" class="da-slider">
				<div class="da-slide">
					<h2>First,I have to declare</h2>
					<p>This tool is based on <a href="http://www.datatables.net/">dataTables.js</a> and <a href="http://www.highcharts.com/">HighCharts.js</a>.Thanks for these jQuery JavaScript library.it's highly flexible tools.</p>
				</div>
				<div class="da-slide">
					<h2>This is tool for generate graph</h2>
					<p>You only need to upload file(csv,excel...),then you can modify the data according to your needs,final,get a variety of graph.(line, spline, area, column, bar, pie...)</p>
				</div>
				<div class="da-slide">
					<h2>Open source</h2>
					<p>Fork us on GitHub and participate in tech discussions.if you have some ideas,please contact me,thanks</p>
				</div>
			</div>
		
			<script type="text/javascript" src="js/homejs/jquery.cslider.js"></script>
			<!---strat-slider---->	    
			<script type="text/javascript" src="js/homejs/modernizr.custom.28468.js"></script>
			<script type="text/javascript">
				$(function() {
					$('#da-slider').cslider({
						autoplay: true,
						bgincrement	: 450
					});		
				});
			</script>
			<!---//End-da-slider----->
		</div>
	</div>
</div>
	<!---start-Try----->
	<div  class="Try" id="Try">
		<div class="wrap">
			<div class="section group">
				<?php echo $error;?>
				<?php echo form_open_multipart('upload/do_upload');?>
					<div class="col_1_of_1 span_1_of_1">
						<h3>Start uploading file(csv,excel...)</h3>
						<p>If you not know how to use it.please read <a href="#htui" class="scroll">How to user it</a> 
						content first.or please 
						<span style="position:relative;display:inline-block;zoom:1;overflow:hidden;vertical-align:middle;cursor:pointer;">
							<a href="javascript:void(0);">choose file</a>
							<input id="choose_file" type="file" name="userfile" onchange="showfilename();" style="position:absolute;right:0;top:5px;_zoom:30;_height:auto;opacity:0;filter:alpha(opacity=0);-ms-filter:'alpha(opacity=0)';cursor:pointer;"/>
						</span> 
						a file from local.</p>
						
						<p id="file_name"></p>
					</div>
					<div style="text-align:center;">
						<input type="submit" value="upload" style="padding:0.5em 2em;"/>
					</div>
				</form>
				<div class="pen">
					<img src="images/pen.png">
				</div>
			</div>
		</div>
	</div>
	<!---//end-Try----->
	
	<!---start-our story----->
	<div class="wif" id="wif">
		<div class="our-story">
			<h3>What is File2Graph</h3>
			<p>You only need to upload file(csv,excel...),modify the data,final,get a variety of graph.(line, spline, area, column, bar, pie...)</p>
		</div>	
		<div class="group_2" id="Portfolio">
			<div class="group_2_items">
				<div class="wrap">
					<div id="owl-demo1" class="owl-carousel">
						<div class="item">
							<div class="carousel">
						  	   <div class="group_2_img1">
									<img src="images/pic1.png" alt="" >
								</div>
							 </div>
						</div>	
						<div class="item">
							<div class="carousel">
								<div class="group_2_img1">
									<img src="images/pic2.png" alt="" >
								</div>
							</div>
						</div>	
						<div class="item">
							<div class="carousel">
								<div class="group_2_img1">
									<img src="images/pic3.png" alt="" >
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Owl Carousel Assets -->
	<link href="css/home/owl.carousel.css" rel="stylesheet">
	<!-- Owl Carousel Assets -->
	<!-- Prettify -->
	<script src="js/homejs/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
			$("#owl-demo").owlCarousel({
		        items : 1,
		        lazyLoad : true,
		        autoPlay : true,
		        navigation : true,
			    navigationText : ["",""],
			    rewindNav :true,
			    scrollPerPage :true,
			    pagination : true,
    			paginationNumbers: false,
		    });
		
		});
		    
		$(document).ready(function() {
		    $("#owl-demo1").owlCarousel({
		        items : 1,
		        lazyLoad : true,
		        autoPlay : true,
		        navigation : true,
			    navigationText : ["",""],
			    rewindNav : true,
			    scrollPerPage :true,
			    pagination : false,
    			paginationNumbers: false,
		    });
		
		}); 
	</script>
	
	<!----start-how to use it---->
	<div class="htui" id="htui">	  
		<div class="wrap">
			<div class="pricing-plans">
				<h5>How to use file2graph.</h5>
				<p>first,you should prepare a stadard table file. and upload it,then you can modify your table data according you needs.when you confirm,you will get a variety of graph.</p>
				<div class="pricing-grids">
					<div id="stepone" class="pricing-grid black">
						<h3><a href="javascript:void(0);">Step 1</a></h3>
						<div class="price-value">
							<p class="stepcontent">Upload standard file:</p>
						</div>
						<ul>
							<li><p>1.The file type is csv or excel.subsequent will be added more file type.</p></li>
							<li><p>2.file is a table,has some column data and row data.</p></li>
							<li><p>3.file name does not include the special characters.</p></li>
						</ul>
						<div class="cart">
							<a class="popup-with-zoom-anim" href="#filedemo">file demo</a>
						</div>
					</div>
					<div id="steptwo" class="pricing-grid green">
						<h3><a href="javascript:void(0);">Step 2</a></h3>
						<div class="price-value">
							<p class="stepcontent">How to modify data:</p>
						</div>
						<ul>
							<li><p>1.switch Advanced tab when you need to modify data.</p></li>
							<li><p>2.you can toggle columns data you needs</p></li>
							<li><p>3.you can select rows data you needs</p></li>
						</ul>
						<div class="cart">
							<a class="popup-with-zoom-anim" href="#tabledemo">table demo</a>
						</div>
					</div>
					<div id="stepthree" class="pricing-grid blue">
						<h3><a href="javascript:void(0);">Step 3</a></h3>
						<div class="price-value">
							<p class="stepcontent">Graph introduction:</p>
						</div>
						<ul>
							<li><p>1.Charts include line, area, column, bar, pie...</p></li>
							<li><p>2.Porvide 3D graphics,it's cool.</p></li>
							<li><p>3.user can print chart and download PNG/JPEG/PDF/SVG image.</p></li>
						</ul>
						<div class="cart">
							<a class="popup-with-zoom-anim" href="#graphdemo">graph demo</a>
						</div>
					</div>
					<!-----pop-up-grid---->
					<!-- file demo -->
					<div id="filedemo" class="mfp-hide">
						<div class="pop_up">
							<div class="payment-online-form-left">
								<div class="file_type">
									<h3>1.csv file demo:</h3>
									<img src='images/csvfiledemo.png' />
								</div>
								<div class="file_type">
									<h3>2.excel file demo:</h3>
									<img src='images/excelfiledemo.png' />
								</div>
								Is to support more...
							</div>
						</div>
					</div>
					<!-- table demo -->
					<div id="tabledemo" class="mfp-hide">
						<div class="pop_up">
							<div class="payment-online-form-left">
							to be adding table
							</div>
						</div>
					</div>
					<!-- graph demo -->
					<div id="graphdemo" class="mfp-hide">
						<div class="pop_up">
							<div class="payment-online-form-left">
								to be adding graph
							</div>
						 </div>
					</div>
					<!-----pop-up-grid---->
				</div>
				<h6>If you have got any quations related to how to use it please get in touch with me using the form bellow.</h6>
			</div>
		</div>
	</div>
	<!-- Add fancyBox light-box -->
	<script src="js/homejs/jquery.magnific-popup.js" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});
		});
	</script>
	<!----End-how to use it---->
	<!----start-contact---->
	<div  class="contact" id="contact">
		<div class="contact">
		 	<h3>Get in touch</h3>
		 	<p>Got any questions? to feel free to get in touch with me .I would love to hear from you.</p>
		 	<div class="wrap">
		 		<div class="con">
				  	<input type="text" name="name" placeholder="Name" required/> 
					<input type="text" name="email" placeholder="Email" required/>
					<div>
						<textarea id="feedbackmessage" name="message" value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = ' Message';}">Message</textarea>
					</div>
					<div class="con-button">
						<button id="feedback">Send</button>
					</div>
				</div>
				<div class="social_icon">	
					<ul>	
						<li class="twitter"><a href="#"><span> </span></a></li>
						<li class="facebook"><a href="#"><span> </span></a></li>	 	
						<li class="google"><a href="#"><span> </span></a></li>
					</ul>
		 	  	</div>
			</div>
		 </div>
	</div>
	<!----//End-contact---->
	<div class="footer">
		<div class="wrap">
			<div class="footer-con">
				<div class="footer-right">
					<ul>
						<li class="active"><a href="#home" class="scroll">Home</a></li>
						<li><a href="#Try" class="scroll">Try</a></li>
						<li><a href="#wif" class="scroll">What is file2graph</a></li>
						<li><a href="#htui" class="scroll">How to use it</a></li>
						<li><a href="#contact" class="scroll">Contact</a></li>								
					</ul>
				</div>
				<div class="footer-left">
					<p>Copyright &copy; 2014.Company name All rights reserved.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- scroll_top_btn -->
	<script type="text/javascript" src="js/homejs/move-top.js"></script>
	<script type="text/javascript" src="js/homejs/easing.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			$().UItoTop({ easingType: 'easeOutQuart' });				
		});
	</script>
					
	<!---smoth-scrlling---->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
		
					<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
		  
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>