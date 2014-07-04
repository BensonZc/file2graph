<?php
require_once './HighChartPHP/HighChartPHP.php';

class stackedbar extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function StackedBar(){
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
		$stackedbar = new HighChartPHP();
		$stackedbar->chart->type = 'bar';
		$stackedbar->title->text = $tablename . " Stacked Bar";
		$stackedbar->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$stackedbar->xAxis->categories = $tablefields;
		$stackedbar->yAxis->title->text = 'number';
		$stackedbar->plotOptions->bar->stacking = 'normal';
		$stackedbar->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['stackedbar'] = $stackedbar;
		
		$this->load->view('f2g_header');
		$this->load->view('ColumnAndBarCharts/StackedBar', $returnData);
	}
 
}

?>