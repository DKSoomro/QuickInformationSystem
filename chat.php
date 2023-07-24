<?php

include("includes/connection.php");
include("functions/functions.php");
session_start();
$user = $_SESSION['user_email'];
$u_id = $_SESSION['u_id'];
$get_user = "Select * from users where user_email = '$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_id = $row['user_id'];


$sel = "select * from messages where receiver = '$u_id' AND sender = '$user_id' OR receiver = '$user_id' AND sender = '$u_id' ORDER BY msg_id desc LIMIT 5";
$run = mysqli_query($con, $sel);
while ($row = mysqli_fetch_array($run)) {
    $msg_text = $row['msg_text'];
    $msg_date = $row['msg_date'];
    $sender = $row['sender'];
    $receiver = $row['receiver'];
    if ($sender != $user_id) {
        echo "
                                    <div id = posts>  
                                    <p style='float: left;'>$msg_text</p> <br>
                                    <p style='float: left;'>$msg_date</p>
                                    </div>
                                    <br><hr>
                                    ";
    } else {

        echo "
                                    <div id = posts>  
                                        <p style='float: right;'>$msg_text</p><br>
                                        <p style='float: right;'>$msg_date</p>
                                    </div>
                                    <br><hr>
                                    ";
    }
}
$query = "update messages set status = 'read' where receiver = '$user_id' AND sender = '$u_id' ";
$runi = mysqli_query($con, $query);
