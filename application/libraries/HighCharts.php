<?php
require 'Chart.php';
require 'Title.php';
require 'SubTitle.php';
require 'XAxis.php';
require 'YAxis.php';
require 'Legend.php';
require 'ToolTip.php';
require 'Series.php';
require 'PlotOptions.php';
require 'DrillDown.php';

class HighCharts{
	var $CI;
	var $chart;
	var $title;
	var $subtitle;
	var $xaxis;
	var $yaxis;
	var $legend;
	var $tooltip;
	var $series;
	var $plotoptions;
	var $drilldown;
	
	function __construct(){
		$this->CI =& get_instance();
		
		$this->chart = new Chart();
		$this->title = new Title();
		$this->subtitle = new SubTitle();
		$this->xaxis = new XAxis();
		$this->yaxis = new YAxis();
		$this->tooltip = new ToolTip();
		$this->legend = new Legend();
		$this->series = new Series();
		$this->plotoptions = new PlotOptions();
		$this->drilldown = new DrillDown();
	}
	
	public function generate($divid){
		$chart_array = $this->chart->getChart();
		$title_array = $this->title->getTitle();
		$subtitle_array = $this->subtitle->getSubTitle();
		$xAxis_array = $this->xaxis->getXAxis();
		$yAxis_array = $this->yaxis->getYAxis();
		$toolTip_array = $this->tooltip->getToolTip();
		$legend_array = $this->legend->getLegend();
		$series_array = $this->series->getSeries();
		$plotoptions_array = $this->plotoptions->getPlotOptions();
		$drilldown_array = $this->drilldown->getDrillDown();
		
		$highchart = array_merge($chart_array, $title_array, $subtitle_array, $xAxis_array, $yAxis_array, 
			$toolTip_array, $legend_array, $series_array, $plotoptions_array, $drilldown_array);
		
		return "$('#" . $divid . "').highcharts(" . json_encode($highchart) . ")";
	}
}
?>