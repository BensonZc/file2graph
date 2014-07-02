<?php
require_once './HighChartPHP/HighChartPHP.php';

class threedcolumn extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('commondata');
	}
	
	function ThreeDColumn(){		
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
		$threedcolumn = new HighChartPHP();
		$threedcolumn->chart->type = 'column';
		$threedcolumn->chart->renderTo = $divid;
		$threedcolumn->chart->margin = 75;
		$threedcolumn->chart->options3d = array(
				"enabled" => true,
				"alpha" => 15,
				"beta" =>15,
				"depth" => 40,
				"viewDistance" => 25
			);
		$threedcolumn->title->text = $tablename . " 3D Column";
		$threedcolumn->subtitle->text = 'Source: ' . $tablename;
		array_shift($tablefields);
		$threedcolumn->xaxis->categories = $tablefields;
		$threedcolumn->tooltip->headerFormat = '<b>{point.key}</b><br>';
		$threedcolumn->tooltip->pointFormat = '<span style="color:{series.color}"></span> {series.name}: {point.y}';
		$threedcolumn->plotoptions->column->depth = 25;
		$threedcolumn->series = SeriesOptions::setSeries($tabledata);
		
		$returnData['threedcolumn'] = $threedcolumn;

		$this->load->view('3DCharts/3DColumn', $returnData);
	}
 
}

?>