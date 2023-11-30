<?php

$hostname = "localhost" ;
$username  = "root" ;
$password  = "" ;
$database   = "data-Copy" ;
$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) 
{ 
	die("Connection failed: " . mysqli_connect_error()); 
} 

$sql = "SELECT `temperature` FROM `data-copy`";
//fire query
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result)){
        $temperature= $row['temperature'];}
    } else {
        echo "No temperature data found" ;
    }
    $maxTemp= -INF;
    $minTemp= INF;
    //Process the data
    foreach($result as $row){
        $temperature= $row['temperature'];
        $maxTemp= max($maxTemp, $temperature);
        $minTemp= min($minTemp, $temperature);
    }
    //Display the results
    echo "Maximum Temperature: " .$maxTemp. "<br>";
    echo "Minimum Temperature: " .$minTemp. "<br>";

    //Check temperature condition and set fan status flag
    $thresholdTemperature = 35;
    $fanStatus =($temperature >= $thresholdTemperature) ? true : false;
    //Display fan status message
    if ($fanStatus){
        echo "Cooling fan needs to be ON";
    } else{
        echo "Cooling fan needs to be OFF";
    }
    echo "<br>" ;
    echo"<br>";
    $sql = "SELECT `humidity` FROM `data-copy`";
    //fire query
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result)){
        $humidity= $row['humidity'];}
    } else {
        echo "No humidity data found" ;
    }
    $maxhumidity= -INF;
    $minhumidity= INF;
    //Process the data
    foreach($result as $row){
        $humidity= $row['humidity'];
        $maxhumidity= max($maxhumidity, $humidity);
        $minhumidity= min($minhumidity, $humidity);
    }
    //Display the results
    echo "Maximum Humidity: " .$maxhumidity. "<br>";
    echo "Minimum Temperature: " .$minhumidity. "<br>";
//Check temperature condition and set fan status flag
$thresholdHumidity = 80;
$DehumidifierStatus =($humidity >= $thresholdHumidity) ? true : false;
    //Display fan status message
if ($DehumidifierStatus){
        echo "Dehumidifier needs to be ON";
    } else{
        echo "Dehumidifier needs to be OFF";
    }
  
  
 echo" 
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <style>
html {
    font-family: Arial, Helvetica;
    display: inline-block;
    text-align: center;
    text-size: large;
</style>
</head>
<body>

</body>
</html> " ;

    //Close database connection
 mysqli_close($conn);
 ?>