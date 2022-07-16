<?php include ("../includes/header_inc.php"); ?>

<section class="Body">

    <div id="wrapper">
        <div class="separatorBox">
            <?php
            //Username of current user logged in
            $currUser = $_SESSION['username'];

            //Get current user ID
            $getCurrUserID = " SELECT * FROM user WHERE username = '$currUser' ";
            //Pass it to a variable called id_user
            $getCurrUserIDqueryRun = mysqli_query($connect, $getCurrUserID);
            while($row  = mysqli_fetch_array($getCurrUserIDqueryRun, MYSQLI_BOTH)) {
                $id_user = $row['id_user'];
            }

            //Search for groups that are assigned to current user
            $groupIDs = " SELECT * FROM user_group_membership WHERE id_user = '$id_user'  ";
            //Run query
            $groupIDsQueryRun = mysqli_query($connect, $groupIDs);
            //Pass all group IDs to an Array
            //While loop for every group
            while($row  = mysqli_fetch_array($groupIDsQueryRun, MYSQLI_BOTH)) {
                $id_group = $row['id_group'];

                //Search for all information about group
                $groupInfo = " SELECT * FROM _group WHERE id_group = '$id_group' ";
                $groupInfoQueryRun = mysqli_query ($connect, $groupInfo);
                //Pass it to variables
                while($row  = mysqli_fetch_array($groupInfoQueryRun, MYSQLI_BOTH)) {
                    // $id_group = $row['id_group'];
                    $groupName = $row['group_name'];
                    $groupType = $row['group_type'];
                    //Change group type from numbers to letters
                    if ($groupType == '1') {
                        $groupType = 'Secret';
                    }
                    if ($groupType == '2') {
                        $groupType = 'Private';
                    }
                    if ($groupType == '3') {
                        $groupType = 'Public';
                    }
                    echo ' <div class="groupCL"><div class="groupCard"> <h2> '.$groupName.' </h2><h4> '.$groupType.' </h4>
                    <div id="enterGroup">
                        <form action="../pages/groupView.php" method="GET">
                            <input type="submit" name="viewGroup'.$id_group.'" value="Enter">
                        </form>
                    </div>
                    <div id="exitGroup">
                        <form action="../pages/exitGroup.php" method="GET">
                            <input type="submit" name="exitGroup'.$id_group.'" value="x">
                        </form>
                    </div>
                     </div></div> ';
                }

            }
             ?>
         </div>

    </div>

     <!-- Javascript Code Here -->
    <script type="text/javascript">
        var Link = document.getElementById('homepage');
        Link.style.borderBottom="2px solid #fff";
    </script>

</section>

<?php include ("../includes/footer_inc.php"); ?>
