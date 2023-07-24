<?php
include("../functions/functions.php");
if (isset($_GET['delete'])) {
    $get_id = $_GET['delete'];

    $delete = "DELETE from users where user_id = $get_id";
    $run_delete = mysqli_query($con, $delete);

    $delete_posts = "DELETE from posts where user_id = $get_id";
    $run_posts = mysqli_query($con, $delete_posts);

    $delete_msgs = "DELETE from messages where sender = $get_id or receiver = $get_id";
    $run_msgs = mysqli_query($con, $delete_msgs);

    echo "<script>alert('User has been deleted');</script>";

    echo "<script>window.open('index.php','_self');</script>";
}
