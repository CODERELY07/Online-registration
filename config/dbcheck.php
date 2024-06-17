<?php
$connect = mysqli_connect('localhost', 'root', '', 'informations');
if(!$connect){
    echo 'Connection error: '. mysqli_connect_error();
}
?>