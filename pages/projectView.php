<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <?php
        //Get ID of project from URL
        $projectUrl = selfURL();
        $projectFull = substr($projectUrl,70);
        //Group ID
        $projectID = strtok($projectFull, '=→');

        //project information
        $viewProjectQuery = "SELECT * FROM project WHERE id_project = '$projectID ' ";
        $viewProjectQueryRun = mysqli_query($connect, $viewProjectQuery);
        while($row  = mysqli_fetch_array($viewProjectQueryRun, MYSQLI_BOTH)) {
            $project_name=$row['project_name'];
            $project_description=$row['description'];
        }
         ?>

         <div class="groupBox">
             <!-- BASIC INFORMATION ABOUT GROUP & ADD NEW PROJECT -->
             <div class="groupBoxData">
                <!-- BASIC GROUP INFORMATION IN THIS DIV -->

                    <div class="groupBoxDataInfo ginfo">
                        <h2>About Project &nbsp; &#8628;</h2>
                        <?php
                            echo '<h3>'.$project_name.'</h3> ';
                            echo '<h4>'.$project_description.'</h4> ';

                            //Find Project Admins That Can Create To Do lists
                            $findProjectAdminQuery = " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' AND user_type = '2' ";
                            $findProjectAdminQueryRun = mysqli_query ($connect, $findProjectAdminQuery);
                            while ($row = mysqli_fetch_array($findProjectAdminQueryRun, MYSQLI_BOTH)) {
                                $projectAdminID = $row['id_user'];
                                //Find out if current session user is project admin
                                $sessionUserQuery = "SELECT * FROM user WHERE id_user = '$projectAdminID' ";
                                $sessionUserQueryRun = mysqli_query ($connect, $sessionUserQuery);
                                while ($row = mysqli_fetch_array($sessionUserQueryRun, MYSQLI_BOTH)) {
                                    $sessionUserAdmin = $row['username'];
                                    if ($sessionUserAdmin == $_SESSION['username']) {
                                        $flag = 1;
                                    }
                                }
                            }

                            //Set group admin as project admin
                            $findProjectGroupAdminQuery =  " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' AND user_type = '3' ";
                            $findProjectGroupAdminQueryRun = mysqli_query ($connect, $findProjectGroupAdminQuery);
                            while ($row = mysqli_fetch_array($findProjectGroupAdminQueryRun, MYSQLI_BOTH)) {
                                $projectGroupAdminID = $row['id_user'];
                                //Find out if current session user is group project admin
                                $sessionUsr = "SELECT * FROM user WHERE id_user = '$projectGroupAdminID'  ";
                                $sessionUsrRun = mysqli_query ($connect, $sessionUsr);
                                while ($row = mysqli_fetch_array($sessionUsrRun, MYSQLI_BOTH)) {
                                    $sessionUsr = $row['username'];
                                    if ($sessionUsr == $_SESSION['username']) {
                                        $flag = 1;
                                    }
                                }
                            }

                            //Update project or create todolist
                            if (@$flag == '1') {

                                $updateProject =  '<div id="updateProject">
                                <form id="updateProject" action="updateProject.php" method="GET">
                                    <input type="submit" name="updateProject'.$projectID.'" value="Update Project">
                                </form>
                                </div>';

                                $addToDoList =  '<div id="newToDoList">
                                <form id="newToDoList" action="newToDoCard.php" method="GET">
                                    <input type="submit" name="newToDoList'.$projectID.'" value="New To Do Card">
                                </form>
                                </div>';

                                echo $updateProject;
                                echo $addToDoList;

                            }
                        ?>
                    </div>
                    <!-- MEMBERS GROUP INFO -->
                    <div class="groupBoxDataInfo ginfo ">
                        <!-- ADMIN SECTION MEMBER HERE -->
                        <h2 class ="projectAdmins">Project Admins  &nbsp; &#8628;</h2>
                        <?php
                        //Get admin group users
                        $getProjectUsers = " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' AND user_type = '2' ";
                        $getProjectUsersQuery = mysqli_query ($connect, $getProjectUsers);
                        //Fetch data for group users
                        while ($row = mysqli_fetch_array($getProjectUsersQuery,MYSQLI_BOTH)) {
                            //ID user from group
                            $id_projectMember = $row['id_user'];
                            //Enter user table and get data
                            $projectMemberInfo = " SELECT * FROM user WHERE id_user = '$id_projectMember' ";
                            $projectMemberInfoQueryRun = mysqli_query ($connect, $projectMemberInfo);
                            //Array to save data
                            while ($row = mysqli_fetch_array($projectMemberInfoQueryRun,MYSQLI_BOTH)) {
                                $userid = $row['id_user'];
                                $username = $row['username'];
                                $fname=$row['fname'];
                                $lname=$row['lname'];
                                $avatar = $row['avatar'];

                                @$projectMember = '<div id="groupAdminShow"><div id="groupAdminShowAvatar"><img src=" '.$avatar.' "></div><div id="AdminInfo"><h5>'.$fname.' '.$lname.'</h5><h6>'.$username.'</h6></div></div>';

                                echo $projectMember;
                            }
                        }
                         ?>
                        <!-- NORMAL MEMBERS SECTION HERE -->
                        <h2>Project Members &nbsp; &#8628;</h2>
                        <?php
                        //Get admin group users
                        $getProjectUsers = " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' AND user_type = '1' ";
                        $getProjectUsersQuery = mysqli_query ($connect, $getProjectUsers);
                        //Fetch data for group users
                        while ($row = mysqli_fetch_array($getProjectUsersQuery,MYSQLI_BOTH)) {
                            //ID user from group
                            $id_projectMember = $row['id_user'];
                            //Enter user table and get data
                            $projectMemberInfo = " SELECT * FROM user WHERE id_user = '$id_projectMember' ";
                            $projectMemberInfoQueryRun = mysqli_query ($connect, $projectMemberInfo);
                            //Array to save data
                            while ($row = mysqli_fetch_array($projectMemberInfoQueryRun,MYSQLI_BOTH)) {
                                $userid = $row['id_user'];
                                $username = $row['username'];
                                $fname=$row['fname'];
                                $lname=$row['lname'];
                                $avatar = $row['avatar'];

                                @$projectMember = '<div id="groupMemberShow"><div id="groupMemberShowAvatar"><img src=" '.$avatar.' "></div><div id="MemberInfo"><h5>'.$fname.' '.$lname.'</h5><h6>'.$username.'</h6></div>';

                                echo $projectMember;

                                //Delete members admin privilage
                                //.........................................................

                                //Find Project Admins That Can Create To Do lists
                                $findProjectAdminQuery = " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' AND user_type = '2' ";
                                $findProjectAdminQueryRun = mysqli_query ($connect, $findProjectAdminQuery);
                                while ($row = mysqli_fetch_array($findProjectAdminQueryRun, MYSQLI_BOTH)) {
                                    $projectAdminID = $row['id_user'];
                                    //Find out if current session user is project admin
                                    $sessionUserQuery = "SELECT * FROM user WHERE id_user = '$projectAdminID' ";
                                    $sessionUserQueryRun = mysqli_query ($connect, $sessionUserQuery);
                                    while ($row = mysqli_fetch_array($sessionUserQueryRun, MYSQLI_BOTH)) {
                                        $sessionUserAdmin = $row['username'];
                                        if ($sessionUserAdmin == $_SESSION['username']) {
                                            $flag = 1;
                                        }
                                    }
                                }

                                //Set group admin as project admin
                                $findProjectGroupAdminQuery =  " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' AND user_type = '3' ";
                                $findProjectGroupAdminQueryRun = mysqli_query ($connect, $findProjectGroupAdminQuery);
                                while ($row = mysqli_fetch_array($findProjectGroupAdminQueryRun, MYSQLI_BOTH)) {
                                    $projectGroupAdminID = $row['id_user'];
                                    //Find out if current session user is group project admin
                                    $sessionUsr = "SELECT * FROM user WHERE id_user = '$projectGroupAdminID'  ";
                                    $sessionUsrRun = mysqli_query ($connect, $sessionUsr);
                                    while ($row = mysqli_fetch_array($sessionUsrRun, MYSQLI_BOTH)) {
                                        $sessionUsr = $row['username'];
                                        if ($sessionUsr == $_SESSION['username']) {
                                            $flag = 1;
                                        }
                                    }
                                }

                                //Update project or create todolist
                                if (@ $flag == '1') {
                                    $deleteMember =  '<div id="deleteMember">
                                        <form action="removePU.php" method="GET">
                                            <input type="submit" name="remove'.$userid.'*'.$projectID.'" value = "-">
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

             <div class="groupBoxData projects todolist">
                <h2>To Do Cards</h2>
                <div class="todolist">
                    <?php
                    $cardIDQuery = " SELECT * FROM project_card WHERE id_project = '$projectID' ";
                    $cardIDQueryRun = mysqli_query ($connect, $cardIDQuery);
                    while ($row = mysqli_fetch_array($cardIDQueryRun, MYSQLI_BOTH)) {
                        $cardID = $row['id_card'];

                        //Find card info
                        @$showCardQuery = " SELECT * FROM card WHERE id_card = '$cardID' ";
                        $showCardQueryRun = mysqli_query ($connect, $showCardQuery);
                        while ($row = mysqli_fetch_array($showCardQueryRun, MYSQLI_BOTH)) {
                            $cardID = $row['id_card'];
                            $cardName = $row['card_name'];
                            $cardDesc = $row['description'];
                            $cardDeadline = $row['deadline'];

                            $showCard = ' <div id="showCardMain">
                                                        <div id="showCard">
                                                            <h4>'.$cardName.'</h4>
                                                            <h5>'.$cardDesc.'</h5>
                                                            <div id="deadline"><h6>'.$cardDeadline.'</h6></div>
                                                        </div>
                                                        ';

                            echo $showCard;

                            //Find Project Admins That Can Delete To Do lists
                            $findProjectAdminQuery = " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' AND user_type = '2' ";
                            $findProjectAdminQueryRun = mysqli_query ($connect, $findProjectAdminQuery);
                            while ($row = mysqli_fetch_array($findProjectAdminQueryRun, MYSQLI_BOTH)) {
                                $projectAdminID = $row['id_user'];
                                //Find out if current session user is project admin
                                $sessionUserQuery = "SELECT * FROM user WHERE id_user = '$projectAdminID' ";
                                $sessionUserQueryRun = mysqli_query ($connect, $sessionUserQuery);
                                while ($row = mysqli_fetch_array($sessionUserQueryRun, MYSQLI_BOTH)) {
                                    $sessionUserAdmin = $row['username'];
                                    if ($sessionUserAdmin == $_SESSION['username']) {
                                        $flag = 1;
                                    }
                                }
                            }

                            //Set group admin as project admin
                            $findProjectGroupAdminQuery =  " SELECT * FROM user_group_project_membership WHERE id_project = '$projectID' AND user_type = '3' ";
                            $findProjectGroupAdminQueryRun = mysqli_query ($connect, $findProjectGroupAdminQuery);
                            while ($row = mysqli_fetch_array($findProjectGroupAdminQueryRun, MYSQLI_BOTH)) {
                                $projectGroupAdminID = $row['id_user'];
                                //Find out if current session user is group project admin
                                $sessionUsr = "SELECT * FROM user WHERE id_user = '$projectGroupAdminID'  ";
                                $sessionUsrRun = mysqli_query ($connect, $sessionUsr);
                                while ($row = mysqli_fetch_array($sessionUsrRun, MYSQLI_BOTH)) {
                                    $sessionUsr = $row['username'];
                                    if ($sessionUsr == $_SESSION['username']) {
                                        $flag = 1;
                                    }
                                }
                            }

                            //Update project or create todolist
                            if (@ $flag == '1') {
                                $deleteMember =  '<div id="removeCard">
                                    <form action="removeCard.php" method="GET">
                                        <input type="submit" name="remove'.$cardID.'" value = "-">
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
         </div>



    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
