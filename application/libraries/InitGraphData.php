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