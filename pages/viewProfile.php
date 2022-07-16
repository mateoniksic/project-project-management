<?php include ("../includes/header_inc.php"); ?>

<section class = "Body">
    <?php

        //Get ID of user from URL
        $url = selfURL();
        $profileIDFollow = substr($url,65);
        $profileID = strtok($profileIDFollow, '=View+Profile');
        $viewProfileQuery = "SELECT * FROM user WHERE id_user = '$profileID ' ";
        $viewProfileQueryquery_run = mysqli_query($connect, $viewProfileQuery);
        while($row  = mysqli_fetch_array($viewProfileQueryquery_run, MYSQLI_BOTH)) {
            $fname=$row['fname'];
            $lname=$row['lname'];
            $email = $row['email'];
            $avatar = $row['avatar'];
            $country=$row['country'];
            $age=$row['age'];
            $about = $row['about'];
            $gender = $row['gender'];
            $createdDate = $row['created_date'];
        }
     ?>

     <div id="wrapper">
         <table id="userProfile">
             <!--  TABLE ROW-->
             <tr >
                 <!-- FIRST COLUMN -->
                 <td style="height:200px; width: 40%; border: 10px solid #34495e; border-radius:15px 15px 0 0; overflow: hidden;" >
                     <?php echo '<img src=" '.$avatar.' " alt = "Profile Photo">'; ?>
                 </td>
                 <!--  SECOND COLUMN -->
                 <td style="height:300px; width: 60%; border: 5px solid  #34495e; background: #2980B9; border-radius:15px 15px 0 0; overflow: hidden;">
                     <?php echo "<h1>". $fname." ".$lname."</h1>"; ?>
                     <div class="followUser">
                         <form action="#" method="post">
                             <input type="submit" name="followUser" value="Follow" id="followUserInput" onclick="FollowUser()">
                         </form>
                         <?php
                         $followUser = isset($_POST['followUser']);
                         if ($followUser) {
                             //Get logged in user ID
                             $activeUser = $_SESSION['username'];
                             $getactiveUserID = " SELECT * FROM user WHERE username = '$activeUser' ";

                             $getactiveUserIDqueryRun = mysqli_query($connect, $getactiveUserID);
                             while($row  = mysqli_fetch_array($getactiveUserIDqueryRun, MYSQLI_BOTH)) {
                                 $id_userActive = $row['id_user'];
                             }
                             //Update follow table
                             $followQuery = " INSERT INTO follow (id_user1,id_user2)  VALUES ('$id_userActive','$profileID') ";
                             $followQueryRun = mysqli_query ($connect, $followQuery) ;
                         }
                         ?>
                            <script type="text/javascript">
                                function FollowUser() {
                                    var followUserInput = document.getElementById("followUserInput");
                                    followUserInput.value = "Following";
                                }
                            </script>
                     </div>
                 </td>
             </tr>

             <!--  TABLE ROW-->
             <tr>
                 <!-- FIRST COLUMN -->
                 <td  style="height:100px; width: 30%; background: #d35400;">
                     <p>About:</p><br>
                     <?php echo "<span class='info'>".$about."</span>"; ?>
                 </td>
                 <!--  SECOND COLUMN -->
             </tr>

             <!--  TABLE ROW-->
             <tr>
                 <!-- FIRST COLUMN -->
                 <td style="height:100px; width: 30%; background: #34495e;">
                     <p>Country:</p><br>
                     <?php echo "<span class='info'>".$country."</span>"; ?>
                 </td>
                 <!--  SECOND COLUMN -->
             </tr>

             <!--  TABLE ROW-->
             <tr>
                 <!-- FIRST COLUMN -->
                 <td style="height:100px; width: 30%; background: #d35400;">
                     <p>Age:</p><br>
                     <?php echo "<span class='info'>".$age."</span>"; ?>
                 </td>
                 <!--  SECOND COLUMN -->
             </tr>

         <!--  TABLE ROW-->
         <tr>
             <!-- FIRST COLUMN -->
             <td style="height:100px; width: 30%; background: #34495e;">
                 <p>Gender:</p><br>
                 <?php echo "<span class='info'>".$gender."</span>"; ?>
             </td style="height:100px; width: 30%;">
             <!--  SECOND COLUMN -->
         </tr>

     <!--  TABLE ROW-->
     <tr>
         <!-- FIRST COLUMN -->
         <td style="height:100px; width: 30%;  background: #d35400; border-bottom: 15px solid #d35400; border-radius:0 0 15px 15px;">
             <p>Email:</p><br>
             <?php echo "<span class='info'>".$email."</span>"; ?>
         </td>
         <!--  SECOND COLUMN -->
        </tr>


         </table>
     </div>

</section>

<?php include ("../includes/footer_inc.php"); ?>
