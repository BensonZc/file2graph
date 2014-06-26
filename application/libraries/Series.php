<?php
class Series{
	var $series_array;
	
	public function __construct(){
		$series_array = array();
	}
	
	/*
	
	$data is table data
	*/
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
	
	/*
    * set Pie chart data with rows sum.
    *
    * @param $allsum all rows sum
	* @param $rowsum rows data contains name and value.
	*/
	public function setPieRowsSumSeries($allsum, $rowsum){
		$this->series_array['series'][0]['type'] = 'pie';
		$this->series_array['series'][0]['name'] = 'Row Sum/Total';
		
		foreach($allsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
				
		foreach($rowsum as $rowsum_key => $rowsum_value){
			$this->series_array['series'][0]['data'][$rowsum_key][0] = $rowsum_value['rowname'];
			$this->series_array['series'][0]['data'][$rowsum_key][1] = $rowsum_value['rowsum']/$total * 100;
		}
	}
	
	/*
	* set Pie chart data with columns sum.
	*
	* @param $allsum all columns sum
	* @param $columnsum columns data sum
	* @param $fields table fields except first item
	*/
	public function setPieColumnSumSeries($allsum, $columnsum, $fields){
		$this->series_array['series'][0]['type'] = 'pie';
		$this->series_array['series'][0]['name'] = 'Column Sum/Total';
		
		foreach($allsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
		
		foreach($columnsum as $columnsum_key => $columnsum_value){
			for($i=0;$i<count($fields);$i++){
				$this->series_array['series'][0]['data'][$i][0] = "Sum of " . $fields[$i];
				$this->series_array['series'][0]['data'][$i][1] = $columnsum_value[$fields[$i]]/$total * 100;
			}
		}
	}
	
	/*
	* set Pie chart with row dirlldown.
	*/
	public function setPieRowDrillDown($name, $data){
		$this->series_array['series'][0]['name'] = $name;
		$this->series_array['series'][0]['data'] = $data;
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