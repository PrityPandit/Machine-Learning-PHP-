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
  $data1=[];
  $data2=[];

  while($row = mysqli_fetch_assoc($result)){
    $data1 = $row["humidity"];
    $data2 = $row["temperature"];
     
}
//Encode code into JSON Format
$jsonData= json_encode([
  'data1' => $data1,
  'data2' => $data2
]);
echo $jsonData;


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


  while($row = mysqli_fetch_assoc($result)){
    $data1 = $row["humidity"];
    $data2 = $row["temperature"];
     
}
//Encode code into JSON Format
$jsonData= json_encode([
  'data1' => $data1,
  'data2' => $data2
]);
echo $jsonData;
 // closing connection
 mysqli_close($conn);

 ?>

 document.getElementById().addEventListener('click', function()
{
    $.ajax({
        url: 'graph.php', method: 'GET',
        success: function(data){
            //Parse JSON Data
            var jsonData= JSON.parse(data);
            var data1= jsonData.data1;
            var data2= jsonData.data2;
            //Create the chart
            var ctx= document.getElementById('chartContainer').getcontext('2d');
            var chart= new chart(ctx, {
                type: 'scatter',
                datasets: [{
                    label: 'Data1',
                    data= data1,}
                {
                    label: 'Data1',
                    data= data2, 
                }]
            },
            Options : {
                title:{
                    display: true,
                    text: 'correlation graph'
                }
            })
        }
    })
})
