<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <?php
            //Get ID of group from URL
            $groupUrl = selfURL();
            $groupIDFull = substr($groupUrl,66);
            //Group ID
            $groupID = strtok($groupIDFull, '=Enter');
            //Get group information
            $viewGroupQuery = "SELECT * FROM _group WHERE id_group = '$groupID ' ";
            $viewGroupQueryRun = mysqli_query($connect, $viewGroupQuery);
            while($row  = mysqli_fetch_array($viewGroupQueryRun, MYSQLI_BOTH)) {
                $group_name=$row['group_name'];
                $group_description=$row['description'];
                $group_type = $row['group_type'];
                $groupDate = $row['created_date'];
                if ($group_type == '1') {
                    $group_type = 'Secret';
                }
                if ($group_type == '2') {
                    $group_type = 'Private';
                }
                if ($group_type == '3') {
                    $group_type = 'Public';
                }
            }
         ?>

         <div class="groupBox">
             <!-- BASIC INFORMATION ABOUT GROUP & ADD NEW PROJECT -->
             <div class="groupBoxData">
                <!-- BASIC GROUP INFORMATION IN THIS DIV -->
                <div class="groupBoxDataInfo ginfo ">
                    <h2>About group &nbsp; &#8628;</h2>
                    <?php
                        echo '<h3>'.$group_name.'</h3> ';
                        echo '<h4>'.$group_description.'</h4> ';
                        echo '<p>Group type: '.$group_type.'<br>  Created on: '.$groupDate;'</p>';

                        //UPDATE GROUP PRIVILAGE
                        //Find admins
                        $find_adminsQuery = " SELECT * FROM user_group_membership WHERE user_type = '2' AND id_group = $groupID ";
                        $find_adminsQueryRun = mysqli_query ($connect, $find_adminsQuery);
                        //Get their IDs
                        while($row  = mysqli_fetch_array($find_adminsQueryRun, MYSQLI_BOTH)) {
                            $admin=$row['user_type'];
                            $admin_id = $row['id_user'];

                            $sesUserQuery = " SELECT * FROM user WHERE id_user = '$admin_id' ";
                            $sesUserQueryRun = mysqli_query ($connect, $sesUserQuery);
                            //Get their IDs
                            while($row  = mysqli_fetch_array($sesUserQueryRun, MYSQLI_BOTH)) {
                                // Current user id - Check if he is admin
                                $sesUserAdmin=$row['username'];
                                if ($sesUserAdmin == $_SESSION['username']) {
                                    $flag = 1;
                                }
                            }
                        }
                        // Echo remove button
                        if (@ $flag == '1') {
                            $updateGroup =  '<div id="updateGroup">
                            <form id="updateGroup" action="updateGroup.php" method="GET">
                                <input type="submit" name="updateGroup'.$groupID.'" value="Update Group">
                            </form>
                            </div>';

                            $addProject =  '<div id="addProject">
                            <form id="newProject" action="newProject.php" method="GET">
                                <input type="submit" name="newProject'.$groupID.'" value="New Project">
                            </form>
                            </div>';

                            echo $updateGroup;
                            echo $addProject;
                            $flag = 0;
                        }
                     ?>
                </div>
                <!-- MEMBERS GROUP INFO -->
                <div class="groupBoxDataInfo ginfo">
                    <!-- ADMIN SECTION MEMBER HERE -->
                    <h2>Admins  &nbsp; &#8628;</h2>
                    <?php
                    //Get admin group users
                    $getGroupUsers = " SELECT * FROM user_group_membership WHERE id_group = '$groupID' AND user_type = '2' ";
                    $getGroupUsersQuery = mysqli_query ($connect, $getGroupUsers);
                    //Fetch data for group users
                    while ($row = mysqli_fetch_array($getGroupUsersQuery,MYSQLI_BOTH)) {
                        //ID user from group
                        $id_user = $row['id_user'];
                        //Enter user table and get data
                        $groupUserInfo = " SELECT * FROM user WHERE id_user = '$id_user' ";
                        $groupUserInfoQueryRun = mysqli_query ($connect, $groupUserInfo);
                        //Array to save data
                        while ($row = mysqli_fetch_array($groupUserInfoQueryRun,MYSQLI_BOTH)) {
                            $userid = $row['id_user'];
                            $username = $row['username'];
                            $fname=$row['fname'];
                            $lname=$row['lname'];
                            $avatar = $row['avatar'];

                            @$groupMember = '<div id="groupAdminShow"><div id="groupAdminShowAvatar"><img src=" '.$avatar.' "></div><div id="AdminInfo"><h5>'.$fname.' '.$lname.'</h5><h6>'.$username.'</h6></div></div>';

                            echo $groupMember;
                        }
                    }
                     ?>
                    <!-- NORMAL MEMBERS SECTION HERE -->
                    <h2>Members &nbsp; &#8628;</h2>
                    <?php
                    //Get group users
                    $getGroupUsers = " SELECT * FROM user_group_membership WHERE id_group = '$groupID'  AND user_type != '2' ";
                    $getGroupUsersQuery = mysqli_query ($connect, $getGroupUsers);
                    //Fetch data for group users
                    while ($row = mysqli_fetch_array($getGroupUsersQuery,MYSQLI_BOTH)) {
                        //ID user from group
                        $id_user = $row['id_user'];
                        //Enter user table and get data
                        $groupUserInfo = " SELECT * FROM user WHERE id_user = '$id_user' ";
                        $groupUserInfoQueryRun = mysqli_query ($connect, $groupUserInfo);
                        //Array to save data
                        while ($row = mysqli_fetch_array($groupUserInfoQueryRun,MYSQLI_BOTH)) {
                            $userid = $row['id_user'];
                            $username = $row['username'];
                            $fname=$row['fname'];
                            $lname=$row['lname'];
                            $avatar = $row['avatar'];

                            @$groupMember = '<div id="groupMemberShow"><div id="groupMemberShowAvatar"><img src=" '.$avatar.' "></div><div id="MemberInfo"><h5>'.$fname.' '.$lname.'</h5><h6>'.$username.'</h6></div>
                            ';
                            echo $groupMember;

                            //Delete members admin privilage
                            //.....................................................................
                            //Find admins
                            $find_adminsQuery = " SELECT * FROM user_group_membership WHERE user_type = '2' AND id_group = $groupID ";
                            $find_adminsQueryRun = mysqli_query ($connect, $find_adminsQuery);
                            //Get their IDs
                            while($row  = mysqli_fetch_array($find_adminsQueryRun, MYSQLI_BOTH)) {
                                $admin=$row['user_type'];
                                $admin_id = $row['id_user'];

                                $sesUserQuery = " SELECT * FROM user WHERE id_user = '$admin_id' ";
                                $sesUserQueryRun = mysqli_query ($connect, $sesUserQuery);
                                //Get their IDs
                                while($row  = mysqli_fetch_array($sesUserQueryRun, MYSQLI_BOTH)) {
                                    // Current user id - Check if he is admin
                                    $sesUserAdmin=$row['username'];
                                    if ($sesUserAdmin == $_SESSION['username']) {
                                        $flag = 1;
                                    }
                                }
                            }
                            // Echo remove button
                            if (@ $flag == '1') {
                                $deleteMember =  '<div id="deleteMember">
                                    <form action="removeGU.php" method="GET">
                                        <input type="submit" name="remove'.$userid.'" value = "-">
                                    </form>
                                </div></div>';

                                echo $deleteMember;
                                $flag = 0;
                            } else {
                                echo '</div>';
                            }

                        }
                    }
                     ?>
                </div>
             </div>
             <!-- PROJECTS FROM THE GROUP -->
             <div class="groupBoxData projects">
                 <h2>Group Projects &nbsp; &#8628;</h2>
                 <?php
                    // FIND GROUP PROJECTS
                    $groupProject = " SELECT * FROM user_group_project_membership WHERE id_group ='$groupID'  AND user_type = '3' ";
                    $groupProjectQueryRun = mysqli_query ($connect, $groupProject);
                    while ($row  = mysqli_fetch_array($groupProjectQueryRun, MYSQLI_BOTH)) {
                        $ProjectID = $row['id_project'];

                        //Find Project names
                        $projectInfo = " SELECT * FROM project where id_project = '$ProjectID' ";
                        $projectInfoQueryRun = mysqli_query ($connect, $projectInfo);
                        while ($row = mysqli_fetch_array($projectInfoQueryRun, MYSQLI_BOTH)) {
                            $ProjectName = $row['project_name'];
                            $projectInfo = '<div id="showProjectRelative"> <div id="showProject"> <h3>'.$ProjectName.' </h3>
                            <div id="enterProject">
                            <form action="../pages/projectView.php" method="GET">
                                <input type="submit" name="viewProject'.$ProjectID.'" value="&#8594;">
                            </form>
                            </div>';
                            $removeProject = '<div id="removeProject">
                            <form action="../pages/removeProject.php" method="GET">
                                <input type="submit" name="removeProject'.$ProjectID.'" value="x">
                            </form>
                            </div>';
                            $end = '</div></div>';

                            //Find admins
                            $find_adminsQuery = " SELECT * FROM user_group_membership WHERE user_type = '2' AND id_group = $groupID ";
                            $find_adminsQueryRun = mysqli_query ($connect, $find_adminsQuery);
                            //Get their IDs
                            while($row  = mysqli_fetch_array($find_adminsQueryRun, MYSQLI_BOTH)) {
                                $admin=$row['user_type'];
                                $admin_id = $row['id_user'];

                                $sesUserQuery = " SELECT * FROM user WHERE id_user = '$admin_id' ";
                                $sesUserQueryRun = mysqli_query ($connect, $sesUserQuery);
                                //Get their IDs
                                while($row  = mysqli_fetch_array($sesUserQueryRun, MYSQLI_BOTH)) {
                                    // Current user id - Check if he is admin
                                    $sesUserAdmin=$row['username'];
                                    if ($sesUserAdmin == $_SESSION['username']) {
                                        $flag = 1;
                                    }
                                }
                            }
                            // Echo remove button
                            if (@ $flag == '1') {
                                echo $projectInfo;
                                echo $removeProject;
                                echo $end;
                                $flag = 0;
                            } else {
                                echo $projectInfo;
                                echo $end;
                            }


                        }
                    }
                  ?>
             </div>

         </div>


</section>

<?php include ("../includes/footer_inc.php"); ?>
