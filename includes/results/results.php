<?php
session_start();
include("../searchs/ImagesSearch.php");
include("../searchs/SitesSearch.php");


if(isset($_GET["searchTerm"]))
{
      
    $term =$_GET["searchTerm"];
 }
    


$type = isset($_GET["searchType"]) ? $_GET["searchType"] : 'sites';
$page = isset($_GET["page"]) ? $_GET["page"] : 1;


?>
<html>

<head>
    
    <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assests/styles/style.css" />
    <link rel="stylesheet" type="text/css" href="assests/style.css" />
    <link rel="stylesheet" type="text/css" href="assests/font-awesome/css/font-awesome.min.css" />
    
    <link rel="stylesheet" href="assests/styles/fancybox/3.3.5/jquery.fancybox.min.css">

    
    <title> NSearch Results</title>

   <style>
 
   </style>
</head>

<body>
    
<div >
                   <?php  require("body.php");?>
                   <div class="b-example-divider"></div>

            
            
<div class="container" >
  <footer class="py-5">
   
<div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
<p>&copy; 2022 Project NSE. All rights reserved.</p>
<ul class="list-unstyled d-flex">
<li class="ms-3"><a class="link-dark" href="#"><i class="fa fa-whatsapp fa-lg"></i></a></li>
<li class="ms-3"><a class="link-dark" href="#"><i class="fa fa-instagram fa-lg"></i></a></li>
<li class="ms-3"><a class="link-dark" href="#"><i class="fa fa-facebook fa-lg"></i></a></li>
</ul>
</div>
</footer>
    <script src="assests/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assests/jquery/jquery.min.js"></script>
    <script src="assests/scripts/fancybox/3.3.5/jquery.fancybox.min.js"></script>
   
    <script src="assests/scripts/masonry/4.2.2/masonry.pkgd.min.js"></script>
    <script src="assests/imagesloaded.pkgd.min.js"></script>
    <script src="assests/script.js"></script>
    
  
</body>

</html>