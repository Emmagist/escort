<?php
include  "config/db.php";

    unset($_SESSION["user_guid"], $_SESSION["email"],$_SESSION["username"]);
    // $db->set('login',false);
    session_destroy();
    header("Location: login");

?>