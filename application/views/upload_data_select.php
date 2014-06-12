<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
	<head>
	<meta name="generator" content="HTML Tidy for Windows (vers 24 May 2007), see www.w3.org">
	<title>Upload File Data</title>
	
	<script src="../../js/jquery.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.1.1.js"></script>
	<script src="../../js/jquery.dataTables.js" type="text/javascript"></script>
	<link href="../../css/jquery.dataTables.css" rel="stylesheet" type="text/css">
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/shCore.css" rel="stylesheet" type="text/css">
	<link href="../../css/upload_data_select.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#datatable').DataTable( {
			"scrollY": "200px",
			"paging": false
		});
		
		$('#advanced').click(function(){
			
			$(this).css('border-bottom', '4px solid #58AD52');
			$('#common').css('border-bottom', '4px solid rgb(232,232,232)');
			
			//is user set table data,value is true;
			$("input[name='isuserdefine']").val('true');
			
			//advanced column settings shown and can be set.
			if($.browser.msie && ($.browser.version == "8.0")){
				//fucking IE8
				$('#advanced_column_settings').css('display', 'block');
			}else{
				$('#advanced_column_settings').slideDown('slow');
			}
			
			$('a.toggle-vis').on( 'click', function (e) {
				e.preventDefault();
				// Get the column API object
				var column = table.column( $(this).attr('data-column') );
				// Toggle the visibility
				if ($(this).attr('data-column') == "0") {
					alert("Please keep the first column");
				} else {
					column.visible( ! column.visible() );
				}
			});
		
			//advanced rows can be set.
			$('#datatable tbody').on( 'click', 'tr', function () {
				$(this).toggleClass('selected');
			});
			
		});
		
		$('#common').click(function(){
			$(this).css('border-bottom', '4px solid #58AD52');
			$('#advanced').css('border-bottom', '4px solid rgb(232,232,232)');
			
			//if all data to chart and user not set table,value is false.
			$("input[name='isuserdefine']").val('false');
			
			//advanced column settings is not shown.can not be set.
			if($.browser.msie && ($.browser.version == "8.0")){
				//fucking IE8
				$('#advanced_column_settings').css('display', 'none');
			}else{
				$('#advanced_column_settings').slideUp('slow');
			}			
			
			//advanced rows can not be set.
			$('#datatable tbody tr').each(function () {
				$(this).removeClass('selected');
			});
		
			$('#datatable tbody').on( 'click', 'tr', function () {
				$(this).removeClass('selected');
			});
			
		});
		
		$('#submit').click( function () {
			var columns = "";
			var rows = "";
			var table_headdiv = $('.dataTables_scrollHead');
			var table_thead = table_headdiv.find('th#filed');
			table_thead.each(function() {
				if (columns == "") {
					columns = $(this).html();
				} else {
					columns = columns + "," + $(this).html();
				}
			});
			$("input[name='filed']").val(columns);

			for (var i=0;i<table.rows('.selected').data().length;i++) {
				if (i==0) {
					rows = "'" + table.rows('.selected').data()[i][0] + "'";
				} else {
					rows = rows + "," + "'" + table.rows('.selected').data()[i][0] + "'";
				}
			}
			$("input[name='rows']").val(rows); 
		});
		
		/*set table setting bottom color*/
		$('a.active').css('border-bottom', '4px solid #58AD52');
	});
</script>
</head>
<body>
<div class="header">
	<div class="header_icon">
		<h1>
			<a href="javascript:void(0);">File2Graph</a>
		</h1>
	</div>
	<div class="header_content">
		<p><a href="http://www.datatables.net">Table plug-in for jQuery</a> is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table.</p>		
	</div>		        
</div>
<div class="content">
	<div class="steptwo">
		<h3><a href="javascript:void(0);">Step 2</a></h3>
		
		<div class="title">
			<p>How to modify data:</p>
		</div>
		<ul>
			<li><p>1.switch Advanced tab when you need to modify data.</p></li>
			<li><p>2.you can toggle columns data you needs.</p></li>
			<li><p>3.you can select rows data you needs.</p></li>
			<li><p>4.Once your data is set up, you can click comfirm to submit.</p></li>
		</ul>
	</div>
	
	<div class="table" style="float:left;height:400px;width:75%;margin-left:20px;margin-top:2%;">
	<!-- Advanced settings, select data base on user require -->
	<div id="table_settings" style="cursor:pointer;">
		<a id="common" class="active" >Common</a>
		<a id="advanced" >Advanced</a>
		<!--<p>Upload file table name: <?php echo $table_name ?></p>-->
	</div>
	<div id="advanced_table" style="">
		<?php echo validation_errors(); ?>
		<?php echo form_open('graphmanager/new_graph') ?>
		<input type="hidden" readonly name="table_name" value="<?php echo $table_name ?>"  style="border:0px;">
		<input type="hidden" name="filed" >
		<input type="hidden" name="rows" >
		<input type="hidden" name="isuserdefine" value="false">
		<div id="advanced_column_settings" style="display:none;">
			Now you can set your table by your require.(columns and rows)<br>
			Toggle column: 
			<?php foreach($horizontal as $horizontal_key => $horizontal_value): ?>
				<a class="toggle-vis" data-column="<?php echo $horizontal_key ?>"><?php echo $horizontal_value ?></a> - 
			<?php endforeach; ?>
			
		</div>
		<table id="datatable" class="display" cellspacing="0" width=100% style="border-top:2px solid rgb(234,234,234);">
			<thead>
				<tr>
					<?php foreach($horizontal as $horizontal_item): ?>
						<th id="filed"><?php echo $horizontal_item ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<?php foreach($horizontal as $horizontal_item): ?>
						<th><?php echo $horizontal_item ?></th>
					<?php endforeach; ?>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($upload_data as $row):?>
					<tr>
						<?php foreach($row as $data): ?>
							<td><?php echo $data ?></td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<input type="submit" id="submit" value="comfirm" />
		</form>
	</div>
	</div>
</div>
</body>
</html>
