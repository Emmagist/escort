<?php 
  require_once "controllers/process.php";
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Access your KonjiZone account to manage your profile, messages, bookings, and settings. Secure login for models and users.">
  <meta property="og:title" content="Login – KonjiZone">
  <meta property="og:image" content="https://konjizone.com/assets/images/seo/login_seo.jpg">
  <meta property="og:url" content="https://konjizone.com/login">
  <meta property="og:description" content="Secure login for KonjiZone users and models.">
  <meta property="og:type" content="website">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Login – KonjiZone">
  <meta name="twitter:description" content="Access your KonjiZone account securely.">
  
  <title>KonjiZone | Login</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="google-site-verification" content="7qzjafXmW2ujOoSdsCmQGwfWd95PTw2hz1t6EDO4EvI" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100" aria-label="This link leads you to the home page">
                  <!-- <img src="../assets/images/logos/dark-logo.svg" width="180" alt=""> -->
                   <strong style="font-size: 30px;font-weight:bold;color:blueviolet;">KonjiZone</strong>
                </a>
                <p class="text-center">No. 1 Escorts App</p>
                <form action="" method="post" id="login_for">
                  <div class="mb-3">
                    <?php
                      require "inc/error-message.php";
                      //require "inc/success-message.php";
                    ?>
                    <!-- <li class="alert alert-success list-unstyled" style="display: none;" id="reg_succes"></li>
                    <li class="alert alert-danger list-unstyled" style="display: none;" id="sreg_danger"></li> -->
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; } ?>">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1"  value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" name="checkbox"  <?php (isset($_COOKIE['email'])) ? 'checked'  : ''; ?>>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="forgot-password">Forgot Password ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 login_button" name="login_button">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Konji Zone?</p>
                    <a class="text-primary fw-bold ms-2" href="register">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require "inc/footer.php";?>