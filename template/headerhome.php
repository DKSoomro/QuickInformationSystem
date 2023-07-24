<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
}
$user = $_SESSION['user_email'];
$get_user = "Select * from users where user_email = '$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_id = $row['user_id'];
$user_name = $row['user_name'];
$register_date = $row['user_reg_date'];
$user_cat_id = $row['user_cat_id'];
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

<body>

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