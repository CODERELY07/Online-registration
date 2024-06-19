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
            <table class='table table-bordered'>
                <tr>
                    <td class='bg-primary text-center' scope='col'>Batch</td>
                    <td class='bg-primary text-center' scope='col'>".$row['batch']."</td>
                   
                </tr>
                <tr>
                     <td class='text-center' scope='col'>Date</td>
                    <td class='text-center' scope='col'>".$row['batch_date']."</td>
                </tr>
                <tr>
                     <td class='text-center' scope='col'>Time</td>
                    <td class='text-center' scope='col'>".$row['batch_time']."</td>
                </tr>
                <tr>
                     <td class='text-center' scope='col'>Branch</td>
                    <td class='text-center' scope='col'>".$row['branch']."</td>
                </tr>
                <tr>
                     <td class='text-center' scope='col'>Mode</td>
                    <td class='text-center' scope='col'>".$row['mode']."</td>
                </tr>
                <tr>
                    <td colspan='2' class='text-center'>".$row['slots']." slot available</td>
                </tr>
            </table>";
            $i++;  
        }
    }
    echo $output;

    $connect->close();

?>