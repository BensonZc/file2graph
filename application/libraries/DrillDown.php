<?php
class DrillDown{
	var $drilldown_array;
	
	public function __construct(){
		$drilldown_array = array();
	}
	
	public function setSeries($value){
		$this->drilldown_array['drilldown']['series'] = $value;
	}
	
	public function getDrillDown(){
		if(empty($this->drilldown_array)){
			return array();
		}else{
			return $this->drilldown_array;
		}
	}
}
?>