<?php
class threedscatterchart extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('initgraphdata');
		$this->load->library('highcharts');
	}
	
	//3D Scatter chart
	function ThreeDScatterChart(){
		$graphdata = $this->common3DAndHeatChart();
		$this->load->view('3DCharts/3DScatterChart', $graphdata);
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