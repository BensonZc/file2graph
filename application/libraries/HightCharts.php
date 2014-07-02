<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class HighCharts{

	public function __construct(){
		$hightChartParams = new HightChartsParams();
	}
	
	public function set(){
		$this->HighChartsParams->Title->text = 'dklsajflksjdflaksjdfla';
	}
	
	public function get(){
		return $this->HighChartsParams->Title->text;
	}
}
?>