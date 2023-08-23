<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/style.css">
    <link rel="stylesheet" href="vendor/app.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/cerulean.theme.min.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="images/nico.svg">


    <style>

    </style>
    <title>Nigerian Search</title>
</head>

<body>

    <div class='home'>

        <div class='home__header'>
            <div class='home__headerleft'>
                <a class="nav-link "><img src="logo.png" width="100%" height="20px" /></a>
                <a class="nav-link active" aria-current="page" href="">Home</a>
                <a class="nav-link" href="includes/contact/contact.php">Contact Us</a>
            </div>




            <?php if (isset($_SESSION['user_name'])) { ?>
                <div class='home__headerright'>

                    <img src="public/<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['user_name'] ?>" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />

                    <a href="includes/profile/dashboard.php">Welcome <?php echo $_SESSION['user_name']; ?></a>
                    <a href="#">|</a>

                    <a href="includes/logout/logout.php">Log Out</a>

                </div>


            <?php  } elseif (isset($_SESSION['role'])) { ?>
                <div class='home__headerright'>

                    <img src="public/<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['admin_name'] ?>" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />

                    <a href="admin/dashboard.php">Welcome <?php echo $_SESSION['admin_name']; ?></a>
                    <a href="#">|</a>

                    <a href="includes/logout/logout.php">Log Out</a>

                </div>



            <?php  } else { ?>

                <div class='home__headerright'>

                    <i class="fa fa-user-circle-o"></i>

                    <a href="includes/signin/Register.php">Register</a>
                    <a href="#">|</a>
                    <a href="includes/login/Login.php">Login</a>


                </div>
            <?php } ?>

        </div>


        <div class='home__body'>
            <!-- <img  alt='logo'></img> -->




            <img src="images/ibrahim.png" />

            <div class="">
                <form action="includes/results/results.php" class='search'>
                    <div class="searchInput">

                        <i class="fa fa-microphone"></i>
                        <input type="text" class="search__inputbox" name="searchTerm" />
                        <i class="fa fa-search searchInputIcon" id=''></i>
                    </div>
                    <br>
                    <div class="search__btn">

                        <input type="submit" class="btn btn-primary define" value="Search" />
                    </div>
                </form>
            </div>

            <div class="container overflow-auto" style="border: 1px solid #044a8d;">
                <div class="row">
                    <div class="col-md-12">


                        <!-- <section class="wrapper"> -->
                        <div class="container-fostrap" style="margin-top:10px">
                            <div>

                                <h5> Latest Nigerian News</h5>
                                <hr>
                            </div>

                            <div class="container overflow-auto" style="height: min-content; ">
                                <div class="row">

                                    <?php require("includes/api/news.php"); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="b-example-divider"></div>



    <div class="container" style="margin-top: 300px;">
        <footer class="py-5">

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                <p>&copy; 2023 Project NSE. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><i class="fa fa-whatsapp fa-lg"></i></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><i class="fa fa-instagram fa-lg"></i></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><i class="fa fa-facebook fa-lg"></i></a></li>
                </ul>
            </div>
        </footer>


        <script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <script src="vendor/jquery/jquery.min.js"></script>


</body>

</html>