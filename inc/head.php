<?php

$page = $db->curlNamePage();
$pg = $_GET['pg'] ?? null;
$city = $_GET['city'] ?? null;

// For escort profile pages
$escort = null;
if ($page == "escort-profile.php" && isset($_SESSION['token'])) {
    $escort = Users::getEscortById($_SESSION['token']);
}

// For category pages
$category = null;
if ($page == "pages.php" && $pg) {
    $category = Users::getCategoryById($pg);
}

// Default page titles for static pages
$pageTitles = [
    'konjizone.com'          => 'KonjiZone – Escort Directory in Nigeria | Lagos & Abuja High-Class Escorts',
    'request-connect.php'    => 'Request Connect – KonjiZone',
    'connect.php'            => 'Connect – KonjiZone',
    'sex-videos.php'         => 'Porn Videos – KonjiZone',
    'sugar-profile.php'      => 'Sugar Profile – KonjiZone',
    'sugar-connect.php'      => 'Sugar Connect – KonjiZone',
    'video.php'              => 'Watch Video – KonjiZone',
    'upload-porn-video.php'  => 'Upload Porn Video – KonjiZone',
    'upload-escort.php'      => 'Upload Escort – KonjiZone',
    'become-escort.php'      => 'Become an Escort – KonjiZone',
    'my-tasks.php'           => 'My Tasks – KonjiZone',
    'my-order.php'           => 'My Orders – KonjiZone',
];

// Dynamic SEO Title
if ($page == "escort-profile.php" && $escort) {
    $title = $escort['name'] . " – " . $escort['location'] . " Escort | KonjiZone";
} elseif ($page == "pages.php" && $category) {
    $title = ucwords($category['category']) . " Escorts in Nigeria | KonjiZone";
} elseif ($city) {
    $title = ucwords($city) . " Escorts | Verified Escorts in " . ucwords($city) . " | KonjiZone";
} else {
    $title = $pageTitles[$page] ?? "KonjiZone – Nigeria Escort Directory | Lagos & Abuja High-Class Escorts";
}

// Dynamic Meta Description
if ($page == "escort-profile.php" && $escort) {
    $description = "View " . $escort['name'] . ", a verified escort in " . $escort['location'] . ". See photos, rates, services, reviews, and contact details on KonjiZone.";
} elseif ($page == "pages.php" && $category) {
    $description = "Browse verified " . ucwords($category['category']) . " escorts across Nigeria. Real photos, rates, reviews, and instant contact.";
} elseif ($city) {
    $description = "Find verified escorts in " . ucwords($city) . ". Browse profiles, photos, rates, and connect instantly on KonjiZone.";
} elseif (in_array($page, ['register.php', 'login.php'])) {
    $description = "Secure " . ($page == 'register.php' ? "registration" : "login") . " for KonjiZone users and models. Manage your profile, messages, and bookings safely.";
} else {
    $description = "Find verified escorts in Nigeria on KonjiZone. Browse high-class escorts in Lagos, Abuja, PH, and more. Safe, discreet, and fast.";
}

// Meta Robots
$robots = in_array($page, ['register.php', 'login.php']) ? "noindex, nofollow" : "index, follow";

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Dynamic Title & Description -->
  <title><?=$title ?></title>
  <meta name="description" content="<?=$description?>">
  <meta name="keywords" content="escorts in Nigeria, Lagos escorts, Abuja escorts, Nigerian escort directory, call girls Lagos, hookup Nigeria, PH escorts, verified escorts Nigeria">
  <meta name="robots" content="<?=$robots?>">

  <!-- Favicon & CSS -->
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <meta property="og:image" content="https://konjizone.com/assets/images/seo/login_seo.jpg">
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Canonical -->
  <link rel="canonical" href="https://konjizone.com<?= $_SERVER['REQUEST_URI'] ?>">

  <!-- Open Graph -->
  <meta property="og:title" content="<?=$title?>">
  <meta property="og:description" content="<?=$description?>">
  <meta property="og:url" content="https://konjizone.com<?= $_SERVER['REQUEST_URI'] ?>">
  <meta property="og:type" content="website">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?=$title?>">
  <meta name="twitter:description" content="<?=$description?>">

  <!-- Geo SEO -->
  <meta name="geo.region" content="NG">
  <meta name="geo.placename" content="Nigeria">
  <meta name="geo.position" content="9.0820;8.6753">
  <meta name="ICBM" content="9.0820, 8.6753">

  <!-- Google Site Verification -->
  <meta name="google-site-verification" content="7qzjafXmW2ujOoSdsCmQGwfWd95PTw2hz1t6EDO4EvI" />

  <!-- Schema.org WebSite -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "KonjiZone",
    "url": "https://konjizone.com",
    "description": "Nigeria's top escort directory. Browse verified escorts in Lagos, Abuja, PH and more.",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://konjizone.com/search?q={query}",
      "query-input": "required name=query"
    }
  }
  </script>

</head>

<body>
