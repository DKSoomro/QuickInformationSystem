<?php
session_start();
include("includes/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            background: pink;
        }

        td,
        table {
            padding: 10px;
        }
    </style>
</head>

<body>
    <form action="admin_login.php" method="POST">
        <table align="center" bgcolor="skyblue" width=500>
            <tr align="center">
                <td colspan="3">
                    <h2>ADMIN LOGIN HERE</h2>
                </td>
            </tr>
            <tr>
                <td align="right">ADMIN EMAIL:</td>
                <td><input type="email" placeholder="ENTER EMAIL" name="email"></td>
            </tr>
            <tr>
                <td align="right">ADMIN PASSWORD:</td>
                <td><input type="password" placeholder="ENTER PASSWORD" name="pass"></td>
            </tr>
            <tr align="center">
                <td colspan="3"><input type="submit" name="admin_login" value="LOGIN"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['admin_login'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pass = mysqli_real_escape_string($con, $_POST['pass']);

        $get_admin = "SELECT * FROM admin where admin_email = '$email' and admin_password = '$pass'";
        $run_admin = mysqli_query($con, $get_admin);
        $check_admin = mysqli_num_rows($run_admin);
        if ($check_admin == 0) {
            echo "<script>alert('EMAIL OR PASSWORD NOT CORRECT');</script>";
        } else {
            $_SESSION['admin_email'] = $email;
            echo "<script>window.open('index.php','_self');</script>";
        }
    }
    ?>
</body>

</html>