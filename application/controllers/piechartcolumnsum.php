<?php
class piechartcolumnsum extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function PieChartColumnSum(){
		$divid = 'container'; //default
		$tablename = '';
		$tablefields = array();
		$tableallsum = array();
		$tablecolumn = array();
		$isuserdefine = $this->input->post('isuserdefine');
		
		if($isuserdefine == 'true'){
			//table name
			$tablename = $this->input->post('tablename');
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			//table some fileds
			$tablefields = explode(',', $filed);
			//table some data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table some column data sum
			$tablecolumn = $this->commondata->get_all_column_sum($tablename, $tablefields, $rows);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table all data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table column data sum
			$tablecolumn = $this->commondata->get_all_column_sum($tablename, $tablefields);
		}
		
		//set highchart property
		
		$this->highcharts->title->setText($tablename . " Pie Chart Column Sum");
		$this->highcharts->subtitle->setText('Source: ' . $tablename);
		$this->highcharts->tooltip->setPointFormat('{series.name}: <b>{point.percentage:.1f}%</b>');
		$this->highcharts->plotoptions->setSeriesAllowPointSelect(true);
		$this->highcharts->plotoptions->setSeriesCursor('pointer');
		$this->highcharts->plotoptions->setSeriesDataLabelsEnabled(false);
		$this->highcharts->plotoptions->setSeriesShowInLegend(true);
		array_shift($tablefields);
		$this->highcharts->series->setPieColumnSumSeries($tableallsum, $tablecolumn, $tablefields);
		
		$returnData['piechartcolumnsum'] = $this->highcharts->generate($divid);

		$this->load->view('PieCharts/PieChartColumnSum', $returnData);
	}
 
}

?>