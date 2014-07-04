<?php
require_once './HighChartPHP/HighChartPHP.php';

class GraphManager extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('initgraphdata');
		$this->load->library('session');
	}
	
	function new_graph(){
		$tablename = $this->input->post('table_name');
		$is_user_define = $this->input->post('isuserdefine');
		$tabledata = array();

		$fields = "";
		$rows = "";
		
		if($is_user_define == 'true'){
			//filed and rows is user defined.
			$fields = $this->input->post('fields');
			$rows = $this->input->post('rows');
			
			//get table fields via user defined.
			$tablefields = explode(',', $filed);
			
			//get data via sql.
			$sql = "select " . $fields . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else if($is_user_define == 'false'){
			//get all table fields.
			$tablefields = $this->commondata->get_table_fields($tablename);
			
			//get all data.
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		
		$session_array = array(
						'tablename' => $tablename,
						'isuserdefine' => $is_user_define,
						'fields' => $fields,
						'rows' => $rows);
		
		$this->session->set_userdata($session_array);
		
		$basicline = new HighChartPHP('maincontainer');
		$basicline->title->text = $tablename . " Basic Line Chart";
		$basicline->title->x = -20;
		$basicline->subtitle->text = 'Source: ' . $tablename;
		$basicline->subtitle->x = -20;
		array_shift($tablefields);
		$basicline->xAxis->categories = $tablefields;
		$basicline->yAxis->title->text = '';
		$basicline->tooltip->valueSuffix = '';
		$basicline->series = SeriesOptions::setSeries($tabledata);
		
		$querydata['basicline'] = $basicline;
		
		$this->load->view('f2g_header');
		$this->load->view('LineCharts/BasicLine', $querydata);
	}
}
?>