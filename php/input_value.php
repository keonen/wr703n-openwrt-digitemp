<?php
$servername = "localhost";
$username = "db_user";
$password = "db_password";
$dbname = "db_name";



if(isset($_GET['value'])) {

   if (strlen($_GET['value']) < 2 ) { exit(); }

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO temperature_data (celsius) VALUES ('".$_GET["value"]."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo $_GET["value"];
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

$temperature = $_GET["value"];

$temperature = str_replace(".",",", $temperature);

$requestUrl = 'https://docs.google.com/forms/d/1nyVNmfvaLSgOjPPCXljJHmmRr815f0rVdT4wS97yoCE/formResponse?ifq&entry.855409987='.$temperature.'&submit=Submit';

$wgetRequest = file_get_contents($requestUrl);

}

?>
