<?php
    include ("connect_inc.php");

    $login = isset($_POST['login']);

    if ($login) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user WHERE username = '$username' AND password='$password' ";
        $query_run = mysqli_query($connect, $query);

        if(mysqli_num_rows($query_run) > 0) {
            //Valid

            //Session Variable
            $_SESSION['username'] = $username;
            
            header('location: ../pages/homepage.php');
        } else {
            //Invalid
            echo '<script type="text/javascript"> alert("Invalid Credentials"); </script>';
        }
    }

 ?>
