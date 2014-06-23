<?php
class ToolTip{
	var $tooltip_array;
	
	public function __construct(){
		$tooltip_array = array();
	}
	
	public function setValueSuffix($value){
		$this->tooltip_array['tooltip']['valueSuffix'] = $value;
	}
	
	public function getToolTip(){
		return $this->tooltip_array;
	}
}
?>