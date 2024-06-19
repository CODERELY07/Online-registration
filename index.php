<?php
include('config/dbcheck.php');
session_start();
if(isset($_SESSION['login'])){
    header("Location:trainee-page.php");

}
$email = $passsword = "";
$errLoginMsg = array('email'=> '', 'password'=> '');
$emailVerified = false;
$passwordVerified = false;

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $passsword = mysqli_real_escape_string($connect, $_POST['password']);

    if(empty($email)){
        $errLoginMsg['email'] = "Please don't leave this blank";
    }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errLoginMsg['email'] = "Please Enter Valid Email Address";
    }else{
        $emailVerified = true;
    }
    if(empty($passsword)){
        $errLoginMsg['password'] = "Please don't leave this blank";
    }else if(strlen($_POST['password']) < 6){
        $errLoginMsg['password'] = 'Password should be at least 6 characters long';
    }else{
        $passwordVerified = true;
    }
    
    if($emailVerified && $passwordVerified){

        $sql = "SELECT * FROM trainees WHERE email = '$email' AND password = '$passsword'";

        $result = $connect->query($sql) or die($connect->error);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['login'] = $row['id'];
            echo header("Location: trainee-page.php");
            exit();
        }else{
            $errLoginMsg['password'] = 'Incorect Username and Password';
        }
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
    <!-- find schedule -->
     <div class="container mb-5">
        <div class="card">
            <div class="p-4" style="background-color:#0C293A;color:#fff">
                <h5 class="text-center">Find Your Shedule Here</h5>
            </div>
            <div class="card-body">
                <p class="text-center"> <mark> To filter schedules further, you may select from the given options below.<mark></p>
                <form id="sced">
                    <div class="mb-3">
                        <label for="" class="form-label bold">Select Course Category</label>
                        <select class="form-control" name="course_category" id="course_category">
                            <option selected value=""></option>
                            <?php
                                $sql = "SELECT * FROM coursecategories";
                                $result = $connect->query($sql) or die("Query Failed" . $connect->error);

                                while($row = $result->fetch_assoc()){
                                    echo "<option value='".$row['category_id'] ."'>". $row['category_name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Select Mode of Training </label>
                        <select class="form-control" name="mode" id="mode">
                            <option selected value=""></option>
                            <option value="Classroom">Classroom</option>
                            <option value="ONELINE">ONELINE</option>
                            <option value="BLENDED">BLENDED</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <p style="display:none" id="course_load">Please Wait</p>
                        <label for="" class="form-label" id="course_label">Select Course </label>
                        <select class="form-control" name="course" id="course">
                        <option></option>
                        <?php
                                $sql = "SELECT DISTINCT * FROM courses";
                                $result = $connect->query($sql) or die("Query Failed" . $connect->error);

                                while($row = $result->fetch_assoc()){
                                    echo "<option value='".$row['course_id'] ."'>". $row['course_name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div id="test"></div>
                    
                    <div id="upcoming-sched">
                        <p class='alert alert-danger text-center' id="sched-hide"></p>
                        <table id="requirements" class="table"></table>
                        <div id="schedule"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <section class="login card p-5">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <h2 class="text-center my-4">Login</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $email?>" aria-describedby="emailHelp">
            </div>
            <div class="errormsg"><?php echo $errLoginMsg['email'] ?></div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" value="<?php echo $passsword?>"  class="form-control" id="exampleInputPassword1" value="">
            </div>
            <div class="errormsg"><?php echo $errLoginMsg['password'] ?><br><br>
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
                // console.log(search_text)
                $.ajax({
                    url: "search.php",
                    type: "POST",
                    data: {search: search_text},
                    success: function (data){
                        $('#table-data').html(data);
                    }
                })
            }


            $('#sched-hide').hide();
            //course

            $('#course_category').change(function(){
                var category_id = $(this).val();
                // console.log(category_id);

                $.ajax({
                    url: "get_courses.php",
                    type:'POST',
                    data:{category_id:category_id},
                    success: function(response){
                        $('#course').html(response)
                    }
                })
            });

            // requirements
            $('#course').change(function(){
                var course_id = $(this).val();
                // console.log(course_id);

                $.ajax({
                    url: "get_requirments.php",
                    type: 'POST',
                    data: {course_id: course_id},
                    success:function(response){
                        $('#requirements').html(response);
                    }
                })
                $('#sched-hide').show();
            })
            
            
           //schedule
           $('#course').change(function(){
                var course_id = $(this).val();
                // console.log(mode);
                // console.log(course_id);

                    $.ajax({
                    url: "get_schedule.php",
                    type: 'POST',
                    data: {course_id: course_id},
                    success:function(response){
                        $('#schedule').html(response);
                    }
                })
                $('#sched-hide').show();
            })
            $('#course').change(function(){
                $('#mode').change(function(){
                    var mode = $(this).val();
                    var course_id = $('#course').val();
                    // console.log(mode);
                    // console.log(course_id);

                        $.ajax({
                        url: "get_schedule.php",
                        type: 'POST',
                        data: {course_id: course_id,mode:mode},
                        success:function(response){
                            $('#schedule').html(response);
                        }
                    })
                })
                $('#sched-hide').show();
            })
            $('#mode').change(function(){
                $('#course').change(function(){
                    var course_id = $(this).val();
                    var mode = $('#mode').val();
                    // console.log(mode);
                    // console.log(course_id);

                        $.ajax({
                        url: "get_schedule.php",
                        type: 'POST',
                        data: {course_id: course_id,mode:mode},
                        success:function(response){
                            $('#schedule').html(response);
                        }
                    })
                })
            
            })

            // $('#course_category').change(function(){
            //     var course_cat = $(this).val();
            //     // console.log(course_cat);
            //     var course_load = $('#course_load');
            //     var course_label = $('#course_label');
            //     var course = $('#course');

            //     course_load.show();
            //     course_label.hide();
            //     course.hide();

            //     // add delay to see the result
            //     setTimeout(function(){
            //         $.ajax({
            //         url:'get_course.php',
            //         type:'POST',
            //         data:{course_category: course_cat},
            //         success: function(response){
            //             course_load.hide();
            //             course_label.show();
            //             course.show();
            //             $('#course').html(response);
            //         }
            //     })
            //     },1000)
              
            // })
        });
       
    </script>
</body>
</html>