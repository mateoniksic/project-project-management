<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <?php

            //Get ID of user from URL
            $userID = selfURL();
            $userIDFull = substr($userID,62);
            $UserID = strtok($userIDFull, "*");
            $projectID = selfURL();
            $ProjectIDPart = trim(explode('*', $projectID)[1]);
            $ProjectID = strtok($ProjectIDPart, "=-");

            $deleteProjectMemberQuery = " DELETE FROM user_group_project_membership WHERE id_user = '$UserID' AND id_project = '$ProjectID' ";
            $deleteProjectMemberQueryRun = mysqli_query($connect, $deleteProjectMemberQuery);
            echo 'Project user removed successfully!'
         ?>

    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
