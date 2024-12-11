<?php

    require_once "ajaxRequest.php";

    // History
    if (isset($_GET['hid'])) {
        $id = $_GET['hid'];

        $db->erase(TBL_TRANSACTION_LOG, "entity_guid = '$id'");
        echo json_encode("Transaction Deleted Successfully...");
    }

    // History
    if (isset($_GET['dt'])) {
        $id = $_GET['dt'];

        $db->erase(TBL_VENDOR_RATE, "token_guid = '$id'");
        echo json_encode("Rate Deleted Successfully...");
    }

    // if (isset($_GET['deleteSub'])) {
    //     $id = $_GET['deleteSub'];

    //     $db->update(, "status = '1'", "entity_guid = '$id'");
    //     echo json_encode("Category Deleted Successfully...");
    // }

    // if (isset($_GET['deleteEnt'])) {
    //     $id = $_GET['deleteEnt'];

    //     $db->update(, "status = '1'", "entity_guid = '$id'");
    //     echo json_encode("Category Deleted Successfully...");
    // }

    // if (isset($_GET['deleteTopic'])) {
    //     $id = $_GET['deleteTopic'];

    //     $db->update(, "status = '1'", "entity_guid = '$id'");
    //     echo json_encode("Blog Deleted Successfully...");
    // }
