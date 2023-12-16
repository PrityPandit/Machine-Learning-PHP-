
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

echo "Database connection is OK <br>"; 
$sql = "SELECT `ID`, `date`, `time`, `temperature`, `humidity`, `soil_moisture`, `pH`, `N`, `K`, `P` FROM `data-copy`";
    //fire query
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    {
       #echo '<table> <tr> <th> ID </th> <th> date </th> <th> time </th> <th> temperature </th> <th> humidity </th> </tr>';
       while($row = mysqli_fetch_assoc($result)){
           $deg = $row["temperature"];
           $percnt = $row["humidity"];
           $percnt1= $row["soil_moisture"];
           $pp = $row["pH"];
           $nitro = $row["N"];
           $potas = $row["K"];
           $phos= $row["P"];
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
           $sql = "SELECT `soil_moisture` FROM `data-copy`";
           //fire query
           $result = mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) > 0)
       {
           while($row = mysqli_fetch_assoc($result)){
               $soil_moisture= $row['soil_moisture'];}
           } else {
               echo "No data found" ;
           }
           $maxsoilmoisture= -INF;
           $minsoilmoisture= INF;
           //Process the data
           foreach($result as $row){
               $soil_moisture= $row['soil_moisture'];
               $maxsoilmoisture= max($maxsoilmoisture, $soil_moisture);
               $minsoilmoisture= min($minsoilmoisture, $soil_moisture);
           }
           $sql = "SELECT `pH` FROM `data-copy`";
           //fire query
           $result = mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) > 0)
       {
           while($row = mysqli_fetch_assoc($result)){
               $pH= $row['pH'];}
           } else {
               echo "No data found" ;
           }
           $maxph= -INF;
           $minph= INF;
           //Process the data
           foreach($result as $row){
               $pH= $row['pH'];
               $maxph= max($maxph, $pH);
               $minph= min($minph, $pH);
           }
           $sql = "SELECT `N` FROM `data-copy`";
           //fire query
           $result = mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) > 0)
       {
           while($row = mysqli_fetch_assoc($result)){
               $Nitrogen= $row['N'];}
           } else {
               echo "No data found" ;
           }
           $maxnitrogen= -INF;
           $minnitrogen= INF;               
           //Process the data
           foreach($result as $row){
                 $Nitrogen= $row['N'];
                 $maxnitrogen= max($maxnitrogen, $Nitrogen);
                 $minnitrogen= min($minnitrogen, $Nitrogen);
           }
           $sql = "SELECT `K` FROM `data-copy`";
           //fire query
           $result = mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) > 0)
       {
           while($row = mysqli_fetch_assoc($result)){
               $potassium= $row['K'];}
           } else {
               echo "No data found" ;
           }
           $maxpotas= -INF;
           $minpotas= INF;
           //Process the data
           foreach($result as $row){
               $potassium= $row['K'];
               $maxpotas= max($maxpotas, $potassium);
               $minpotas= min($minpotas, $potassium);
           }
           $sql = "SELECT `P` FROM `data-copy`";
           //fire query
           $result = mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) > 0)
        {
           while($row = mysqli_fetch_assoc($result)){
               $phosphorus= $row['P'];}
           } else {
               echo "No data found" ;
           }
           $maxphosphorus= -INF;
           $minphosphorus= INF;
           //Process the data
           foreach($result as $row){
               $phosphorus= $row['P'];
               $maxphosphorus= max($maxphosphorus, $phosphorus);
               $minphosphorus = min($minphosphorus, $phosphorus);
           }
           
    $streamURL = "rtsp://192.168.1.100:554/video.mjpg"; // Replace with your camera's IP address and stream URL;
    echo"  
      <!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
     <title>Precision Agriculture</title>
     <!-- link with CSS-->
     <!--link rel=\"stylesheet\" href=\"css/style.css\"-->
     <style type=\"text/css\">
        @import url(\'https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700&display=swap\');
html {
    font-family: Arial, Helvetica;
    display: inline-block;
    text-align: center;
}
.topnav {
    overflow: hidden;
    background-color: yellow;
}

body{
    background-image:url(https://climate.copernicus.eu/sites/default/files/styles/hero_image_extra_large_2x/public/2018-07/globalagriculture.jpg?itok=fUmFHs6s);
    background-position:center;
    background-repeat:no-repeat;
    background-size:cover;
    width:90%;
    margin: 0;
    font-family: 'Raleway', sans-serif;  

}
.content {
    padding: 50px;
}
.card-grid {
    max-width: 1000px;
    margin: 0 auto;
    display: grid;
    grid-gap: 0.5rem;
    grid-template-columns: repeat(auto-fit, minmax(130px, 0.5fr));
}
.card1 {
    background-color: white;
    box-shadow: 1px 2px 12px 1px rgba(140,140,140,.5);
}
.card1-title {
    font-size: 1rem;
    font-weight: bold;
    color: #034078
}
.reading1 {
    font-size: 0.5rem;
    color: #1282A2;
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
.reading {
    font-size: 1rem;
    color: #1282A2;
}
.button span {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
  }
  
  .button span:after {
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
    transition: 0.5s;
  }
  
  .button:hover span {
    padding-right: 25px;
  }
  
  .button:hover span:after {
    opacity: 1;
    right: 0;
  }
        </style>
</head>
<body>

    <div class=\"topnav\">
        <h1>Monitoring Precision Agriculture</h1>
    </div>
    <div class=\"content\">
        <div class=\"card-grid\">
    
            <div class=\"card1\">
                <p class=\"card-title\"><i class=\"fas fa-thermometer-threequarters\" style=\"color:#059e8a;\"></i>Current Temperature</p>
                <p class=\"reading\"><span id=\"temperature\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$deg." *C</p>
             </div>
             <div class=\"card\">
                <p class=\"card-title\">Current Humidity</p>
                <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$percnt." %</p>
             </div>&nbsp
             <div class=\"card\">
                <p class=\"card-title\"><i class=\"fas fa-thermometer-threequarters\" style=\"color:#059e8a;\"></i>Maximum Temperature</p>
                <p class=\"reading\"><span id=\"temperature\"></span> ".$maxTemp." *C</p>
                <p class=\"card-title\"><i class=\"fas fa-thermometer-threequarters\" style=\"color:#059e8a;\"></i>Minimum Temperature</p>
                 <p class=\"reading\"><span id=\"temperature\"></span>".$minTemp." *C</p>
             </div>
             <div class=\"card\">
                 <p class=\"card-title\"> Maximum Humidity</p>
                <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$maxhumidity." %</p>
                <p class=\"card-title\"> Minimum Humidity</p>
                <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$minhumidity." %</p>
             </div>
             <div class=\"card\">
                <p class=\"card-title\"> Maximum Soil Moisture</p>
                <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$maxsoilmoisture." %</p>
                <p class=\"card-title\"> Minimum Soil Moisture</p>
                <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$minsoilmoisture." %</p>
             </div>
             <div class=\"card\">
                <p class=\"card-title\"> Maximum pH</p>
                <p class=\"reading\"><span id=\"ph\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp ".$maxph." </p>
                <p class=\"card-title\"> Minimum pH</p>
                <p class=\"reading\"><span id=\"ph\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$minph." </p>
             </div>
             <div class=\"card\">
                <p class=\"card-title\"> Soil Moisture </p>
                <p class=\"reading\"><span id=\"soil_moist\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$percnt1." %</p>
            </div>
             <div class=\"card\">
                    <p class=\"card-title\">pH </p>
                    <p class=\"reading\"><span id=\"ph\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ".$pp." </p>
             </div>
            &nbsp&nbsp&nbsp&nbsp&nbsp
             <div class=\"card\">
                <p class=\"card-title\"> Maximum Nitrogen</p>
                <p class=\"reading\"><span id=\"N\"></span>".$maxnitrogen." mg/kg</p>
                <p class=\"card-title\"> Minimum Nitrogen</p>
                <p class=\"reading\"><span id=\"humidity\"></span>".$minnitrogen." mg/kg</p>
            </div>
            <div class=\"card\">
                <p class=\"card-title\"> Maximum Potassium</p>
                <p class=\"reading\"><span id=\"K\"></span>".$maxpotas." mg/kg</p>
                <p class=\"card-title\"> Minimum Potassium</p>
                <p class=\"reading\"><span id=\"K\"></span>".$minpotas." mg/kg</p> 
            </div>
            <div class=\"card\">
                <p class=\"card-title\"> Maximum Phosphorus</p>
                <p class=\"reading\"><span id=\"P\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp ".$maxphosphorus." mg/kg</p>
                <p class=\"card-title\"> Minimum Phosphorus</p>
                <p class=\"reading\"><span id=\"humidity\"></span>&nbsp&nbsp&nbsp&nbsp&nbsp ".$minphosphorus." mg/kg</p>
            </div>&nbsp&nbsp&nbsp
            <div class=\"card\">
            <p class=\"card-title\"> Nitrogen</p>
            <p class=\"reading\"><span id=\"N\"></span>&nbsp&nbsp ".$nitro." mg/kg</p>
            <p class=\"card-title\">Potassium</p>
            <p class=\"reading\"><span id=\"K\"></span>&nbsp&nbsp ".$potas." mg/kg</p>
            <p class=\"card-title\"> Phosphorus</p>
            <p class=\"reading\"><span id=\"P\"></span>&nbsp&nbsp ".$phos." mg/kg</p>
     </div>
             <a href=\"insertData.php\" target=\"_blank\"><button class=\"button\"><span>Insert Data</span></button></a>
    <a href=\"showdata.php\" target=\"_blank\"><button class=\"button\"><span>Table</span></button></a>
     <!--<div id=\"loader\" class=\"center\"></div>
    <script src=\"script.js\"></script>
    <form action = \"show.php\" method=\"post\">
        <input type=\"submit\" name=\"submit\" value=\"Display Dataframe\">
    </form>-->
    <a href=\"graph.php\"target=\"_blank\"><button class=\"button\"><span>Generate Scatter Plot</span></button></a>
    <a href=\"recommend.php\" target=\"_blank\"><button class=\"button\"><span>Recommendation</span></button></a></div>
    <!--<a href=\"video.php\"target=\"_blank\"><button class=\"button\"><span>Live Streaming Video</span></button></a>-->
    <div id=\"scatterPlotContainer\"></div>
    <script src=\"https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js\"></script>
    <canvas id=\"chart-canvas\"></div>
    <video id='myvideo' width=\"320\" height=\"240\" autoplay src=\"<?php echo $streamURL ?>\" type=\"video/x-mjpeg\" controls></video>
    <script>
    // Get video URL from PHP variable
    var videoUrl = '<?php echo $video;?>';
    document.getElementById('playButton').addEventListener('click', function() {
      document.getElementById('myVideo').src = videoUrl;
      document.getElementById('myVideo').play();
    });
  </script>
</body>
</html>      ";
}
else
{
    echo "0 results";
}
// closing connection
mysqli_close($conn);
?>
      