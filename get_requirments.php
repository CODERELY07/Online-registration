<?php

    include('config/dbcheck.php');

    $course_id = $_POST['course_id'];

    $sql = "SELECT * FROM course_requirments WHERE course_id = '$course_id'";
    $result = $connect->query($sql);
   $output = "";
    $output .= "<tr>
                <td>#</td>
                <td class='text-danger'>Requirements</td>
            </tr>";
    if($result->num_rows > 0){
        $i = 1;
        while($row = $result->fetch_assoc()){
            $output .= "<tr>
                <td>$i</td>
                <td>".$row['course_requirments_name']."</td>
            </tr>";
            $i++;  
        }
    }
    echo $output;

    $connect->close();

?>