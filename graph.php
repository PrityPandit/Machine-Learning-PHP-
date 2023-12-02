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

  $sql = "SELECT `temperature`, `humidity`, `date`, `time` FROM `data-copy`";
  $result = mysqli_query($conn, $sql);
  
  if ($result) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
  } 
  else {
    echo "Error retrieving data";
  }

  mysqli_close($conn);
  


    // Filter data for morning, afternoon, and evening
    $morningData = array_filter($data, function($item) {
      return (strtotime($item['time']) >= strtotime('06:00:00') && strtotime($item['time']) < strtotime('12:00:00'));
  });
  
  $afternoonData = array_filter($data, function($item) {
      return (strtotime($item['time']) >= strtotime('12:00:00') && strtotime($item['time']) < strtotime('18:00:00'));
  });
  
  $eveningData = array_filter($data, function($item) {
      return (strtotime($item['time']) >= strtotime('18:00:00') && strtotime($item['time']) <= strtotime('23:59:59'));
  });
  
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
  <canvas id="morningChart"></canvas>
</div>
<!-- <script>

  // === include 'setup' then 'config' above ===
  var morningData =<?php echo($morningData); ?>;

  console.log(morningData);
  var temp = [];
  var humidity = [];
  var time = [];
 
  for(let i = 0; i < morningData.length; i++) {
    temp.push(morningData[i].temperature);
    humidity.push(morningData[i].humidity);
    time.push(morningData[i].time);
  }
  const labels = time;
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
    type: 'bar',
    data: data,
    options: {
      plugins: {
      title: {
        text:date,
        display: true
      }
    },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('morningChart'),
    config
  );
</script> -->
   <div>
        <canvas id="eveningChart"></canvas>
    </div>
<script>
  var eveningData = <?php echo json_encode($eveningData); ?>;
  console.log(eveningData);
  var temp = [];
  var humidity = [];
  var time = [];
  var date = eveningData.length > 0 ? eveningData[0].date : null;
  for(let i = 0; i < eveningData.length; i++) {
    temp.push(eveningData[i].temperature);
    humidity.push(eveningData[i].humidity);
    time.push(eveningData[i].time);
  }
  const labels = time;
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
      type: 'bar',
      data: data,
      options: {
        plugins: {
        title: {
          text:date,
          display: true
        }
      },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      },
    };

    var myChart = new Chart(
      document.getElementById('eveningChart'),
      config
    );
  </script>


</body>
</html>


