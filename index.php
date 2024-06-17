<?php
include('config/dbcheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <form action="form.php" method="post">

        <input type="text" name="name" >
        <button type="submit" name="search">Search</button>
        <input type="button" name="Add" value="New Applicant">
        </form>
    </div>
    
</body>
</html>