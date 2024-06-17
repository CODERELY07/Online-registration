<?php
include('dbcheck.php');
  if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($connect, $_POST['name']);
    $sql = "SELECT * FROM trainees WHERE firstname LIKE '%$search$' OR middlename LIKE '%$search$' OR lastname LIKE '%$search$'";
    $result =mysqli_query($connect, $sql);
    $queryResult = mysqli_num_rows($result);

    if($queryResult > 0) {

    }
    else{
      echo "There are No result matching your search!";
    }
  }

?>