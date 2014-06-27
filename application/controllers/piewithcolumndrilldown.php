<?php
class piewithcolumndrilldown extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
		$this->load->library('highcharts');
	}
	
	function PieWithColumnDrillDown(){
		$divid = 'container'; //default
		
		$series = '';
		$series_item = '';
		$series_1 = '';
		$series_2 = '';
		$series_3 = '';
		
		$tablename = '';
		$tablefields = array();
		$tableallsum = array();
		$graphdata = array();
		$isuserdefine = $this->input->post('isuserdefine');
		
		if($isuserdefine == 'true'){
			//table name
			$tablename = $this->input->post('tablename');
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			//table some fileds data sum
			$tablefields = explode(',', $filed);
			//table all data sum
			$tableallsum = $this->commondata->get_all_sum($tablename, $tablefields);
			//table data
			$sql = "select " . $filed . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
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
		$this->highcharts->chart->setType('pie');
		$this->highcharts->title->setText($tablename . " Pie With Column DrillDown");
		$this->highcharts->subtitle->setText('Click the slices to view the proportion of column. Source: ' . $tablename);
		$this->highcharts->tooltip->setHeaderFormat('<span style="font-size:11px">{series.name}</span><br>');
		$this->highcharts->tooltip->setPointFormat('{series.name}: <b>{point.percentage:.1f}%</b>');
		$this->highcharts->plotoptions->setSeriesDataLabelsEnabled(true);
		//$this->highcharts->plotoptions->setSeriesShowInLegend(true);
		$this->highcharts->series->setPieRowDrillDown('Column Item', 'brandsData');
		$this->highcharts->drilldown->setSeries('drilldownSeries');
		$returnData['series'] = $series;
		$piewithrowdrilldown = str_replace("\"data\":\"brandsData\"", "\"data\":brandsData", $this->highcharts->generate($divid));
		$piewithrowdrilldown = str_replace("\"series\":\"drilldownSeries\"", "\"series\":drilldownSeries", $piewithrowdrilldown);
		
		$returnData['piewithcolumndrilldown'] = $piewithrowdrilldown;
		
		
		$this->load->view('PieCharts/PieWithColumnDrillDown', $returnData);
	}
 
}

?>