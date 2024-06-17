<?php
    include('config/dbcheck.php');

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search'])){
        $search_term = $_POST['search'];
        
        $sql = "SELECT * FROM trainees WHERE firstname LIKE '%$search_term%' OR middlename LIKE '%$search_term%' OR lastname LIKE '%$search_term%'";
        $result = $connect->query($sql) or die("QUERY FAILED" . $connect->error);

        $output = "";
        if(empty($search_term)){
            echo "Please Input";
        }
        else{
            if($result->num_rows > 0){
                $output = "<table>
                <tr>
                    <td>ID</td>
                    <td>First Name</td>
                </tr>
                ";
                while($row = $result->fetch_assoc()){
                    $output .= "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['firstname']}</td>
                    </tr>";
                }
                $output .= "</table>";
                $connect->close();
    
                echo $output;
            }else{
                echo "Not found";
            }
         
        }
    }else{
        echo "<h2>No Record Found</h2>";
    }
?>