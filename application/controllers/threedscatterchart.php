<?php
require "HighchartJsExpr.php";

class threedscatterchart extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	//3D Scatter chart
	function ThreeDScatterChart(){
		$divid = 'container'; //default
		
		$y_array = array();
		$returnData = array();
		
		$isuserdefine = $this->input->post('isuserdefine');
		if($isuserdefine == 'true'){
			$tablename = $this->input->post('tablename');
			
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			
			//table some fileds
			$tablefields = explode(',', $filed);
			//table data
			$sql = "select " . $filed . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table data
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		
		foreach($tabledata as $data_item){
			array_push($y_array, $data_item[$tablefields[0]]);
		}
		
		foreach($tabledata as $data_item){
			$max_temp = $data_item[$tablefields[1]];
			$min_temp = $data_item[$tablefields[1]];
		}
		
		foreach($tabledata as $data_item){
			for($i=0;$i<count($tablefields);$i++){
				if($i!=0){
					$max_temp = max($max_temp, $data_item[$tablefields[$i]]);
					$min_temp = min($min_temp, $data_item[$tablefields[$i]]);
				}
			}
		}
		
		//set highchart property
		$this->highcharts->chart->setRenderTo($divid);
		$this->highcharts->chart->setMargin(75);
		$this->highcharts->chart->setType('scatter');
		$this->highcharts->chart->setOptions3d(true, 10, 30, 250, 5);
		$this->highcharts->chart->setFrameBottom(1, 'rgba(0,0,0,0.02)');
		$this->highcharts->chart->setFrameBack(1, 'rgba(0,0,0,0.04)');
		$this->highcharts->chart->setFrameSide(1, 'rgba(0,0,0,0.06)');
		$this->highcharts->title->setText($tablename . ' Scatter plot chart');
		$this->highcharts->subtitle->setText('You can click and drag the plot area to rotate in space');
		array_shift($tablefields);
		$this->highcharts->xaxis->setCategories($tablefields);
		$this->highcharts->yaxis->setCategories($y_array);
		$this->highcharts->zaxis->setMin($min_temp);
		$this->highcharts->zaxis->setMax($max_temp);
		$this->highcharts->tooltip->setFormatter(new HighchartJsExpr("formatter:function(){
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
				
				return \"<b>X</b>: \"+ this.x + \",<br><b>Y</b>: \"+ this.y + \",<br><b>Z</b>: \" + this.point.z;"));
		$this->highcharts->series->setPointSeries($tabledata, $tablefields);
		
		$returnData['threedscatterchart'] = $this->highcharts->generateWithObject();		
		
		
		$this->load->view('3DCharts/3DScatterChart', $returnData);
	}
	
	function common3DAndHeatChart(){
		
		
		
		
		$graphdata = $this->initgraphdata->init3DScatterData($tablefields, $tabledata);
		$graphdata['tablename'] = $tablename;
		$graphdata['js'] = "eval(function(){
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
				
				return \"<b>X</b>: \"+ this.x + \",<br><b>Y</b>: \"+ this.y + \",<br><b>Z</b>: \" + this.point.z;)";
		return $graphdata;
	}
 
}

?>