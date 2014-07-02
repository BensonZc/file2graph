<?php
require_once './HighChartPHP/HighChartPHP.php';

class basiccolumn extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function BasicColumn(){
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
		$basiccolumn = new HighChartPHP();
		$basiccolumn->chart->type = 'column';
		$basiccolumn->title->text = $tablename . " Basic Column";
		$basiccolumn->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$basiccolumn->xAxis->categories = $tablefields;
		$basiccolumn->yAxis->title->text = 'number';
		$basiccolumn->tooltip->headerFormat = '<span style="font-size:10px">{point.key}</span><table>';
		$basiccolumn->tooltip->pointFormat = '<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>';
		$basiccolumn->tooltip->footerFormat = '</table>';
		$basiccolumn->tooltip->useHTML = true;
		$basiccolumn->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['basiccolumn'] = $basiccolumn;
		
		$this->load->view('ColumnAndBarCharts/BasicColumn', $returnData);
	}
 
}

?>