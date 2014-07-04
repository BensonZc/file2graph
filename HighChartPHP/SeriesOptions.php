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
	
	/**
	 * Set Pie row sum data
	 *
	 * @param $allsum all rows sum
	 * @param $rowsum rows data contains name and value.
	 * @return series array
	 */
	public static function setPieRowsSumSeries($allsum, $rowsum){
		$series_array = array();
		
		$series_array[0]['type'] = 'pie';
		$series_array[0]['name'] = 'Row Sum/Total';
		
		foreach($allsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
				
		foreach($rowsum as $rowsum_key => $rowsum_value){
			$series_array[0]['data'][$rowsum_key][0] = $rowsum_value['rowname'];
			$series_array[0]['data'][$rowsum_key][1] = $rowsum_value['rowsum']/$total * 100;
		}
		
		return $series_array;
	}
	
	/**
	 * set Pie chart data with columns sum.
	 *
	 * @param $allsum all columns sum
	 * @param $columnsum columns data sum
	 * @param $fields table fields except first item
	 * @return series array
	 */
	public function setPieColumnSumSeries($allsum, $columnsum, $fields){
		$series_array = array();
		$series_array[0]['type'] = 'pie';
		$series_array[0]['name'] = 'Column Sum/Total';
		
		foreach($allsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
		
		foreach($columnsum as $columnsum_key => $columnsum_value){
			for($i=0;$i<count($fields);$i++){
				$series_array[0]['data'][$i][0] = "Sum of " . $fields[$i];
				$series_array[0]['data'][$i][1] = $columnsum_value[$fields[$i]]/$total * 100;
			}
		}
		
		return $series_array;
	}
	
	/**
	 * set Pie chart with row dirlldown.
	 *
	 * @param part description $name
	 * @param from 'pre' element $data
	 * @return series array
	 */
	public static function setPieDrillDown($name, $data){
		$series_array = array();
		$series_array[0]['name'] = $name;
		$series_array[0]['data'] = $data;
		return $series_array;
	}
	
	/**
	 * set combination chart.
	 *
	 * @param tabledata $data
	 * @param tablefields $fields
	 * @param rows of sum $rowsum
	 * @return series array
	 */
	public function setCombination($data, $fields, $rowsum){
		$series_array = array();
		
		//column data
		foreach($data as $data_key => $data_item){
			$series_data = array();
			$first_column = array_shift($data_item);
			$series_array[$data_key]['type'] = 'column';
			$series_array[$data_key]['name'] = $first_column;
			
			//delete first element.
			foreach($data_item as $data_value){
				array_push($series_data, floatval($data_value));
			}
			$series_array[$data_key]['data'] = array_values($series_data);
		}
				
		//spline data
		$ave_data_array = array();
		for($i=0;$i<count($fields);$i++){
			$column_sum = '';
			foreach($data as $data_items){
				$column_sum = $column_sum + $data_items[$fields[$i]];
			}
			array_push($ave_data_array, $column_sum/count($data));
		}
		$series_array[$data_key+1]['type'] = 'spline';
		$series_array[$data_key+1]['name'] = 'Average';
		$series_array[$data_key+1]['data'] = $ave_data_array;
		
		//pie data
		$series_array[$data_key+2]['type'] = 'pie';
		$series_array[$data_key+2]['name'] = 'Sum of Rows';
				
		foreach($rowsum as $rowsum_key => $rowsum_value){
			$series_array[$data_key+2]['data'][$rowsum_key]['name'] = $rowsum_value['rowname'];
			$series_array[$data_key+2]['data'][$rowsum_key]['y'] = (float)$rowsum_value['rowsum'];
		}
		$series_array[$data_key+2]['center'] = array(100, 10);
		$series_array[$data_key+2]['size'] = 100;
		$series_array[$data_key+2]['showInLegend'] = false;
		$series_array[$data_key+2]['dataLabels']['enabled'] = false;
		
		return $series_array;
	}
	
	/**
	 * for scatter chart
	 * 
	 * @param table data $data
	 * @param table fields $fields
	 * @return series array
	 */
	public function setPointSeries($data, $fields){
		$series_array = array();
		
		$series_array[0]['name'] = 'Point';
		$series_array[0]['colorByPoint'] = true;
		
		
		$point_series = array();
		
		for($j=0;$j<count($data);$j++){
			for($i=0;$i<count($fields);$i++){
				$point = array();
				$pointY = $j;
				$pointX = $i;
				$pointZ = (float)$data[$j][$fields[$i]];
				array_push($point, $pointX, $pointY, $pointZ);
				array_push($point_series, $point);
			}
		}
		
		$series_array[0]['data'] = $point_series;
		
		return $series_array;
	}
	
	/**
	 * for heatmap chart
	 * 
	 * @param table data $data
	 * @param table fields $fields
	 * @return series array
	 */
	public function setHeatMapSeries($data, $fields){
		$series_array = array();
		
		$series_array[0]['name'] = 'Heat Map';
		$series_array[0]['borderWidth'] = 1;
		
		
		$point_series = array();
		
		for($j=0;$j<count($data);$j++){
			for($i=0;$i<count($fields);$i++){
				$point = array();
				$pointY = $j;
				$pointX = $i;
				$pointZ = (float)$data[$j][$fields[$i]];
				array_push($point, $pointX, $pointY, $pointZ);
				array_push($point_series, $point);
			}
		}
		
		$series_array[0]['data'] = $point_series;
		
		$series_array[0]['dataLabels']['enabled'] = true;
		$series_array[0]['dataLabels']['color'] = '#333';
		$series_array[0]['dataLabels']['style']['textShadow'] = 'none';
		$series_array[0]['dataLabels']['style']['HcTextStroke'] = null;
		
		return $series_array;
	}
}