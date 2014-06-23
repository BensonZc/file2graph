<?php
class SubTitle{
	var $sub_title_array;
	
	public function __construct(){
		$sub_title_array = array();
	}
	
	public function setText($value){
		$this->title_array['subtitle']['text'] = $value;
	}
	
	public function setX($value){
		$this->title_array['subtitle']['x'] = $value;
	}
	
	public function getSubTitle(){
		return json_encode($this->sub_title_array);
	}
}
?>