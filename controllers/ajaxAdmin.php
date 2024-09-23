<?php

    use Egulias\EmailValidator\EmailValidator;

    require_once "ajaxRequest.php";

    if (isset($_GET['pg'])) {
        $pg = $_GET['pg'];
    }

    if($pg == 200){
        $error = '';
        $success = '';
        $name = $db->escape($_POST['name']);
        $percentage = $db->escape($_POST['percentage']);
        $min_plan = $db->escape($_POST['min_plan']);
        $duration = $db->escape($_POST['duration']);
        $description = $db->escape($_POST['description']);
        $entity = $db->escape($_POST['entity']);
        $current_image = $db->escape($_POST['current_file']);

        if (empty($name)) {
            $error = 'Plan name is required';
        }

        if (empty($percentage)) {
            $error = 'Percentage is required';
        }

        if (empty($min_plan)) {
            $error = 'Minimum plan is required';
        }

        if (empty($duration)) {
            $error = 'Plan duration is required';
        }

        if (empty($description)) {
            $error = 'Description is required';
        }

        // File upload
        $target_dir = "../img/plan/";
        $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
        if($check == false) {
            $error =  "File is not an image";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            $error = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["fileUpload"]["size"] > 500000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if (empty($error) && $uploadOk == 1) {
            $move_file = move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
            if($move_file){
                $db->update(TBL_PLAN, "name = '$name', percentage = '$percentage', min_plan = '$min_plan', duration = '$duration', img = '$target_file', short_description = '$description'", "entity_guid = '$entity'");
                unlink($current_image);
                $success = "Plan edited successfully";
            }
            
        }

        echo json_encode([
            'error' => $error,
            'success' => $success
        ]);

    }

?>