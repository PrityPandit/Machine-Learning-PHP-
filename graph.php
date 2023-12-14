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

  $sql = "SELECT * FROM `data-copy`";
  $result = mysqli_query($conn, $sql);
  print_r($result) ;
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
  // $morningData = array_filter($data, function($item) {
  //     return (strtotime($item['time']) >= strtotime('06:00:00') && strtotime($item['time']) < strtotime('12:00:00'));
  // });
  
  
  // $afternoonData = array_filter($data, function($item) {
  //   return (strtotime($item['time']) >= strtotime('12:00:00') && strtotime($item['time']) < strtotime('18:00:00'));
  // });
  
  $eveningData = array_filter($data, function($item) {
    return (strtotime($item['time']) >= strtotime('18:00:00') && strtotime($item['time']) <= strtotime('23:59:59'));
  });

  // $nightData = array_filter($data, function($item) {
  //   return (strtotime($item['time']) >= strtotime('00:00:00') && strtotime($item['time']) < strtotime('06:00:00'));
  // });
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
<!-- <div>
  <h1>Morning Data</h1>
  <canvas id="morningChart"></canvas>
</div> -->
<!-- <div>
  <h1>AfterNoon Data</h1>
  <canvas id="afternoonChart"></canvas>
</div>  -->
<div>
  <h1>Evening Data</h1>
  <canvas id="eveningChart"></canvas>
</div> 
<!-- <div>
  <h1>Night Data</h1>
  <canvas id="nightChart"></canvas>
</div>  -->

<script>

  //Morning Data
//  var morningData = <?php echo json_encode($morningData); ?>;
//   // console.log(morningData);
//   var morningTemp = [];
//   var morningHumidity = [];
//   var morningTime = [];
//   morningDataKey  = (Object.keys(morningData));
//   var morningDate = morningData[morningDataKey[0]].date;
//   // console.log(morningDataKey);
//   var morningScatterTypeTempData = []
//   var morningScatterTypeHumidityData = []
//   for(let i = 0; i < morningDataKey.length; i++) {

//     // console.log(morningData[morningDataKey[i]]);
//     morningTemp.push(morningData[morningDataKey[i]].temperature);
//     morningHumidity.push(morningData[morningDataKey[i]].humidity);
//     morningTime.push(morningData[morningDataKey[i]].time);
//   }

//   for(let i = 0; i < morningDataKey.length; i++) {
//     morningScatterTypeTempData.push({x: i, y: morningTemp[i] })
//     morningScatterTypeHumidityData.push({x: i, y: morningHumidity[i]})
//   }
//   // console.log(morningTemp);
//   // console.log(morningHumidity);

//   const mlabels = morningTime;
//   const morning_Data = {
//     labels: mlabels,
//     datasets: [{
//       label: 'Temprature',
//       data: morningScatterTypeTempData,
//     },{
//       label: 'Humidity',
//       data: morningScatterTypeHumidityData,
//     }]
//   };

//     const morningConfig = {
//       type: 'line',
//       data: morning_Data,
//       options: {
//         plugins: {
//         title: {
//           text:morningDate,
//           display: true
//         }
//       },
//         scales: {
//           y: {
//             beginAtZero: true
//           }
//         }
//       },
//     };

//     var myChart = new Chart(
//       document.getElementById('morningChart'),
//       morningConfig
//     );

//Evening Data

  var eveningData = <?php echo json_encode($eveningData); ?>;
  // console.log(eveningData);
  var temp = [];
  var humidity = [];
  var time = [];
  var date = eveningData.length > 0 ? eveningData[0].date : null;
  var eveningScatterTypeTempData = []
  var eveningScatterTypeHumidityData = []
  eveningDataKey = Object.keys(eveningData);
  for(let i = 0; i < eveningDataKey.length; i++) {
    temp.push(eveningData[eveningDataKey[i]].temperature);
    humidity.push(eveningData[eveningDataKey[i]].humidity);
    time.push(eveningData[eveningDataKey[i]].time);
  }

  for(let i = 0; i < eveningDataKey.length; i++) {
    eveningScatterTypeTempData.push({x: i, y: temp[i] })
    eveningScatterTypeHumidityData.push({x: i, y: humidity[i]})
  }



  const elabels = time;
  const data = {
    labels: elabels,
    datasets: [{
      label: 'Temprature',
      data: eveningScatterTypeTempData,
    },
    {
      label: 'Humidity',
      data: eveningScatterTypeHumidityData,
    }
  ]
  };

    const eveningConfig = {
      type: 'line',
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

  // var afternoonData = <?php echo json_encode($afternoonData); ?>;
  // // console.log(afternoonData);
  // var atemp = [];
  // var ahumidity = [];
  // var atime = [];

  // const afternoonDataKey = Object.keys(afternoonData);
  // const aDate = afternoonData[afternoonDataKey[0]].date;

  // var afterNoonScatterTypeTempData = []
  // var afterNoonScatterTypeHumidityData = []
  // for(let i = 0; i < afternoonDataKey.length; i++) {
  //   atemp.push(afternoonData[afternoonDataKey[i]].temperature);
  //   ahumidity.push(afternoonData[afternoonDataKey[i]].humidity);
  //   atime.push(afternoonData[afternoonDataKey[i]].time);

  // }

  // for(let i = 0; i < afternoonDataKey.length; i++) {
  //   afterNoonScatterTypeTempData.push({x: i, y: atemp[i] })
  //   afterNoonScatterTypeHumidityData.push({x: i, y: ahumidity[i]})
  // }

  // const alabels = atime;
  // const afternoon_data = {
  //   labels: alabels,
  //   datasets: [{
  //     label: 'Temprature',
  //     data: afterNoonScatterTypeTempData,
      
  //   },{
  //     label: 'Humidity',
  //     data: afterNoonScatterTypeHumidityData,
  //   }]
  // };

  //   const afternoonConfig = {
  //     type: 'line',
  //     data: afternoon_data,
  //     options: {
  //       plugins: {
  //       title: {
  //         text:aDate,
  //         display: true
  //       }
  //     },
  //       scales: {
  //         y: {
  //           beginAtZero: true
  //         }
  //       }
  //     },
  //   };

  //   var myChart = new Chart(
  //     document.getElementById('afternoonChart'),
  //     afternoonConfig
  //   );



  // Night Data
  // var nightData = <?php echo json_encode($nightData); ?>;
  // // console.log(nightData);
  // var ntemp = [];
  // var nhumidity = [];
  // var ntime = [];

  // const nightDataKey = Object.keys(nightData);
  // const nDate = nightData[nightDataKey[0]].date;
  // var nightScatterTypeTempData = []
  // var nightScatterTypeHumidityData = []
  // for(let i = 0; i < nightDataKey.length; i++) {
  //   ntemp.push(nightData[nightDataKey[i]].temperature);
  //   ntime.push(nightData[nightDataKey[i]].time);
  //   nhumidity.push(nightData[nightDataKey[i]].humidity);

  // }

  // for(let i = 0; i < nightDataKey.length; i++) {
  //   nightScatterTypeTempData.push({x: i, y: ntemp[i] })
  //   nightScatterTypeHumidityData.push({x: i, y: nhumidity[i]})
  // }

  // const nlabels = ntime;
  // const night_data = {
  //   labels: nlabels,
  //   datasets: [{
  //     label: 'Temprature',
  //     data: nightScatterTypeTempData,
      
  //   },{
  //     label: 'Humidity',
  //     data: nightScatterTypeHumidityData,
  //   }]
  // };

  //   const nightConfig = {
  //     type: 'line',
  //     data: night_data,
  //     options: {
  //       plugins: {
  //       title: {
  //         text:nDate,
  //         display: true
  //       }
  //     },
  //       scales: {
  //         y: {
  //           beginAtZero: true
  //         }
  //       }
  //     },
  //   };

  //   var myChart = new Chart(
  //     document.getElementById('nightChart'),
  //     nightConfig
  //   );
</script> 
</body>
</html>


