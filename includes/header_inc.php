<?php session_start(); ?>
<?php include ("../includes/connect_inc.php"); ?>
<?php include ("../includes/login_inc.php"); ?>
<?php include ("../includes/search_inc.php"); ?>
<?php include ("../includes/functions_inc.php"); ?>
<?php include ("../includes/group_inc.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tracker</title>
        <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/headerFooter.css">
        <link rel="stylesheet" type="text/css" href="../css/homepage.css">
        <link rel="stylesheet" type="text/css" href="../css/logout.css">
        <link rel="stylesheet" type="text/css" href="../css/profile.css">
        <link rel="stylesheet" type="text/css" href="../css/accountSettings.css">
        <link rel="stylesheet" type="text/css" href="../css/search.css">
        <link rel="stylesheet" type="text/css" href="../css/groupCreate.css">
        <link rel="stylesheet" type="text/css" href="../css/viewProfile.css">
        <link rel="stylesheet" type="text/css" href="../css/groupView.css">
        <link rel="stylesheet" type="text/css" href="../css/updateGroup.css">
        <link rel="stylesheet" type="text/css" href="../css/projectView.css">
        <link rel="stylesheet" type="text/css" href="../css/newToDoCard.css">
    </head>
    <body>
        <header>
            <div id="wrapper">

                <div id="logo">
                    <a href="homepage.php">
                        <img src="../images/trackerLogo.png" alt="Official Tracker Logo">
                    </a>
                </div>

                <div id="groupPlus">
                    <a href="groupCreate.php">+</a>
                </div>

                <div id="searchBox">
                    <form id="search" action="../pages/search.php" method="POST">
                        <input type="text" name="search_Box" class="search_Box" size="15" placeholder="Search...">
                        <input type="submit" name="searchSubmit" value="&#187;">
                    </form>
                </div>

                <div id="mainNavbar">
                    <a href="profile.php" id="profile"> <?php echo $_SESSION['username']; ?> </a>
                    <a href="homepage.php" id="homepage">Dashboard</a>
                    <a href="accountsettings.php" id="accountsettings">Account Settings</a>
                    <a href="logout.php" id="logout">Logout</a>
                </div>

            </div>
        </header>
