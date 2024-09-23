<?php

    require_once "controllers/users.php";

    $redirect = $db->redirectURI();
    $db->getLoginSession($redirect);

    $ip_address = Database::getClientIp();

    if (isset($_SESSION['token']) && isset($_SESSION['role']) && $_SESSION['role'] == 3) {
        $token = $_SESSION['token'];
        $role = $_SESSION['role'];
    }else{
        header("Location: login?page_url=".$redirect);
    }

    if (! Users::findUserByToken($token)) {
        header("Location: login.php?page_url=".$redirect);
    }

    // if (Users::checkUserIfVerified($token) === true) {
    //     header("Location: ../check-email");
    // }

    if (Users::checkRole($role) == false) {
        header("Location: logout.php");
    }

?>

<!-- <div class="ip" data-id="<?//=$ip_address?>"></div> -->