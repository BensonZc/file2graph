<?php
require_once './HighChartPHP/HighChartPHP.php';

class piechartrowsum extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function PieChartRowSum(){
		
		$tablefields = array();
		$tableallsum = array();
		$tablerowsum = array();
		$isuserdefine = $this->session->userdata('isuserdefine');
		$tablename = $this->session->userdata('tablename');
		
		if($isuserdefine == 'true'){
			
			$fields = $this->session->userdata('fields');
			$rows = $this->session->userdata('rows');
			//table some fileds data sum
			$tablefields = explode(',', $fields);
			//table some data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table some rows data sum
			$tablerowsum = $this->commondata->get_some_row_sum($tablename, $tablefields, $rows);
		}else{
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
		
		$this->load->view('f2g_header');
		$this->load->view('PieCharts/PieChartRowSum', $returnData);
	}
 
}

?>