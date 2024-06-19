<?php

    include('config/dbcheck.php');

    $course_id = $_POST['course_id'];

    $sql = "SELECT * FROM course_requirments WHERE course_id = '$course_id'";
    $result = $connect->query($sql);
   $output = "";
    if($result->num_rows > 0){
        $i = 1;
        $output .= "<tr>
        <td style='border:1px solid red' class='text-center'>#</td>
        <td style='border:1px solid red''><h5 class='text-danger  text-center'>Requirements</h5></td>
        </tr>";
        while($row = $result->fetch_assoc()){
            $output .= "<tr>
                <td style='border:1px solid red' class='text-center'>$i</td>
                <td style='border:1px solid red' class='text-center'>".$row['course_requirments_name']."</td>
            </tr>";
            $i++;  
        }
    }
    echo $output;

    $connect->close();

?>