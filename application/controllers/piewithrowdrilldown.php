<?php
require_once './HighChartPHP/HighChartPHP.php';

class piewithrowdrilldown extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function PieWithRowDrillDown(){
		$series = '';
		$series_item = '';
		$series_1 = '';
		$series_2 = '';
		$series_3 = '';
		
		$tablename = $this->session->userdata('tablename');
		$tablefields = array();
		$tableallsum = array();
		$graphdata = array();
		$isuserdefine = $this->session->userdata('isuserdefine');
		
		if($isuserdefine == 'true'){			
			$fields = $this->session->userdata('fields');
			$rows = $this->session->userdata('rows');
			//table some fileds data sum
			$tablefields = explode(',', $fields);
			//table all data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table data
			$sql = "select " . $fields . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else{
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table all data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table all data
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		
		foreach($tableallsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
		
		foreach($tabledata as $data_item){
			for($i=0;$i<count($tablefields);$i++){
				if($i==0){
					$series_1 = $data_item[$tablefields[0]];
				}else{
					$series_2 = $tablefields[$i];
					$series_3 = $data_item[$tablefields[$i]]/$total*100 . "%";
					
					$series_item = $series_1 . "," . $series_2 . " " . $series_3 . "\n";
				}
				
				$series = $series . $series_item;
			}
		}
		
		//set highchart property
		$piewithrowdrilldown = new HighChartPHP();
		$piewithrowdrilldown->chart->type = 'pie';
		$piewithrowdrilldown->title->text = $tablename . " Pie With Rows DrillDown";
		$piewithrowdrilldown->subtitle->text = 'Click the slices to view the proportion of row. Source: ' . $tablename;
		$piewithrowdrilldown->tooltip->headerFormat = '<span style="font-size:11px">{series.name}</span><br>';
		$piewithrowdrilldown->tooltip->pointFormat = '{series.name}: <b>{point.percentage:.1f}%</b>';
		$piewithrowdrilldown->plotOptions->series->dataLabels->enabled = true;
		$piewithrowdrilldown->series = SeriesOptions::setPieDrillDown('Row Item', 'brandsData');
		$piewithrowdrilldown->drilldown->series = 'drilldownSeries';
		
		$returnData['seriesdata'] = $series;
		$returnData['piewithrowdrilldown'] = $piewithrowdrilldown;
		
		$this->load->view('f2g_header');
		$this->load->view('PieCharts/PieWithRowDrillDown', $returnData);
	}
 
}

?>