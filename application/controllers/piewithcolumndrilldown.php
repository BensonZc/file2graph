<?php
require_once './HighChartPHP/HighChartPHP.php';

class piewithcolumndrilldown extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function PieWithColumnDrillDown(){	
		$series = '';
		$series_item = '';
		$series_1 = '';
		$series_2 = '';
		$series_3 = '';
		
		$tablename = '';
		$tablefields = array();
		$tableallsum = array();
		$graphdata = array();
		$isuserdefine = $this->session->userdata('isuserdefine');
		$tablename = $this->session->userdata('tablename');
		
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
		
		$column_sum = array();
		
		foreach($tableallsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
		
		foreach($tabledata as $data_item){
			for($i=0;$i<count($tablefields);$i++){
				if($i==0){
					$series_2 = $data_item[$tablefields[0]];
				}else{
					$series_1 = $tablefields[$i];
					$series_3 = $data_item[$tablefields[$i]]/$total*100 . "%";
					
					$series_item = $series_1 . "," . $series_2 . " " . $series_3 . "\n";
				}
				
				$series = $series . $series_item;
			}
		}
		
		//set highchart property
		$piewithcolumndrilldown = new HighChartPHP();
		
		$piewithcolumndrilldown->chart->type = 'pie';
		$piewithcolumndrilldown->title->text = $tablename . " Pie With Column DrillDown";
		$piewithcolumndrilldown->subtitle->text = 'Click the slices to view the proportion of column. Source: ' . $tablename;
		$piewithcolumndrilldown->tooltip->headerFormat = '<span style="font-size:11px">{series.name}</span><br>';
		$piewithcolumndrilldown->tooltip->pointFormat = '{series.name}: <b>{point.percentage:.1f}%</b>';
		$piewithcolumndrilldown->plotOptions->series->dataLabels->enabled = true;
		$piewithcolumndrilldown->series = SeriesOptions::setPieDrillDown('Column Item', 'brandsData');
		$piewithcolumndrilldown->drilldown->series = 'drilldownSeries';
		
		$returnData['seriesdata'] = $series;
		$returnData['piewithcolumndrilldown'] = $piewithcolumndrilldown;
		
		$this->load->view('f2g_header');
		$this->load->view('PieCharts/PieWithColumnDrillDown', $returnData);
	}
 
}

?>