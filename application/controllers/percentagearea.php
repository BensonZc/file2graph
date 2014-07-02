<?php
require_once './HighChartPHP/HighChartPHP.php';

class percentagearea extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function PercentageArea(){
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
		$percentagearea = new HighChartPHP();
		$percentagearea->chart->type = 'area';
		$percentagearea->title->text = $tablename . " Stacked Area Chart";
		$percentagearea->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$percentagearea->xAxis->categories = $tablefields;
		$percentagearea->yAxis->title->text = 'Percent';
		$percentagearea->tooltip->pointFormat = '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f})<br/>';
		$percentagearea->tooltip->shared = true;
		$percentagearea->plotOptions->area->stacking = 'percent';
		$percentagearea->plotOptions->area->lineColor = '$ffffff';
		$percentagearea->plotOptions->area->lineWidth = 1;
		$percentagearea->plotOptions->area->marker->lineWidth = 1;
		$percentagearea->plotOptions->area->marker->lineColor = '#666666';
		$percentagearea->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['percentagearea'] = $percentagearea;
		
		$this->load->view('AreaCharts/PercentageArea', $returnData);
	}
 
}

?>