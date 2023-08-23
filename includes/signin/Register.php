
<?php
//Include required PHPMailer files
require '../mailer/PHPMailer.php';
require '../mailer/SMTP.php';
require '../mailer/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

 require '../../vendor/autoload.php';
@include '../../Database/databaseconfig.php';
// @include '../../includes/helper/functions.php';

$errors = [];

$name= '';
$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $cpass = $_POST['cpassword'];
	$usertype = 'user';
	$status = 'not verified';
    $image = $_FILES['image'] ?? null;
    $imagePath = '';
$mail = new PHPMailer();
try {
	$select = $pdo->query("SELECT * FROM users WHERE email = '$email'");
	$number_of_rows = $select->fetchColumn();
	if($number_of_rows > 0) {
		$errors[] = 'This email already exist!';
	}else{
		if ($password !== $cpass) {
			$errors[] ='password not matched';
		}else{

			include_once '../../validate_users.php';
			
			
			if (empty($errors)) {

				$mail->isSMTP();
				// $mail->SMTPDebug = 1;
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->SMTPSecure='tls';
				$mail->Port = 587;
				$mail->Username = 'ibraheemedrys@gmail.com';
				$mail->Password = 'vpuausqirdmyfqhd';
				// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTL7777777iS;
				$mail->Subject = 'Email Verification';
				$mail->setFrom('ibraheemedrys@gmail.com');
				$mail->addAddress($email, $name);
				$mail ->isHTML(true);
				$code = substr(number_format(time() * rand(), 0, '',''), 0, 6);
				$mail->Body = '<p> Your Verification code is : <b style="font-size: 30px;">'.$code.'</b></p>';
				if ($mail->send()){
					echo "Email Sent....!";
				}else{
					echo "Message could not be sent. Mailer Error: ";
				}
				$mail->smtpClose();
				$statement = $pdo->prepare("INSERT INTO users ( image, name, status, email, usertype, password, created_at, code)
						VALUES (:image, :name, :status, :email, :usertype, :password, :date, :code)");
				$statement->bindValue(':image', $imagePath);
				$statement->bindValue(':name', $name);
				$statement->bindValue(':status', $status);
				$statement->bindValue(':email', $email);
				$statement->bindValue(':usertype', $usertype);
				$statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
				$statement->bindValue(':date', date('Y-m-d H:i:s'));
				$statement->bindValue(':code', $code);
				$statement->execute();
				header("location: emailVerification.php?email=". $email);
				exit();
			}
	}
}


} catch (Exception $e) {
	echo "Message could not be send. Mailer Error: {$mail->ErrorInfo}";
}
	
}

 ?>
 

<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		
		<link rel="icon" type="image/x-icon" href="../../assets/images/icon.svg">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../../admin/assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="../../admin/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../../admin/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../../admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../../admin/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../../admin/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../../admin/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="../../admin/assets/vendor/modernizr/modernizr.js"></script>
		<title>Sign Up</title>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="../../index.php" class="logo pull-left">
					<img src="../../images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign" >
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign Up</h2>
					</div>
					<div class="panel-body" >
								<?php if (!empty($errors)): ?>
								<div class="alert alert-warning">
									<?php foreach ($errors as $error): ?>
										<div class="alert alert-danger"><?php echo $error ?></div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						<form  method="post" enctype="multipart/form-data">
							<div class="form-group mb-lg">
								<label>Image</label>
								<div class="input-group input-group-icon">
									<input name="image" type="file" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-image"></i>
										</span>
									</span>
									
								</div>
							</div>
							<div class="form-group mb-lg">
								
								<div class="input-group input-group-icon">
									<input name="name" type="text" class="form-control input-lg" placeholder="Name" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
								</div>
							</div>
							<div class="form-group mb-lg">
								
								<div class="input-group input-group-icon">
									<input name="email" type="email" class="form-control input-lg" placeholder="Email"/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-envelope"></i>
										</span>
								</div>
							</div>
							<div class="form-group mb-lg">
								
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg"  placeholder="Password"/>
									
								</div>
							</div>
							<div class="form-group mb-lg">
								
								<div class="input-group input-group-icon">
									<input name="cpassword" type="password" class="form-control input-lg" placeholder="Comfirm Password"/>
									
								</div>
							</div>

							

								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs">Sign Up</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign Up</button>
								</div>
							</div>

							<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or</span>
							</span>

							<div class="mb-xs text-center">
								<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
								<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
							</div>

							<p class="text-center">Already have an account? <a href="../login/Login.php">Sign In!</a></p>

						</form>
					</div>
				</div>

				
			</div>
		</section>
		<!-- end: page -->

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