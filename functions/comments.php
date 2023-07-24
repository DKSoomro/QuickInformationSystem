<?php
include('includes/connection.php');

$get_id = $_GET['post_id'];
$get_com = "Select * from comments where post_id = '$get_id' ORDER by 1 DESC";
$run_com = mysqli_query($con, $get_com);
while ($row = mysqli_fetch_array($run_com)) {
    $com = $row['comment'];
    $com_name = $row['comment_author'];
    $date = $row['date'];

    echo "
        
        <strong>$com_name </strong> $com<br>
        <span><i> Said</i> on $date</span>
        <hr>
    ";
}
