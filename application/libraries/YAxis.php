<?php
class YAxis{
	var $yaxis_array;
	
	public function __construct(){
		$yaxis_array = array();
	}
	
	/*$value is array*/
	public function setTitleText($value){
		$this->yaxis_array['yAxis']['title']['text'] = $value;
	}
	
	public function getYAxis(){
		return json_encode($this->yaxis_array);
	}
}
?>