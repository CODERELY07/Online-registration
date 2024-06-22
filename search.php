<?php
    include('config/dbcheck.php');

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search'])){
        $search_term = $_POST['search'];
        
        $sql = "SELECT * FROM trainees WHERE email = '$search_term'";
        $result = $connect->query($sql) or die("QUERY FAILED" . $connect->error);

        if(empty($search_term)){
            echo "Please Input";
        }
        else{
            if($result->num_rows > 0){
                echo "Your are registered, You can login using your registered email address";
                $connect->close();
            }else{
                echo "Your are not registered yet click <a href='form.php')>here </a>to register";
            }
         
        }
    }else{
        echo "<h2>No Record Found</h2>";
    }
?>