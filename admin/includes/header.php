<?php
	session_start();

	if (!isset($_SESSION['admin_name'])) {
		header('location: ../includes/login/Login.php');
		die();
	}

?>
<!DOCTYPE html>
<html lang="en" class="sidebar-light sidebar-left-big-icons boxed header-fixed">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Search the web for sites and images.">
	<meta name="keywords" content="Search engine, nigeria, websites">
	<meta name="author" content="Ibrahim Abdullahi (Lee banjee)">
	<link rel="icon" type="image/x-icon" href="includes/images/nico.svg">
	
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
<!-- Vendor CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.carousel.css" />
<link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.theme.default.css" />
<!-- Theme CSS -->
<link rel="stylesheet" href="assets/stylesheets/theme.css" />
<!-- Skin CSS -->
<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />
<!-- Theme Custom CSS -->
<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
<!-- Head Libs -->
<script src="assets/vendor/modernizr/modernizr.js"></script>
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
<!-- Theme CSS -->
<link rel="stylesheet" href="assets/stylesheets/theme.css" />
<!-- Skin CSS -->
<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />
<!-- Theme Custom CSS -->
<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.css" />
<link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.theme.css" />
<link rel="stylesheet" href="assets/vendor/select2/css/select2.css" />
<link rel="stylesheet" href="assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
<link rel="stylesheet" href="assets/vendor/dropzone/basic.css" />
<link rel="stylesheet" href="assets/vendor/dropzone/dropzone.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />
		<title>NS-Admin</title>
       
</head>
<body>
<header class="header">
				<div class="logo-container">
					<a href="dashboard.php" class="logo">
						<h3>N-SEARCH</h3>
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
			
					<span class="separator"></span>
			
					<ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Alerts
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-thumbs-down bg-danger"></i>
												</div>
												<span class="title">Searchs</span>
												<span class="message">30 hours ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning"></i>
												</div>
												<span class="title">Posts</span>
												<span class="message">20 hours ago</span>
											</a>
										</li>
										
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="/profile" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="../public/<?php echo $_SESSION['image']?>" alt="Ibrahim Abdullahi Idris" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="Ibrahim Abdullahi Idris" data-lock-email="Ibraheemedrys@gmail.com">
								<span class="name"><?php echo $_SESSION['admin_name'] ?></span>
								<span class="role"><?php echo $_SESSION['role'] ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="#"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
                                                                    <a role="menuitem" tabindex="-1" href="../includes/logout/Logout.php"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<br>
			<div class="inner-wrapper">
       <aside id="sidebar-left" class="sidebar-left" >
				
                <div class="sidebar-header" >
                    <div class="sidebar-title" >
                        
                    </div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar" ></i>
                    </div>
                </div>
            
                <div class="nano" >
                    <div class="nano-content" >
                        <nav id="menu" class="nav-main" role="navigation" >
                        
                            <ul class="nav nav-main" >
                                <li class="nav-active" >
                                    <a href="dashboard.php" >
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>Dashboard</span>
                                    </a>                        
                                </li>
                                
                                <li class="nav-parent">
                                    <a href="#" >
                                        <i class="fa fa-users" aria-hidden="true" ></i>
                                        <span>Users</span>
                                    </a>
                                    <ul class="nav nav-children" >
                                                               
                                                                
                                        <li >
                                            <a href="userIndex.php">
                                                All Users
                                            </a>
                                        </li>
                                                                <li>
                                            <a href="userCreate.php">
                                                Create User
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                                        <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-gear" aria-hidden="true"></i>
                                        <span>Posts</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="postIndex.php">
                                                All Posts
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-parent">
                                    <a href="">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        <span>Sites</span>
                                    </a>
                                    <ul class="nav nav-children">
                                                                <li>
                                            <a href="siteIndex.php">
                                               All Sites
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </li>
                                <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-image" aria-hidden="true"></i>
                                        <span>Images</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="imageIndex.php">
                                                All Images
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                
                                </li>
                                <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-gear" aria-hidden="true"></i>
                                        <span>Crawler</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="webcrawler.php">
                                                Web Crawler
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                
                                </li>
                                <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-gears" aria-hidden="true"></i>
                                        <span>Settings</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="#">
                                                Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Settings
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
            
                        <hr class="separator" />
            
                        <div class="sidebar-widget widget-tasks">
                            <div class="widget-header">
                                <h6>More</h6>
                                <div class="widget-toggle">+</div>
                            </div>
                            
                            <div class="widget-content">
                                <ul class="list-unstyled m-none">
                                    <li><a href="../includes/logout/Logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
            
                        <hr class="separator" />
                    </div>
            
                    <script>
                        // Maintain Scroll Position
                        if (typeof localStorage !== 'undefined') {
                            if (localStorage.getItem('sidebar-left-position') !== null) {
                                var initialPosition = localStorage.getItem('sidebar-left-position'),
                                    sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                                
                                sidebarLeft.scrollTop = initialPosition;
                            }
                        }
                    </script>
                    
            
                </div>
            
            </aside>
            <?php include_once 'includes/right-bar.php'; ?>