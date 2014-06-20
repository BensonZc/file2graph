<?php 
class HighCharts{
	var $CI;
	
	function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->library('title');
	}
	
	public function setTitleText($value){
		$this->CI->title->setText($value);
	}
	
	public function setTitleX($value){
		$this->CI->title->setX($value);
	}
	
	public function generate(){
		return $this->CI->title->getTitle();
	}
}
?>