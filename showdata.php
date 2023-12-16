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

$sql = "SELECT `ID`, `temperature`, `humidity`, `date`, `time`, `soil_moisture`, `pH`, `N`, `K`, `P` FROM `data-copy`";
    //fire query
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    {
       echo '<table border = 1> <tr> <th> ID </th> <th> Temperature </th> <th> Humidity </th> <th> date </th> <th>time</th> <th>Soil Moisture</th> <th>pH</th> <th>N</th> <th>K</th> <th>P</th> </tr>';
       while($row = mysqli_fetch_assoc($result)){
         // to output mysql data in HTML table format
           echo '<tr > <td>' . $row["ID"] . '</td>
           <td>' . $row["temperature"] . '</td>
           <td> ' . $row["humidity"] . '</td>
           <td>' . $row["date"] . '</td>
           <td>' . $row["time"] . '</td> 
           <td>' . $row["soil_moisture"] . '</td> 
           <td>' . $row["pH"] . '</td> 
           <td>' . $row["N"] . '</td> 
           <td>' . $row["K"] . '</td> 
           <td>' . $row["P"] . '</td> 
           </tr>';
       }
       echo '</table>';
    }
    else
    {
        echo "0 results";
    }
    // closing connection
    mysqli_close($conn);

?>