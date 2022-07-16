<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <?php
            // CURRENT GROUP INFORMATION
            // ===========================================================
            //Get ID of group from URL
            $groupUrl = selfURL();
            $groupIDFull = substr($groupUrl,70);
            //Group ID
            $groupID = strtok($groupIDFull, '=Update+Group');
            //Get group information
            $viewGroupQuery = "SELECT * FROM _group WHERE id_group = '$groupID ' ";
            $viewGroupQueryRun = mysqli_query($connect, $viewGroupQuery);
            while($row  = mysqli_fetch_array($viewGroupQueryRun, MYSQLI_BOTH)) {
                $group_name=$row['group_name'];
                $group_description=$row['description'];
                $group_type = $row['group_type'];
            }
            // ============================================================
            //Update Group
            $updateGroup = isset($_POST['updateGroup']);

            if ($updateGroup) {
                @$GroupName = strip_tags($_POST['group_name']);
                @$GroupDesc = strip_tags($_POST['description']);
                @$GroupType = strip_tags($_POST['group_type']);
                @$AddMember = strip_tags($_POST['addMember']);
                @$SetGroupAdmin = strip_tags($_POST['setGroupAdmin']);

                $updateGroupQuery = " UPDATE _group SET  group_name = '$GroupName', description = '$GroupDesc', group_type = '$GroupType' WHERE id_group = '$groupID'  ";
                $updateGroupQuery = mysqli_query ($connect, $updateGroupQuery);

                //Added members split
                $memberArray = explode (" ", $AddMember);
                foreach ($memberArray as $member) {
                    //Find member id
                    $getMemberID = " SELECT * FROM user WHERE username = '$member' ";
                    $getMemberIDqueryRun = mysqli_query($connect,$getMemberID);
                    //Saving member ID in variable
                    while($row  = mysqli_fetch_array($getMemberIDqueryRun, MYSQLI_BOTH)) {
                        @$id_member = $row['id_user'];
                    }
                    //Save users to user_group_membership with default privilage 1
                    @$insertBasicMember = " INSERT INTO user_group_membership (id_user, id_group, user_type) VALUES ('$id_member','$groupID','1')  ";
                    $insertBasicMemberQueryRun = mysqli_query($connect, $insertBasicMember);
                }

                //Set another group Admin
                $adminArray = explode (" ", $SetGroupAdmin);
                foreach ($adminArray as $admin) {
                    //Find member id
                    @$getAdminID = " SELECT * FROM user WHERE username = '$admin' ";
                    $getAdminIDqueryRun = mysqli_query($connect,$getAdminID);
                    //Saving member ID in variable
                    while($row  = mysqli_fetch_array($getAdminIDqueryRun, MYSQLI_BOTH)) {
                        @$id_admin = $row['id_user'];
                    }
                    //Save users to user_group_membership with default privilage 1
                    @$insertAdminMember = " INSERT INTO user_group_membership (id_user, id_group, user_type) VALUES ('$id_admin','$groupID','2')  ";
                    $insertAdminMemberQueryRun = mysqli_query($connect, $insertAdminMember);
                }

                header("Refresh:0");
            }
        ?>


        <!-- FORM INPUT FIELDS -->
        <form class="groupUpdate" action="#" method="post">
            <div class="mainFormDivUpdate">

                <div class="FormDivUpdate basicgInfoUpdate">
                    <h1>Update Group</h1>
                    <hr>

                    <label for="group_name">Group Name</label><br>
                    <input type="text" name="group_name" value="<?php echo $group_name;?>" size=40; style="display:table-cell;"> <br>

                    <label for="description">About This Group</label><br>
                    <textarea name="description"  value="" rows = "5" cols = "44"><?php echo $group_description;?></textarea><br>

                    <label for="addMember">Add Members By Username</label><br>
                    <input type="text" name="addMember" value="" size=40; style="display:table-cell;"> <br>

                    <label for="setGroupAdmin">Set Group Admins By Username</label><br>
                    <input type="text" name="setGroupAdmin" value="" size=40; style="display:table-cell;"> <br>
                    <p>(Note: add space after every username! <br> e.g. user1 user2 ...)</p> <br>

                    <label for="group_type">Change Group Type</label><br>
                    <select class="group_type" name="group_type" id="mySelect" >
                        <option value="1" >Secret</option>
                        <option value="2" >Private</option>
                        <option value="3"  >Public</option>
                    </select>
                    <script type="text/javascript">
                        document.getElementById("mySelect").selectedIndex = "<?php echo $group_type-1;?>";
                    </script>

                    <input type="submit" name="updateGroup" value="Update">
                </div>

                <div class="FormDivUpdate">
                </div>

    </div>

</section>

<?php include ("../includes/footer_inc.php"); ?>
