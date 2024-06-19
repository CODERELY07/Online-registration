
<?php
    session_start();
    if(isset($_SESSION['login'])){
        header("Location:trainee-page.php");
    }
    include ('credentialchecker.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <div class="container card my-5 py-5 px-4">
        <form class="form-wrap" action="form.php" method="post">
            <div class="wrapper">
                <div class="">
                    <div>
                        <p class="text-secondary">To create account enter your valid email address and password here.</p>
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="text" name="login_email"  value="<?php echo $email?>">
                        <div class="errormsg"><?php echo $errormsg['email'] ?>
                        </div>
                    </div>
                    <div>
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="login_password"  value="<?php echo $password?>">
                    <div class="errormsg"><?php echo $errormsg['password'] ?>
                    </div>
                    </div>
                    <div>
                    <label for="password">Confirm Password</label>
                    <input class="form-control" type="password" name="confirm_password"  value="<?php echo $confirmpassword?>">
                    <div class="errormsg"><?php echo $errormsg['confirmpassword'] ?>
                    </div>
                    </div>
                    <br>
                    
                </div>
                <br>
                <p class="text-secondary">Fill up all data to proceed</p>
                <div class="top">
                    <div class="srn">
                        <label class="srn-number form-label" for="srn">SRN Number</label>
                        <input class="srn-number form-control" type="number" name="srn" value="<?php echo $srn?>">
                        <div class="errormsg"><?php echo $errormsg['srn'] ?></div>
                    </div>
                    <div class="mode">
                        <label for="mode" class="form-label">Mode</label>
                        <select class="form-control" name="mode" id="mode">
                            <option <?php if(empty($mode)) echo "selected";?>></option>
                            <option <?php if($mode == "face-to-face") echo "selected";?> value="face-to-face">Face to Face</option>
                            <option <?php if($mode == "online") echo "selected";?> value="online">Online</option>
                            <option <?php if($mode == "modular") echo "selected";?> value="modular">Modular</option>
                        </select>
                        <div class="errormsg"><?php echo $errormsg['mode'] ?></div>
                    </div>
                        
                </div>
                <div class="name">
                    
                    <div class="firstname-box box">
                        <label class="firstname form-label" for="firstname"> First Name</label>
                        <input class="firstname form-control" type="text" name="firstname"  value="<?php echo $firstname?>">

                        <div class="errormsg"><?php echo $errormsg['firstname'] ?></div>

                    </div>
                        
                    <div class="midname-box box">
                        <label class="midname form-label" for="midname">Middle Name</label>
                        <input class="midname form-control" type="text" name="midname"  value="<?php echo $midname?>">

                        <div class="errormsg"><?php echo $errormsg['middlename'] ?></div>

                    </div>
                        
                    <div class="lastname-box box">
                        <label class="lastname form-label" for="lastname">Last Name</label>
                        <input class="lastname form-control" type="text" name="lastname"  value="<?php echo $lastname?>">

                        <div class="errormsg"><?php echo $errormsg['lastname'] ?></div>

                    </div>
                        
                    <div class="suffix-box">
                        <label class="suffix form-label" for="suffix">Suffix</label>
                        <select name="suffix" class="suffix form-control" id="extension">
                            <option <?php if (empty($suffix)) echo 'selected'; ?>></option>
                            <option value="jr" <?php if ($suffix == "jr") echo 'selected'; ?>>Jr.</option>
                            <option value="Sr" <?php if ($suffix == "Sr") echo 'selected'; ?>>Sr.</option>
                            <option value="phd" <?php if ($suffix == "phd") echo 'selected'; ?>>PhD.</option>
                            <option value="md" <?php if ($suffix == "md") echo 'selected'; ?>>MD.</option>
                            <option value="esq" <?php if ($suffix == "esq") echo 'selected'; ?>>esq.</option>
                        </select>

                    </div>
                        
                    </div>
                    <div class="ads">
                        <div class="address">
                            <label for="address" class="form-label">Address</label>
                            <input class="form-control" type="text" name="address" value="<?php echo $address ?>">

                            <div class="errormsg"><?php echo $errormsg['address'] ?></div>

                        </div>
                        <div class="gender">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" name="gender" id="gender">
                                <option <?php if(empty($gender)) echo "selected";?>></option>
                                <option value="male" <?php if($gender == "male") echo 'selected';?>>Male</option>
                                <option value="female" <?php if($gender == "female") echo 'selected'?>>Female</option>
                            </select>
                            <div class="errormsg"><?php echo $errormsg['gender'] ?></div>
                        </div>
                    </div>
                <div class="additional">
                    <div class="rank adbox">
                        <label for="rank form-label">Rank/Position</label>
                        <select class="form-control " name="position" id="position">
                            <option <?php if(empty($rank)) echo "selected";?>></option>
                            <?php
                                $sql_position = "SELECT * FROM positionList";
                                $resul_position = $connect->query($sql_position) or die("Query Failed" . $connect->error);

                                if($resul_position->num_rows > 0){
                                    while($row = $resul_position->fetch_assoc()){
                                        echo '<option id="' . $row["position"] . '" value="' . $row['position'] . '"';
                                        if($rank == $row['position']){
                                            echo 'selected';
                                        }
                                        echo '>' .$row["position"].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="civil-status adbox">
                        <label for="civil-status" class="form-label">Civil Status</label>
                        <select class="form-control" name="status" id="status">
                            <option  <?php if(empty($status)) echo 'selected'?>></option>
                            <option  <?php if($status == "single") echo 'selected'?> value="single">Single</option>
                            <option  <?php if($status == "married") echo 'selected'?> value="married">Married</option>
                            <option  <?php if($status == "widowed") echo 'selected'?> value="widowed">Widowed</option>
                            <option  <?php if($status == "separated") echo 'selected'?> value="separated">Separated</option>
                            <option  <?php if($status == "divorced") echo 'selected'?> value="divorced">Divorced</option>
                        </select>
                    </div>
                    <div class="date-of-birth adbox">
                        <label for="birth" class="from-label">Date of Birth</label>
                        <input class="form-control" type="date" name="date" value="<?php echo $birth?>">

                        <div class="errormsg"><?php echo $errormsg['birth'] ?></div>

                    </div>
                
                    <div class="contact adbox">
                        <label for="contact" class='form-label'>Contact</label>
                        <input class="form-control" type="number" name="contact"  value="<?php echo $contact?>">
                        <div class="errormsg"><?php echo $errormsg['contact'] ?></div>
                    </div>
                    <div class="place-of-birth adbox">
                        <label for="place-of-birth" class="form-label">Place of Birth</label>
                        <input class="form-control" type="text" name="place-of-birth"  value="<?php echo $place?>">
                        <div class="errormsg"><?php echo $errormsg['place'] ?></div>
                    </div>
                </div>
        
            </div>
            <div class="info-submit">
                <input id="submit" type="submit" name="submit" class="btn btn-primary">
            </div>
            
            
        
        </form>
    </div>
</body>
</html>