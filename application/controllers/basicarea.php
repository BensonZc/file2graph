<?php
require_once './HighChartPHP/HighChartPHP.php';

class basicarea extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function BasicArea(){
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
		$basicarea = new HighChartPHP();
		$basicarea->chart->type = 'area';
		$basicarea->title->text = $tablename . " Basic Area Chart";
		$basicarea->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$basicarea->xAxis->categories = $tablefields;
		$basicarea->yAxis->title->text = '';
		$basicarea->plotOptions->area->pointStart = 0;
		$basicarea->plotOptions->area->marker->enabled = false;
		$basicarea->plotOptions->area->marker->radius = 2;
		$basicarea->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['basicarea'] = $basicarea;
		
		$this->load->view('AreaCharts/BasicArea', $returnData);
	}
 
}

?>