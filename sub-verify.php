<?php

  require_once "controllers/users.php";

  $redirect = $db->redirectURI(); //echo $redirect;exit;
  // $db->getLoginSession($redirect);

  // $ip_address = Database::getClientIp();

  if (isset($_SESSION['token']) && isset($_SESSION['role']) && $_SESSION['role'] == 3 || $_SESSION['role'] == 2) {
      $token = $_SESSION['token'];
      $role = $_SESSION['role'];
  }

  if (isset($_GET['inv']) && isset($_GET['amt']) && isset($_GET['verify']) && isset($_GET['pd'])) {
    if (Users::subscriptionVerify($_GET['inv'], $_GET['amt'], $_GET['verify'], $token, $_GET['pd']) == true) {
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
                    echo '<p style="color: #000;">Subscription reference: " <span style="color:orangered">'. $paymentCode .' </span> "<br /><br /> Your reference code is your verification code, kindly note it.</p>';
                }

            ?>
        </div>
<?php 
  require "inc/footer.php";
?>