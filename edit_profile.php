<?php
require("template/headerhome.php");
$email = $_SESSION['user_email'];
$user = "SELECT * from  users where user_email = '$email'";
$run_user = mysqli_query($con, $user);
$row_user = mysqli_fetch_array($run_user);
$user_id = $row_user['user_id'];
$user_name = $row_user['user_name'];
$user_image = $row_user['user_image'];
$user_reg_date = $row_user['user_reg_date'];
$user_cat_id = $row_user['user_cat_id'];
$user_pass = $row_user['user_pass'];
$user_gender = $row_user['user_gender'];

$cat = "SELECT * from  user_details where user_id = '$user_id'";
$run_cat = mysqli_query($con, $cat);
$row_cat = mysqli_fetch_array($run_cat);
$discipline = $row_cat['discipline'];
$phone = $row_cat['phone_no'];
$reg_no = $row_cat['reg_no'];
$shift = $row_cat['shift'];


?>
<style>
    input {
        width: 50%;
    }

    select {
        width: 50%;
    }
</style>
<!-- timeline ends -->
<!--Content timeline starts-->
<div class="main-wrapper">
    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center">
            <div>
                <form action="" method="post" id="f" class="ff" enctype="multipart/form-data">
                    <table class="table ">
                        <tr align="center">
                            <td colspan="6">
                                <h2>Edit Your Profile</h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Name:</td>
                            <td>
                                <input type="text" name="u_name" required="required" value="<?php echo $user_name; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Password:</td>
                            <td>
                                <input type="text" name="u_password" required="required" value="<?php echo $user_pass; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Email:</td>
                            <td>
                                <input type="email" name="u_email" required="required" value="<?php echo $email; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Discipline/Title:</td>
                            <td>
                                <input type="text" value="<?php echo $discipline; ?>" disabled>

                            </td>
                        </tr>
                        <tr>
                            <td align="right">Phone No:</td>
                            <td>
                                <input type="text" placeholder="Phone no ( 03000000000)" name="u_phone" id="u_phone" value="<?php echo $phone; ?>" required>

                            </td>
                        </tr>
                        <tr>
                            <td align="right">Gender:</td>
                            <td>
                                <select name="u_gender" disabled="disabled">
                                    <option><?php echo $user_gender; ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Reg No:</td>
                            <td>
                                <input type="text" value="<?php echo $reg_no; ?>" disabled />
                            </td>
                        </tr>

                        <tr>
                            <td align="right">Shift:</td>
                            <td>
                                <input type="text" value="<?php echo $shift; ?>" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Profile Photo:</td>
                            <td>
                                <input type="file" name="u_image" required="required" />
                            </td>
                        </tr>

                        <tr align="center">
                            <td colspan="6">
                                <input class="btn btn-primary" type="submit" name="update" value="Update">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </section>
    <!--Content timeline ends-->
    <!-- content ends -->
    <!-- container ends -->
    <?php
    if (isset($_POST['update'])) {
        $u_name = $_POST['u_name'];
        $u_pass = $_POST['u_password'];
        $u_email = $_POST['u_email'];
        $u_image = $_FILES['u_image']['name'];
        $image_tmp = $_FILES['u_image']['tmp_name'];

        move_uploaded_file($image_tmp, "users/$u_image");

        $update = "update users set user_name = '$u_name', user_pass = '$u_pass', user_email = '$u_email', user_image = '$u_image' where user_id = '$user_id'";

        $run = mysqli_query($con, $update);
        if ($run) {
            $u_phone = $_POST['u_phone'];
            $update = "update user_details set phone_no = '$u_phone' where user_id = '$user_id'";

            $run = mysqli_query($con, $update);
            echo "<script>alert('Your Profile has been updated');</script>";
            echo "<script>window.open('home.php','_self');</script>";
        } else {
            echo mysqli_error($con);
        }
    }

    ?>
    <?php require('template/footerhome.php'); ?>
</div>
<!--//main-wrapper-->




<!-- *****CONFIGURE STYLE (REMOVE ON YOUR PRODUCTION SITE)****** -->
<div id="config-panel" class="config-panel d-none d-lg-block">
    <div class="panel-inner">
        <a id="config-trigger" class="config-trigger config-panel-hide text-center" href="#"><i class="fas fa-cog fa-spin mx-auto" data-fa-transform="down-6"></i></a>
        <h5 class="panel-title">Choose Colour</h5>
        <ul id="color-options" class="list-inline mb-0">
            <li class="theme-1 active list-inline-item"><a data-style="assets/css/theme-1.css" href="#"></a></li>
            <li class="theme-2  list-inline-item"><a data-style="assets/css/theme-2.css" href="#"></a></li>
            <li class="theme-3  list-inline-item"><a data-style="assets/css/theme-3.css" href="#"></a></li>
            <li class="theme-4  list-inline-item"><a data-style="assets/css/theme-4.css" href="#"></a></li>
            <li class="theme-5  list-inline-item"><a data-style="assets/css/theme-5.css" href="#"></a></li>
            <li class="theme-6  list-inline-item"><a data-style="assets/css/theme-6.css" href="#"></a></li>
            <li class="theme-7  list-inline-item"><a data-style="assets/css/theme-7.css" href="#"></a></li>
            <li class="theme-8  list-inline-item"><a data-style="assets/css/theme-8.css" href="#"></a></li>
        </ul>
        <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
    </div>
    <!--//panel-inner-->
</div>
<!--//configure-panel-->



<!-- Javascript -->
<script src="assets/plugins/jquery-3.3.1.min.js"></script>
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Style Switcher (REMOVE ON YOUR PRODUCTION SITE) -->
<script src="assets/js/demo/style-switcher.js"></script>


</body>

</html>