<?php
class YAxis{
	var $yaxis_array;
	
	public function __construct(){
		$yaxis_array = array();
	}
	
	public function setTitleText($value){
		$this->yaxis_array['yAxis']['title']['text'] = $value;
	}
	
	/*
	formatter: Function
	Callback JavaScript function to format the label. The value is given by this.value. Additional properties for this are axis, chart, isFirst and isLast. 
	Defaults to:
	function() {
		return this.value;
	}
	*/
	public function setLabelsFormatter($value){
		$this->yaxis_array['yAxis']['labels']['formatter'] = $value;
	}
	
	/*
	categories: Array
	If categories are present for the xAxis, names are used instead of numbers for that axis. Since Highcharts 3.0, categories can also be extracted by giving each point a name and setting axis type to "category".

	Defaults to null
	*/
	public function setCategories($value){
		$this->yaxis_array['yAxis']['categories'] = $value;
	}
	
	public function getYAxis(){
		if(empty($this->yaxis_array)){
			return array();
		}else{
			return $this->yaxis_array;
		}
	}
}
?>