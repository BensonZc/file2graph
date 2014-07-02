<?php
class Highchart{
	/**
	 * graph div id,default is 'container'.
	 * 
	 * @var divid string
	 */
	var $divid;
	
	public function __construct($divid = 'container'){
		$this->$divid = $divid;
	}
	
	function __call($name, $args){
		if($name=='series'){
			switch(count($args)){
				case 0: $this->series2($args[0]);break;
				case 1: $this->overloadFun1($args[0]); break;
				case 2: $this->overloadFun2($args[0], $args[1]); break;
				default: //do something
				break;
			}
		}
	}

	function series2($data){
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

	function overloadFun1($var1){
		echo $var1;
	}

	function overloadFun2($var1,$var2){
		echo $var1+$var2;
	}
} 



?>