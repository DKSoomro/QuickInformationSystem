<?php
require("template/headerhome.php")
?>

<div class="main-wrapper">
    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center">
            <h2 class="heading">IICT SMART CHAT SYSTEM</h2>
            <div class="intro">
                <a href="online_users.php"><button class="btn btn-success">VIEW ONLINE USERS</button></a>
            </div>
            <form class="signup-form form-inline justify-content-center pt-3" method="post">
                <div class="form-group">
                    <input type="text" id="semail" name="name" class="form-control mr-md-1 semail" placeholder="Enter Name">
                </div>
                <button type="submit" name="search" class="btn btn-primary">Search</button>
            </form>
            <?php
            if (isset($_POST['search'])) {
                $name = $_POST['name'];
                $query = "SELECT * from users where user_name like '%$name%'";
                $run = mysqli_query($con, $query);
                if ($row = mysqli_fetch_array($run)) {
                    $user_name = $row['user_name'];
                    $user_id = $row['user_id'];
                    echo "Match Found <br><a href = 'messages.php?u_id=$user_id'>$user_name</a>";
                } else {
                    echo "No Results Found";
                }
            }
            ?>

            <?php mymessages(); ?>


        </div>
        <!--//container-->
    </section>

    <?php require('template/footerhome.php'); ?>
</div>
<!--//main-wrapper-->




<!-- *****CONFIGURE STYLE (REMOVE ON YOUR PRODUCTION SITE)****** -->
<div id="config-panel" class="config-panel d-none d-lg-block">
    <div class="panel-inner">
        <a id="config-trigger" class="config-trigger config-panel-hide text-center" href="#"><i class="fas fa-cog fa-spin mx-auto" data-fa-transform="down-6"></i></a>
        <h5 class="panel-title">Choose Colour</h5>
        <ul id="color-options" class="list-inline mb-0">
            <li class="theme-1 active list-inline-item"><a data-style="assets/css/theme-1.css" href="#"></a></li>
            <li class="theme-2  list-inline-item"><a data-style="assets/css/theme-2.css" href="#"></a></li>
            <li class="theme-3  list-inline-item"><a data-style="assets/css/theme-3.css" href="#"></a></li>
            <li class="theme-4  list-inline-item"><a data-style="assets/css/theme-4.css" href="#"></a></li>
            <li class="theme-5  list-inline-item"><a data-style="assets/css/theme-5.css" href="#"></a></li>
            <li class="theme-6  list-inline-item"><a data-style="assets/css/theme-6.css" href="#"></a></li>
            <li class="theme-7  list-inline-item"><a data-style="assets/css/theme-7.css" href="#"></a></li>
            <li class="theme-8  list-inline-item"><a data-style="assets/css/theme-8.css" href="#"></a></li>
        </ul>
        <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
    </div>
    <!--//panel-inner-->
</div>
<!--//configure-panel-->



<!-- Javascript -->
<script src="assets/plugins/jquery-3.3.1.min.js"></script>
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Style Switcher (REMOVE ON YOUR PRODUCTION SITE) -->
<script src="assets/js/demo/style-switcher.js"></script>


</body>

</html>