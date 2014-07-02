<?php
require_once './HighChartPHP/HighChartPHP.php';

class compareline extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function Compareline(){
		//submit data.
		$tablename = $this->input->post('tablename');
		$is_user_define = $this->input->post('isuserdefine');
		
		$divid = 'container'; //default.
		$tabledata = array();
		$tablefields = array();
		
		//filed and rows is user defined.
		$filed = '';
		$rows = '';
		
		//prepare data for highchart.
		if($is_user_define == 'true'){
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			
			//get table fields via user defined.
			$tablefields = explode(',', $filed);
			
			//get data via sql.
			$sql = "select " . $filed . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else if($is_user_define == 'false'){
			//get all table fields.
			$tablefields = $this->commondata->get_table_fields($tablename);
			
			//get all data.
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		
		//set highchart property
		$compareline = new HighChartPHP();
		$compareline->chart->type = 'spline';
		$compareline->title->text = $tablename . " Compare Line Chart";
		$compareline->title->x = -20;
		$compareline->subtitle->text = 'Source: ' . $tablename;
		$compareline->subtitle->x = -20;
		array_shift($tablefields);
		$compareline->xAxis->categories = $tablefields;
		$compareline->yAxis->title->text = '';
		$compareline->tooltip->valueSuffix = '';
		$compareline->tooltip->crossHairs = true;
		$compareline->tooltip->shared = true;
		$compareline->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['compareline'] = $compareline;
		
		$this->load->view('LineCharts/CompareLine', $returnData);
	}
 
}

?>