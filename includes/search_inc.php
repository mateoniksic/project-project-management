<?php
    $search = isset($_POST['searchSubmit']);
    $usersFound = array();
    if($search) {
        $output = '';
        //What is user searching for?
        $searchQuery = $_POST['search_Box'];
        //For better result ordering
        $stringSearchQuery = (string)$searchQuery;
        //Remove everything that is not letter or number
        $searchQuery = preg_replace("#[^0-9a-z@.]#i","",$searchQuery);

        $query = "SELECT * FROM user WHERE username LIKE '%$searchQuery%' OR fname LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%'  LIMIT 20";
        $query_run = mysqli_query($connect, $query);
        $count = mysqli_num_rows($query_run);

        if ($count == 0 ) {
            $output = 'No user '.$searchQuery.' found. Please try again.';
        } else {
            while ($row = mysqli_fetch_array($query_run, MYSQLI_BOTH)) {
                $id = $row['id_user'];
                $fname=$row['fname'];
                $lname=$row['lname'];
                $username=$row['username'];
                $email = $row['email'];
                $avatar = $row['avatar'];
                $country=$row['country'];
                $age=$row['age'];
                $gender = $row['gender'];
                $createdDate = $row['created_date'];

                $usersFound[] = $row['id_user']; //Do not need yet...

                if ($username != $_SESSION['username'] ) {
                    $output .= '<div class="searchDiv"><div class="searchProfilePhoto"><img  src=" '.$avatar.' " style = "width:200px; height:200px;"> </div> <div class="profileInfo"> <h3> '.$fname.'  '.$lname.'</h3> <h4>'.$username.'</h4> <p> <strong>Email:&nbsp;</strong> '.$email.'</p><p><strong>Country:&nbsp;</strong> '.$country.'</p><p> <strong>Gender:&nbsp;</strong> '.$gender.'</p><p><strong>Age:&nbsp;</strong> '.$age.'</p><p><strong>Member since:&nbsp;</strong> '.$createdDate.'</p></div>
                        <div id="followForm">
                            <form id="follow" action="../pages/viewProfile.php" method="GET">
                                <input type="submit" name="follow'.$id.'" value="View Profile">
                            </form>
                        </div>
                    </div>';
                }
            }
        }

    }
 ?>
