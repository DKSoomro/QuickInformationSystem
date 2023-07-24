<?php
include("../functions/functions.php");
session_start();

if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
}
?>
<style>
    * {
        padding: 0;
        margin: 0;
    }

    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
        display: block;
    }

    .container {
        background: #AFEEEE;
        width: 250px;
        float: left;
        height: 100%;
        border-right: 1px solid black;
    }

    .menu {
        line-height: 35px;
        padding: 0;
        margin: 0;
        float: left;
    }

    .menu li {
        display: inline;
        list-style: none;
    }

    .menu a {
        margin: 5px;
        padding: 5px;
        text-decoration: none;
        color: gray;
        font-size: 20px;
        font-weight: bold;
    }

    .menu a:hover {
        color: brown;
        font-weight: bolder;
        text-decoration: underline;
    }

    .content {
        width: 1000px;
        margin: 0 auto;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN PANEL</title>
</head>

<body>
    <div class="container">
        <h2>MANAGE CONTENT:</h2>
        <br><br><br>
        <br><br><br>

        <ul class="menu">
            <li><a href="index.php?view_users">VIEW USERS</a></li><br>
            <li><a href="index.php?view_posts">VIEW POSTS</a></li><br>
            <li><a href="index.php?view_comments">VIEW COMMENTS</a></li><br>
            <li><a href="index.php?view_topics">VIEW TOPICS</a></li><br>
            <li><a href="index.php?add_users">ADD TOPICS</a></li><br>
            <li><a href="admin_logout.php">LOGOUT</a></li><br>

        </ul>
    </div>

    <div class="content">
        <h2 style="color: blue; text-align: center; padding: 5px;">
            WELCOME
            <!-- <?php $_GET['welcome']; ?> -->
        </h2>

        <?php
        if (isset($_GET['view_users'])) {
            include("includes/view_users.php");
        }
        if (isset($_GET['view_posts'])) {
            include("includes/view_posts.php");
        }
        if (isset($_GET['view_comments'])) {
            include("includes/view_comments.php");
        }

        ?>
    </div>
</body>

</html>