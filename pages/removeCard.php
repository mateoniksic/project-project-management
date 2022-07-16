<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <?php

            //Get ID of user from URL
            $cardUrl = selfURL();
            $cardUrlCut = substr($cardUrl,64);
            $cardID = strtok($cardUrlCut, '=-');

            $deleteCardQuery = " DELETE FROM card WHERE id_card = '$cardID' ";
            $deleteCardQueryRun = mysqli_query($connect, $deleteCardQuery);
            echo 'Card removed successfully!'
         ?>

    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
