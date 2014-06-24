<?php
class basicline extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function Basicline(){
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
		$this->highcharts->title->setText($tablename . " Compare Line Chart");
		$this->highcharts->title->setX(-20);
		$this->highcharts->subtitle->setText('Source: ' . $tablename);
		$this->highcharts->subtitle->setX(-20);
		array_shift($tablefields);
		$this->highcharts->xaxis->setCategories($tablefields);
		$this->highcharts->yaxis->setTitleText('');
		$this->highcharts->tooltip->setValueSuffix('');
		$this->highcharts->legend->setLayout('vertical');
		$this->highcharts->legend->setAlign('right');
		$this->highcharts->legend->setVerticalAlign('middle');
		$this->highcharts->legend->setBorderWidth(0);
		$this->highcharts->series->setSeries($tabledata);
		
		$returnData['basicline'] = $this->highcharts->generate($divid);
		
		$this->load->view('LineCharts/BasicLine', $returnData);
	}
 
}

?>