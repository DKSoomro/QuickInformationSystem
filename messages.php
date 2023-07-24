<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");
$user = $_SESSION['user_email'];
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
}

$get_user = "Select * from users where user_email = '$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_id = $row['user_id'];
$user_name = $row['user_name'];
$register_date = $row['user_reg_date'];
$last_login = $row['user_last_login'];
$user_image = $row['user_image'];


$user_posts = "Select * from posts where user_id = '$user_id'";
$run_posts = mysqli_query($con, $user_posts);
$posts = mysqli_num_rows($run_posts);

//getting number of unred messages
$sel_msg = "Select * from messages where receiver = '$user_id' AND status = 'unread' ORDER by 1 DESC";
$run_msg = mysqli_query($con, $sel_msg);
$count_msg = mysqli_num_rows($run_msg);

?>


<head>
    <title>SMART NOTIFICATION SYSTEM</title>
    <link rel="icon" type="image/png" href="assets/images/iict.jpg">
    <script>
        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;

                }
            }
            req.open('GET', 'chat.php', true);
            req.send();
        }
        setInterval(function() {
            ajax()
        }, 1000);
    </script>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/theme-8.css">


</head>

<body onload="ajax();">

    <header class="header text-center">
        <h1 class="blog-name pt-lg-4 mb-0">WELCOME <?php echo $user_name; ?></h1>

        <nav class="navbar navbar-expand-lg navbar-dark">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navigation" class="collapse navbar-collapse flex-column">
                <div class="profile-section pt-3 pt-lg-0">
                    <img class="profile-image mb-3 rounded-circle mx-auto" src='users/<?php echo $user_image; ?>' width='150' height='150' />


                    <ul class="navbar-nav flex-column text-left menu">
                        <li class="nav-item active">
                            <a class="nav-link" href="home.php"><i class="fas fa-home fa-fw mr-2"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="members.php"><i class="fas fa-bookmark fa-fw mr-2"></i>Members</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='mymessages.php?inbox&u_id=<?php echo $user_id; ?>'><i class="fa fa-envelope mr-2"></i> Messages <span class="badge badge-light"><?php echo "($count_msg)"; ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='myposts.php?inbox&u_id=<?php echo $user_id; ?>'><i class="fa fa-clipboard mr-2"></i> My Posts <span class="badge badge-light"><?php echo "($posts)"; ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mr-2" href='edit_profile.php?u_id=<?php echo $user_id ?>'><i class="fas fa-user fa-fw mr-2"></i>Edit Info</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href='logout.php'><i class="fa fa-power-off mr-2"></i>Log Out</a>
                        </li>
                    </ul>
                </div>
        </nav>
    </header>


    <div class="main-wrapper">
        <section class="cta-section theme-bg-light py-5">
            <div class="container text-center">
                <?php
                if (isset($_GET['u_id'])) {
                    $u_id = $_GET['u_id'];

                    $sel = "select * from users where user_id = '$u_id'";
                    $run = mysqli_query($con, $sel);
                    $row = mysqli_fetch_array($run);

                    $user_name = $row['user_name'];
                    $user_image = $row['user_image'];
                    $user_last_login = $row['user_last_login'];
                    $_SESSION['u_id'] =  $_GET['u_id'];
                }
                ?>
                <img src="users/<?php echo $user_image; ?>" alt="" style="border: 2px solid black; border-radius: 5px; " width="100" height="100" />
                <h3><?php echo $user_name; ?></h3>
                <h6>LAST LOGIN: <?php if ($user_last_login == 'ONLINE') {
                                    echo "$user_last_login NOW <i class='far fa-circle' style = 'color: green;'></i>";
                                } else {
                                    echo "$user_last_login <i class='fas fa-circle'></i>";
                                } ?></h6>
                <br>
                <hr>
                <div id="chat">

                    <!-- For output -->

                </div>
                <h2>SEND A MESSGAE TO <?php echo $user_name; ?></h2>
                <div class="form-group">
                    <form action="messages.php?u_id=<?php echo $u_id; ?>" method="post" class="signup-form  justify-content-center pt-3" id="f">
                        <textarea name="msg_text" class="form-control mr-md-1 " cols="83" rows="4" id="" placeholder="Type Your Message..."></textarea><br>
                        <input class="btn btn-primary btn-block" type="submit" name="message" value="Send Message">
                    </form>
                </div>

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



    <?php
    if (isset($_POST['message'])) {
        $msg_text = mysqli_real_escape_string($con, $_POST['msg_text']);
        date_default_timezone_set('Asia/Karachi');
        $date = date('d/m/Y h:i:sa', time());
        $insert = "insert into messages (sender,receiver, msg_text, status, msg_date) values ('$user_id', '$u_id', '$msg_text', 'unread', '$date')";
        $run = mysqli_query($con, $insert);
    }
    ?>

    <!-- content ends -->
    </div>
    <!-- container ends -->
</body>

</html>