<?php
require 'SeriesOptions.php';

class HighChartPHP{
	
	/**
	 * json array for return result
	 *
	 * @var array
	 */
	private $options = array();
	
	/**
	 * div's id for graph
	 *
	 * @var string
	 */
	private $divid;
	
	public function __construct($divid = 'container'){
		$this->divid = $divid;
		
	}
	
	/**
	 * Return JavaScript script
	 *
	 */
	public function render(){
		$result = json_encode($this);
		if (isset($this->tooltip->formatter)) {
			$result = str_replace('"' . $this->tooltip->formatter . '"', $this->tooltip->formatter, $result);
		}
		return $result;
	}
	
	/**
	 * Return JavaScript reference file
	 *
	 */
	public function buildJs($object = null){
		$highchart_js = '<script type="text/javascript">';
		//$highchart_js .= '$(function(){';
		if(empty($object)){
			$highchart_js .= "$('#" . $this->divid . "').highcharts(";
		}else{
			$highchart_js .= "var " . $object . ' = ';
			$highchart_js .= "new Highcharts.Chart(";
		}
		
		$highchart_js .= $this->render();
		$highchart_js .= ")</script>";
		
		return $highchart_js;
	}
	
	/**
	 * 
	 * 
	 */
	public function setSeries($data = null, $fiels = null){
		$this->series->setSeries($data);
	}
	
}
?>