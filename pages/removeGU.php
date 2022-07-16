<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <?php

            //Get ID of user from URL
            $removeGUurl = selfURL();
            $removeGUurl_ID = substr($removeGUurl,62);
            $rguID = strtok($removeGUurl_ID, '=-');

            $deleteGroupMemberQuery = " DELETE FROM user_group_membership WHERE id_user = '$rguID' ";
            $deleteGroupMemberQueryRun = mysqli_query($connect, $deleteGroupMemberQuery);
            echo 'User removed successfully!'
         ?>

    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
