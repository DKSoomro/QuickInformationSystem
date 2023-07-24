<?php
include("includes/connection.php");

session_start();
$user = $_SESSION['user_email'];
date_default_timezone_set('Asia/Karachi');
$date = date('d/m/Y h:i:sa', time());

$select_user = "update users set user_last_login = '$date' where user_email = '$user'";

$query = mysqli_query($con, $select_user);
$check_user = mysqli_num_rows($query);

session_destroy();

header("location: index.php");
