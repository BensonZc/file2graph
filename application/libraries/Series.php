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
			
			$this->series_array['series'][$data_key]['name'] = $data_item['Column0'];
			
			//delete first element.
			array_shift($data_item);
			foreach($data_item as $data_value){
				array_push($series_data, floatval($data_value));
			}
			$this->series_array['series'][$data_key]['data'] = array_values($series_data);
		}
	}
	
	public function getSeries(){
		return json_encode($this->series_array);
	}
}
?>