<?php
class XAxis{
	var $xaxis_array;
	
	public function __construct(){
		$xaxis_array = array();
	}
	
	/*$value is array*/
	public function setCategories($value = array()){
		$this->xaxis_array['xAxis']['categories'] = $value;
	}
	
	public function getXAxis(){
		if(empty($this->xaxis_array)){
			return array();
		}else{
			return $this->xaxis_array;
		}
	}
}
?>