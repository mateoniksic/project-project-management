<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <!-- PHP SETTINGS HERE -->
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT * FROM user WHERE username = '$username ' ";
    $query_run = mysqli_query($connect, $query);
    while($row  = mysqli_fetch_array($query_run, MYSQLI_BOTH)) {
        $id=$row['id_user'];
        $username=$row['username'];
        $password=$row['password'];
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

     <?php
        //UPDATE PROFILE
        $update = isset($_POST['update']);

        if ($update) {
            // $username = $_POST['username'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $country = $_POST['country'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $about = $_POST['about'];

            $updateQuery = "UPDATE user SET
                                            fname = '$fname' ,
                                            lname = '$lname' ,
                                            email = '$email',
                                            password = '$password',
                                            country = '$country' ,
                                            age = '$age' ,
                                            gender = '$gender' ,
                                            about = '$about'
                                        WHERE id_user = '$id' ";
            $query_runUpdate = mysqli_query($connect, $updateQuery);

            //Check if it works
            // if($query_runUpdate) {
            //     echo "yes";
            //     echo var_dump($query_runUpdate);
            // } else {
            //     echo "no";
            //     echo var_dump($query_runUpdate);
            // }
        }


        //UPLOAD AVATAR
        $target_dir = "../users/avatars/";
        $target_file = $target_dir . basename(@$_FILES["avatarPhoto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["uploadAvatar"])) {
                $check = @getimagesize(@$_FILES["avatarPhoto"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                }
            // Check if file already exists
            if (file_exists($target_file)) {
                //echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["avatarPhoto"]["size"] > 500000) {
                //echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                //echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["avatarPhoto"]["tmp_name"], $target_file)) {
                    //echo "The file ". basename( $_FILES["avatarPhoto"]["name"]). " has been uploaded.";
                    $avatarName = basename( $_FILES["avatarPhoto"]["name"]);
                    $updatePhoto = "UPDATE user SET
                                                    avatar = '$target_dir$avatarName'
                                                WHERE id_user = '$id' ";
                    $query_runUpdate = mysqli_query($connect, $updatePhoto);
                    header("Refresh:0");

                } else {
                    //echo "Sorry, there was an error uploading your file.";
                }
        }
    }

    if (isset($_POST['removeAvatar'])) {
        $removePhoto = "UPDATE user SET
                                        avatar = '../images/profilePhotoDefault.png'
                                    WHERE id_user = '$id' ";
        $query_runRemove = mysqli_query($connect, $removePhoto);
        header("Refresh:0");
    }
      ?>

     <!-- HTML SETTINGS HERE -->
    <div id="wrapper">
        <div class="BigBox">

            <div class="aside">
                <table class="profileEdit" style="border:5px solid #34495e; border-radius:10px;">
                    <tr >
                        <td style="height: 20px; border-bottom: 5px solid #34495e; background: #34495e; border-radius:7px 7px 0 0;"><h2>Current Profile Settings</h2></td>
                    </tr>
                    <tr>
                        <td style="height:300px; border-bottom: 5px solid #c0392b;">
                            <?php echo '<img src=" '.$avatar.' " alt = "Profile Photo">'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #c0392b;"><h3 style="color:#c0392b;">Change Photo:</h3> <br>
                             <form class="changePhoto" action="#" method="post" enctype="multipart/form-data">
                                 <input type="file" name="avatarPhoto" class="fileHidden" >
                                 <input type="submit" name="uploadAvatar" value="Upload Photo">
                             </form>

                             <form class="removePhoto" action="#" method="post" >
                                 <input type="submit" name="removeAvatar" value="Remove Photo">
                             </form>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>User Id:</h3> <br>
                             <?php echo "<h4>". $id."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>Username:</h3> <br>
                             <?php echo "<h4>". $username."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>Name:</h3> <br>
                             <?php echo "<h4>". $fname." ".$lname."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>Email:</h3> <br>
                             <?php echo "<h4>". $email."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>Password:</h3> <br>
                             <?php echo "<h4>". $password."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>Country:</h3> <br>
                             <?php echo "<h4>". $country."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>Age:</h3> <br>
                             <?php echo "<h4>". $age."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>Gender:</h3> <br>
                             <?php echo "<h4>". $gender."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 5px solid #34495e;"><h3>About:</h3> <br>
                             <?php echo "<h4>". $about."</h4>"; ?>
                         </td>
                    </tr>
                    <tr>
                        <td style=" "><h3>Member Since:</h3> <br>
                             <?php echo "<h4>". $createdDate."</h4>"; ?>
                         </td>
                    </tr>
                </table>
            </div>

            <div class="aside">
                <h2 class="h2UP">Update Profile Settings</h2>
                <form class="updateProfile" action="#" method="post" enctype="multipart/form-data">

                    <!-- <div class="formSection">
                        <label for="username">Username:</label><br>
                        <input type="text" name="username" size=40; value="<?php // echo $username; ?>">
                    </div> -->

                    <div class="formSection">
                        <label for="fname">First Name:</label><br>
                        <input type="text" name="fname"  size=40 value="<?php echo $fname; ?>">
                    </div>

                    <div class="formSection">
                        <label for="lname">Last Name:</label><br>
                        <input type="text" name="lname"  size=40 value="<?php echo $lname; ?>">
                    </div>

                    <div class="formSection">
                        <label for="email">Email:</label><br>
                        <input type="text" name="email"  size=40 value="<?php echo $email; ?>">
                    </div>

                    <div class="formSection">
                        <label for="password">Password:</label><br>
                        <input type="text" name="password"  size=40 value="<?php echo $password; ?>">
                    </div>

                    <div class="formSection">
                        <label for="country">Country:</label><br>
                        <input type="text" name="country"  size=40 value="<?php echo $country; ?>">
                    </div>

                    <div class="formSection">
                        <label for="age">Age:</label><br>
                        <input type="text" name="age"  size=40 value="<?php echo $age; ?>">
                    </div>

                    <div class="formSection">
                        <label for="gender">Gender:</label><br>
                        <input type="radio" name="gender"  size=40 value="Male" <?php if ($gender == 'Male') {echo ' checked ';} ?> >&nbsp; Male
                        <input type="radio" name="gender"  size=40 value="Female"  <?php if ($gender == 'Female') {echo ' checked ';} ?> >&nbsp; Female
                        <input type="radio" name="gender"  size=40 value="Other"  <?php if ($gender == 'Other') {echo ' checked ';} ?> >&nbsp; Other
                    </div>

                    <div class="formSection">
                        <label for="about">About:</label><br>
                        <textarea  rows="7" cols="45" id="about" name="about"   ><?php echo $about; ?></textarea>
                    </div>

                    <!-- <div class="formSection">
                        <label for="avatar">Change profile photo:</label><br>
                        <input type="file" name="avatar" id="avatar">
                    </div> -->

                    <div class="formSection">
                        <input type="submit" name="update" value="Update">
                    </div>

                </form>
            </div>


        </div>
    </div>


    <!-- JAVASCRIPT  -->
    <script type="text/javascript">
        var Link = document.getElementById('accountsettings');
        Link.style.borderBottom="2px solid #fff";
    </script>
</section>

<?php include ("../includes/footer_inc.php"); ?>
