<?php $page = $db->curlNamePage();

$page = $db->curlNamePage();

if (isset($_GET['pg'])) {
  $pg = $_GET['pg'];
}

$pageSub = Users::getCategoryById($pg);

$pageTitles = [
  'request-connect.php'    => 'Escort | Request Connect',
  'connect.php'            => 'Escort | Connect',
  'sex-videos.php'         => 'Escort | Sex Videos',
  'sugar-profile.php'      => 'Escort | Sugar Profile',
  'sugar-connect.php'      => 'Escort | Sugar Connect',
  'video.php'              => 'Escort | Video',
  'upload-porn-video.php'  => 'Escort | Upload Porn Video',
  'upload-escort.php'      => 'Escort | Upload Escort',
  'become-escort.php'      => 'Escort | Become Escort',
  'pages.php'              => 'Escort | '.ucwords($pageSub['category']),
  'my-tasks.php'           => 'Escort | My Tasks',
  'register.php'           => 'Escort | Register',
  'my-order.php'           => 'Escort | My-Order',
];

$title = $pageTitles[$page] ?? 'Escort | Home';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$title ?></title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>