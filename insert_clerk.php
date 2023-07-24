<?php
include("includes/connection.php");

if (isset($_POST['sign_up'])) {

    $name = mysqli_real_escape_string($con, $_POST['u_name']);
    $pass = mysqli_real_escape_string($con, $_POST['u_pass']);
    $pass2 = mysqli_real_escape_string($con, $_POST['u_pass2']);
    $email = mysqli_real_escape_string($con, $_POST['u_email']);
    $gender = mysqli_real_escape_string($con, $_POST['u_gender']);
    $status = "verified";
    $posts = "no";
    $user_cat_id = 1;
    $ver_code = mt_rand(1, 9);
    date_default_timezone_set('Asia/Karachi');
    $date = date('d/m/Y h:i:sa', time());
    $discipline = mysqli_real_escape_string($con, $_POST['u_disc']);
    $phone_no = mysqli_real_escape_string($con, $_POST['u_phone']);

    $shift = mysqli_real_escape_string($con, $_POST['u_shift']);


    // Password validation

    if (strlen($pass) < 8) {
        echo "<script>alert('Password should be more than 8 characters')</script>";
        exit();
    }
    if ($pass != $pass2) {
        echo "<script>alert('Passwords are not same')</script>";
        exit();
    }
    //email validation
    $check_email = "select * from users where user_email = '$email'";
    $run_email = mysqli_query($con, $check_email);
    $check = mysqli_num_rows($run_email);

    if ($check == 1) {
        echo "<script>alert('Email already exists')</script>";
        exit();
    }

    // Inserting new User

    $insert = "insert into users (user_name,user_pass,user_email,user_gender,user_image,user_reg_date,status,ver_code,posts,user_cat_id) values ('$name','$pass','$email','$gender','default.jpg','$date','$status','$ver_code','$posts', '$user_cat_id')";
    $query = mysqli_query($con, $insert);
    $insert2 = "insert into user_details (discipline,phone_no,shift) values ('$discipline', '$phone_no',  '$shift')";
    $query2 = mysqli_query($con, $insert2);
    if ($query) {
        echo "<h3 style='width: 400px; color: red; text-align: justify;'>Hi, $name! Your registeration is in final process. Go and verify your email</h3>";
        echo "<script>window.open('login.php','_self');</script>";
    } else {
        echo "<h3 style='width: 400px; color: red; text-align: justify;'>Registeration failed! try again</h3>";
    }
    if ($query2) {
        echo "<h3 style='width: 400px; color: red; text-align: justify;'>QUERY 2</h3>";
    } else {
        echo "<h3 style='width: 400px; color: red; text-align: justify;'>2nd wali khrb hai</h3>" . mysqli_error($con);
    }
}
