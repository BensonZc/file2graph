<?php

class SeriesOptions{
	
	/**
	 * Set common series data
	 * 
	 * @param Table data $data
	 * @return series array
	 */
	public static function setSeries($data){
		$series_array = array();
	
		//prepare data
		foreach($data as $data_key => $data_item){
			$series_data = array();
			$first_column = array_shift($data_item);
			
			$series_array[$data_key]['name'] = $first_column;
			
			//delete first element.
			foreach($data_item as $data_value){
				array_push($series_data, floatval($data_value));
			}
			$series_array[$data_key]['data'] = array_values($series_data);
		}
		
		//return series array
		return $series_array;
	}
}