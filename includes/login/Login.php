<?php
@include '../../Database/config.php';
@include '../../includes/helper/functions.php';

session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	if (empty($email) && empty($password)) {
		$errors[] = "Email and Password  field can't empty";
	}

	if (empty($email)) {
		$errors[]  = "Email field can't empty";
	}
	if (empty($password)) {
		$errors[] = "Password field can't empty";
	}

	$select = "SELECT * FROM users WHERE email = '$email'";
	$result = mysqli_query($conn, $select);

	if (mysqli_num_rows($result) > 0) {

		$row = mysqli_fetch_assoc($result);
		if ($row['status'] == 'verified') {
			if ($row['usertype'] == 'Administrator') {
				$_SESSION['admin_name'] = $row['name'];
				$_SESSION['role'] = $row['usertype'];
				$_SESSION['image'] = $row['image'];

				echo '<script>window.location.href="../../Admin/dashboard.php"</script>';
			} elseif ($row['usertype'] == 'user') {

				$_SESSION['id'] = $row['id'];
				$_SESSION['user_name'] = $row['name'];
				$_SESSION['image'] = $row['image'];
				$_SESSION['email'] = $row['email'];

				echo '<script>window.location.href="../../index.php"</script>';
			}
		} else {
			$info = "It's look like you're not yet a member! Please verify your email<a href='../signin/emailVerification.php?email=" . $email . "'> from here!!</a>.";
			$_SESSION['info'] = $info;
			echo '<script>window.location.href=" resetCode.php"</script>';
		}
	} else {
		$errors[]  = 'Incorrect email or password!';
	}
}

?>

<!doctype html>
<html class="fixed">

<head>

	<!-- Basic -->
	<meta charset="UTF-8">



	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">


	<!-- Vendor CSS -->
	<link rel="stylesheet" href="../../admin/assets/vendor/bootstrap/css/bootstrap.css" />

	<link rel="stylesheet" href="../../admin/assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="../../admin/assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="../../admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
	<link rel="icon" type="image/x-icon" href="../../assets/images/icon.svg">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="../../admin/assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="../../admin/assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="../../admin/assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="../../admin/assets/vendor/modernizr/modernizr.js"></script>
	<title>Login</title>
</head>


<body>
	<!-- start: page -->
	<section class="body-sign">
		<div class="center-sign">
			<a href="../../index.php" class="logo pull-left">
				<img src="../../images/logo.png" height="54" alt="Porto Admin" />
			</a>

			<div class="panel panel-sign">
				<div class="panel-title-sign mt-xl text-right">
					<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
				</div>
				<div class="panel-body">
					<?php if (!empty($errors)) : ?>
						<div class="alert alert-danger">
							<?php foreach ($errors as $error) : ?>
								<div><?php echo $error ?></div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<form method="post">
						<div class="form-group mb-lg">
							<label>Email</label>
							<div class="input-group input-group-icon">
								<input name="email" type="email" class="form-control input-lg" />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-user"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="form-group mb-lg">
							<div class="clearfix">
								<label class="pull-left">Password</label>
								<a href="forgotPassword.php" class="pull-right">Lost Password?</a>
							</div>
							<div class="input-group input-group-icon">
								<input name="password" type="password" class="form-control input-lg" />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-lock"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-8">
								<div class="checkbox-custom checkbox-default">
									<input id="RememberMe" name="rememberme" type="checkbox" />
									<label for="RememberMe">Remember Me</label>
								</div>
							</div>
							<div class="col-sm-4 text-right">
								<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
								<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
							</div>
						</div>

						<span class="mt-lg mb-lg line-thru text-center text-uppercase">
							<span>or</span>
						</span>

						<div class="mb-xs text-center">
							<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
							<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
						</div>

						<p class="text-center">Don't have an account yet? <a href="../signin/Register.php">Sign Up!</a></p>

					</form>
				</div>
			</div>

			<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2023. All Rights Reserved.</p>
		</div>
	</section>
	<!-- end: page -->

	<!-- Vendor -->
	<script src="../../admin/assets/vendor/jquery/jquery.js"></script>
	<script src="../../admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="../../admin/assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="../../admin/assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="../../admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../../admin/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="../../admin/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="../../admin/assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="../../admin/assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="../../admin/assets/javascripts/theme.init.js"></script>

</body>

</html>