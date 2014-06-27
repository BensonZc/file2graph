<?php
/*
labels

HTML labels that can be positioined anywhere in the chart area.
*/
class Label{
	var $label_array;
	
	public function __construct(){
		$label_array = array();
	}
	
	/*
	html: String
	Inner HTML or text for the label.
	*/
	public function setItemHTML($value){
		$this->label_array['items']['html'] = $value;
	}
	
	/*
	style: CSSObject
	CSS styles for each label. To position the label, use left and top like this:
	
	style: {
		left: '100px',
		top: '100px'
	}
	*/
	public function setItemStyle($leftvalue, $topvalue){
		$this->label_array['items']['style']['left'] = $leftvalue;
		$this->label_array['items']['style']['top'] = $topvalue;
	}
	
	public function getLabel(){
		if(empty($this->label_array)){
			return array();
		}else{
			return $this->label_array;
		}
	}
}
?>