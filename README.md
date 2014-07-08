file2graph
==========

This project is based on [CodeIgniter](http://ellislab.com/codeigniter) PHP Framework and [DataTable](http://www.datatables.net/) jQuery library and [HighChart](http://www.highcharts.com/) javaScript library.

file2graph is process data project.upload csv(in the prescribed form) file,you will get a variety of graph.supports line, spline, area, column, bar, pie, scatter......

How to use it?
----------
### 1.upload:
You should prepare a standard table file(csv, excel will be supported). and upload it, the file include column data and row data and file name does not has the special characters.
### 2.modify data:
If you need all data,you just click comfirm button. if you need modify data, switch Advanced tab, Toggle columns data and select rows data according to your requirements.
### 3.graph:
Switch graph(line, spline, area, column, bar, pie, scatter......), and you can print chart or download PNG/JPEG/PDF/SVG image.

HighChartPHP
---------
HighchartPHP is a PHP library to interact with the Highcharts JavaScript charting library.

### Example:
Create a Highchart object.params include div id, whether return object(true or false).
    
    $basicline = new HighChartPHP('maincontainer');
    
Set highchart property via php array
### 
    $basicline->title->text = " Basic Line Chart";
    $basicline->title->x = -20;
    $basicline->subtitle = array( 'text' => 'Source: table name', 'x' => -20);
    $basicline->xAxis->categories = $tablefields;
    $basicline->yAxis->title->text = '';
    $basicline->tooltip->valueSuffix = '';
    ......
Set highchart series data via SeriesOptions class,SeriesOptions provide static function to build series data according various graph.
###
    $basicline->series = SeriesOptions::setSeries($tabledata);
    
render graph in HTML page.
###
    <script src="http://code.highcharts.com/highcharts.js"></script>
    ... and you need,jQurey and some special highchart js library.
    
    <div id="maincontainer" style="width:1410px;height:400px;z-index:5;margin-top:3%">
    </div>
    <!--Basic Line-->
    <?php echo $basicline->buildJs() ?>

###update 14.7.8
support xlsx type.
