<?php
require_once './HighChartPHP/HighChartPHP.php';

class GraphManager extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('initgraphdata');
	}
	
	function new_graph(){
		$tablename = $this->input->post('table_name');
		$is_user_define = $this->input->post('isuserdefine');
		$tabledata = array();

		$filed = "";
		$rows = "";
		
		$sliderbar = array(
				'Line Charts' => array(
					'Basic line',
					'Compare line',
				),
				'Area Charts' => array(
					'Basic area',
					'Stacked area',
					'Percentage area',
				),
				'Column and Bar Charts' => array(
					'Basic bar',
					'Stacked bar',
					'Basic column',
					'Stacked column',
					'Stacked percentage column'
				),
				'Pie Charts' => array(
					'Pie chart row sum',
					'Pie chart column sum',
					'Pie with row drilldown',
					'Pie with column drilldown'
				),
				'Combinations' => array(
					'Column Line and Pie'
				),
				'3D Charts' => array(
					'3D Column',
					'3D Scatter chart'
				),
				'Heat Map' => array(
					'Heat map'
				),
			);
		
		if($is_user_define == 'true'){
			//filed and rows is user defined.
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
		
		
		$querydata['sliderbar'] = $sliderbar;
		$querydata['tablename'] = $tablename;
		$querydata['filed'] = $filed;
		$querydata['rows'] = $rows;
		$querydata['isuserdefine'] = $is_user_define;
		
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
		
		$this->load->view('upload_data_graph', $querydata);
	}
	
	
	
	function HeatMap(){
		$graphdata = $this->common3DAndHeatChart();
		$this->load->view('HeatMap/HeatMap', $graphdata);
	}
	
	function common3DAndHeatChart(){
		$graphdata = array();
		$isuserdefine = $this->input->post('isuserdefine');
		if($isuserdefine == 'true'){
			$tablename = $this->input->post('tablename');
			
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			
			//table some fileds
			$tablefields = explode(',', $filed);
			//table data
			$sql = "select " . $filed . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table data
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		$graphdata = $this->initgraphdata->init3DScatterData($tablefields, $tabledata);
		$graphdata['tablename'] = $tablename;
		
		return $graphdata;
	}
	
	
}
?>