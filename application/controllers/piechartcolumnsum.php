<?php
require_once './HighChartPHP/HighChartPHP.php';

class piechartcolumnsum extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function PieChartColumnSum(){
		$divid = 'container'; //default
		$tablename = '';
		$tablefields = array();
		$tableallsum = array();
		$tablecolumn = array();
		$isuserdefine = $this->input->post('isuserdefine');
		
		if($isuserdefine == 'true'){
			//table name
			$tablename = $this->input->post('tablename');
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			//table some fileds
			$tablefields = explode(',', $filed);
			//table some data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table some column data sum
			$tablecolumn = $this->commondata->get_all_column_sum($tablename, $tablefields, $rows);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table all data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table column data sum
			$tablecolumn = $this->commondata->get_all_column_sum($tablename, $tablefields);
		}
		
		//set highchart property
		$piechartcolumnsum = new HighChartPHP();
		$piechartcolumnsum->title->text = $tablename . " Pie Chart Column Sum";
		$piechartcolumnsum->subtitle->text = 'Source: ' . $tablename;
		$piechartcolumnsum->tooltip->pointFormat = '{series.name}: <b>{point.percentage:.1f}%</b>';
		$piechartcolumnsum->plotOptions->series->allowPointSelect = true;
		$piechartcolumnsum->plotOptions->series->cursor = 'pointer';
		$piechartcolumnsum->plotOptions->series->dataLabels->enabled = false;
		$piechartcolumnsum->plotOptions->series->showInLegend = true;
		array_shift($tablefields);
		$piechartcolumnsum->series = SeriesOptions::setPieColumnSumSeries($tableallsum, $tablecolumn, $tablefields);
		
		$returnData['piechartcolumnsum'] = $piechartcolumnsum;

		$this->load->view('PieCharts/PieChartColumnSum', $returnData);
	}
 
}

?>