<?php $page = $db->curlNamePage(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php
    if ($page == 'request-connect.php') {
      echo 'Escort | Request Connect';
    } elseif ($page == 'connect.php') {
      echo 'Escort | Connect';
    } elseif ($page == 'sex-videos.php') {
      echo 'Escort | Sex Videos';
    } elseif ($page == 'sugar-profile.php') {
      echo 'Escort | Sugar Profile';
    } elseif ($page == 'sugar-connect.php') {
      echo 'Escort | Sugar Connect';
    } elseif ($page == 'video.php') {
      echo 'Escort | Video';
    } elseif ($page == 'upload-porn-video.php') {
      echo 'Escort | Upload Porn Video';
    } elseif ($page == 'upload-escort.php') {
      echo 'Escort | Upload Escort';
    } elseif ($page == 'become-escort.php') {
      echo 'Escort | Become Escort';
    } elseif ($page == 'pages.php') {
      echo 'Escort | Page';
    } elseif ($page == 'my-tasks.php') {
      echo 'Escort | My Tasks';
    } elseif ($page == 'register.php') {
      echo 'Escort | Register';
    } 

    ?>
  </title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>