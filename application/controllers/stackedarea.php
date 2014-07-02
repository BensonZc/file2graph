<?php
require_once './HighChartPHP/HighChartPHP.php';

class stackedarea extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function StackedArea(){
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
		
		$this->load->view('AreaCharts/StackedArea', $returnData);
	}
 
}

?>