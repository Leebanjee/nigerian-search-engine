<?php

require '../mailer/PHPMailer.php';
require '../mailer/SMTP.php';
require '../mailer/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');

    

    //Create a new PHPMailer instance
    $mail = new PHPMailer();
    //Send using SMTP to localhost (faster and safer than using mail()) – requires a local mail server
    //See other examples for how to use a remote server such as gmail
    $mail->isSMTP();
	
				// $mail->SMTPDebug = 1;
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->SMTPSecure='tls';
				$mail->Port = 587;
    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('ibraheemedrys@gmail.com', 'NEXT-IN');
    //Choose who the message should be sent to
    //You don't have to use a <select> like in this example, you can simply use a fixed address
    //the important thing is *not* to trust an email address submitted from the form directly,
    //as an attacker can substitute their own and try to use your form to send spam
    $addresses = [
        'sales' => 'sales@example.com',
        'support' => 'support@example.com',
        'accounts' => 'accounts@example.com',
    ];
    //Validate address selection before trying to use it
    if (array_key_exists('dept', $_POST) && array_key_exists($_POST['dept'], $addresses)) {
        $mail->addAddress($addresses[$_POST['dept']]);
    } else {
        //Fall back to a fixed address if dept selection is invalid or missing
        $mail->addAddress('support@example.com');
    }
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'Contact form';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
		Email: {$_POST['email']}
		Name: {$_POST['name']}
		Message: {$_POST['message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but it's unsafe to display errors directly to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
}
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $mssg = $_POST['mssg'];
 if (!empty($email) && !empty($mssg)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $reciever = 'ibraheemedrys@gmail.com';
       $subject = "From: $name <$email>";
       $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $mssg\n\nRegards,\n$name";
       $sender = "From: $email";

       if (mail($reciever, $subject, $body, $sender)) {
        echo "Email sent successfully to $reciever!"; 
       } else {
        echo "Sorry, failed to send your message"; 
       }
       
    }else{
        echo "Enter a valid Email!"; 
    }
 } else {
    echo "Email and Message field is required!"; 
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
		<link rel="icon" type="image/x-icon" href="../../assets/images/icon.svg">
		<!-- Skin CSS -->
		<link rel="stylesheet" href="../../admin/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../../admin/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="../../admin/assets/vendor/modernizr/modernizr.js"></script>
        <title>Contact</title>
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
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-envelope mr-xs"></i> Contact Us</h2>
					</div>
					<div class="panel-body">
								<?php if (!empty($errors)): ?>
								<div class="alert alert-danger">
									<?php foreach ($errors as $error): ?>
										<div><?php echo $error ?></div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						<form  method="post" enctype="multipart/form-data" >
							
							<div class="row">
								<div class="col-md-6">
								<div class="form-group mb-lg">
									
									<div class="input-group input-group-icon">
										<input name="name" type="text" class="form-control input-lg" placeholder="Name"/>
										<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
									</div>
										</div>
								</div>
								<div class="col-md-6">
						<div class="form-group mb-lg">
														
							<div class="input-group input-group-icon">
								<input name="email" type="email" class="form-control input-lg" placeholder="Email" />
								<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-envelope"></i>
										</span>
									</span>
							</div>
						</div>
								</div>
							</div>
							
							
							<div class="form-group mb-lg">
								
								<div class="input-group input-group-icon">
									<input name="phone" type="text" class="form-control input-lg" placeholder="Phone"/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-phone"></i>
										</span>
									</span>
								</div>
							</div>
							
							<div class="form-group mb-lg">
								
								<div class="input-group input-group-icon">
									<textarea name="mssg" id="" cols="30" rows="10" placeholder="Write Your Message" class="form-control"></textarea>
									<span class="text-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-sms"></i>
										</span>
									</span>
								</div>
							</div>

							

								<div class="btn-area" style="display: flex;">
									<button type="submit" class="btn btn-primary hidden-xs">Send Message</button>
									<button type="submit" class="btn btn-primary  btn-lg visible-xs mt-lg">Send Message</button>
									<span style="color: #0d6efd; margin-left:20%; display:none;">Sending Your message...</span>
								</div>
							</div>

							
						</form>
					</div>
				</div>

				
			</div>
		</section>
		<!-- end: page -->
		<script src="script.js"></script>
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