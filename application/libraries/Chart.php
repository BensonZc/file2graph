<?php
class Chart{
	var $chart_array;
	
	public function __construct(){
		$chart_array = array();
	}
	
	public function setType($value){
		$this->chart_array['chart']['type'] = $value;
	}
	
	public function getChart(){
		if(empty($this->chart_array)){
			return array();
		}else{
			return $this->chart_array;
		}
	}
}
?>