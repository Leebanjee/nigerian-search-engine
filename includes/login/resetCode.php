<?php 
session_start();
@include '../../Database/config.php';
$email = "";
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['info'] = "";
    
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Create a new password ";
        $_SESSION['info'] = $info;
        header('location: newPassword.php');
        exit();
    }else{
        $errors[] = "You've entered incorrect code!";
    }
}

if($email == false){
  header('Location: Register.php');
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
   

		
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

</head>
<body>
<section class="body-sign">
			<div class="center-sign">
				<a href="../../index.php" class="logo pull-left">
					<img src="../../assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign" >
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Code Verification</h2>
					</div>
					<div class="panel-body" >
								<?php if (!empty($errors)): ?>
								<div class="alert alert-danger">
									<?php foreach ($errors as $error): ?>
										<div><?php echo $error ?></div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						<form  method="post" enctype="multipart/form-data" autocomplete="off">
                
                    <h2 class="text-center">Code Verification</h2>
                    <!-- <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>-->
                    
                   <div class="form-group mb-lg">
								
								<div class="input-group input-group-icon">
									<input name="otp" type="text" class="form-control input-lg" placeholder="OTP" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
								</div>
							</div>
                            <div class="form-group">
                        <input class="form-control button btn btn-primary" type="submit" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
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