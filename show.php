<?php
if(isset($_POST['submit'])){
    //Execute the Python script using shell_exec
    // $pythonOutput = shell_exec("/usr/bin/python3 main.py 2>&1");
    // echo "<pre>$pythonOutput</pre>";
    // echo $output;
    // echo $pythonOutput;
    // Convert the JSON-encoded dataframe to a PHP array
    // $data= json_decode($pythonOutput ,true);
    //extract the Dataframe data from the PHP array
    // $dataframeData= $data['df'];
    //Process the Dataframe data and prepare it for the AJAX response
    // $processedOutput= json_encode(['data'=> $dataframeData]);
    //send the AJAX response
    // echo $processedOutput;




    if(file_exists('output.json'))
    {
        $filename = 'output.json';
        $data = file_get_contents($filename); //data read from json file
        
        $users = json_decode($data,true);  //decode a data

        echo '<table> 
        <tr>  
            <th> Date </th> 
            <th> Time </th> 
            <th> Temp </th> 
            <th> Humidity </th>
            <th> temp(depend) </th> 
            <th> Hum(depend) </th> 
            <th> depend1 </th> 
            <th> depend2 </th> 
            <th> Result </th> 
        </tr>';

        for($i = 0; $i < sizeof($users); $i++) {
        echo '<tr > 
            <td>' . $users[$i]['Date'] . '</td>
            <td> ' . $users[$i]['Time'] . '</td>
            <td>' . $users[$i]['Temp'] . '</td>
            <td>' . $users[$i]['Humidity'] . '</td> 
            <td>' . $users[$i]['temp(depend)'] . '</td>
            <td> ' . $users[$i]['Hum(depend)'] . '</td>
            <td>' . $users[$i]['depend1'] . '</td>
            <td>' . $users[$i]['depend2'] . '</td>
            <td>' . $users[$i]['Result'] . '</td> 
           </tr>';
        }
        echo '</table>';
       

        // Convert the JSON-encoded dataframe to a PHP array
        

        // $processedOutput= json_encode(['data'=> $dataframeData]);
        // echo $processedOutput;

    }else{
	    $message = "<h3 class='text-danger'>JSON file Not found</h3>";
    }
}

?>
