<?php
require_once './HighChartPHP/HighChartPHP.php';

class stackedpercentagecolumn extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function StackedPercentageColumn(){
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
		$stackedpercentagecolumn = new HighChartPHP();
		$stackedpercentagecolumn->chart->type = 'column';
		$stackedpercentagecolumn->title->text = $tablename . " Stacked Percentage Column";
		$stackedpercentagecolumn->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$stackedpercentagecolumn->xAxis->categories = $tablefields;
		$stackedpercentagecolumn->yAxis->title->text = 'number';
		$stackedpercentagecolumn->tooltip->pointFormat = '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>';
		$stackedpercentagecolumn->plotOptions->series->stacking = 'percent';
		$stackedpercentagecolumn->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['stackedpercentagecolumn'] = $stackedpercentagecolumn;
		
		$this->load->view('f2g_header');
		$this->load->view('ColumnAndBarCharts/StackedPercentageColumn', $returnData);
	}
 
}

?>