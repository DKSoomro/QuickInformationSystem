<?php
require("template/headerhome.php")
?>


<!--Content timeline starts-->
<div class="content_timeline">
    <?php
    if (isset($_GET['post_id'])) {
        $get_id = $_GET['post_id'];
        $get_post = "select * from posts where post_id = '$get_id'";
        $run_posts = mysqli_query($con, $get_post);
        $row = mysqli_fetch_array($run_posts);

        $post_content = $row['post_content'];
    }
    ?>

    <div class="main-wrapper">
        <section class="cta-section theme-bg-light py-5">
            <div class="container text-center">
                <h2 class="heading">IICT SMART NOTIFICATION SYSTEM</h2>
                <form class="signup-form  justify-content-center pt-3" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <h2>Edit Post</h2>
                        <textarea class="form-control mr-md-1 " cols="83" rows="4" name="post_content" id="" cols="30" rows="10" placeholder="Write a post..."><?php echo $post_content; ?></textarea>

                        <input class="form-control mr-md-1 " type="file" name="post_image" style="padding: 5px;" />

                        <input class="btn btn-primary btn-block" type="submit" value="Update" name="update">
                    </div>
                </form>
            </div>
            <!--//container-->
        </section>




        <?php
        if (isset($_POST['update'])) {
            $post_content = $_POST['post_content'];
            $post_image = $_FILES['post_image']['name'];
            $image_tmp = $_FILES['post_image']['tmp_name'];

            move_uploaded_file($image_tmp, "posts/$post_image");


            $update_post = "update posts set  post_content = '$post_content', post_image = '$post_image' where post_id = '$get_id'";
            $run_update = mysqli_query($con, $update_post);

            if ($run_update) {
                echo "<script>alert('Post has been updated')</script>";
                echo "<script>window.open('home.php','_self')</script>";
            }
        }
        ?>

    </div>
    <!--Content timeline ends-->
    <!-- content ends -->
</div>
<!-- container ends -->
</body>

</html>