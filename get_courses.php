<?php
    include('config/dbcheck.php');
    
    $category_id = $_POST['category_id'];

    $sql = "SELECT * FROM courses WHERE category_id = '$category_id'";
    $result = $connect->query($sql);
    $output= '<option value="" selected></option>';
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $output .= '<option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>';
        }
    }else {
        $output = '<option value="" selected></option>';
    }
    echo $output;
    $connect->close();
?>