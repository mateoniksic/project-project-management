<?php

    $createGroup = isset($_POST['createGroup']);
    //Declare variables
    //Group variables
    $groupName = '';
    $groupDesc = '';
    $groupType = '';
    // $groupPassword = '';
    $groupDate = '';
    //User Group Membership
    $addMember = '';
    // $setGroupAdmin='';

    if ($createGroup) {
        @$groupName = strip_tags($_POST['group_name']);
        @$groupDesc = strip_tags($_POST['description']);
        @$groupType = strip_tags($_POST['group_type']);
        // $groupPassword= strip_tags($_POST['password']);
        @$groupDate = date("Y-m-d");
        @$addMember = strip_tags($_POST['addMember']);
        @$setGroupAdmin = strip_tags($_POST['setGroupAdmin']);

        //Get current user ID for user_group_membership table
        $currUser = $_SESSION['username'];
        $getCurrUserID = " SELECT * FROM user WHERE username = '$currUser' ";

        $getCurrUserIDqueryRun = mysqli_query($connect, $getCurrUserID);
        while($row  = mysqli_fetch_array($getCurrUserIDqueryRun, MYSQLI_BOTH)) {
            $id_user = $row['id_user'];
        }

        //Insert data into group table
        $groupQuery = "INSERT INTO _group (group_name, description, group_type, created_date)  VALUES ('$groupName', '$groupDesc', '$groupType', '$groupDate')  ";
        $queryRun = mysqli_query($connect, $groupQuery);

        //Get created group ID
        $getCurrGroupID = " SELECT * FROM _group WHERE group_name = '$groupName' ";
        $getCurrGroupIDqueryRun = mysqli_query($connect, $getCurrGroupID);

        while($row  = mysqli_fetch_array($getCurrGroupIDqueryRun, MYSQLI_BOTH)) {
            $id_group = $row['id_group'];
        }

        //Insert data into user_group_membership table
        //This data applies to group creator who is Admin of the group
        $insertUGMData = " INSERT INTO user_group_membership (id_user, id_group, user_type) VALUES ('$id_user','$id_group','2')  ";
        $insertUGMDataQueryRun = mysqli_query($connect, $insertUGMData);

        //Added members split
        $memberArray = explode (" ", $addMember);
        foreach ($memberArray as $member) {
            //Find member id
            $getMemberID = " SELECT * FROM user WHERE username = '$member' ";
            $getMemberIDqueryRun = mysqli_query($connect,$getMemberID);
            //Saving member ID in variable
            while($row  = mysqli_fetch_array($getMemberIDqueryRun, MYSQLI_BOTH)) {
                @$id_member = $row['id_user'];
            }
            //Save users to user_group_membership with default privilage 1
            @$insertBasicMember = " INSERT INTO user_group_membership (id_user, id_group, user_type) VALUES ('$id_member','$id_group','1')  ";
            $insertBasicMemberQueryRun = mysqli_query($connect, $insertBasicMember);
        }

        //Set another group Admin
        $adminArray = explode (" ", $setGroupAdmin);
        foreach ($adminArray as $admin) {
            //Find member id
            $getAdminID = " SELECT * FROM user WHERE username = '$admin' ";
            $getAdminIDqueryRun = mysqli_query($connect,$getAdminID);
            //Saving member ID in variable
            while($row  = mysqli_fetch_array($getAdminIDqueryRun, MYSQLI_BOTH)) {
                @$id_admin = $row['id_user'];
            }
            //Save users to user_group_membership with default privilage 1
            @$insertAdminMember = " INSERT INTO user_group_membership (id_user, id_group, user_type) VALUES ('$id_admin','$id_group','2')  ";
            $insertAdminMemberQueryRun = mysqli_query($connect, $insertAdminMember);
        }

    }

 ?>
