<?php include ("../includes/header_inc.php"); ?>

<section class="Body">
    <div id="wrapper">
        <form class="groupCreate" action="#" method="post">
            <div class="mainFormDiv">

                <div class="FormDiv basicgInfo">
                    <h1>Create Group</h1>
                    <hr>

                    <label for="group_name">Group Name</label><br>
                    <input type="text" name="group_name" value="" size=40; style="display:table-cell;"> <br>

                    <label for="description">About This Group</label><br>
                    <textarea name="description"  value="" rows = "5" cols = "44"></textarea><br>

                    <label for="addMember">Add Members By Username</label><br>
                    <input type="text" name="addMember" value="" size=40; style="display:table-cell;"> <br>

                    <label for="setGroupAdmin">Set Group Admins By Username</label><br>
                    <input type="text" name="setGroupAdmin" value="" size=40; style="display:table-cell;"> <br>
                    <p>(Note: add space after every username! <br> e.g. user1 user2 ...)</p> <br>

                    <label for="group_type">Group Type</label><br>
                    <select class="group_type" name="group_type">
                        <option value="3">Public</option>
                        <option value="2">Private</option>
                        <option value="1">Secret</option>
                    </select>

                    <input type="submit" name="createGroup" value="Create">
                </div>

                <div class="FormDiv">
                </div>
            </div>
        </form>
    </div>
</section>

<?php include ("../includes/footer_inc.php"); ?>
