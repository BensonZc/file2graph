<?php
require_once './HighChartPHP/HighChartPHP.php';

class compareline extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function Compareline(){
		//submit data.
		$tablename = $this->session->userdata('tablename');
		$is_user_define = $this->session->userdata('isuserdefine');
		
		$tabledata = array();
		$tablefields = array();
		
		//fields and rows is user defined.
		$fields = '';
		$rows = '';
		
		//prepare data for highchart.
		if($is_user_define == 'true'){
			$fields = $this->session->userdata('fields');
			$rows = $this->session->userdata('rows');
			
			//get table fields via user defined.
			$tablefields = explode(',', $fields);
			
			//get data via sql.
			$sql = "select " . $fields . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
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
		
		$this->load->view('f2g_header');
		$this->load->view('LineCharts/CompareLine', $returnData);
	}
 
}

?>