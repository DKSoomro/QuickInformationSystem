<table align="center" width="800" bgcolor="skyblue">
    <tr bgcolor="orange" border="1">
        <th>POST BY</th>
        <th>ABOUT</th>
        <th>CONTENT</th>
        <th>DATE</th>
        <th>IMAGE</th>
        <th>DELETE</th>
    </tr>
    <?php
    include("includes/connection.php");
    $sel_users = "Select * from posts ORDER by 1 DESC";
    $run_users = mysqli_query($con, $sel_users);
    while ($row_users = mysqli_fetch_array($run_users)) {
        $post_id = $row_users['post_id'];
        $user_id = $row_users['user_id'];
        $about = $row_users['topic_id'];
        $content = $row_users['post_content'];
        $date = $row_users['post_date'];
        $image = $row_users['post_image'];

    ?>
        <tr align="center">
            <td><?php echo $user_id; ?></td>
            <td><?php echo $about; ?></td>
            <td><?php echo $content; ?></td>
            <td><img src="../posts/<?php echo $image; ?>" width="50" height="50" alt=""></td>
            <td><?php echo $date; ?></td>
            <td><a href="delete_post.php?delete=<?php echo $post_id; ?>">DELETE</a></td>
        </tr>
    <?php } ?>
</table>