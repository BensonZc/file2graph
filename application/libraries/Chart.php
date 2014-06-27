<?php
class Chart{
	var $chart_array;
	
	public function __construct(){
		$chart_array = array();
	}
	
	/*
	type: String
	The default series type for the chart. Can be any of the chart types listed under plotOptions. 
	Defaults to line.
	*/
	public function setType($value){
		$this->chart_array['chart']['type'] = $value;
	}
	
	/*
	renderTo: String|Object
	The HTML element where the chart will be rendered. If it is a string, the element by that id is used. The HTML element can also be passed by direct reference.
	*/
	public function setRenderTo($divid){
		$this->chart_array['chart']['renderTo'] = $divid;
	}
	
	/*
	chart.options3d

	Options to render charts in 3 dimensions. This feature requires highcharts-3d.js, found in the download package or online at code.highcharts.com/highcharts-3d.js.
	
	@param alpha: Number One of the two rotation angles for the chart. Defaults to 0.
	@param beta: Number One of the two rotation angles for the chart. Defaults to 0.
	@param depth: Number The total depth of the chart. Defaults to 100.
	@param enabled: Boolean Wether to render the chart using the 3D functionality. Defaults to false.
	@param viewDistance: Number Defines the distance the viewer is standing in front of the chart, this setting is important to calculate the perspective effect in column and scatter charts. It is not used for 3D pie charts. Defaults to 100.
	*/
	public function setOptions3d($enabled, $alpha, $beta, $depth, $viewdistance){
		$this->chart_array['chart']['options3d']['enabled'] = $enabled;
		$this->chart_array['chart']['options3d']['alpha'] = $alpha;
		$this->chart_array['chart']['options3d']['beta'] = $beta;
		$this->chart_array['chart']['options3d']['depth'] = $depth;
		$this->chart_array['chart']['options3d']['viewDistance'] = $viewdistance;
	}
	
	/*
	margin: Array
	The margin between the outer edge of the chart and the plot area. The numbers in the array designate top, right, bottom and left respectively. Use the options marginTop, marginRight, marginBottom and marginLeft for shorthand setting of one option.
	Since version 2.1, the margin is 0 by default. The actual space is dynamically calculated from the offset of axis labels, axis title, title, subtitle and legend in addition to the spacingTop, spacingRight, spacingBottom and spacingLeft options.
	Defaults to [null].
	*/
	public function setMargin($margin){
		$this->chart_array['chart']['margin'] = $margin;
	}
	
	/*
	chart.options3d.frame

	Provides the option to draw a frame around the charts by defining a bottom, front and back panel.
	*/
	public function setFrameBottom($size, $color){
		$this->chart_array['chart']['frame']['bottom']['size'] = $size;
		$this->chart_array['chart']['frame']['bottom']['color'] = $color;
	}
	
	public function setFrameBack($size, $color){
		$this->chart_array['chart']['frame']['back']['size'] = $size;
		$this->chart_array['chart']['frame']['back']['color'] = $color;
	}
	
	public function setFrameSide($size, $color){
		$this->chart_array['chart']['frame']['side']['size'] = $size;
		$this->chart_array['chart']['frame']['side']['color'] = $color;
	}
	
	public function getChart(){
		if(empty($this->chart_array)){
			return array();
		}else{
			return $this->chart_array;
		}
	}
}
?>