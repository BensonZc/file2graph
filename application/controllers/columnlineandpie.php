<?php
require_once './HighChartPHP/HighChartPHP.php';

class columnlineandpie extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function ColumnLineAndPie(){
		//table name
		$tablename = $this->session->userdata('tablename');
		$isuserdefine = $this->session->userdata('isuserdefine');
		
		if($isuserdefine == 'true'){
			$fields = $this->session->userdata('fields');
			$rows = $this->session->userdata('rows');
			
			//table some fileds
			$tablefields = explode(',', $fields);
			//table some rows data sum
			$tablerowsum = $this->commondata->get_some_row_sum($tablename, $tablefields, $rows);
			//table data
			$sql = "select " . $fields . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else{
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table row data sum
			$tablerowsum = $this->commondata->get_all_row_sum($tablename, $tablefields);
			//table all data
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		
		//set highchart property
		$columnlineandpie = new HighChartPHP();
		$columnlineandpie->title->text = $tablename . " Combination chart(Column,Line,Pie)";
		$columnlineandpie->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$columnlineandpie->xAxis->categories = $tablefields;
		$columnlineandpie->label->items->html = 'Total Rows';
		$columnlineandpie->label->items->style->left = '50px';
		$columnlineandpie->label->items->style->top = '18px';
		$columnlineandpie->series = SeriesOptions::setCombination($tabledata, $tablefields, $tablerowsum);
		
		$returnData['columnlineandpie'] = $columnlineandpie;
	
		$this->load->view('f2g_header');
		$this->load->view('Combinations/ColumnLineAndPie', $returnData);
	}
 
}

?>