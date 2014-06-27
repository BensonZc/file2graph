<?php
class threedcolumn extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function ThreeDColumn(){
		$divid = 'container'; //default
		
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
		$this->highcharts->chart->setType('column');
		$this->highcharts->chart->setRenderTo($divid);
		$this->highcharts->chart->setMargin(75);
		$this->highcharts->chart->setOptions3d(true, 15, 15, 40, 25);
		$this->highcharts->title->setText($tablename . " 3D Column");
		$this->highcharts->subtitle->setText('Source: ' . $tablename);
		array_shift($tablefields);
		$this->highcharts->xaxis->setCategories($tablefields);
		$this->highcharts->tooltip->setHeaderFormat('<b>{point.key}</b><br>');
		$this->highcharts->tooltip->setPointFormat('<span style="color:{series.color}"></span> {series.name}: {point.y}');
		$this->highcharts->plotoptions->setColumnDepth(25);
		$this->highcharts->series->setSeries($tabledata);
		
		$returnData['threedcolumn'] = $this->highcharts->generateWithObject();

		$this->load->view('3DCharts/3DColumn', $returnData);
	}
 
}

?>