<?php
require("template/headerhome.php")
?>

<div class="main-wrapper">
	<section class="cta-section theme-bg-light py-5">
		<div class="container text-center">
			<h2 class="heading"><img src="assets/images/iict.jpg" width="10%"> IICT SMART NOTIFICATION SYSTEM</h2>
			<?php if ($user_cat_id == 2 or $user_cat_id == 1) {


			?>
				<form class="signup-form  justify-content-center pt-3" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<h2>New Posts</h2>
						<select class="form-control mr-md-1 " name="user_cat" style="padding: 10px;">
							<option selected="true" disabled="disabled">SELECT A CLASS OR AUDIENCE</option>
							<?php getClasses(); //get categories for
							?>
						</select>

						<select class="form-control mr-md-1 " name="topic_id" style="padding: 10px;">
							<option selected="true" disabled="disabled">SELECT A TOPIC</option>
							<?php getTopics();	//Topic
							?>
						</select>

						<textarea class="form-control mr-md-1 " cols="83" rows="4" name="content" id="" cols="30" rows="10" placeholder="Write a post..."></textarea>

						<input class="form-control mr-md-1 " type="file" name="post_image" style="padding: 5px;" />

						<input class="btn btn-primary btn-block" type="submit" value="Post" name="sub">
					</div>
				</form>
			<?php
			}
			insertPost();

			?>

		</div>
		<!--//container-->
	</section>
	<section class="blog-list px-3 py-5 p-md-5">
		<div class="container">
			<?php getPosts(); ?>


		</div>
	</section>

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