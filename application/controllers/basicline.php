<?php
require_once './HighChartPHP/HighChartPHP.php';

class basicline extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function Basicline(){
		//submit data.
		$tablename = $this->session->userdata('tablename');
		$is_user_define = $this->session->userdata('isuserdefine');
		
		$tabledata = array();
		$tablefields = array();
		
		//filed and rows is user defined.
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
		$basicline = new HighChartPHP();
		$basicline->title->text = $tablename . " Basic Line Chart";
		$basicline->title->x = -20;
		$basicline->subtitle->text = 'Source: ' . $tablename;
		$basicline->subtitle->x = -20;
		array_shift($tablefields);
		$basicline->xAxis->categories = $tablefields;
		$basicline->yAxis->title->text = '';
		$basicline->tooltip->valueSuffix = '';
		$basicline->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['basicline'] = $basicline;
				
		$this->load->view('f2g_header');
		$this->load->view('LineCharts/BasicLine', $returnData);
	}
 
}

?>