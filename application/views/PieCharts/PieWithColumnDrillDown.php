<script>
$(function () {
    Highcharts.data({
        csv: document.getElementById('tsv').innerHTML,
        itemDelimiter: ' ',
        parsed: function (columns) {

            var brands = {},
                brandsData = [],
                versions = {},
                drilldownSeries = [];
            
            // Parse percentage strings
            columns[1] = $.map(columns[1], function (value) {
                if (value.indexOf('%') === value.length - 1) {
                    value = parseFloat(value);
                }
                return value;
            });

            $.each(columns[0], function (i, name) {
                var brand,
                    version;

                if (i > 0) {
                    
                    // Split into brand and version
                    version = name.split(',')[1].match(/([a-zA-Z0-9_]+[\.0-9x]*)/);
                    // Remove special edition notes
                    name = name.split(',')[0];
                    
                    
                    //version = name.match(/([0-9]+[\.0-9x]*)/);
                    if (version) {
                        version = version[0];
                    }
                    brand = name.replace(version, '');

                    // Create the main data
                    if (!brands[brand]) {
                        brands[brand] = columns[1][i];
                    } else {
                        brands[brand] += columns[1][i];
                    }

                    // Create the version data
                    if (version !== null) {
                        if (!versions[brand]) {
                            versions[brand] = [];
                        }
                        versions[brand].push([version, columns[1][i]]);
                    }
                }
                
            });

            $.each(brands, function (name, y) {
                brandsData.push({ 
                    name: name, 
                    y: y,
                    drilldown: versions[name] ? name : null
                });
            });
            $.each(versions, function (key, value) {
                drilldownSeries.push({
                    name: key,
                    id: key,
                    data: value
                });
            });

            // Create the chart
            <?php echo $piewithcolumndrilldown->buildJs(false) ?>

        }
    });
});
</script>
<div id="container" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
<pre id="tsv" style="display:none">
<?php echo $seriesdata ?>
</pre>