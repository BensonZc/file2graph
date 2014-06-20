<?php
class Title{
	var $title_array = array();
	
	public function __construct(){
		
	}
	
	public function setText($value){
		$this->title_array['text'] = $value;
	}
	
	public function setX($value){
		$this->title_array['x'] = $value;
	}
	
	public function getTitle(){
		return json_encode($this->title_array);
	}
}
?>