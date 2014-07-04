<?php
require_once './HighChartPHP/HighChartPHP.php';

class stackedarea extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function StackedArea(){
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
		$stackedarea = new HighChartPHP();
		$stackedarea->chart->type = 'area';
		$stackedarea->title->text = $tablename . " Stacked Area Chart";
		$stackedarea->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$stackedarea->xAxis->categories = $tablefields;
		$stackedarea->yAxis->title->text = '';
		$stackedarea->tooltip->shared = true;
		$stackedarea->plotOptions->area->stacking = 'normal';
		$stackedarea->plotOptions->area->marker->lineWidth = 1;
		$stackedarea->plotOptions->area->marker->lineColor = '#666666';
		$stackedarea->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['stackedarea'] = $stackedarea;
		
		$this->load->view('f2g_header');
		$this->load->view('AreaCharts/StackedArea', $returnData);
	}
 
}

?>