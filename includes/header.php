<?php
ob_start();
session_start();
require "config/config.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <title><?php echo APP_NAME ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="#">

    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/custom-bs.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/fonts/line-icons/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/quill.snow.css">

    <!-- TOASTER CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/style.css">
  </head>
  <body id="top">

<!--  <div id="overlayer"></div>-->
<!--  <div class="loader">-->
<!--    <div class="spinner-border text-primary" role="status">-->
<!--      <span class="sr-only">Loading...</span>-->
<!--    </div>-->
<!--  </div>-->


<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="<?php echo BASE_URL ?>"><?php echo APP_NAME ?></a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="<?php echo BASE_URL ?>" class="nav-link active">Home</a></li>
              <li><a href="about.html">About</a></li>
              <li><a href="contact.html">Contact</a></li>
            <?php if(! isset($_SESSION['auth_id'])) :?>
                <li class="d-lg-none"><a href="login.php">Log In</a></li>
                <li class="d-lg-none"><a href="<?php echo REGISTER_URL ?>">Register</a></li>
            <?php else: if($_SESSION['auth_type'] === 'company'):?>
                <li class="d-lg-none"><a href="<?php echo BASE_URL . 'post-job.php' ?>">
                        <span class="mr-2">+</span> Post a Job</a>
                </li>
            <?php endif; ?>
                <li class="d-lg-none text-danger"><a href="logout.php">Logout</a></li>
            <?php endif; ?>

            </ul>
          </nav>

          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">

                <?php if(! isset($_SESSION['auth_id'])) :?>
                    <a href="<?php echo LOGIN_URL; ?>" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a>
                    <a href="<?php echo REGISTER_URL; ?>" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Register</a>
                <?php else: if($_SESSION['auth_type'] === 'company'):?>
                    <a href="<?php echo BASE_URL . '/post-job.php' ?>" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Post a Job</a>
                <?php endif; ?>
                    <div class="dropdown border-width-2 d-none d-lg-inline-block">
                        <button class="btn btn-outline-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Account <span class="ml-2 icon-keyboard_arrow_down"></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>/profile.php?id=<?php echo $_SESSION['auth_id']?> ">Public Profile</a>
                            <a class="dropdown-item" href="<?php echo BASE_URL."/profile-update.php" ?>">Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>/logout.php">Log Out</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>