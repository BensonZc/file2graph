<?php
require_once './HighChartPHP/HighChartPHP.php';

class threedscatterchart extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	//3D Scatter chart
	function ThreeDScatterChart(){
		$divid = 'maincontainer'; //default
		
		$y_array = array();
		$returnData = array();
		$tablename = $this->session->userdata('tablename');
		$isuserdefine = $this->session->userdata('isuserdefine');
		
		if($isuserdefine == 'true'){
			$fields = $this->session->userdata('fields');
			$rows = $this->session->userdata('rows');
			
			//table some fileds
			$tablefields = explode(',', $fields);
			//table data
			$sql = "select " . $fields . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else{
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table data
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		
		foreach($tabledata as $data_key => $data_item){
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
		$threedscatterchart = new HighChartPHP();
		$threedscatterchart->chart->renderTo = $divid;
		$threedscatterchart->chart->margin = 75;
		$threedscatterchart->chart->type = 'scatter';
		$threedscatterchart->chart->options3d = array(
				"enabled" => true,
				"alpha" => 10,
				"beta" =>30,
				"depth" => 250,
				"viewDistance" => 5
			);
		$threedscatterchart->chart->frame->bottom = array( 'size' => 1, 'color' => 'rgba(0,0,0,0.02)');
		$threedscatterchart->chart->frame->back = array( 'size' => 1, 'color' => 'rgba(0,0,0,0.04)');
		$threedscatterchart->chart->frame->side = array( 'size' => 1, 'color' => 'rgba(0,0,0,0.06)');
		$threedscatterchart->title->text = $tablename . ' Scatter plot chart';
		$threedscatterchart->subtitle->text = 'You can click and drag the plot area to rotate in space';
		array_shift($tablefields);
		$threedscatterchart->xAxis->categories = $tablefields;
		$threedscatterchart->yAxis->categories = $y_array;
		$threedscatterchart->zAxis->min = $min_temp;
		$threedscatterchart->zAxis->max = $max_temp;
		$threedscatterchart->legend->enabled = false;
		$threedscatterchart->tooltip->formatter = "function (){return this.series.xAxis.categories[this.point.x]+'  '+this.series.yAxis.categories[this.point.y]+'  '+this.point.z;}";
		
		$threedscatterchart->series = SeriesOptions::setPointSeries($tabledata, $tablefields);
		$returnData['threedscatterchart'] = $threedscatterchart;		
		
		$this->load->view('f2g_header');
		$this->load->view('3DCharts/3DScatterChart', $returnData);
	}
}

?>