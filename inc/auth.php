<?php

    require_once "controllers/users.php";

    $redirect = $db->redirectURI(); //echo $redirect;exit;
    $db->getLoginSession($redirect);

    $ip_address = Database::getClientIp();

    if (isset($_SESSION['token']) && isset($_SESSION['role']) && $_SESSION['role'] == 3 || $_SESSION['role'] == 2) {
        $token = $_SESSION['token'];
        $role = $_SESSION['role'];
    }else{
        header('Location: pages?pg=67543388$re386yf32198765430op87697');
    }

    if (! Users::findUserByToken($token)) {
        header('Location: pages?pg=67543388$re386yf32198765430op87697');
    }

    // if (Users::checkUserIfVerified($token) === true) {
    //     header("Location: ../check-email");
    // }

    // if (Users::checkRole($role) == false) {
    //     header("Location: logout.php");
    // }

?>

<!-- <div class="ip" data-id="<?//=$ip_address?>"></div> -->