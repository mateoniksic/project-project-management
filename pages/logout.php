<?php include ("../includes/header_inc.php"); ?>
<?php include ("../includes/logout_inc.php"); ?>

<section class="homepageBody">
    <div id="wrapper">
        <div class="mainContainer">

            <div class="container">
                <h2>Thank You For Using Tracker! <br> <span style="font-size:10px;">Logged in as: <?php echo $_SESSION['username']; ?></span></h2>
                <p>Click on the button below to logout.</p>
                <div class="logoutFormBox">
                    <form class="logoutForm" action="#" method="post">
                        <input type="submit" name="logout" value="Logout">
                    </form>
                </div>
            </div>

            <div class="container">
                <h2>What's new on Tracker...</h2>

                <div class="news1">
                    <img src="../images/friendadd.jpg" alt="Add friend">
                    <p>If you've ever been curious about different cultures and places, you might have a desire to make friends from all around the world. If you're not sure where to look, you can use the internet to connect with people that aren't from your country or become involved with your school's international programs and clubs. If you take the right approach and use all the resources at your disposal, making friends from all over the world is easy.</p>
                </div>

                <div class="news2">
                    <img src="../images/group.png" alt="Work with any team">
                    <h3>Work With Any Team </h3>
                    <p>Whether it’s for work, a side project or even the next family vacation, Tracker helps your team stay organized.</p>
                </div>

                <div class="news3">
                    <img src="../images/todocard.jpg" alt="To Do Cards">
                    <h3>Information At A Glance</h3>
                    <p>Dive into the details by adding comments, attachments, and more directly to Trello cards. Collaborate on projects from beginning to end.</p>
                </div>

            </div>

        </div>
    </div>

    <script type="text/javascript">
        var Link = document.getElementById('logout');
        Link.style.borderBottom="2px solid #fff";
    </script>
</section>

<?php include ("../includes/footer_inc.php"); ?>
