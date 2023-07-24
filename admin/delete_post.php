<?php
include("../functions/functions.php");
if (isset($_GET['delete'])) {
    $get_id = $_GET['delete'];

    $delete = "DELETE from posts where post_id = $get_id";
    $run_delete = mysqli_query($con, $delete);

    $delete_posts = "DELETE from comments where post_id = $get_id";
    $run_posts = mysqli_query($con, $delete_posts);

    echo "<script>alert('Post has been deleted');</script>";

    echo "<script>window.open('index.php','_self');</script>";
}
