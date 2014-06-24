<?php
class Title{
	var $title_array;
	
	public function __construct(){
		$title_array = array();
	}
	
	public function setText($value){
		$this->title_array['title']['text'] = $value;
	}
	
	public function setX($value){
		$this->title_array['title']['x'] = $value;
	}
	
	public function getTitle(){
		if(empty($this->title_array)){
			return array();
		}else{
			return $this->title_array;
		}
	}
}
?>