<?php

    include('config/dbcheck.php');

    $course_id = $_POST['course_id'];
    if(isset($_POST['mode'])){
        $mode = $_POST['mode'];
    }
    $sql = "SELECT * FROM schedules WHERE course_id = '$course_id'";

    if(!empty($mode)){
        $sql .= " AND mode = '$mode'";
    }
    $result = $connect->query($sql);
    $output = "";
    
    if($result->num_rows > 0){
        $i = 1;
        while($row = $result->fetch_assoc()){
            $output .= "<br>
            <table border='1'>
                <tr>
                    <td>Batch</td>
                    <td>".$row['batch']."</td>
                   
                </tr>
                <tr>
                     <td>Date</td>
                    <td>".$row['batch_date']."</td>
                </tr>
                <tr>
                     <td>Time</td>
                    <td>".$row['batch_time']."</td>
                </tr>
                <tr>
                     <td>Branch</td>
                    <td>".$row['branch']."</td>
                </tr>
                <tr>
                     <td>Mode</td>
                    <td>".$row['mode']."</td>
                </tr>
                <tr>
                     <td>Slots</td>
                    <td>".$row['slots']." slot available</td>
                </tr>
            </table>";
            $i++;  
        }
    }
    echo $output;

    $connect->close();

?>