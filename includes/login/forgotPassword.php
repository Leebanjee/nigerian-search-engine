<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

 require '../../vendor/autoload.php';
@include '../../Database/databaseconfig.php';
@include '../../includes/helper/functions.php';

$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
$mail = new PHPMailer(true);
try {
	$select = $pdo->query("SELECT * FROM users WHERE email = '$email'");
	
		
			
			

				$mail->SMTPDebug = 0;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'nextinnovation2580@gmail.com';
				$mail->Password = '';
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;
				$mail->setFrom('nextinnovation@gmail.com','Next-Innovation');
				$mail->addAddress($email, $name);
				$mail ->isHTML(true);
				$code = substr(number_format(time() * rand(), 0, '',''), 0, 6);
				$mail->Subject = 'Email Verification';
				$mail->Body = '<p> Your Verification code is : <b style="font-size: 30px;">'.$code.'</b></p>';
				$mail->send();
				$statement = $pdo->prepare("UPDATE users SET code = :code WHERE email = :email");
               $statement->bindValue(':code', $code);
               
               $statement->bindValue(':email', $email);

                $statement->execute();
        
				header("location: emailVerification.php?email=". $email);
				exit();
			
	
}


catch (Exception $e) {
	echo "Message could not be send. Mailer Error: {$mail->ErrorInfo}";
}
	
}

 ?>
 

<!DOCTYPE html>
<html lang="en">
<head>
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
            <img src="../../assets/images/logo.png" height="54" alt="Porto Admin" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Forgot Password</h2>
            </div>
            <div class="panel-body">
            <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <div><?php echo $error ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <form  method="post">
                    <h2 class="text-center">Forgot Password</h2>
                    
                    
                    <div class="form-group mb-lg">
								
								<div class="input-group input-group-icon">
									<input name="email" type="email" class="form-control input-lg" placeholder="Email"/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-envelope"></i>
										</span>
									</span>
								</div>
							</div>
                    <div class="form-group">
                        <input class="form-control button btn btn-primary" type="submit" value="Continue">
                    </div>
                </form>
         
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