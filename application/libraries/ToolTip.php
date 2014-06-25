<?php
class ToolTip{
	var $tooltip_array;
	
	public function __construct(){
		$tooltip_array = array();
	}
	
	/*
	valueSuffix: String
		A string to append to each series' y value. Overridable in each series' tooltip options object.
	*/
	public function setValueSuffix($value){
		$this->tooltip_array['tooltip']['valueSuffix'] = $value;
	}
	
	/*
	Display crosshairs to connect the points with their corresponding axis values. The crosshairs can be defined as a boolean, an array of booleans or an object.
	Boolean
		If the crosshairs option is true, a single crosshair relating to the x axis will be shown.
	Array of booleans
		In an array of booleans, the first value turns on the x axis crosshair and the second value to the y axis crosshair. Use [true, true] to show complete crosshairs.
	Array of objects
		In an array of objects, the first value applies to the x axis crosshair and the second value to the y axis crosshair. For each dimension, a width, color, dashStyle and zIndex can be given.
	Defaults to null.
	*/
	public function setCrossHairs($value){
		$this->tooltip_array['tooltip']['crosshairs'] = $value;
	}
	
	/*
	shared: Boolean
		When the tooltip is shared, the entire plot area will capture mouse movement. Tooltip texts for series types with ordered data (not pie, scatter, flags etc) will be shown in a single bubble. This is recommended for single series charts and for tablet/mobile optimized charts. 
	Defaults to false.
	*/
	public function setShared($value){
		$this->tooltip_array['tooltip']['shared'] = $value;
	}
	
	/*
	formatter: Function
	Callback function to format the text of the tooltip. Return false to disable tooltip for a specific point on series.

	A subset of HTML is supported. The HTML of the tooltip is parsed and converted to SVG, therefore this isn't a complete HTML renderer. The following tabs are supported: <b>, <strong>, <i>, <em>, <br/>, <span>. Spans can be styled with a style attribute, but only text-related CSS that is shared with SVG is handled.

	Since version 2.1 the tooltip can be shared between multiple series through the shared option. The available data in the formatter differ a bit depending on whether the tooltip is shared or not. In a shared tooltip, all properties except x, which is common for all points, are kept in an array, this.points.

	Available data are:

	this.percentage (not shared) / this.points[i].percentage (shared)
		Stacked series and pies only. The point's percentage of the total.
	this.point (not shared) / this.points[i].point (shared)
		The point object. The point name, if defined, is available through this.point.name.
	this.points
		In a shared tooltip, this is an array containing all other properties for each point.
	this.series (not shared) / this.points[i].series (shared)
		The series object. The series name is available through this.series.name.
	this.total (not shared) / this.points[i].total (shared)
		Stacked series only. The total value at this point's x value.
	this.x
		The x value. This property is the same regardless of the tooltip being shared or not.
	this.y (not shared) / this.points[i].y (shared)
		The y value.
	*/
	public function setFormatter($value){
		$this->tooltip_array['tooltip']['formatter'] = $value;
	}
	
	/*
	pointFormat: String
	The HTML of the point's line in the tooltip. Variables are enclosed by curly brackets. Available variables are point.x, point.y, series.name and series.color and other properties on the same form. Furthermore, point.y can be extended by the tooltip.yPrefix and tooltip.ySuffix variables. This can also be overridden for each series, which makes it a good hook for displaying units.

	Defaults to 
	<span style="color:{series.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br/>.
	*/
	public function setPointFormat($value){
		$this->tooltip_array['tooltip']['pointFormat'] = $value;
	}
	
	/*
	headerFormat: String
	The HTML of the tooltip header line. Variables are enclosed by curly brackets. Available variables	 are point.key, series.name, series.color and other members from the point and series objects. The point.key variable contains the category name, x value or datetime string depending on the type of axis. For datetime axes, the point.key date format can be set using tooltip.xDateFormat.

	Defaults to <span style="font-size: 10px">{point.key}</span><br/>
	*/
	public function setHeaderFormat($value){
		$this->tooltip_array['tooltip']['headerFormat'] = $value;
	}
	
	/*
	footerFormat: String
	A string to append to the tooltip format. 
	Defaults to false.
	*/
	public function setFooterFormat($value){
		$this->tooltip_array['tooltip']['footerFormat'] = $value;
	}
	
	/*
	useHTML: Boolean
	Use HTML to render the contents of the tooltip instead of SVG. Using HTML allows advanced formatting like tables and images in the tooltip. It is also recommended for rtl languages as it works around rtl bugs in early Firefox. 
	Defaults to false.
	*/
	public function setUseHTML($value){
		$this->tooltip_array['tooltip']['useHTML'] = $value;
	}
	
	public function getToolTip(){
		if(empty($this->tooltip_array)){
			return array();
		}else{
			return $this->tooltip_array;
		}
	}
}
?>