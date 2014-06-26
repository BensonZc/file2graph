<?php
class piechartrowsum extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function PieChartRowSum(){
		$divid = 'container'; //default
		$tablename = '';
		$tablefields = array();
		$tableallsum = array();
		$tablerowsum = array();
		$isuserdefine = $this->input->post('isuserdefine');
		
		if($isuserdefine == 'true'){
			//table name
			$tablename = $this->input->post('tablename');
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			//table some fileds data sum
			$tablefields = explode(',', $filed);
			//table some data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table some rows data sum
			$tablerowsum = $this->commondata->get_some_row_sum($tablename, $tablefields, $rows);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table all data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table row data sum
			$tablerowsum = $this->commondata->get_all_row_sum($tablename, $tablefields);
		}
		
		//set highchart property
		
		$this->highcharts->title->setText($tablename . " Pie Chart Rows Sum");
		$this->highcharts->subtitle->setText('Source: ' . $tablename);
		$this->highcharts->tooltip->setPointFormat('{series.name}: <b>{point.percentage:.1f}%</b>');
		$this->highcharts->plotoptions->setSeriesAllowPointSelect(true);
		$this->highcharts->plotoptions->setSeriesCursor('pointer');
		$this->highcharts->plotoptions->setSeriesDataLabelsEnabled(false);
		$this->highcharts->plotoptions->setSeriesShowInLegend(true);
		$this->highcharts->series->setPieRowsSumSeries($tableallsum, $tablerowsum);
		
		$returnData['piechartrowsum'] = $this->highcharts->generate($divid);
		

		$this->load->view('PieCharts/PieChartRowSum', $returnData);
	}
 
}

?>