 <?php include ("../includes/header_inc.php"); ?>

 <section class="Body">
     <div id="wrapper">
         <?php
             //Get ID of group from URL
             $groupUrl = selfURL();
             $groupIDFull = substr($groupUrl,66);
             //Group ID
             $groupID = strtok($groupIDFull, '=x');
             //Curr Username
             //Find current user ID
             $currUser = $_SESSION['username'];
             $getCurrUserID = " SELECT * FROM user WHERE username = '$currUser' ";

             $getCurrUserIDqueryRun = mysqli_query($connect, $getCurrUserID);
             while($row  = mysqli_fetch_array($getCurrUserIDqueryRun, MYSQLI_BOTH)) {
                 $id_userExit= $row['id_user'];
             }

            $exitGroupQuery = " DELETE FROM user_group_membership WHERE id_group = '$groupID' AND id_user = '$id_userExit' ";
            $exitGroupQueryRun = mysqli_query ($connect, $exitGroupQuery);
            echo 'Group was removed successfully!';
          ?>
     </div>
 </section>

 <?php include ("../includes/footer_inc.php"); ?>
