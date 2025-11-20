<?php 
  require_once "controllers/process.php";
  require "inc/head.php";
?>
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