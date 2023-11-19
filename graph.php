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

  $result = $conn->query($sql);

  if ($result) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
  } 
  else {
    echo "Error retrieving data";
  }

  $a = json_encode($data);
  
  mysqli_close($conn);
  
?>
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
<div>
  <canvas id="myChart"></canvas>
</div>
<script>
  // === include 'setup' then 'config' above ===
  var a = <?php echo $a; ?>;
  console.log(a);
  var temp = [];
  var humidity = [];
  for(let i = 0; i < a.length; i++) {
    temp.push(a[i].temperature);
    humidity.push(a[i].humidity);
  }
  const labels = temp;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Temprature',
      data: temp,
      
    },{
      label: 'Humidity',
      data: humidity,
    }]
  };

  const config = {
    type: 'line',
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
</script>
</body>
</html>


