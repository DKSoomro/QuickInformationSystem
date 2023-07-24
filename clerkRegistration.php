<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
	<title>Clerk Registration Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="icon" type="image/png" href="assets/images/iict.jpg">

	<link rel="stylesheet" type="text/css" href="assets/css/clerkRegistration-style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/teachRegistration-style.css">

</head>

<body>
	<a href="index.php"><img class="backimg img-fluid" src="assets/images/back.png"></a> <!-- back icon -->
	<div class="container">
		<!-- container start -->
		<div class="box">
			<!-- box start -->

			<div class="row clerkregistration-form">
				<!-- Registration form for clerk start here -->

				<div class="col-lg-6 clerkform-imgArea">
					<!-- slider img area start -->
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" src="assets/images/clerkimg1.png" alt="First slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="assets/images/clerkimg2.png" alt="Second slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="assets/images/clerkimg3.png" alt="Third slide">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div> <!-- slider img area end -->

				<div class="col-lg-6 clerkform-formArea">
					<!-- form area start -->
					<h1 class="headingclerkform">SIGN UP FOR CLERK</h1>
					<form class="form-forStd-registration" method="POST">


						<div class="form-row">
							<!-- f.name and l.name start -->
							<div class="form-group col-md-6">
								<input type="text" class="form-control formforclerk" placeholder="Full Name" name="u_name" required>
							</div>
							<div class="form-group col-md-6">
								<select class="custom-select teachformtitle-b formforteacher" name="u_disc">
									<option selected="true" disabled="disabled">Select Title</option>
									<option>Office Worker</option>
									<option>Admin</option>
									<option>Lab Assistant</option>
									<option>Seminar Library Incharge</option>
								</select>
							</div>
						</div> <!-- f.name and l.name end -->

						<div class="form-row">
							<!-- email and password start -->
							<div class="form-group col-md-6">
								<input type="text" class="form-control formforclerk" placeholder="Phone no ( 03000000000)" name="u_phone" id="u_phone" required>
							</div>

							<div class="form-group col-md-6">
								<input type="email" class="form-control formforclerk" id="inputEmail4" placeholder="Email" required name="u_email">
							</div>
						</div> <!-- email and password end -->
						<div class="form-row">
							<!-- password and confirm password start here -->

							<div class="form-group col-md-6">
								<input type="password" class="form-control formforteach" id="inputPassword4" placeholder="Password" name="u_pass" required>
							</div>
							<div class="form-group col-md-6">
								<input type="password" class="form-control formforteach" id="inputPassword4" placeholder="Confirm password" name="u_pass2" required>
							</div>
						</div><!-- Email and password end here -->

						<div class="form-row">
							<!-- techer gender and  qualification start -->

							<div class="form-group col-md-6">
								<input type="text" class="form-control formforteach" placeholder="Qualification">
							</div>
							<div class="form-group col-md-6 teach-gender">
								<div class="teachform-gender custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline1" name="u_gender" class="custom-control-input" required='required' value="Male">
									<label class="custom-control-label" for="customRadioInline1">Male</label>
								</div>
								<div class="steachform-gender custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline2" name="u_gender" class="custom-control-input" required='required' value="Female">
									<label class="custom-control-label" for="customRadioInline2">Female</label>
								</div>
							</div>

						</div> <!-- techer gender and  qualification end -->


						<div class="form-group col-md-6">
							<!-- selection of shift start -->
							<div class="teachform-shift custom-control custom-radio">
								<input type="radio" id="customRadio1" name="u_shift" value="Morning" required class="custom-control-input">
								<label class="custom-control-label" for="customRadio1">Morning</label>
							</div>
							<div class="teachform-shift custom-control custom-radio">
								<input type="radio" id="customRadio2" name="u_shift" value="Evening" required class="custom-control-input">
								<label class="custom-control-label" for="customRadio2">Evening</label>
							</div>
							<div class="teachform-shift custom-control custom-radio">
								<input type="radio" id="customRadio3" name="u_shift" value="Both" required class="custom-control-input">
								<label class="custom-control-label" for="customRadio3">Both</label>
							</div>
						</div><!-- selection of shift end -->


						<button type="submit" class="teachform btn btn-block btn-primary" name="sign_up" value="Submit">SIGN UP</button>
						<!--btn for sign-up  -->

					</form>
					<?php include("insert_clerk.php"); ?>

				</div> <!-- form area end -->
			</div> <!-- Registration form for clerk End here -->


		</div> <!-- box end here -->
	</div> <!-- container end here -->

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>