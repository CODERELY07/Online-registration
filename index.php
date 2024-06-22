<?php
include('config/dbcheck.php');
session_start();
if(isset($_SESSION['login'])){
    header("Location:trainee-page.php");

}
include ('credentialchecker.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awsome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Script -->
    <script defer src="ajax/request.js"></script>
    <script defer src="js/script.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/loading.css?v=<?php echo time(); ?>">
</head>
<body>
    <div>
        <header>
            <div class="row main-bg pt-5 pb-3">
                <div class="col-lg py-2"><h1 class="text-center pt-2 big bolder">COMPAS</h1></div>
                <div class="col-lg py-2 text-center">
                    <h2>WELCOME ABROAD</h2>
                    <p style="width:300px" class="mx-auto">MyCOMPASS Online Enrollment System and Student Portal</p>
                </div>
            </div>
            <div class="other-info second-bg m-0" style="height:100px;width:100.7%" >

            </div>
        </header>
        <div class="ms-4 my-5">
            <p class="text-secondary">You can verify the existence of your account by searching using your registered email address</p>
            <div class="">
                <div id='search-bar'>
                    <input class="form-control d-inline" type="text" name="search" id="search" autocomplete="off" style="width:300px">
                    <button type="submit" class="btn btn-dark" id="search-btn" name="search-btn" style="margin-top:-5px">Search</button>
                </div>
            </div>
            <div id="table-data" class="py-2">

            </div>
        </div>
      
        <!-- find schedule -->
        <div class="row container-fluid box-parent">
            <div class=" mb-5 col-xl mx-2">
                <div class="card">       
                    <div class="p-3 pt-4" style="background-color:#0C293A;color:#fff">
                        <h5 class="text-center">Find Your Shedule Here</h5>
                    </div>
                    <div class="card-body p-4 pt-5">
                        <p class="text-center"> <mark> To filter schedules further, you may select from the given options below.<mark></p>
                        <form id="sced" class="row mt-4">
                            <div class="mb-3 col-xl">  
                                <label for="" class="form-label bold">Select Course Category</label>
                                <div class="drop-parent">
                                    <i class="fa-solid fa-caret-down"></i>
                                    <select class="form-control" name="course_category" id="course_category">
                                        <option selected value=""></option>
                                        <option value="customized">Customized</option>
                                        <?php
                                            $sql = "SELECT * FROM coursecategories";
                                            $result = $connect->query($sql) or die("Query Failed" . $connect->error);

                                            while($row = $result->fetch_assoc()){
                                                echo "<option value='".$row['category_id'] ."'>". $row['category_name'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-xl">
                                <label for="" class="form-label">Select Mode of Training </label>
                                <div class="drop-parent">
                                    <i class="fa-solid fa-caret-down"></i>
                                    <select class="form-control" name="mode" id="mode">
                                        <option selected value=""></option>
                                        <option value="Classroom">Classroom</option>
                                        <option value="ONLINE">ONLINE</option>
                                        <option value="BLENDED">BLENDED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p style="display:none" class="loading" id="course_load">&#8230</p>
                                <label for="" class="form-label" id="course_label">Select Course </label>
                                <div class="drop-parent">
                                    <i class="fa-solid fa-caret-down"></i>
                                    <select class="form-control" name="course" id="course">
                                    <option value=""></option>
                                    <?php
                                            $sql = "SELECT DISTINCT * FROM courses";
                                            $result = $connect->query($sql) or die("Query Failed" . $connect->error);

                                            while($row = $result->fetch_assoc()){
                                                echo "<option value='".$row['course_id'] ."'>". $row['course_name'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- messages -->
                            <div class='alert alert-primary text-center text-primary' id="modeAlert" role='alert'>
                                Please select course to see upcoming schedules.
                            </div>
                            <div class='alert alert-danger text-center text-danger' id="courseAlert" role='alert'>
                                Upcoming Schedules
                            </div>
                            <div id="upcoming-sched">
                                <table id="requirements" class="table table-bordered" style=''>
                                    <!-- requirments table -->
                                </table>
                                <div id="schedule">
                                    <!-- shcedule table -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl mx-2 ">
                <section class="login card">
                    <h5 class="p-4 text-center" style="background-color:#0C293A;color:#fff">Login</h5>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="mt-2 p-4 px-2" id="loginForm">
                        <div class="mb-3 px-4">
                            <label for="" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="" value="<?php echo $checkemail?>" aria-describedby="emailHelp">
                        </div>
                        <div class="errormsg"><?php echo $errormsg['chkemail'] ?></div>
                        <div class="mb-3 px-4">
                            <label for="passwordField" class="form-label">Password</label>
                            <div class="drop-parent">
                                <input type="password" name="password"  class="inputField form-control" value="<?php echo $checkpassword?>">
                                <i class="fa-regular fa-eye-slash eye showPassword1"></i>
                            </div>
                        </div>
                        <div class="errormsg"><?php echo $errormsg['chkpass'] ?></div><br><br>
                        <div style="display:flex;justify-content:center;gap:20px">
                            <button type="submit" id="login" name="login" class="btn btn-dark mb-2 ">Login</button>
                            <button class="btn btn-dark mb-2">Clear</button>
                        </div>
                        <p class="form-label text-secondary" style="text-align: center; color:black;font-size:14px ">----OR----</p>
                        <input type="button" id="Add" class="btn btn-dark mb-2" style="display: block; margin:auto;" value="New Applicant"> 
                    <p><small style="font-size:13px" class="text-center text-secondary d-block p-3">If you are a NEW STUDENT (you were never enrolled in any of our courses), please click the <strong>New Applicant</strong> button</small></p>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>