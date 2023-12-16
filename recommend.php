<?php

$hostname = "localhost" ;
$username  = "root" ;
$password  = "" ;
$database   = "data" ;
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
    //echo "Maximum Temperature: " .$maxTemp. "<br>";
    //echo "Minimum Temperature: " .$minTemp. "<br>";

    //Check temperature condition and set fan status flag
    $thresholdTemperature = 35;
    $fanStatus =($temperature >= $thresholdTemperature) ? true : false;
    //Display fan status message
    //$relatedRecomendation = "";
    if ($fanStatus)
    {
       $CoolingFan =  "Cooling fan needs to be ON";}
       //echo "Cooling fan needs to be ON";}
    else{
        $CoolingFan = "Cooling fan needs to be OFF";
       // echo "Cooling fan needs to be OFF";
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
    //echo "Maximum Humidity: " .$maxhumidity. "<br>";
    //echo "Minimum Temperature: " .$minhumidity. "<br>";
//Check temperature condition and set fan status flag
$thresholdHumidity = 80;
$DehumidifierStatus =($humidity >= $thresholdHumidity) ? true : false;
$dehumidifierStatusString = "";
    //Display fan status message
if ($DehumidifierStatus){
        $dehumidifierStatusString = "Dehumidifier needs to be ON";
    } else{
        $dehumidifierStatusString = "Dehumidifier needs to be OFF";
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
}
    .card-grid {
        max-width: 800px;
        margin: 0 auto;
        display: grid;
        grid-gap: 2rem;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .card {
        background-color: white;
        box-shadow: 2px 2px 12px 1px rgba(140,140,140,.5);
    }
    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #034078
    }
</style>
</head>
<body>
<div class=\"content\">
<div class=\"card-grid\">

   <!-- <div class=\"card\">
        <p class=\"card-title\"><i class=\"fas fa-thermometer-threequarters\" style=\"color:#059e8a;\"></i>Maximum Temperature</p>
        <p class=\"reading\"><span id=\"temperature\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$maxTemp." *C</p>
        </div>
        <div class=\"card\">
        <p class=\"card-title\"><i class=\"fas fa-thermometer-threequarters\" style=\"color:#059e8a;\"></i>Minimum Temperature</p>
        <p class=\"reading\"><span id=\"temperature\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$minTemp." *C</p>
        </div>-->
        <div class=\"card\">
            <p class=\"card-title\"><i class=\"fas fa-thermometer-threequarters\" style=\"color:#059e8a;\"></i>Cooling Fan</p>
            <p class=\"reading\"><span id=\"temperature\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$CoolingFan." </p>
        </div>
        <!--<div class=\"card\">
            <p class=\"card-title\"> Maximum Humidity</p>
            <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$maxhumidity." %</p>
        </div>
        <div class=\"card\">
            <p class=\"card-title\"> Minimum Humidity</p>
            <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$minhumidity." %</p> 
        </div>-->
        <div class=\"card\">
            <p class=\"card-title\"><i class=\"humidity\" style=\"color:#059e8a;\"></i>Dehumidifier</p>
            <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$dehumidifierStatusString." </p>
        </div>
</body>
</html> " ;

    //Close database connection
 mysqli_close($conn);
 ?>