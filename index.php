<?php include ("./includes/connect_inc.php"); ?>
<?php include ("./includes/register_inc.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tracker</title>
        <link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="./css/normalize.css">
        <link rel="stylesheet" type="text/css" href="./css/master.css">
    </head>
    <body>
        <div class="header">
            <div id="wrapper">

                <div class="logo">
                    <a href="index.php">
                        <img src="images/trackerLogo.png" alt="Tracker Logo">
                    </a>
                </div>

                <div class="IndexMenu">
                    <a href="pages/login.php">Login</a>
                    <a href="#">About</a>
                </div>

            </div>
        </div>

        <div class="introSection">
            <div id="wrapper">
                <div class="signUp">
                    <table>
                        <tr>
                            <td width: "60%" valign:"top">
                                <h2>Join Tracker Today!</h2> <br>
                                <p> Whether it’s for work, a side project or even the next family vacation, Tracker helps your team stay organized.</p>
                            </td>
                            <td width:"40%" valign:"top">
                                <form action="#" method="post">
                                    <input type="text" name="fname" size="25" placeholder="First Name" required> <br>
                                    <input type="text" name="lname" size="25" placeholder="Last Name" required> <br>
                                    <input type="text" name="username" size="25" placeholder="Username" required> <br>
                                    <input type="text" name="email" size="25" placeholder="Email Adress" required> <br>
                                    <input type="password" name="password" size="25" placeholder="Password" required> <br>
                                    <input type="password" name="passwordcheck" size="25" placeholder="Repeat Password" required> <br>
                                    <input type="submit" name="register" value="Sign Up">
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="footer">
            <div id="wrapper">
                <p>2017 &copy; Tracker</p>
            </div>
        </div>


    </body>
</html>
