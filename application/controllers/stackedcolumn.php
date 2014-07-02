<?php
require_once './HighChartPHP/HighChartPHP.php';

class stackedcolumn extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function StackedColumn(){
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
		$stackedcolumn = new HighChartPHP();
		$stackedcolumn->chart->type = 'column';
		$stackedcolumn->title->text = $tablename . " Stacked Column";
		$stackedcolumn->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$stackedcolumn->xAxis->categories = $tablefields;
		$stackedcolumn->yAxis->title->text = 'number';
		$stackedcolumn->plotOptions->column->stacking = 'normal';
		$stackedcolumn->plotOptions->series->dataLabels->enabled = true;
		$stackedcolumn->plotOptions->series->dataLabels->color = 'white';
		$stackedcolumn->plotOptions->series->dataLabels->style->textShadow = '0 0 3px black, 0 0 3px black';
		$stackedcolumn->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['stackedcolumn'] = $stackedcolumn;
		
		$this->load->view('ColumnAndBarCharts/StackedColumn', $returnData);
	}
 
}

?>