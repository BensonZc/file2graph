<?php
/*
plotOptions
The plotOptions is a wrapper object for config objects for each series type. The config objects for each series can also be overridden for each series item as given in the series array.
Configuration options for the series are given in three levels. Options for all series in a chart are given in the plotOptions.series object. Then options for all series of a specific type are given in the plotOptions of that type, for example plotOptions.line. Next, options for one single series are given in the series array.
*/
class PlotOptions{
	var $plotoptions_array;
	
	public function __construct(){
		$plotoptions_array = array();
	}
	
	/*
	pointStart: Number
	If no x values are given for the points in a series, pointStart defines on what value to start. For example, if a series contains one yearly value starting from 1945, set pointStart to 1945. Defaults to 0.
	*/
	public function setAreaPointStart($value){
		$this->plotoptions_array['plotOptions']['area']['pointStart'] = $value;
	}
	
	/*
	enabled: Boolean
	Enable or disable the point marker. 
	Defaults to true.
	*/
	public function setAreaMarkerEnabled($value){
		$this->plotoptions_array['plotOptions']['area']['marker']['enabled'] = $value;
	}
	
	/*
	symbol: String
	A predefined shape or symbol for the marker. When null, the symbol is pulled from options.symbols. Other possible values are "circle", "square", "diamond", "triangle" and "triangle-down".

	Additionally, the URL to a graphic can be given on this form: "url(graphic.png)". Note that for the image to be applied to exported charts, its URL needs to be accessible by the export server.

	Custom callbacks for symbol path generation can also be added to Highcharts.SVGRenderer.prototype.symbols. The callback is then used by its method name, as shown in the demo.
	*/
	public function setAreaMarkerSymbol($value){
		$this->plotoptions_array['plotOptions']['area']['marker']['symbol'] = $value;
	}
	
	/*
	radius: Number
	The radius of the point marker. 
	Defaults to 4.
	*/
	public function setAreaMarkerRadius($value){
		$this->plotoptions_array['plotOptions']['area']['marker']['radius'] = $value;
	}
	
	/*
	enabled: Boolean
	Enable or disable the point marker. 
	Defaults to true.
	*/
	public function setAreaMarkerStatesHoverEnable($value){
		$this->plotoptions_array['plotOptions']['area']['marker']['states']['hover']['enabled'] = $value;
	}
	
	public function getPlotOptions(){
		if(empty($this->plotoptions_array)){
			return array();
		}else{
			return $this->plotoptions_array;
		}
	}
}
?>