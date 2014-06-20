<?php
require_once './phpexcel/PHPExcel.php';

class GraphManager extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('commondata');
		$this->load->library('initgraphdata');
		$this->load->library('highcharts');
	}
	
	function new_graph(){
		$tablename = $this->input->post('table_name');
		$is_user_define = $this->input->post('isuserdefine');
		$result_array = array();
		$series_name = "";
		$series_data = "";
		$series = "";
		$chart_x = "";
		$chart_y = "";
		$filed = "";
		$rows = "";
		
		$sliderbar = array(
				'Line Charts' => array(
					'Basic line',
					'Compare line',
				),
				'Area Charts' => array(
					'Basic area',
					'Stacked area',
					'Percentage area',
				),
				'Column and Bar Charts' => array(
					'Basic bar',
					'Stacked bar',
					'Basic column',
					'Stacked column',
					'Stacked percentage column'
				),
				'Pie Charts' => array(
					'Pie chart row sum',
					'Pie chart column sum',
					'Pie with row drilldown',
					'Pie with column drilldown'
				),
				'Combinations' => array(
					'Column Line and Pie'
				),
				'3D Charts' => array(
					'3D Column',
					'3D Scatter chart'
				),
				'Heat Map' => array(
					'Heat map'
				),
			);
		
		if($is_user_define == 'true'){
			/*
			1.create a sql query.
			2.get data by sql.
			3.return result data array.
			4.set chart x.
			5.set chart y.
			*/
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			
			$tablefields = explode(',', $filed);
			$sql = "select " . $filed . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$result_array = $this->commondata->get_table_sql($sql);
			
			for($i=0;$i<count($tablefields);$i++){
				if($i==0){
				}else{
					$chart_x = $chart_x . "'" . $tablefields[$i] . "',";
				}
			}
			
			foreach($result_array as $result_array_items){
				$series_value = "";
				for($i=0;$i<count($tablefields);$i++){
					if($i==0){
						$series_name = "{ name: '" . $result_array_items[$tablefields[$i]] . "',";
					}else{
						$series_value = $series_value . $result_array_items[$tablefields[$i]] . ",";					
					}
					$series_data = "data: [" . $series_value . "] },";
				}
				$series = $series . $series_name . $series_data;
			}
			$chart_y = $series;
		}else if($is_user_define == 'false'){
			/*
			1.get all data from DB.
			2.set chart x.
			3.set chart y.
			*/
			$result_array = $this->commondata->get_all_data($tablename);
			
			/*
			get fileds from table
			[tablefields] database table fields for chart
			*/
			$tablefields = $this->commondata->get_table_fields($tablename);
			for($i=0;$i<count($tablefields);$i++){
				if($i==0){
				}else{
					$chart_x = $chart_x . "'" . $tablefields[$i] . "',";
				}
			}
			
			/*
			get all data
			*/
			$filedata = $this->commondata->get_all_data($tablename);
			foreach($filedata as $filedata_items){
				$series_value = "";
				for($i=0;$i<count($tablefields);$i++){
					if($i==0){
						$series_name = "{ name: '" . $filedata_items[$tablefields[$i]] . "',";
					}else{
						$series_value = $series_value . $filedata_items[$tablefields[$i]] . ",";					
					}
					$series_data = "data: [" . $series_value . "] },";
				}
				$series = $series . $series_name . $series_data;
			}
			$chart_y = $series;
		}
		
		$querydata['chart_x'] = rtrim($chart_x, ",");
		$querydata['chart_y'] = rtrim($chart_y, ",");
		$querydata['sliderbar'] = $sliderbar;
		$querydata['tablename'] = $tablename;
		$querydata['filed'] = $filed;
		$querydata['rows'] = $rows;
		$querydata['isuserdefine'] = $is_user_define;
		$querydata['filedata'] = $filedata;
		$querydata['json'] = $this->commondata->get_json_data($tablename);
		$querydata['array'] = $this->commondata->get_array_data();
		
		$this->highcharts->setTitleText('this is text');
		$this->highcharts->setTitleX(-20);
		
		$querydata['test'] = "test: " . $this->highcharts->generate();
		
		$this->load->view('upload_data_graph', $querydata);
	}

	//Basic Line Chart
	function Basicline(){	
		$graphdata = $this->commonChart();
		$this->load->view('LineCharts/BasicLine', $graphdata);
	}
	
	//Compare Line Chart
	function Compareline(){	
		$graphdata = $this->commonChart();
		$this->load->view('LineCharts/CompareLine', $graphdata);
	}
	
	//Basic Area Chart
	function BasicArea(){	
		$graphdata = $this->commonChart();
		$this->load->view('AreaCharts/BasicArea', $graphdata);
	}
	
	//Stacked Area Chart
	function StackedArea(){		
		$graphdata = $this->commonChart();
		$this->load->view('AreaCharts/StackedArea', $graphdata);
	}
	
	//Percentage Area Chart
	function PercentageArea(){	
		$graphdata = $this->commonChart();
		$this->load->view('AreaCharts/PercentageArea', $graphdata);
	}
	
	//Basic Bar Chart
	function BasicBar(){	
		$graphdata = $this->commonChart();
		$this->load->view('ColumnAndBarCharts/BasicBar', $graphdata);
	}
	
	//Basic Bar Chart
	function StackedBar(){	
		$graphdata = $this->commonChart();
		$this->load->view('ColumnAndBarCharts/StackedBar', $graphdata);
	}
	
	//Basic Column Chart
	function BasicColumn(){		
		$graphdata = $this->commonChart();
		$this->load->view('ColumnAndBarCharts/BasicColumn', $graphdata);
	}
	
	//Stacked Column Chart
	function StackedColumn(){	
		$graphdata = $this->commonChart();
		$this->load->view('ColumnAndBarCharts/StackedColumn', $graphdata);
	}
	
	//Stacked Percentage Column Chart
	function StackedPercentageColumn(){
		$graphdata = $this->commonChart();
		$this->load->view('ColumnAndBarCharts/StackedPercentageColumn', $graphdata);
	}
	
	//Pie Chart Row Sum
	function PieChartRowSum(){	
		$tablename = '';
		$tablefields = array();
		$tableallsum = array();
		$tablerowsum = array();
		$graphdata = array();
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
		
		$graphdata = $this->initgraphdata->initPieRowSumData($tableallsum, $tablerowsum);
		$graphdata['tablename'] = $tablename;
		
		$this->load->view('PieCharts/PieChartRowSum', $graphdata);
	}
	
	//Pie Chart Column Sum
	function PieChartColumnSum(){		
		$tablename = '';
		$tablefields = array();
		$tableallsum = array();
		$tablecolumn = array();
		$graphdata = array();
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
		
		$graphdata = $this->initgraphdata->initPieColumnSumData($tableallsum, $tablecolumn, $tablefields);
		$graphdata['tablename'] = $tablename;

		$this->load->view('PieCharts/PieChartColumnSum', $graphdata);
	}
	
	//Pie Chart Row Drill Down
	function PieWithRowDrillDown(){
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
		
		$graphdata = $this->initgraphdata->initPieRowDrillDownData($tableallsum, $tabledata, $tablefields);
		$graphdata['tablename'] = $tablename;
		
		$this->load->view('PieCharts/PieWithRowDrillDown', $graphdata);
	}
	
	//Pie Chart Column Drill Down
	function PieWithColumnDrillDown(){
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
		
		$graphdata = $this->initgraphdata->initPieColumnDrillDownData($tableallsum, $tabledata, $tablefields);
		$graphdata['tablename'] = $tablename;
		
		$this->load->view('PieCharts/PieWithColumnDrillDown', $graphdata);
	}
	
	//Combinations charts:Column,Line,Pie
	function ColumnLineAndPie(){
		$graphdata = array();
		$isuserdefine = $this->input->post('isuserdefine');
		
		if($isuserdefine == 'true'){
			//table name
			$tablename = $this->input->post('tablename');
			
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			
			//table some fileds
			$tablefields = explode(',', $filed);
			//table some rows data sum
			$tablerowsum = $this->commondata->get_some_row_sum($tablename, $tablefields, $rows);
			//table data
			$sql = "select " . $filed . " from " . $tablename . " where " . $tablefields[0] . " in (" . $rows . ")";
			$tabledata = $this->commondata->get_table_sql($sql);
		}else{
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
			$tablefields = $this->commondata->get_table_fields($tablename);
			//table row data sum
			$tablerowsum = $this->commondata->get_all_row_sum($tablename, $tablefields);
			//table all data
			$tabledata = $this->commondata->get_all_data($tablename);
		}
		
		$graphdata = $this->initgraphdata->initCombinationsColumnLinePieData($tablefields, $tabledata, $tablerowsum);
		$graphdata['tablename'] = $tablename;
		
		$this->load->view('Combinations/ColumnLineAndPie', $graphdata);
	}
	
	//3D Column
	function ThreeDColumn(){
		$graphdata = $this->commonChart();
		$this->load->view('3DCharts/3DColumn', $graphdata);
	}
	
	//3D Scatter chart
	function ThreeDScatterChart(){
		$graphdata = $this->common3DAndHeatChart();
		$this->load->view('3DCharts/3DScatterChart', $graphdata);
	}
	
	function HeatMap(){
		$graphdata = $this->common3DAndHeatChart();
		$this->load->view('HeatMap/HeatMap', $graphdata);
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
	
	function commonChart(){
		$tabledata = array();
		$tablefields = array();
		$isuserdefine = $this->input->post('isuserdefine');
		$graphdata = array();
		
		if($isuserdefine == 'true'){
			$filed = $this->input->post('filed');
			$rows = $this->input->post('rows');
			//table name
			$tablename = $this->input->post('tablename');
			//table fields
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
		$graphdata = $this->initgraphdata->initBasicData($tablename, $tablefields, $tabledata);
		$graphdata['tablename'] = $tablename;
		
		return $graphdata;
	}
}
?>