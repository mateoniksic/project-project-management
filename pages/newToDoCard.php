<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <?php
            //Get ID of project from URL
            $projectUrl = selfURL();
            $projectFull = substr($projectUrl,70);
            $projectID = strtok($projectFull,'=New+To+Do+Card');

            $createCard = isset($_POST['createCard']);

            if ($createCard) {
                $cardName = $_POST['cardName'];
                $cardDesc = $_POST['cardDesc'];
                $cardDeadline = $_POST['cardDeadline'];

                $createCardQuery = " INSERT INTO card (card_name,description,deadline) VALUES ( '$cardName', '$cardDesc', '$cardDeadline') ";
                $createCardQueryRun = mysqli_query ($connect, $createCardQuery);

                //Find card id
                $cardIdQuery = " SELECT * FROM card WHERE card_name ='$cardName' AND description = '$cardDesc' AND deadline ='$cardDeadline' ";
                $cardIdQueryRun = mysqli_query ($connect, $cardIdQuery);
                while ($row = mysqli_fetch_array($cardIdQueryRun, MYSQLI_BOTH)) {
                    $cardID = $row['id_card'];
                }

                $createProjectCardQuery = " INSERT INTO project_card (id_project, id_card) VALUES ('$projectID', '$cardID') ";
                $createCardQueryRun = mysqli_query ($connect, $createProjectCardQuery);
            }
        ?>


        <form class="groupCardCreate" action="#" method="POST">
            <div class="mainFormDivCardCreate">

                <div class="FormDivCardCreate basicgInfoCardCreate">
                    <h1>Create Card</h1>
                    <hr>

                    <label for="project_name">Card Name</label><br>
                    <input type="text" name="cardName" value="" size=40; style="display:table-cell;"> <br>

                    <label for="project_description">Card Description</label><br>
                    <textarea name="cardDesc"  value="" rows = "5" cols = "44"></textarea><br>

                    <label for="project_name">Deadline</label><br>
                    <input type="date" name="cardDeadline" value="" size=40; > <br>

                    <!-- <label for="project_addMember">Add Members By Username</label><br>
                    <input type="text" name="project_addMember" value="" size=40; style="display:table-cell;"> <br>

                    <label for="project_setAdmin">Set Project Admins By Username</label><br>
                    <input type="text" name="project_setAdmin" value="" size=40; style="display:table-cell;"> <br>
                    <p>(Note: add space after every username! <br> e.g. user1 user2 ...)</p> <br> -->

                    <input type="submit" name="createCard" value="Create">
                </div>

                <div class="FormDivCardCreate">
                </div>
            </div>
        </form>


    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
