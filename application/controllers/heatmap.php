<?php
require_once './HighChartPHP/HighChartPHP.php';

class heatmap extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	//3D Scatter chart
	function HeatMap(){
		$y_array = array();
		$returnData = array();
		
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
		
		foreach($tabledata as $data_key => $data_item){
			array_push($y_array, $data_item[$tablefields[0]]);
		}
		
		//set highchart property
		$heatmap = new HighChartPHP();
		
		$heatmap->chart->marginTop = 70;
		$heatmap->chart->marginBottom = 40;
		$heatmap->chart->type = 'heatmap';
		$heatmap->title->text = $tablename . ' Heat Map';
		$heatmap->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$heatmap->xAxis->categories = $tablefields;
		$heatmap->yAxis->categories = $y_array;
		$heatmap->colorAxis->min = 0;
		$heatmap->colorAxis->minColor = '#FFFFFF';
		$heatmap->legend = array(
									'align' => 'right',
									'layout' => 'vertical',
									'margin' => 0,
									'verticalAlign' => 'top',
									'y' => 25,
									'symbolHeight' => 320);
		$heatmap->tooltip->formatter = "function (){return this.series.xAxis.categories[this.point.x]+'  '+this.series.yAxis.categories[this.point.y]+'  '+this.point.value;}";
		
		$heatmap->series = SeriesOptions::setHeatMapSeries($tabledata, $tablefields);

		$returnData['heatmap'] = $heatmap;		
		
		$this->load->view('HeatMap/HeatMap', $returnData);
	}
}

?>