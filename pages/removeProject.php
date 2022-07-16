<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <?php
            //Get ID of project from URL
            $projectUrl = selfURL();
            $projectFull = substr($projectUrl,74);
            //Group ID
            $projectID = strtok($projectFull, '=x');

            //Delete from user group project membership table all users connect with this project id
           $removeUsersGroupProjectQuery = " DELETE FROM user_group_project_membership WHERE id_project = '$projectID' ";
           $removeUsersGroupProjectQueryRun = mysqli_query ($connect, $removeUsersGroupProjectQuery);

           //Delete project from project table
           $removeGroupProjectQuery = " DELETE FROM project WHERE id_project = '$projectID' ";
           $removeGroupProjectQueryRun = mysqli_query ($connect, $removeGroupProjectQuery);

           echo 'Project was removed successfully!';
         ?>
    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
