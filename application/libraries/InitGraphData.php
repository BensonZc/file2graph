<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class InitGraphData{
	function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->library('highcharts');
	}
	
	public function initBasicData($name, $fields, $data, $divid){
		/*set highchart property*/
		$this->highcharts->title->setText($name . " Basic Line Chart");
		$this->highcharts->title->setX(-20);
		$this->highcharts->subtitle->setText('Source: ' . $name);
		$this->highcharts->subtitle->setX(-20);
		array_shift($fields);
		$this->highcharts->xaxis->setCategories($fields);
		$this->highcharts->yaxis->setTitleText('');
		$this->highcharts->tooltip->setValueSuffix('');
		$this->highcharts->legend->setLayout('vertical');
		$this->highcharts->legend->setAlign('right');
		$this->highcharts->legend->setVerticalAlign('middle');
		$this->highcharts->legend->setBorderWidth(0);
		$this->highcharts->series->setData($data);
		
		$returnData = $this->CI->highcharts->generate($divid);
		return $returnData;
	}
	
	public function initPieRowSumData($allsum, $rowsum){
		$returnData = array();
		$series = '';
		
		foreach($allsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
		 
		foreach($rowsum as $rowsum_item){
			$series = $series . "['" . $rowsum_item['rowname'] . "', " . $rowsum_item['rowsum']/$total * 100 . "],";
		}
		
		$returnData['series'] = $series;
		
		return $returnData;
	}
	
	public function initPieColumnSumData($allsum, $columnsum, $fields){
		$returnData = array();
		$series = '';
		
		foreach($allsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
		
		foreach($columnsum as $columnsum_item){
			for($i=0;$i<count($fields);$i++){
				if($i==0){
				}else{
					$series = $series . "[' Sum of " . $fields[$i] . "', " . $columnsum_item[$fields[$i]]/$total * 100 . "],";
				}
			}
		}
		
		$returnData['series'] = $series;
		
		return $returnData;
	}
	
	public function initPieRowDrillDownData($allsum, $data, $fields){
		$returnData = array();
		$row_sum = array();
		$series = '';
		$series_item = '';
		$series_1 = '';
		$series_2 = '';
		$series_3 = '';
		
		foreach($allsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
		
		foreach($data as $data_item){
			for($i=0;$i<count($fields);$i++){
				if($i==0){
					$series_1 = $data_item[$fields[0]];
				}else{
					$series_2 = $fields[$i];
					$series_3 = $data_item[$fields[$i]]/$total*100 . "%";
					
					$series_item = $series_1 . "," . $series_2 . " " . $series_3 . "\n";
				}
				
				$series = $series . $series_item;
			}
		}
		
		$returnData['series'] = $series;
		
		return $returnData;
	}
	
	public function initPieColumnDrillDownData($allsum, $data, $fields){
		$returnData = array();
		$column_sum = array();
		$series = '';
		$series_item = '';
		
		foreach($allsum as $allsum_item){
			$total = $allsum_item['allsum'];
		}
		
		foreach($data as $data_item){
			for($i=0;$i<count($fields);$i++){
				if($i==0){
					$series_2 = $data_item[$fields[0]];
				}else{
					$series_1 = $fields[$i];
					$series_3 = $data_item[$fields[$i]]/$total*100 . "%";
					
					$series_item = $series_1 . "," . $series_2 . " " . $series_3 . "\n";
				}
				
				$series = $series . $series_item;
			}
		}
		
		$returnData['series'] = $series;
		
		return $returnData;
	}
	
	public function initCombinationsColumnLinePieData($fields, $data, $rowsum){
		//Column data
		$returnData = array();
		$series = '';
		$chart_column_x = '';
		$chart_column_y = '';
		$chart_avg_data = '';
		$chart_avg_line = '';
		$chart_pie_item = '';
		$chart_pie_data = '';
		
		/*
		init X data
		[fields] database table fields for chart
		*/
		for($i=0;$i<count($fields);$i++){
			if($i==0){
			}else{
				$chart_column_x = $chart_column_x . "'" . $fields[$i] . "',";
			}
		}
		
		/*
		init Y data.
		*/
		foreach($data as $data_items){
			$series_value = "";
			for($i=0;$i<count($fields);$i++){
				if($i==0){
					$series_name = "{ type: 'column', name: '" . $data_items[$fields[$i]] . "',";
				}else{
					$series_value = $series_value . $data_items[$fields[$i]] . ",";					
				}
				$series_data = "data: [" . $series_value . "] },";
			}
			$series = $series . $series_name . $series_data;
		}
		$chart_column_y = $series;
		
		$returnData['chart_column_x'] = $chart_column_x;
		$returnData['chart_column_y'] = $chart_column_y;
		
		//Average line
		for($i=1;$i<count($fields);$i++){
			$column_sum = '';
			foreach($data as $data_items){
				$column_sum = $column_sum + $data_items[$fields[$i]];
			}
			$chart_avg_data = $chart_avg_data . $column_sum/count($data) . ",";
		}
		$chart_avg_line = "type:'spline', name:'Average', data: [" . $chart_avg_data . "],";
		
		$returnData['chart_avg_line'] = $chart_avg_line;
		
		//Pie Chart
		foreach($rowsum as $rowsum_item){
			$chart_pie_item = $chart_pie_item . "{ name:'" . $rowsum_item['rowname'] . "', y:" . $rowsum_item['rowsum'] . "},";
		}
		
		$chart_pie_data = "{type:'pie', name:'Total rows', data:[" . $chart_pie_item . "],";
		
		$returnData['chart_pie_data'] = $chart_pie_data;
		
		return $returnData;
	}
	
	public function init3DScatterData($fields, $data){
		$returnData = array();
		$chart_x = '';
		$chart_y = '';
		
		//init X data
		for($i=0;$i<count($fields);$i++){
			$chart_x = $chart_x . "'" . $fields[$i] . "',";
		}
		$returnData['x_array'] = $fields;
		$returnData['chart_x'] = $chart_x;
		
		//init Y data
		foreach($data as $data_item){
			$chart_y = $chart_y . "'" . $data_item[$fields[0]] . "',";
		}
		$returnData['chart_y'] = $chart_y;
		$returnData['y_array'] = explode(",", str_replace("'","",$chart_y));
		
		
		//init Z data
		foreach($data as $data_item){
			$max_temp = $data_item[$fields[1]];
			$min_temp = $data_item[$fields[1]];
		}
		
		foreach($data as $data_item){
			for($i=0;$i<count($fields);$i++){
				if($i!=0){
					$max_temp = max($max_temp, $data_item[$fields[$i]]);
					$min_temp = min($min_temp, $data_item[$fields[$i]]);
				}
			}
		}
		$returnData['max'] = $max_temp;
		$returnData['min'] = $min_temp;
		
		//init Point data
		$pointX = '';
		$pointY = '';
		$pointZ = '';
		$pointData = '';
		for($j=0;$j<count($data);$j++){
			$pointY = $j;
			for($i=0;$i<count($fields);$i++){
				if($i != 0){
					$pointX = $i;
					$pointZ = $data[$j][$fields[$i]];
					$pointData = $pointData . "[" . $pointX . "," . $pointY . "," . $pointZ . "],";
				}
			}
		}
		
		$returnData['pointData'] = $pointData;
		
		return $returnData;
	}
}
?>