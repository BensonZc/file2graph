<?php
class Series{
	var $series_array;
	
	public function __construct(){
		$series_array = array();
	}
	
	/*$data is table data*/
	public function setSeries($data){
		
		foreach($data as $data_key => $data_item){
			$series_data = array();
			$first_column = array_shift($data_item);
			
			$this->series_array['series'][$data_key]['name'] = $first_column;
			
			//delete first element.
			foreach($data_item as $data_value){
				array_push($series_data, floatval($data_value));
			}
			$this->series_array['series'][$data_key]['data'] = array_values($series_data);
		}
	}
	
	public function getSeries(){
		if(empty($this->series_array)){
			return array();
		}else{
			return $this->series_array;
		}
	}
}
?>