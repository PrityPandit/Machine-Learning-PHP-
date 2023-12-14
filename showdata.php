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
$sql = "SELECT `ID`, `temperature`, `humidity`, `date`, `time` FROM `data-copy`";
    //fire query
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    {
       echo '<table> <tr> <th> ID </th> <th> Temperature </th> <th> Humidity </th> <th> date </th> <th>time</th> </tr>';
       while($row = mysqli_fetch_assoc($result)){
         // to output mysql data in HTML table format
           echo '<tr > <td>' . $row["ID"] . '</td>
           <td>' . $row["temperature"] . '</td>
           <td> ' . $row["humidity"] . '</td>
           <td>' . $row["date"] . '</td>
           <td>' . $row["time"] . '</td> </tr>';
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