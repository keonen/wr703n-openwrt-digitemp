<?php

if (!isset($_GET['data'])) {
    // no data passed by get
   $count = 1000;
   $query = "select A,B where datediff(now(), A) <= 7";
}
else
{
   $count = $_GET["data"];
   $query = "select+A,B+order+by+A+desc+LIMIT+" .$count;
}

if (isset($_POST['querystring'])) 
{
    $query = $_POST['querystring'];
}

if (isset($_POST['datasourcestring'])) 
{
    $datasource = $_POST['datasourcestring'];
    if (substr($datasource, -1) == '/') 
       {
            $newstring = substr($datasource, 0, -1);
            $datasource = $newstring;
       }

}

if (!isset($_POST['datasourcestring'])) 
{
    $datasource = "https://docs.google.com/spreadsheets/d/1oqm4e95pxYn8pt9Lx_gkb56YTM4eJsuwL63GWwHeE84";
}

if (!isset($_POST['titlestring'])) 
{
    $title = "Digitemp temperature data";
}

if (isset($_POST['titlestring'])) 
{
    $title = $_POST['titlestring'];
}

if (!isset($_POST['charttype'])) 
{
    $charttypestring = "ScatterChart";
    $scatterselected = " selected";
    $lineselected = "";
    $columnselected = "";
}

if (isset($_POST['charttype'])) 
{
    $charttypestring = $_POST['charttype'];
}

if ( $charttypestring == "ScatterChart")
{
    $scatterselected = " selected";
    $lineselected = "";
    $columnselected = "";
}

if ( $charttypestring == "LineChart")
{
    $scatterselected = "";
    $lineselected = " selected";
    $columnselected = "";
}

if ( $charttypestring == "ColumnChart")
{
    $scatterselected = "";
    $lineselected = "";
    $columnselected = " selected";
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>This example draws chart using Google spreadsheet as data source</title>
</head>
<body>
<center>
<form action="index.php" method="post">
<table border="0" style="width:80%">
<tr><td width="15%" align="right">Query: </td><td colspan="2"><input type="text" name="querystring" value="<?php $newquery = str_replace("+", " ", $query); echo $newquery; ?>" style="width:100%"></td><td></td></tr>
<tr><td width="15%" align="right">Data source: </td><td colspan="2"><input type="text" name="datasourcestring" value="<?php $newsource = str_replace("+", " ", $datasource); echo $newsource; ?>" style="width:100%"></td><td></td></tr>
<tr><td width="15%" align="right">Title: </td><td><input type="text" name="titlestring" value="<?php $newtitle = str_replace("+", " ", $title); echo $newtitle; ?>" style="width:98%"></td><td width="15%" align="center"><select name="charttype" style="width:100%; heigth:100%"><option value="ColumnChart"<?php echo $columnselected; ?>>Column chart</option><option value="LineChart"<?php echo $lineselected; ?>>Line Chart</option><option value="ScatterChart"<?php echo $scatterselected; ?>>Scatter chart</option></select></td><td width="10%" align="left"><input type="submit"></td></tr>
</table>
</form>
  <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
       <div id="chart" style="width: 100%; height: 700px;"></div>
   
 <script type='text/javascript'>//<![CDATA[ 

      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var query = new google.visualization.Query("<?php echo $datasource; ?>/gviz/tq?tq=<?php echo $query; ?>");
        query.send(handleQueryResponse);
      }

function handleQueryResponse(response) {
  var data = response.getDataTable();

  var options = { 
          chartArea: {width: '85%', height: '75%'},
          title: '<?php $newtitle = str_replace("+", " ", $title); echo $newtitle; ?>',
          legend: {position: 'none'},
          colors: ['#087037'],
          pointSize: 1
        };

  var chart = new google.visualization.<?php echo $charttypestring; ?>(document.getElementById('chart'));

  chart.draw(data, options);
     
}

//]]>  

</script>
<font face="verdana" size="1">JavaScript source: <a href="http://jsfiddle.net/srrrn9sa/68/" style="text-decoration: none" target="_blank">JSFiddle</a></font>
</center>
</body>
</html>
