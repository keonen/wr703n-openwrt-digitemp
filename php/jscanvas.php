<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<?php


if(!isset($_POST['width']) || !isset($_POST['height'])) {
echo '
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    var height = $(window).height();
    var width = $(window).width();
    $.ajax({
        type: \'POST\',
        url: \'index.php\',
        data: {
            "height": height,
            "width": width
        },
        success: function (data) {
            $("body").html(data);
        },
    });
});
</script>
';
}

$w = $_POST['width'];
$h = $_POST['height'];


?>
    <title>Temperature data</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
    <script src="js/source/canvasjs.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $.getJSON("json.php", function (result) {

                var chart = new CanvasJS.Chart("chartContainer", {
		    zoomEnabled: true,
		    title: {
       				text: "Digitemp temperature data",
				fontSize: 20
      			},
		    axisX: {
				labelAngle: 30,
				labelFontSize: 10
			},
                    data: [
                        {
			    type: "line",
                            dataPoints: result
                        }
                    ]
                });
                chart.render();
            });
        });
    </script>
</head>
<body>
<center>
<?php $temp = $_POST['height'] - 20; $div_string = '<div id="chartContainer" style="height: '.$temp.'px;width: 100%;"></div>'; echo $div_string; ?>
</center>
</body>
</html>
