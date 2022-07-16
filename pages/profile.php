<?php include ("../includes/header_inc.php"); ?>


<section class="Body">
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT * FROM user WHERE username = '$username ' ";
    $query_run = mysqli_query($connect, $query);
    while($row  = mysqli_fetch_array($query_run, MYSQLI_BOTH)) {
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


    <!--  JAVASCRIPT CODE -->
    <script type="text/javascript">
        var Link = document.getElementById('profile');
        Link.style.borderBottom="2px solid #fff";
    </script>
</section>

<?php include ("../includes/footer_inc.php"); ?>
