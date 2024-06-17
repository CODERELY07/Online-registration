<?php
    include('config/dbcheck.php');
    $errormsg = array('srn' => '', 'mode'=>'', 'firstname'=>'', 'middlename'=>'', 'lastname'=>'', 'address'=>'', 'gender'=>'',  'birth'=>'', 'email' => '', 'contact'=>'', 'place'=>'',);
    $srn = $mode = $firstname = $midname = $lastname = $suffix = $address = $gender = $rank = $birth = $contact = $status = $email = $place = '';

    if(isset($_POST['submit'])){
        #SRN number checker
        if (empty($_POST['srn'])) {
            #Creating an error message
            $errormsg['srn'] = 'Please don\'t leave this blank';
        } elseif (!preg_match('/^[0-9]{10}$/', $_POST['srn'])) {
             #Checking if the inputed data is not correct
            $errormsg['srn'] = 'Must be composed of 10 digits only';
        } else {
               #Storing the data to a variable
            $srn = $_POST['srn'];
        }

        #mode of learning checker
        if (empty($_POST['mode'])) {
            #Creating an error message
            $errormsg['mode'] = 'Please don\'t leave this blank';
        }
        else{
            #Storing the data to a variable
            $mode = $_POST['mode'];
        }

        #First Name checker
        if (empty($_POST['firstname'])) {
            #Creating an error message
            $errormsg['firstname'] = 'Please don\'t leave this blank';
        }elseif (!preg_match('/^[a-zA-Z\s]+$/', $_POST['firstname'])) {
            #Checking if the inputed data is not correct
            $errormsg['firstname'] = 'Please enter a proper first name';
        } else {
            #Storing the data to a variable
            $firstname = $_POST['firstname'];
        }

        #Middle Name checker
        if (empty($_POST['midname'])) {
            #Creating an error message
            $errormsg['middlename'] = 'Please don\'t leave this blank';
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', $_POST['midname'])) {
            #Checking if the inputed data is not correct
            $errormsg['middlename'] = 'Please enter a proper middle name';
        } else {
            #Storing the data to a variable
            $midname = $_POST['midname'];
        }


        #Last Name checker
        if (empty($_POST['lastname'])) {
            #Creating an error message
            $errormsg['lastname'] = 'Please don\'t leave this blank';
        }elseif (!preg_match('/^[a-zA-Z\s]+$/', $_POST['lastname'])) {
             #Storing the data to a variable
            $errormsg['lastname'] = 'Please enter a proper last name';
        } else {
               #Checking if the inputed data is not correct
            $lastname = $_POST['lastname'];
        }

        #Suffix checker
        if ($_POST['suffix']) {
             #Storing the data to a variable
            $suffix = $_POST['suffix'];
        }

        #Address checker
        if (empty($_POST['address'])) {
            #Creating an error message
            $errormsg['address'] = 'Please don\'t leave this blank';
        }elseif (!preg_match('/^[a-zA-Z\s,]+$/', $_POST['address'])) {
            #Checking if the inputed data is not correct
            $errormsg['address'] = 'Enter a valid address (ex: Barangay, Municipality Province)';
        } else {
            #Storing the data to a variable
            $address = $_POST['address'];
        }
      
        #Gender checker
        if (empty($_POST['gender'])) {
            #Creating an error message
            $errormsg['gender'] = 'Please don\'t leave this blank';
        }
        else{
            #Storing the data to a variable
            $gender = $_POST['gender'];
        }

        #Rank checker
        if ($_POST['position']) {
            #Storing the data to a variable
           $rank = $_POST['position'];
       }

        #Birthday checker
        if (empty($_POST['date'])) {
            #Creating an error message
            $errormsg['birth'] = 'Please don\'t leave this blank';
        }
        else{
            #Storing the data to a variable
            $birth = $_POST['date'];
        }

        #Contact checker
        if (empty($_POST['contact'])) {
            #Creating an error message
            $errormsg['contact'] = 'Please don\'t leave this blank';
        }
        elseif (!preg_match('/^[0-9]{11}$/', $_POST['contact'])) {
            #Checking if the inputed data is not correct
            $errormsg['contact'] = 'Please enter a proper phone number';
        } else {
            #Storing the data to a variable
            $contact = $_POST['contact'];
        }


        #Email checker
        if ($_POST['email']) {
          
            $email = $_POST['email'];
           
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errormsg['email'] = 'Please enter a proper email address';
            }
        }

        if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errormsg['email'] = 'Please enter a proper email address';
        } else {
              #Storing the data to a variable
            $email = $_POST['email'];
        }

        #Place of birth checker
        #Checking if the inputed data is not correct
        if (!empty($_POST['place-of-birth']) && !preg_match('/^[a-zA-Z\s,]+$/', $_POST['place-of-birth'])) {
            $errormsg['place'] = 'Enter a valid place of birth (ex: Barangay, Municipality Province)';
        } else {
             #Storing the data to a variable
            $place = $_POST['place-of-birth'];
        }

        if (!empty($_POST['status'])) {
            $status = $_POST['status'];
        }
        if (!empty($_POST['contact'])) {
            $contact = $_POST['contact'];
        }

        if(array_filter($errormsg)){
            echo "Unable to proceed, error/s detected!";
        }
        else{
            #filtering data
            $srn = mysqli_real_escape_string($connect, $_POST['srn']);
            $mode = mysqli_real_escape_string($connect, $_POST['mode']);
            $firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
            $middlename = mysqli_real_escape_string($connect, $_POST['midname']);
            $lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
            $suffix = mysqli_real_escape_string($connect, $_POST['suffix']);
            $address = mysqli_real_escape_string($connect, $_POST['address']);
            $gender = mysqli_real_escape_string($connect, $_POST['gender']);
            $position = mysqli_real_escape_string($connect, $_POST['position']);
            $birth = mysqli_real_escape_string($connect, $_POST['date']);
            $contact = mysqli_real_escape_string($connect, $_POST['contact']);
            $status = mysqli_real_escape_string($connect, $_POST['status']);
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $place = mysqli_real_escape_string($connect, $_POST['place-of-birth']);

            #Putting data on the database
            $sql = "INSERT INTO trainees(srn_number,mode,firstname,middlename,lastname,suffix,addrss,gender,position,birth,stat,email,place,contact) VALUES('$srn','$mode','$firstname','$midname','$lastname','$suffix','$address','$gender','$rank','$birth','$status','$email','$place','$contact') ";

            #checking if there is a connection on the database
            if(mysqli_query($connect,$sql)){
                echo "success";
                header("Location: form.php");
                exit();
            }
            else{
                echo "query_error:" . mysqli_error($connect);
            }
        }


    }


?>