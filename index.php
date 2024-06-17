<?php
include('config/dbcheck.php');
session_start();
if(isset($_SESSION['login'])){
    header("Location:trainee-page.php");
    exit();
}

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $sql = "SELECT * FROM trainees WHERE email = '$email' AND password = '$password'";

    $result = $connect->query($sql) or die($connect->error);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['login'] = $row['id'];
        echo header("Location: trainee-page.php");
        exit();
    }else{
        echo "User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container my-5">
        <div class="wrapper">
            <div id='search-bar'>
                <input type="text" name="search" id="search" autocomplete="off">
                <button type="submit" id="search-btn" name="search-btn">Search</button>
                <input type="button" id="Add" value="New Applicant">
            </div>
        </div>
        <div id="table-data">

        </div>
    </div>
    <div class="container">
        <section class="login card p-5">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <h2 class="text-center my-4">Login</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="login" class="btn btn-primary">Submit</button>
        </form>
        </section>
    </div>
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        document.getElementById('Add').onclick = ()=>{
            window.location = "form.php";
        }

        $(document).ready(function(){
            $('#search-btn').on("click", function(){
                var search_term = $('#search').val();
                searching(search_term);
            })

            $('#search').on("keypress" , function (e){
                if(e.which === 13){
                    var search_term = $('#search').val();
                    searching(search_term);
                }
            })
            function searching(search_text){
                console.log(search_text)
                $.ajax({
                    url: "search.php",
                    type: "POST",
                    data: {search: search_text},
                    success: function (data){
                        $('#table-data').html(data);
                    }
                })
            }
        });
       
    </script>
</body>
</html>