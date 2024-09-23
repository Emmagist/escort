<?php

    require_once "admin.php";

    if ($_GET['id']) {
        $token = $_GET['id'];
        $db->update(TBL_ADMIN_SYSTEM, "active = '1'", "user_guid = '$token'");
        echo json_encode('done');
    }

?>