
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
$sql = "SELECT `ID`, `date`, `time`, `temperature`, `humidity` FROM `data-copy`";
    //fire query
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    {
       #echo '<table> <tr> <th> ID </th> <th> date </th> <th> time </th> <th> temperature </th> <th> humidity </th> </tr>';
       while($row = mysqli_fetch_assoc($result)){
           $deg = $row["temperature"];
           $percnt = $row["humidity"];
       }
       
    echo file_get_contents("./home.html");
}
else
{
    echo "0 results";
}
// closing connection
mysqli_close($conn);
?>
      