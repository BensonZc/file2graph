<?php
class stackedarea extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function StackedArea(){
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
		$this->highcharts->chart->setType('area');
		$this->highcharts->title->setText($tablename . " Stacked Area Chart");
		$this->highcharts->subtitle->setText('Source: ' . $tablename);
		array_shift($tablefields);
		$this->highcharts->xaxis->setCategories($tablefields);
		$this->highcharts->yaxis->setTitleText('');
		$this->highcharts->tooltip->setShared(true);
		$this->highcharts->plotoptions->setAreaStacking('normal');
		$this->highcharts->plotoptions->setAreaMarkerLineWidth(1);
		$this->highcharts->plotoptions->setAreaMarkerLineColor('#666666');
		$this->highcharts->series->setSeries($tabledata);
		
		$returnData['stackedarea'] = $this->highcharts->generate($divid);
		
		$this->load->view('AreaCharts/StackedArea', $returnData);
	}
 
}

?>