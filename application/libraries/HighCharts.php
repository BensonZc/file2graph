<?php 
class HighCharts{
	var $CI;
	
	function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->library('title');
		$this->CI->load->library('subtitle');
		$this->CI->load->library('xaxis');
		$this->CI->load->library('yaxis');
		$this->CI->load->library('tooltip');
		$this->CI->load->library('legend');
		$this->CI->load->library('series');
	}
	
	public function setSeriesData($data){
		$this->CI->series->setSeries($data);
	}
	
	public function setLegendBorderWidth($value){
		$this->CI->legend->setBorderWidth($value);
	}
	
	public function setLegendVerticalAlign($value){
		$this->CI->legend->setVerticalAlign($value);
	}
	
	public function setLegendAlign($value){
		$this->CI->legend->setAlign($value);
	}
	
	public function setLegendLayout($value){
		$this->CI->legend->setLayout($value);
	}
	
	public function setToolTipValueSuffix($value){
		$this->CI->tooltip->setValueSuffix($value);
	}
	
	public function setYAxisTitleText($value){
		$this->CI->yaxis->setTitleText($value);
	}
	
	public function setXAxisCategories($value = array()){
		$this->CI->xaxis->setCategories($value);
	}
	
	public function setSubTitleText($value){
		$this->CI->subtitle->setText($value);
	}
	
	public function setSubTitleX($value){
		$this->CI->subtitle->setX($value);
	}
	
	public function setTitleText($value){
		$this->CI->title->setText($value);
	}
	
	public function setTitleX($value){
		$this->CI->title->setX($value);
	}
	
	public function generate($divid){
		$title_array = $this->CI->title->getTitle();
		$subtitle_array = $this->CI->subtitle->getSubTitle();
		$xAxis_array = $this->CI->xaxis->getXAxis();
		$yAxis_array = $this->CI->yaxis->getYAxis();
		$toolTip_array = $this->CI->tooltip->getToolTip();
		$legend_array = $this->CI->legend->getLegend();
		$series_array = $this->CI->series->getSeries();
		
		$highchart = array_merge($title_array, $subtitle_array, $xAxis_array, $yAxis_array, 
			$toolTip_array, $legend_array, $series_array);
		
		return "$('#" . $divid . "').highcharts(" . json_encode($highchart) . ")";
	}
}
?>