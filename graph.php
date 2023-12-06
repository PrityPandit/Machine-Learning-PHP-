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
<div>
  <canvas id="afternoonChart"></canvas>
</div> 
<div>
  <canvas id="eveningChart"></canvas>
</div> 

<script>
 var morningData = <?php echo json_encode($morningData); ?>;
  // console.log(morningData);
  var morningTemp = [];
  var morningHumidity = [];
  var morningTime = [];
  morningDataKey  = (Object.keys(morningData));
  var morningDate = morningData[morningDataKey[0]].date;
  // console.log(morningDataKey);
  for(let i = 0; i < morningDataKey.length; i++) {

    // console.log(morningData[morningDataKey[i]]);
    morningTemp.push(morningData[morningDataKey[i]].temperature);
    morningHumidity.push(morningData[morningDataKey[i]].humidity);
    morningTime.push(morningData[morningDataKey[i]].time);
  }
  // console.log(morningTemp);
  // console.log(morningHumidity);

  const mlabels = morningTime;
  const morning_Data = {
    labels: mlabels,
    datasets: [{
      label: 'Temprature',
      data: morningTemp,
      
    },{
      label: 'Humidity',
      data: morningHumidity,
    }]
  };

    const morningConfig = {
      type: 'bar',
      data: morning_Data,
      options: {
        plugins: {
        title: {
          text:morningDate,
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
      morningConfig
    );

//Evening Data

  var eveningData = <?php echo json_encode($eveningData); ?>;
  // console.log(eveningData);
  var temp = [];
  var humidity = [];
  var time = [];
  var date = eveningData.length > 0 ? eveningData[0].date : null;

  eveningDataKey = Object.keys(eveningData);
  for(let i = 0; i < eveningDataKey.length; i++) {
    temp.push(eveningData[eveningDataKey[i]].temperature);
    humidity.push(eveningData[eveningDataKey[i]].humidity);
    time.push(eveningData[eveningDataKey[i]].time);

  }

  const elabels = time;
  const data = {
    labels: elabels,
    datasets: [{
      label: 'Temprature',
      data: temp,
      
    },{
      label: 'Humidity',
      data: humidity,
    }]
  };

    const eveningConfig = {
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
      eveningConfig
    );



//AfterNoon Data

  var afternoonData = <?php echo json_encode($afternoonData); ?>;
  // console.log(afternoonData);
  var atemp = [];
  var ahumidity = [];
  var atime = [];

  const afternoonDataKey = Object.keys(afternoonData);
  const aDate = afternoonData[afternoonDataKey[0]].date;

  for(let i = 0; i < afternoonDataKey.length; i++) {
    atemp.push(afternoonData[afternoonDataKey[i]].temperature);
    ahumidity.push(afternoonData[afternoonDataKey[i]].humidity);
    atime.push(afternoonData[afternoonDataKey[i]].time);

  }

  const alabels = atime;
  const afternoon_data = {
    labels: alabels,
    datasets: [{
      label: 'Temprature',
      data: temp,
      
    },{
      label: 'Humidity',
      data: humidity,
    }]
  };

    const afternoonConfig = {
      type: 'bar',
      data: afternoon_data,
      options: {
        plugins: {
        title: {
          text:aDate,
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
      document.getElementById('afternoonChart'),
      afternoonConfig
    );
</script> 
</body>
</html>


