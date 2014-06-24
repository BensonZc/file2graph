<?php
class Legend{
	var $legend_array;
	
	public function __construct(){
		$legend_array = array();
	}
	
	public function setLayout($value){
		$this->legend_array['legend']['layout'] = $value;
	}
	
	public function setAlign($value){
		$this->legend_array['legend']['align'] = $value;
	}
	
	public function setVerticalAlign($value){
		$this->legend_array['legend']['verticalAlign'] = $value;
	}
	
	public function setBorderWidth($value){
		$this->legend_array['legend']['borderWidth'] = $value;
	}
	
	public function getLegend(){
		if(empty($this->legend_array)){
			return array();
		}else{
			return $this->legend_array;
		}
	}
}
?>