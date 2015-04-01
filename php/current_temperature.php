<html>
<head>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="refresh" content="300">
<title>Current temperature</title>
</head>
<body>
<center><br>
<table border='1'><tr><td><center>Timestamp</center></td><td><center>Temperature</center></td></tr>

<?php

$con = mysqli_connect("localhost","username","password","dbname");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{

    mysqli_query($con, "SET time_zone = '+3:00'");

    $result = mysqli_query($con, "SELECT * FROM temperature_data ORDER BY timestamp DESC LIMIT 12;");
    

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
          echo "<tr><td>". $row["timestamp"]. "</td><td><center>" . $row["celsius"]. "</center></td></tr>";
    }
} else {
    echo "0 results";
}
    
}
mysqli_close($con);

?>

</table>
</center>
</body>
</table>
