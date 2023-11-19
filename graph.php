<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>
<body>

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

$sql = "SELECT `temperature`, `humidity` FROM `data-copy`";
 //fire query
 $result = mysqli_query($conn, $sql);
  $humidityData=[];
  $temperatureData=[];

  while($row = mysqli_fetch_assoc($result)){
    $humidityData = $row["humidity"];
    $temperatureData = $row["temperature"];
     
}
//Encode code into JSON Format
$jsonData= json_encode([
  'data1' => $humidityData,
  'data2' => $temperatureData
]);
echo $jsonData;


?>

<!-- <div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>

<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($humidityData) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Humidity',
      data: <?php echo json_encode($humidityData) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script> -->
</body>
</html>





