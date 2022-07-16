<?php
    $logout = isset($_POST['logout']);

    if($logout) {
        session_destroy();
        header('location: ../index.php');
    }
 ?>
