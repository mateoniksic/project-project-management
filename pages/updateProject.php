<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">

        <?php
        //Project ID
        $projectUrl = selfURL();
        $projectIDFull = substr($projectUrl,74);
        $projectID = strtok($projectIDFull, '=Update+Project');
        //Project information
        $projectInfoQuery = " SELECT * FROM project WHERE id_project = '$projectID' ";
        $projectInfoQueryRun = mysqli_query ($connect, $projectInfoQuery);
        while ($row = mysqli_fetch_array($projectInfoQueryRun, MYSQLI_BOTH)) {
            $projectName = $row['project_name'];
            $projectDesc = $row['description'];
        }
        //Group id
        $pGroupID = " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' ";
        $pGroupIDRun = mysqli_query ($connect, $pGroupID);
        while ($row = mysqli_fetch_array($pGroupIDRun, MYSQLI_BOTH)) {
            $groupID = $row['id_group'];
        }
        //Update project
        $updateProject = isset($_POST['updateProject']);
        if ($updateProject) {
            $projectName =strip_tags($_POST['project_name']);
            $projectDesc = strip_tags($_POST['project_description']);
            $project_addMember =strip_tags($_POST['project_addMember']);
            $project_setAdmin = strip_tags($_POST['project_setAdmin']);
            //Update name and description
            $updateProjectQuery = " UPDATE project SET project_name = '$projectName', description = '$projectDesc' WHERE id_project = '$projectID' ";
            $updateProjectQueryRun = mysqli_query ($connect, $updateProjectQuery);
            //Add members to project
            $projectMemberArray = explode (" ", $project_addMember);
            foreach ($projectMemberArray as $project_member) {
                //Find member id
                $getProjectMemberID = " SELECT * FROM user WHERE username = '$project_member' ";
                $getProjectMemberIDqueryRun = mysqli_query($connect,$getProjectMemberID);
                //Saving member ID in variable
                while($row  = mysqli_fetch_array($getProjectMemberIDqueryRun, MYSQLI_BOTH)) {
                    @$id_ProjectMember = $row['id_user'];
                }
                //Save users to user_group_membership with default privilage 1
                @$insertBasicProjectMember = " INSERT INTO user_group_project_membership (id_user, id_group, id_project, user_type) VALUES ('$id_ProjectMember','$groupID','$projectID','1') ";
                $insertBasicProjectMemberQueryRun = mysqli_query($connect, $insertBasicProjectMember);
            }
            //=======================================
            //Add admins for project
            $projectAdminArray = explode (" ", $project_setAdmin);
            foreach ($projectAdminArray as $projectAdmin) {
                //Find member id
                $getProjectAdminID = " SELECT * FROM user WHERE username = '$projectAdmin' ";
                $getProjectAdminIDqueryRun = mysqli_query($connect,$getProjectAdminID);
                //Saving member ID in variable
                while($row  = mysqli_fetch_array($getProjectAdminIDqueryRun, MYSQLI_BOTH)) {
                    @$id_ProjectAdmin = $row['id_user'];
                }
                //Save users to user_group_membership with default privilage 1
                @$insertProjectAdminMember = " INSERT INTO user_group_project_membership (id_user, id_group, id_project, user_type) VALUES ('$id_ProjectAdmin','$groupID','$projectID','2') ";
                $insertProjectAdminMemberQueryRun = mysqli_query($connect, $insertProjectAdminMember);
            }
        }

        ?>

        <form class="groupCreate" action="#" method="POST">
            <div class="mainFormDiv">

                <div class="FormDiv basicgInfo">
                    <h1>Update Project</h1>
                    <hr>

                    <label for="project_name">Project Name</label><br>
                    <input type="text" name="project_name" value="<?php echo $projectName; ?>" size=40; style="display:table-cell;"> <br>

                    <label for="project_description">About This Project</label><br>
                    <textarea name="project_description"  value="" rows = "5" cols = "44"><?php echo $projectDesc; ?></textarea><br>

                    <label for="project_addMember">Add Members By Username</label><br>
                    <input type="text" name="project_addMember" value="" size=40; style="display:table-cell;"> <br>

                    <label for="project_setAdmin">Set Project Admins By Username</label><br>
                    <input type="text" name="project_setAdmin" value="" size=40; style="display:table-cell;"> <br>
                    <p>(Note: add space after every username! <br> e.g. user1 user2 ...)</p> <br>

                    <input type="submit" name="updateProject" value="Update">
                </div>

                <div class="FormDiv">
                </div>
            </div>
        </form>

    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
