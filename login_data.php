<?php
session_start();

include("includes/connection.php");

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $category = $_POST['category'];

    $select_user = "select * from users where user_email = '$email' AND user_pass = '$password' AND status = 'verified' AND user_cat_id = $category";

    $query = mysqli_query($con, $select_user);
    $check_user = mysqli_num_rows($query);

    if ($check_user == 1) {
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('home.php','_self');</script>";
        $update_online = "update users set user_last_login = 'ONLINE' where user_email = '$email'";

        $query = mysqli_query($con, $update_online);
        $check_user = mysqli_num_rows($query);
    } else {
        echo "<script>alert('Not regitered');</script>";
    }
}
