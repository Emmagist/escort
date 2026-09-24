<?php

require_once __DIR__ . '/inc/auth.php';

$streamGuid = trim((string) ($_GET['stream_id'] ?? ''));

if ($streamGuid === '') {
    header("Location: live-list");
    exit;
}

?>

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
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="/" class="text-nowrap logo-img">
            <!-- <img src="assets/images/logos/dark-logo.svg" width="180" alt="" /> -->
             <strong style="font-size: 36px;font-weight:bold;color:blueviolet;">KonjiZone</strong>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" role="navigation">
          <ul id="sidebarnav">
            <?php if($_SESSION['role'] == 2 && $_SESSION['escort_approval'] == 'approved'):?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu text-capitalization">activities</span>
            </li>
            <?php endif; if($_SESSION['role'] == 2 && $_SESSION['escort_approval'] == 'approved'):?>
              <li class="sidebar-item">
                <a class="sidebar-link" href="upload-escort" aria-expanded="false">
                  <span>
                    <i class="ti ti-typography"></i>
                  </span>
                  <span class="hide-menu">Upload Escort</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="upload-porn-video" aria-expanded="false">
                  <span>
                    <i class="ti ti-typography"></i>
                  </span>
                  <span class="hide-menu">Upload Porn Vidoe</span>
                </a>
              </li>
            <?php endif; if($_SESSION['token']):?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="request-connect" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <?php if($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 's_daddy') : ?>
                  <span class="hide-menu">Request Sugar Girl</span>
                <?php elseif($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 's_mummy') : ?>
                      <span class="hide-menu">Request Sugar Boy</span>
                <?php elseif($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 'none') : ?>
                      <span class="hide-menu">Request Sugar Mummy</span>
                <?php elseif($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 'none') : ?>
                      <span class="hide-menu">Request Sugar Daddy</span>
                <?php endif; ?>
              </a>
            </li>
            <?php endif;?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu text-capitalization">services</span>
            </li>
            <li id="navigation_lists"></li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="connect" aria-expanded="false">
                  <span>
                    <i class="ti ti-user"></i>
                  </span>
                  <?php if($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 's_daddy') : ?>
                    <span class="hide-menu">Sugar Girl</span>
                  <?php elseif($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 's_mummy') : ?>
                    <span class="hide-menu">Sugar Boy</span>
                  <?php elseif($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 'none') : ?>
                    <span class="hide-menu">Sugar Mummy</span>
                  <?php elseif($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 'none') : ?>
                    <span class="hide-menu">Sugar Daddy</span>
                  <?php else : ?>
                    <span class="hide-menu">Sugar Daddy&Mummy</span>
                  <?php endif; ?>
                </a>
              </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="sex-videos" aria-expanded="false">
                <span>
                  <i class="ti ti-video"></i>
                </span>
                <span class="hide-menu">Sex Videos</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-user-circle"></i>
                </span>
                <span class="hide-menu">Live Chat</span>
              </a>
            </li>
            <li class="sidebar-item">
              <?php if($_SESSION['token'] && $_SESSION['role'] == 2 && $_SESSION['escort_approval'] == 'approved'):?>
                <a class="sidebar-link" href="go-live" aria-expanded="false">
              <?php else:?>
                <a class="sidebar-link" href="live-list" aria-expanded="false">
              <?php endif;?>
                <span>
                  <i class="ti ti-video"></i>
                </span>
                <span class="hide-menu">Live Video Call</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Tour Guide</span>
              </a>
            </li>
            <!-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Register</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">EXTRA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Icons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li> -->
          </ul>
          <div class="unlimited-access hide-menu bg-light-primary position-relative mb-5 mt-5 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Place Your Ads Here</h6>
                <a href="#" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
              </div>
              <div class="unlimited-access-img">
                <img src="assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
<div class="body-wrapper" role="main">
      <!--  Header Start -->
      <header class="app-header" role="banner">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <?php if (empty($_SESSION['escort_approval'])) : ?>
                <a href="become-escort" target="_blank" class="btn btn-primary" id="become_escort">Become an Escort</a>
              <?php elseif($_SESSION['escort_approval'] == 'waiting'): ?>
                <a style="color: black;" target="_blank" class="btn btn-warning" >Awaiting Approval</a>
              <?php elseif($_SESSION['escort_approval'] != 'approved'): ?>
                <a href="become-escort" target="_blank" class="btn btn-primary" id="become_escort">Become an Escort</a>
              <?php elseif($_SESSION['escort_approval'] == 'denied'): ?>
                <a href="become-escort" target="_blank" class="btn btn-warning" id="become_escort">Apply Again</a>
              <?php endif; ?>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <?php if($_SESSION['token']):?>
                      <a href="profile" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-user fs-6"></i>
                        <p class="mb-0 fs-3">My Profile</p>
                      </a>
                      <?php if($_SESSION['role'] == 2):?>
                        <a href="/" class="d-flex align-items-center gap-2 dropdown-item">
                          <i class="ti ti-mail fs-6"></i>
                          <p class="mb-0 fs-3">My Account</p>
                        </a>
                        <a href="my-tasks" class="d-flex align-items-center gap-2 dropdown-item">
                          <i class="ti ti-list-check fs-6"></i>
                          <p class="mb-0 fs-3">My Task</p>
                        </a>
                        <a href="withdraw" class="d-flex align-items-center gap-2 dropdown-item">
                          <i class="ti ti-credit-card fs-6"></i>
                          <p class="mb-0 fs-3">Withdraw</p>
                        </a>
                      <?php endif;?>
                      <a href="my-order" class="d-flex align-items-center gap-2 dropdown-item">
                          <i class="ti ti-list-check fs-6"></i>
                          <p class="mb-0 fs-3">My Order</p>
                        </a>
                      <a href="change-password" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-lock fs-6"></i>
                        <p class="mb-0 fs-3">Change Password</p>
                      </a>
                      <a href="logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    <?php else :?>
                      <a href="login" class="btn btn-outline-primary mx-3 mt-2 d-block">Login</a>
                    <?php endif;?>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Main -->
    <div class="container-fluid"></div>
    <div class="py-6 px-6 text-center mt-5" role="contentinfo">
          <p class="text-center pb-3">Follow Us</p>
          <p class="mb-0 fs-4"><a href="" target="_blank" class="pe-3 text-primary"><i class="fa fa-twitter" style="font-size:32px;"></i></a> <a href="" class="pe-3"><i class="fa fa-telegram" style="font-size:32px;"></i></a><a href="" class="pe-3"><i class="fa fa-instagram" style="font-size:32px;"></i></a>
            
          </ul></p>
        </div>
      </div>

      <form action="" class="form-group" method="post" id="subscription_proc_form" style="display:none;"><input type="hidden" id="arial_sub_token" name="arial_sub_token"><select name="select_sub_plan" id="select_sub_plan"><option value="" id="select_opt"></option></select><input type="hidden" id="price_plan" name="price_plan"><input type="hidden" id="invoice_code" name="invoice_code"><button type="submit" id="subscription_processing"></button></form>
    </div>
    <?php require "modal/modal.php";?>
  </div>
  <script src="assets/src/jquery/dist/jquery.min.js"></script>
  <script src="assets/src/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/src/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/src/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="https://checkout.squadco.com/widget/squad.min.js"></script>

  <script>
    $(document).ready(() => {
      setInterval(() => {
        $('#become_escort').attr('class', 'btn btn-danger');
        setTimeout(() => {
          $('#become_escort').attr('class', 'btn btn-warning');
        }, 2000);
        setTimeout(() => {
          $('#become_escort').attr('class', 'btn btn-secondary');
        }, 3000);
        setTimeout(() => {
          $('#become_escort').attr('class', 'btn btn-success');
        }, 4000);
      }, 1000);
      
    })
    
    function subscribe(params) {
      $('#subscribeModal').modal('show');
      // $('#arial_token').val(params)

      $.ajax({
        url: 'controllers/ajaxGet.php?sub='+params,
        method: 'GET',
        dataType: 'json',
        data: params,
        contentType: false,
        processData: false,
        beforeSend: () => {
            $('#subscribe_contents').html('Loading contents...');
        },
        success: (param) => {
          if (param) {
              $('#subscribe_contents').html(param);
          }
        }
      })
    }

    function selectplan() {
      const value = $('#selectPlan').val();

      $.ajax({
        url: 'controllers/ajaxGet.php?plan_price='+value,
        method: 'GET',
        dataType: 'json',
        data: value,
        contentType: false,
        processData: false,
        success: (param) => {
          if (param) {
              $('#price_div').html(param);
          }
        }
      })
    }

    //Wallet earns
    $(document).ready(function() {
        $.ajax({
            url: 'controllers/ajaxGet.php?ern=200',
            method: 'GET',
            dataType: 'json',
            data: '200',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('#wallet_earn').html('Loading contents...');
            },
            success: (param) => {
                if (param) {
                    $('#wallet_earn').html(param);
                }
            }
        })

    });

    //escort transactions
    $(document).ready(function() {
      $.ajax({
        url: 'controllers/ajaxGet.php',
        method: 'GET',
        dataType: 'json',
        data: {trn: 220},
        beforeSend: () => {
            $('#table-body').html('Loading Transactions...');
        },
        success: (param) => {
            if (param) {
                $('#table-body').html(param);
            }
        }
      })

    });

    //escort payment received
    $(document).ready(function() {
        $.ajax({
            url: 'controllers/ajaxGet.php?prv=220',
            method: 'GET',
            dataType: 'json',
            data: '220',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('#timeline').html('Loading Transactions...');
            },
            success: (param) => {
                if (param) {
                    $('#timeline').html(param);
                }
            }
        })

    });

    //Sugestion
    $(document).ready(function () {
      $.ajax({
        url: 'controllers/ajaxGet.php',
        method: 'GET',
        dataType: 'json',
        data: {sugestion: 'sugestion'},
        beforeSend: () => {
            $('#sugestion').html('Loading contents...');
        },
        success: (param) => {
          if (param) {
              $('#sugestion').html(param);
          }
        }
      })

    });

    //Check expired subscription and update user
    // $(document).ready(function () {
    //   $.ajax({
    //     url: 'controllers/fetchAjax.php?pg=216',
    //     method: 'POST',
    //     dataType: 'json',
    //     data: '216',
    //     contentType: false,
    //     processData: false,
    //     success: (param) => {
    //       if (param.success) {
    //         console.log(response.message);
    //       }
    //     }
    //   })
    // })

    function SquadPaySUb() {
      // e.preventDefault();
      const key_opener = "<?=KEY?>";
      const arial_token = document.getElementById("arial_token").value;
      const plan_id = document.getElementById("selectPlan").value;
      const price = document.getElementById("plan_price").value;
      const invoice = document.getElementById("invoice").value;
      passage(arial_token,plan_id,price,invoice);
      const squadInstance = new squad({
      onLoad: () => console.log("Widget loaded successfully"),
      key: key_opener,
      // "test_pk_sample-public-key-1"
      //Change key (test_pk_sample-public-key-1) to the key on your Squad Dashboard
      email: document.getElementById("email-address").value,
      amount: price * 100,
      //Enter amount in Naira or Dollar (Base value Kobo/cent already multiplied by 100)
      transaction_ref: 'Inv'+Math.floor((Math.random() * 1000000000) + 1),
      currency_code: "NGN",
      onClose: () => alert("Transaction Cancelled"),
      onSuccess: function(response){
          let message = 'Payment complete! Reference: ' + response.transaction_ref ;
          // alert(message);
          const amt = price;
          location.href = "sub-verify?verify="+response.transaction_ref+'&inv='+invoice+'&amt='+amt+'&pd='+plan_id;
      }
      });
      squadInstance.setup();
      squadInstance.open();

    }

    function passage(arial_token,plan_id,price,invoice) {
      const arial_sub_token = $('#arial_sub_token').val(arial_token);
      const select_opt = $('#select_opt').val(plan_id);
      const price_plan = $('#price_plan').val(price);
      const invoice_code = $('#invoice_code').val(invoice);

      if (arial_sub_token != '' && select_opt != '' && price_plan != '' && invoice_code != '') {
          $('#subscription_processing').click();
      }
    }

    $('#subscription_proc_form').submit( function(event) {
      event.preventDefault();
      const formData = new FormData(this);

      $.ajax({
          url: 'controllers/fetchAjax.php?pg=207',
          method: 'POST',
          dataType: 'json',
          data: formData,
          contentType: false,
          processData: false,
          success: (props) => {
              
          }
      })

      return false;
    });

  </script>

</body>

</html>