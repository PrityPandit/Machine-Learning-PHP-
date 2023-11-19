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
      } else {
        echo "Error retrieving data";
      }
      echo json_encode($data);
?>





