<?php

header('Content-Type: application/json');

$con = mysqli_connect("localhost","db_user","db_password","db_name");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
    $data_points = array();

    mysqli_query($con, "SET time_zone = '+3:00'");

    $result = mysqli_query($con, "SELECT * FROM temperature_data ORDER BY id ASC;");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("label" => $row['timestamp'] , "y" => $row['celsius']);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}
mysqli_close($con);

?>
