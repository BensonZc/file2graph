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
	
	/*
	lineWidth: Number
	The width of the point marker's outline. 
	Defaults to 0.
	*/
	public function setAreaMarkerLineWidth($value){
		$this->plotoptions_array['plotOptions']['area']['marker']['lineWidth'] = $value;
	}
	
	/*
	lineColor: Color
	The color of the point marker's outline. When null, the series' or point's color is used. 
	Defaults to #FFFFFF.
	*/
	public function setAreaMarkerLineColor($value){
		$this->plotoptions_array['plotOptions']['area']['marker']['lineColor'] = $value;
	}
	
	/*
	stacking: String
	Whether to stack the values of each series on top of each other. Possible values are null to disable, "normal" to stack by value or "percent".
	*/
	public function setAreaStacking($value){
		$this->plotoptions_array['plotOptions']['area']['stacking'] = $value;
	}
	
	/*
	stacking: String
	Whether to stack the values of each series on top of each other. Possible values are null to disable, "normal" to stack by value or "percent".
	*/
	public function setBarStacking($value){
		$this->plotoptions_array['plotOptions']['bar']['stacking'] = $value;
	}
	
	public function setColumnStacking($value){
		$this->plotoptions_array['plotOptions']['column']['stacking'] = $value;
	}
	
	public function setSeriesStacking($value){
		$this->plotoptions_array['plotOptions']['series']['stacking'] = $value;
	}
	
	/*
	lineColor: Color
	The color of the point marker's outline. When null, the series' or point's color is used. 
	Defaults to #FFFFFF.
	*/
	public function setAreaLineColor($value){
		$this->plotoptions_array['plotOptions']['area']['lineColor'] = $value;
	}
	
	/*
	lineWidth: Number
	The width of the point marker's outline. 
	Defaults to 0.
	*/
	public function setAreaLineWidth($value){
		$this->plotoptions_array['plotOptions']['area']['lineWidth'] = $value;
	}
	
	/*
	enabled: Boolean
	Enable or disable the data labels. 
	Defaults to false.
	*/
	public function setBarDataLabelsEnabled($value){
		$this->plotoptions_array['plotOptions']['bar']['dataLabels']['enabled'] = $value;
	}
	
	/*
	allowPointSelect: Boolean
	Allow this series' points to be selected by clicking on the markers, bars or pie slices. 
	Defaults to false.
	*/
	public function setSeriesAllowPointSelect($value){
		$this->plotoptions_array['plotOptions']['series']['allowPointSelect'] = $value;
	}
	
	/*
	cursor: String
	You can set the cursor to "pointer" if you have click events attached to the series, to signal to the user that the points and lines can be clicked.
	*/
	public function setSeriesCursor($value){
		$this->plotoptions_array['plotOptions']['series']['cursor'] = $value;
	}
	
	/*
	showInLegend: Boolean
	Whether to display this particular series or series type in the legend. The default value is true for standalone series, false for linked series. 
	Defaults to false.
	*/
	public function setSeriesShowInLegend($value){
		$this->plotoptions_array['plotOptions']['series']['showInLegend'] = $value;
	}
	
	/*
	enabled: Boolean
	Enable or disable the data labels. 
	Defaults to false.
	*/
	public function setSeriesDataLabelsEnabled($value){
		$this->plotoptions_array['plotOptions']['series']['dataLabels']['enabled'] = $value;
	}
	
	/*
	color: Color
	The text color for the data labels. 
	Defaults to null.
	*/
	public function setSeriesDataLabelsColor($value){
		$this->plotoptions_array['plotOptions']['series']['dataLabels']['color'] = $value;
	}
	
	/*
	shadow: Boolean|Object
	The shadow of the box. Works best with borderWidth or backgroundColor. Since 2.3 the shadow can be an object configuration containing color, offsetX, offsetY, opacity and width. 
	Defaults to false.
	*/
	public function setSeriesDataLabelsStyleTextShadow($value){
		$this->plotoptions_array['plotOptions']['series']['dataLabels']['style']['textShadow'] = $value;
	}
	
	
	/*
	pointPadding: Number
	Padding between each column or bar, in x axis units. 
	Defaults to 0.1.
	*/
	public function setColumnPointPadding($value){
		$this->plotoptions_array['plotOptions']['column']['pointPadding'] = $value;
	}
	
	/*
	borderWidth: Number
	The width of the border surronding each column or bar. 
	Defaults to 1.
	*/
	public function setColumnBorderWidth($value){
		$this->plotoptions_array['plotOptions']['column']['borderWidth'] = $value;
	}
	
	/*depth: NumberSince 4.0
	Depth of the columns in a 3D column chart. Requires highcharts-3d.js. 
	Defaults to 25.
	*/
	public function setColumnDepth($value){
		$this->plotoptions_array['plotOptions']['column']['depth'] = $value;
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