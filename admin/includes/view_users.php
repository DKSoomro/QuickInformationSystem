<table align="center" width="800" bgcolor="skyblue">
    <tr bgcolor="orange" border="1">
        <th>NAME</th>
        <th>USER CAT ID</th>
        <th>GENDER</th>
        <th>IMAGE</th>
        <th>MEMBER SINCE</th>
        <th>DELETE</th>
    </tr>
    <?php
    include("includes/connection.php");
    $sel_users = "Select * from users ORDER by 1 DESC";
    $run_users = mysqli_query($con, $sel_users);
    while ($row_users = mysqli_fetch_array($run_users)) {
        $user_id = $row_users['user_id'];
        $user_name = $row_users['user_name'];
        $user_cat_id = $row_users['user_cat_id'];
        $user_gender = $row_users['user_gender'];
        $user_image = $row_users['user_image'];
        $user_reg_date = $row_users['user_reg_date'];

    ?>
        <tr align="center">
            <td><?php echo $user_name; ?></td>
            <td><?php echo $user_cat_id; ?></td>
            <td><?php echo $user_gender; ?></td>
            <td><img src="../users/<?php echo $user_image; ?>" width="50" height="50" alt=""></td>
            <td><?php echo $user_reg_date; ?></td>
            <td><a href="delete_user.php?delete=<?php echo $user_id; ?>">DELETE</a></td>
        </tr>
    <?php } ?>
</table>