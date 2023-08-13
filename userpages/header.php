<?php include "connection.php";

?>

<!DOCTYPE html>
<html lang="en" class="theme-dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!-- Boxicons CSS -->
        <link rel="stylesheet" href="assets/css/boxicons.min.css">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="assets/css/responsive.css">
        <!-- Theme Dark CSS -->
        <link rel="stylesheet" href="assets/css/theme-dark.css">

        <title>GERS GARAGE</title>

        <link rel="icon" type="image/png" href="assets/img/favicon.png">
    </head>

    <body>
        <!-- Start Navbar Area -->
        <div class="navbar-area ">
            <!-- Menu For Mobile Device -->
            <div class="mobile-nav">
                <a href="index.php" class="logo">
                    <img src="assets/img/logo.png" alt="Logo">
                </a>
            </div>

            <!-- Menu For Desktop Device -->
            <div class="main-nav" style="position: relative;">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="index.php">
              
                        </a>
                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a href="index.php">Home</a>
                                   
                                </li>
                                <li class="nav-item">
                                    <a href="about.php" class="nav-link">About</a>
                                </li>
                                <li class="nav-item">
                                    <a href="service.php" class="nav-link dropdown-toggle">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a href="pricing.php" class="nav-link">Pricing</a>
                                </li>
                    
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">Your Profile</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="profile.php" class="nav-link">Your Vehicles</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="track_vehicle.php" class="nav-link">Track Your Vehicle</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="booking.php" class="nav-link">Book for your vehicle</a>
                                        </li>
                                     
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="contact.php" class="nav-link">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="cmn-btn" style="display: flex;">
                        <?php if(!empty($_SESSION['email'])) { ?>
                          <a class="banner-btn-left" href="profile.php">
                                <i class='bx bxs-user-plus'></i>
                                Profile
                            </a>  
                            <a class="banner-btn-left" href="logout.php">
                                <i class='bx bxs-user-plus'></i>
                                Logout
                            </a> 
                            
                            

                        <?php } else { ?> 
                          <a class="banner-btn-left" href="login.php">
                                <i class='bx bxs-user-plus'></i>
                                Sign In
                            </a>  
                            <a class="banner-btn-left" href="register.php">
                                <i class='bx bxs-user-plus'></i>
                                Sign Up
                            </a>  
                        <?php } ?>
                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->
          
          
        </div>
      </div>
    </div>
  </header>

