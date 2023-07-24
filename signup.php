<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>create account page</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
	<link rel="icon" type="image/png" href="assets/images/iict.jpg">

	<script type="text/javascript" href="assets/js/bootstrap.min"></script>
</head>

<body>
	<div class="container-fluid bg">
		<!-- container-fluid start -->
		<a href=""><img class="backimg img-fluid" src="assets/images/back.png"></a> <!-- back icon -->
		<div class="container complte-box">
			<!-- create account portion start from here -->
			<center>
				<h1 class="set-topheading">SIGN UP / CREATE ACCOUNT</h1>
			</center>
			<center>
				<div class="row">
					<!-- student portion start -->
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<a href="stdRegistration.php"><img src="assets/images/std1.png" class="box img-fluid"></a>
						<a href="stdRegistration.php">
							<h3 class="set-stdheading">Student</h3>
						</a>
					</div>
					<!-- student portion end -->

					<!-- teacher portion start-->
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<a href="teachRegistration.php"><img src="assets/images/teacher.png" class="box img-fluid"></a>
						<a href="teachRegistration.php">
							<h3 class="set-teachheading">Teacher</h3>
						</a>
					</div>
					<!-- teacher portion end -->

					<!-- clerk portion start -->
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<a href="clerkRegistration.php"><img src="assets/images/clerk.png" class="box img-fluid"></a>
						<a href="clerkRegistration.php">
							<h3 class="set-clerkheading">Clerk</h3>
						</a>
					</div>
					<!-- clerk portion end -->
				</div>
				<a href="login.php">
					<h4 class="already-member">Already a member?</h4>
				</a>
			</center>
		</div> <!-- create account portion End here -->
	</div> <!-- container-fluid End  -->
</body>

</html>