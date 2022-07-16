<?php include ("../includes/header_inc.php"); ?>


<section class="Body">
    <div id="wrapper">
        <?php
        $createProject = isset($_POST['createProject']);
        if ($createProject) {
            $projectName =strip_tags($_POST['project_name']);
            $projectDesc = strip_tags($_POST['project_description']);
            $project_addMember =strip_tags($_POST['project_addMember']);
            $project_setAdmin = strip_tags($_POST['project_setAdmin']);

            //=======================================
            //Find group ID
            $groupUrl = selfURL();
            $groupIDFull = substr($groupUrl,68);
            $groupID = strtok($groupIDFull, '=New+Project');
            //=======================================
            //Find current user ID
            $currUser = $_SESSION['username'];
            $getCurrUserID = " SELECT * FROM user WHERE username = '$currUser' ";

            $getCurrUserIDqueryRun = mysqli_query($connect, $getCurrUserID);
            while($row  = mysqli_fetch_array($getCurrUserIDqueryRun, MYSQLI_BOTH)) {
                $id_userCreateProject = $row['id_user'];
            }
            //=======================================
            //Insert Data into project table
            $createProjectQuery = " INSERT INTO project (project_name, description) VALUES ('$projectName','$projectDesc') ";
            $createProjectQueryRun = mysqli_query($connect, $createProjectQuery);
            //=======================================
            //Get created Project ID
            $getCurrProjectID = " SELECT * FROM project WHERE project_name = '$projectName' AND description = '$projectDesc' ";
            $getCurrProjectIDqueryRun = mysqli_query($connect, $getCurrProjectID);

            while($row  = mysqli_fetch_array($getCurrProjectIDqueryRun, MYSQLI_BOTH)) {
                $id_project = $row['id_project'];
            }
            //=======================================
            //Add project creator to project
            $insertProjectAdmin = " INSERT INTO user_group_project_membership (id_user, id_group, id_project, user_type) VALUES ('$id_userCreateProject','$groupID','$id_project','3')  ";
            $insertProjectAdminQueryRun = mysqli_query($connect, $insertProjectAdmin);
            //=======================================
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
                @$insertBasicProjectMember = " INSERT INTO user_group_project_membership (id_user, id_group, id_project, user_type) VALUES ('$id_ProjectMember','$groupID','$id_project','1') ";
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
                @$insertProjectAdminMember = " INSERT INTO user_group_project_membership (id_user, id_group, id_project, user_type) VALUES ('$id_ProjectAdmin','$groupID','$id_project','2') ";
                $insertProjectAdminMemberQueryRun = mysqli_query($connect, $insertProjectAdminMember);
            }
        }
        ?>

        <form class="groupCreate" action="#" method="POST">
            <div class="mainFormDiv">

                <div class="FormDiv basicgInfo">
                    <h1>New Project</h1>
                    <hr>

                    <label for="project_name">Project Name</label><br>
                    <input type="text" name="project_name" value="" size=40; style="display:table-cell;"> <br>

                    <label for="project_description">About This Project</label><br>
                    <textarea name="project_description"  value="" rows = "5" cols = "44"></textarea><br>

                    <label for="project_addMember">Add Members By Username</label><br>
                    <input type="text" name="project_addMember" value="" size=40; style="display:table-cell;"> <br>

                    <label for="project_setAdmin">Set Project Admins By Username</label><br>
                    <input type="text" name="project_setAdmin" value="" size=40; style="display:table-cell;"> <br>
                    <p>(Note: add space after every username! <br> e.g. user1 user2 ...)</p> <br>

                    <input type="submit" name="createProject" value="Create">
                </div>

                <div class="FormDiv">
                </div>
            </div>
        </form>
    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
