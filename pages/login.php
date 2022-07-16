<?php session_start(); ?>
<?php include ("../includes/connect_inc.php"); ?>
<?php include ("../includes/login_inc.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tracker</title>
        <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="../css/normalize.css">
        <link rel="stylesheet" type="text/css" href="../css/master.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <div class="header">
            <div id="wrapper">

                <div class="logo">
                    <a href="../index.php">
                        <img src="../images/trackerLogo.png" alt="Tracker Logo">
                    </a>
                </div>

                <div class="IndexMenu">
                    <a href="../index.php">Register</a>
                    <a href="#">About</a>
                </div>

            </div>
        </div>

        <div class="introSection">
            <div id="wrapper">

                <div class="loginFormBox">
                    <h2>Welcome</h2>
                    <form class="loginForm" action="#" method="post">
                        <input type="text" name="username" placeholder="Username" required> <br>
                        <input type="password" name="password" placeholder="Password" required> <br>
                        <input type="submit" name="login" value="Login" class="login">
                    </form>
                </div>

            </div>
        </div>

        <div class="footer">
            <div id="wrapper">
                <p>2017 &copy; Tracker</p>
            </div>
    </body>
