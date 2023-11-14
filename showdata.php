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

echo "Database connection is OK <br>"; 
$sql = "SELECT `ID`, `Temperature`, `Humidity`, `pp` FROM `data-copy`";
    //fire query
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    {
       echo '<table> <tr> <th> ID </th> <th> Temperature </th> <th> Humidity </th> <th> pp </th> </tr>';
       while($row = mysqli_fetch_assoc($result)){
         // to output mysql data in HTML table format
           echo '<tr > <td>' . $row["ID"] . '</td>
           <td>' . $row["Temperature"] . '</td>
           <td> ' . $row["Humidity"] . '</td>
           <td>' . $row["pp"] . '</td> </tr>';
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