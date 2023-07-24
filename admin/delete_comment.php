<?php
include("../functions/functions.php");
if (isset($_GET['delete'])) {
    $get_id = $_GET['delete'];

    $delete = "DELETE from comments where com_id = $get_id";
    $run_delete = mysqli_query($con, $delete);

    echo "<script>alert('Post has been deleted');</script>";

    echo "<script>window.open('index.php','_self');</script>";
}
