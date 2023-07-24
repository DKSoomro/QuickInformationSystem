<table align="center" width="800" bgcolor="skyblue">
    <tr bgcolor="orange" border="1">
        <th>POST BY</th>
        <th>COMMENT</th>
        <th>COMMENT BY</th>
        <th>DATE</th>
        <th>DELETE</th>
    </tr>
    <?php
    include("includes/connection.php");
    $sel_users = "Select * from comments ORDER by 1 DESC";
    $run_users = mysqli_query($con, $sel_users);
    while ($row_users = mysqli_fetch_array($run_users)) {
        $com_id = $row_users['com_id'];
        $post_id = $row_users['post_id'];
        $user_id = $row_users['user_id'];
        $comment = $row_users['comment'];
        $author = $row_users['comment_author'];
        $date = $row_users['date'];

    ?>
        <tr align="center">
            <td><?php echo $user_id; ?></td>
            <td><?php echo $comment; ?></td>
            <td><?php echo $author; ?></td>
            <td><?php echo $date; ?></td>
            <td><a href="delete_comment.php?delete=<?php echo $com_id; ?>">DELETE</a></td>
        </tr>
    <?php } ?>
</table>