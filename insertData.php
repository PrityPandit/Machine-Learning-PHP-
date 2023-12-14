<?php
function insertDataFromFile($filePath, $conn)
{
    $csv = array();
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $key => $value) {
        $csv[$key] = str_getcsv($value);
    }

    for ($i = 1; $i < sizeof($csv); $i++) {
        $date = $csv[$i][1];
        $time = $csv[$i][2];
        $temp = $csv[$i][3];
        $humid = $csv[$i][4];
        $soil_moisture = $csv[$i][5];
        $pH = $csv[$i][6];
        $N = $csv[$i][7];
        $K = $csv[$i][8];
        $P = $csv[$i][9];

        $insertSql = "INSERT INTO `data-copy` (`date`, `time`, `temperature`, `humidity`, `soil_moisture`, `pH`, `N`, `K`, `P`, ) VALUES ('$date', '$time', $temp, $humid, $soil_moisture, $pH, $N, $K, $P);";
        if (!mysqli_query($conn, $insertSql)) {
            echo "Getting Error in inserting Data";
        }
    }

    echo "All Data inserted Successfully! <br>";
}

$hostname = "localhost";
$username  = "root";
$password  = "";
$database   = "data";
$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['insertData'])) {
    insertDataFromFile('111.csv', $conn);
}
if (isset($_POST['manualInsert'])) {
    // Retrieve data from the form
    $manualDate = $_POST['manualDate'];
    $manualTime = $_POST['manualTime'];
    $manualTemp = $_POST['manualTemp'];
    $manualHumid = $_POST['manualHumid'];
    $manualSoilMoisture = $_POST['manualSoilMoisture'];
    $manualpH = $_POST['manualpH'];
    $manualN = $_POST['manualN'];
    $manualK = $_POST['manualK'];
    $manualP = $_POST['manualP'];

    // Insert data into the database
    $insertSql = "INSERT INTO `data-copy` (`date`, `time`, `temperature`, `humidity`, `soil_moisture`, `pH`, `N`, `K`, `P`, ) VALUES ('$date', '$time', $temp, $humid, $soil_moisture, $pH, $N, $K, $P);";
        
    if (!mysqli_query($conn, $insertSql)) {
        echo "Error in inserting manual data: " . mysqli_error($conn);
    } else {
        echo "Manual data inserted successfully! <br>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Insertion</title>
</head>
<body>
    <!-- Insert data manually -->
    <form action="insertData.php" method="post">
        <label for="manualDate">Date:</label>
        <input type="text" name="manualDate" id="manualDate" required>

        <label for="manualTime">Time:</label>
        <input type="text" name="manualTime" id="manualTime" required>

        <label for="manualTemp">Temperature:</label>
        <input type="number" name="manualTemp" id="manualTemp" required>

        <label for="manualHumid">Humidity:</label>
        <input type="number" name="manualHumid" id="manualHumid" required>

        <label for="manualDate">Soil Moisture:</label>
        <input type="text" name="manualSoilMoisture" id="manualSoilMoisture" required>

        <label for="manualTime">pH:</label>
        <input type="text" name="manualpH" id="manualpH" required>

        <label for="manualTemp">N:</label>
        <input type="number" name="manualN" id="manualN" required>

        <label for="manualHumid">K:</label>
        <input type="number" name="manualK" id="manualK" required>

        <label for="manualDate">P:</label>
        <input type="text" name="manualP" id="manualP" required>

        <input type="submit" name="manualInsert" value="Insert Manual Data">
    </form>
    <!-- Insert data from file -->
    <form action="insertData.php" method="post">
        <input type="submit" name="insertData" value="Insert Data from File">
    </form>
    <a href = "index.php">Go back</a>
    

</body>
</html>
