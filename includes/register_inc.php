<?php
    include ("connect_inc.php");

    $register = isset($_POST['register']);

    //Declaring variables to prevent errors
    $fname = "";  //First name
    $lname = ""; //Last name
    $username = ""; //Username
    $email = ""; //Email adress
    $password = ""; //Password
    $passwordcheck = ""; //Password
    $date = ""; //Date Registered
    $username_exist_check = "";  //Check if username exists

    //If register button is pressed do this
    if ($register) {
        //Grab data from register form
        $fname = strip_tags($_POST['fname']);
        $lname = strip_tags($_POST['lname']);
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $passwordcheck = strip_tags($_POST['passwordcheck']);
        $date = date("Y-m-d");

        if ($password == $passwordcheck) {
            $query = "SELECT * FROM user WHERE username='$username' ";
            $query_run = mysqli_query($connect, $query);

            if(mysqli_num_rows($query_run) > 0) {
                //There is already a user with the same username
                echo '<script type="text/javascript"> alert("User already exists. Try another username!") </script>' ;
            } else {
                $query = "INSERT INTO user (fname,lname,username,email,password,created_date) VALUES ('$fname','$lname','$username','$email','$password','$date') ";
                $query_run = mysqli_query($connect, $query);

                if($query_run) {
                    echo '<script type="text/javascript"> alert("You have been registered! Please log in to access your account!") </script>' ;
                } else {
                    echo '<script type="text/javascript"> alert("Something went wrong. Please try again!") </script>' ;
                }
            }
        } else echo '<script type="text/javascript"> alert("Passwords do not match! Please try again!") </script>' ;;

    }

 ?>
