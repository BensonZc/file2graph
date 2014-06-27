<?php
class ZAxis{
	var $zaxis_array;
	
	public function __construct(){
		$zaxis_array = array();
	}
	
	public function setMin($value){
		$this->zaxis_array['zAxis']['min'] = $value;
	}
	
	public function setMax($value){
		$this->zaxis_array['zAxis']['max'] = $value;
	}
	
	public function getZAxis(){
		if(empty($this->zaxis_array)){
			return array();
		}else{
			return $this->zaxis_array;
		}
	}
}
?>