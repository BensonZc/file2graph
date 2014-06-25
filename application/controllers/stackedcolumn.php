<?php
class stackedcolumn extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
		$this->load->library('jsexpression');
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
		$this->highcharts->chart->setType('column');
		$this->highcharts->title->setText($tablename . " Stacked Column");
		$this->highcharts->subtitle->setText('Source: ' . $tablename);
		array_shift($tablefields);
		$this->highcharts->xaxis->setCategories($tablefields);
		$this->highcharts->yaxis->setTitleText('number');
		$this->highcharts->plotoptions->setColumnStacking('normal');
		$this->highcharts->plotoptions->setSeriesDataLabelsEnabled(true);
		$this->highcharts->plotoptions->setSeriesDataLabelsColor('white');
		$this->highcharts->plotoptions->setSeriesDataLabelsStyleTextShadow('0 0 3px black, 0 0 3px black');
		$this->highcharts->series->setSeries($tabledata);
		
		$returnData['stackedcolumn'] = $this->highcharts->generate($divid);
		
		$this->load->view('ColumnAndBarCharts/StackedColumn', $returnData);
	}
 
}

?>