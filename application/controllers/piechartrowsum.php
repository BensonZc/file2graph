<?php
require_once './HighChartPHP/HighChartPHP.php';

class piechartrowsum extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function PieChartRowSum(){
		$divid = 'container'; //default
		$tablename = '';
		$tablefields = array();
		$tableallsum = array();
		$tablerowsum = array();
		$isuserdefine = $this->input->post('isuserdefine');
		
		if($isuserdefine == 'true'){
			//table name
			$tablename = $this->input->post('tablename');
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			//table some fileds data sum
			$tablefields = explode(',', $filed);
			//table some data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table some rows data sum
			$tablerowsum = $this->commondata->get_some_row_sum($tablename, $tablefields, $rows);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table all data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table row data sum
			$tablerowsum = $this->commondata->get_all_row_sum($tablename, $tablefields);
		}
		
		//set highchart property
		$piechartrowsum = new HighChartPHP();
		$piechartrowsum->title->text = $tablename . " Pie Chart Rows Sum";
		$piechartrowsum->subtitle->text = 'Source: ' . $tablename;
		$piechartrowsum->tooltip->pointFormat = '{series.name}: <b>{point.percentage:.1f}%</b>';
		$piechartrowsum->plotOptions->series->allowPointSelect = true;
		$piechartrowsum->plotOptions->series->cursor = 'pointer';
		$piechartrowsum->plotOptions->series->dataLabels->enabled = false;
		$piechartrowsum->plotOptions->series->showInLegend = true;
		$piechartrowsum->series = SeriesOptions::setPieRowsSumSeries($tableallsum, $tablerowsum);
		
		$returnData['piechartrowsum'] = $piechartrowsum;
		
		$this->load->view('PieCharts/PieChartRowSum', $returnData);
	}
 
}

?>