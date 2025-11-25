<?php
  require_once "controllers/process.php";
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Create your KonjiZone account to access exclusive features, manage profiles, bookings, messages, and more. Fast and secure registration.">

  <meta name="robots" content="noindex, nofollow">

  <link rel="canonical" href="https://konjizone.com/register">
  <meta property="og:image" content="https://konjizone.com/assets/images/seo/login_seo.jpg">
  <!-- Open Graph -->
  <meta property="og:title" content="Create Account – KonjiZone">
  <meta property="og:description" content="Join KonjiZone to manage your profile, bookings, and messages. Fast and secure registration.">
  <meta property="og:url" content="https://konjizone.com/register">
  <meta property="og:type" content="website">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Create Account – KonjiZone">
  <meta name="twitter:description" content="Fast and secure KonjiZone account registration.">
  
  <title>KonjiZone | Register</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="google-site-verification" content="7qzjafXmW2ujOoSdsCmQGwfWd95PTw2hz1t6EDO4EvI" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form action="" method="post" id="registeration_form">
                  <div class="mb-3">
                  <li class="alert alert-success list-unstyled" style="display: none;" id="reg_succes"></li>
                  <li class="alert alert-danger list-unstyled" style="display: none;" id="sreg_danger"></li>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputtext1" aria-describedby="textHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                  </div>
                  <div class="mb-4">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                      <option value="">Select Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 register_button">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="login">Sign In</a>
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