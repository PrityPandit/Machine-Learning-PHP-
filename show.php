<?php
if(isset($POST['submit'])){
    //Execute the Python script using shell_exec
    $pythonOutput= shell_exec('main.py');

    //Convert the JSON-encoded dataframe to a PHP array
    $data= json_decode($pythonOutput ,true);
    //extract the Dataframe data from the PHP array
    $dataframeData= $data['df'];
    //Process the Dataframe data and prepare it for the AJAX response
    $processedOutput= json_encode(['data'=> $dataframeData]);
    //send the AJAX response
    echo $processedOutput;
}
?>
