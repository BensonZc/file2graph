<?php
class columnlineandpie extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function ColumnLineAndPie(){
		$divid = 'container'; //default
		
		$isuserdefine = $this->input->post('isuserdefine');
		
		if($isuserdefine == 'true'){
			//table name
			$tablename = $this->input->post('tablename');
			
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			
			//table some fileds
			$tablefields = explode(',', $filed);
			//table some rows data sum
			$tablerowsum = $this->commondata->get_some_row_sum($tablename, $tablefields, $rows);
			//table data
			$sql = "select " . $filed . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table row data sum
			$tablerowsum = $this->commondata->get_all_row_sum($tablename, $tablefields);
			//table all data
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		
		//set highchart property
		$this->highcharts->title->setText($tablename . " Combination chart(Column,Line,Pie)");
		$this->highcharts->subtitle->setText('Source: ' . $tablename);
		array_shift($tablefields);
		$this->highcharts->xaxis->setCategories($tablefields);
		$this->highcharts->label->setItemHTML('Total Rows');
		$this->highcharts->label->setItemStyle('50px', '18px');
		$this->highcharts->series->setCombination($tabledata, $tablefields, $tablerowsum);
		
		$returnData['columnlineandpie'] = $this->highcharts->generate($divid);

		$this->load->view('Combinations/ColumnLineAndPie', $returnData);
	}
 
}

?>