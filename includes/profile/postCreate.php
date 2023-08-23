<?php

session_start();
if (!isset($_SESSION['user_name'])) {
    header('location: ../../index.php');
    die();
  }
  $pdo = require_once '../../Database/databaseconfig.php';
$errors = [];

$title= '';
$url = '';
$body = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $siteurl = $_POST['siteurl'];
    $body = $_POST['body'];
    $user_id = $_SESSION['id'];
    $email= $_SESSION['email'];
	if (!$title) {
        $errors[] = 'title is required';
    }
    
    if (!$siteurl) {
        $errors[] = 'Url is required';
    }
		
			if (empty($errors)) {
               

				$statement = $pdo->prepare("INSERT INTO posts (user_id, email, title, siteurl, body, created_at)
						VALUES (:user_id, :email, :title, :siteurl, :body, :date)");
				
				$statement->bindValue(':user_id', $user_id);
				$statement->bindValue(':email', $email);
				$statement->bindValue(':title', $title);
				$statement->bindValue(':siteurl', $siteurl);
				$statement->bindValue(':body', $body);
				$statement->bindValue(':date', date('Y-m-d H:i:s'));
		
				$statement->execute();
				
				echo '<script>window.location.href="dashboard.php"</script>';
				die;
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
        <title>Create Post</title>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="dashboard.php" class="logo pull-left">
					<img src="../../images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-envelope mr-xs"></i> Post Your Site</h2>
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
							
							
                                                
                                            <div class="form-group mb-lg">
								
                                                    <div class="input-group input-group-icon">
                                                        <input name="title" type="text" class="form-control input-lg" placeholder="Title"/>
                                                        <span class="input-group-addon">
                                                            <span class="icon icon-lg">
                                                                <i class="fa fa-exchange"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-lg"> 

                                                    <div class="input-group input-group-icon">
                                                        <input name="siteurl" type="url" class="form-control input-lg" placeholder="Website link"/>
                                                        <span class="input-group-addon">
                                                            <span class="icon icon-lg">
                                                                <i class="fa fa-link"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                             
                            
                                                 <div class="form-group mb-lg">
								
                                                    <div class="input-group input-group-icon">
                                                        <textarea name="body" id="" cols="30" rows="10" placeholder="Write Your Site Description" class="form-control"></textarea>
                                                        <span class="text-group-addon">
                                                            <span class="icon icon-lg">
                                                                <i class="fa fa-info-circle"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>

                                        
                                                            <footer class="panel-footer">
                                                                <button type="submit" class="btn btn-primary">Submit Site</button>
                                                            </footer>
                                    </form>
                                </section>
                            </div>
                    </div>
</section>
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

    
   
    

    
   
    
    
    
    
    

