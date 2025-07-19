<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
  require_once "controllers/users.php";

  $redirect = $db->redirectURI(); //echo $redirect;exit;
  // $db->getLoginSession($redirect);

  // $ip_address = Database::getClientIp();

    if (isset($_SESSION['token']) && isset($_SESSION['role']) && $_SESSION['role'] == 3 || $_SESSION['role'] == 2) {
        $token = $_SESSION['token'];
        $role = $_SESSION['role'];
    }

    if (isset($_GET['inv']) && isset($_GET['amt']) && isset($_GET['verify'])) {
        if (Users::sugarRequestServiceChargeVerification($_GET['inv'], $_GET['amt'], $_GET['verify'], $token) == true) {
            $paymentCode = $_GET['verify'];
            // $amount = $_GET['amt'];
            // $inv = $_GET['inv'];
        }else{
            // echo "<script>
            //     alert('Something went wrong here...');
            //     window.location.href = '../logout';
            // </script>";
        }

    
    }else{
        echo "
        <script>
            alert('Something went wrong...');
        </script>";
        
    }
  require "inc/head.php";

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <div class="col-md-8 offset-md-4 mt-5">
            <?php

                if ($paymentCode) {
                    echo '<p style="color: #000;">Transaction succesfull, reference: " <bold style="color:orangered; font-size:18px;font-weight:1000">'. $paymentCode .' </bold> "<br /><br /> Your reference code is your verification code, if any payment issue occcur, kindly note it.</p>
                    <a href="/" class="btn btn-primary mt-5">Back to home</a>';
                }

            ?>
        </div>
<?php 
  require "inc/footer.php";
?>