<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="chat.css">
</head>

<body>
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="profile" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <a href="login" class="btn btn-outline-primary mx-3 mt-2 d-block">Login</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
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
                            <strong style="font-size: 36px;font-weight:bold;color:blueviolet;">Gescort</strong>
                        </a>
                        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                            <i class="ti ti-x fs-8"></i>
                        </div>
                    </div>
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                        <ul id="sidebarnav">
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
                                    <span class="hide-menu">Sugar Mummy</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="sex-videos" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-mood-happy"></i>
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
                                <a class="sidebar-link" href="#" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-typography"></i>
                                    </span>
                                    <span class="hide-menu">Tour Guide</span>
                                </a>
                            </li>

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
            <!-- Main -->
             <div class="container-fluid">
            <section class="sidebar__chat mobileSidebarChat container">
                <div id="mySidenav" class="sidenav">
                    <div class="mobile-message-header">
                        <h3>My Messages </h3>
                    </div>
                    <div class='chat__messageHeaderContent' id="chatMessageHeaderContentMobile" data-id="<?=$token?>">
                        <div class='Message-List-Container'>
                            <div class="message__list" onclick="closeNav()">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="" class="profile__message" />';
                                <div class="message__listContent">
                                    <h5>Mary</h5>
                                    <p class="chat__previewText">Hi</p>
                                </div>
                                <div>
                                    <span class='chat-time'>12p.m</span>
                                </div>
                            </div>
                        </div>
                        <div class='Message-List-Container'>
                            <div class="message__list" onclick="closeNav()">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="" class="profile__message" />';
                                <div class="message__listContent">
                                    <h5>Mary</h5>
                                    <p class="chat__previewText">Hi</p>
                                </div>
                                <div>
                                    <span class='chat-time'>12p.m</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="main">
                    <div class="chat__header">
                        <div class="chat__bodyMessage">
                            <div class="message__body" id="messageMobileBody"
 data-token="<?=$token?>">
                                <header class="chat__messageHeader" id="chat__messageHeaderMobile">
                                </header>
                                <div class="message__bodyContent">
                                    <div class="warning__message">
                                        <span>April 12, 1223</span>
                                        <div class="warning__chatView">
                                            <i class="uil uil-exclamation-triangle"></i>
                                            <p>Do not pay in advance , including for delivery</p>
                                        </div>
                                        <div class="body__chat" id="bodyChatMobile">
                                        </div>
                                        <form class="textBox" action='' method='POST' id="replyMessageTwo">
                                            <div class="sticker">
                                                <i class="uil uil-emoji"></i>
                                            </div>
                                            <div class="text__input">
                                                <input type="text" name="message" class="messageBox" placeholder="Write your message here" />
                                                <input type="hidden" name="token" value="<?=$token?>">
                                                <input type="hidden" name="tickets" id="tokenMobileId">

                                            </div>
                                            <div class=' link__box'>
                                                <i class="uil uil-link"></i>
                                                <i class="uil uil-microphone"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class='mobileMessages'>
                <div>
                    <div class="chat__header">
                        <div class="chat__messageList">
                            <header class="chat__messageHeader">
                                <h2>My messages</h2>
                                <i class="uil uil-bars"></i>
                            </header>

                            <div class="chat__ListBody">
                                <div class='chat__messageHeaderContent' id="chatMessageHeaderContent" data-id="<?=$token?>">
                                </div>
                            </div>
                        </div>

                        <div class="chat__bodyMessage" id="chat__bodyMessage">
                            <!-- <div class="no__message">
                                <span>You have no message yet</span>
                                <span>Find something to discuss or sell something</span>
                                </div> -->
                            <div class="message__body" data-token="<?=$token?>" id="messageBody">
                                <header class="chat__messageHeader" id="messageHeader">
                                </header>
                                <div class="message__bodyContent">
                                    <div class="warning__message" id="warning__message" style="display:none">
                                        <span class="">Hi</span>
                                        <div class="warning__chatView">
                                            <i class="uil uil-exclamation-triangle"></i>
                                            <p>Do not scam people else , your account will be ban</p>
                                        </div>
                                        <div class="body__chat" id="bodyMessageOne">
                                        </div>
                                        <form action="" method="Post" id="replyMessage" class="textBox">
                                            <!-- <div> -->
                                            <div class="sticker">
                                                <i class="uil uil-emoji"></i>
                                            </div>
                                            <div class="text__input">

                                                <input type="text" name="message" class="messageBox" placeholder="Write your message here" />
                                                <input type="hidden" name="token" id="token" value="<?=$token?>">
                                                <input type="hidden" name="tickets" id="tokenId" value="">

                                            </div>
                                            <div class="link__box">
                                                <i class="uil uil-link"></i>
                                                <i class="uil uil-microphone"></i>
                                            </div>
                                            <!-- </div> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             </div>
            <!-- main end -->
        </div>

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
        // errorMessage.hide();
        // errorMessageTwo.hide();

        function openNav() {
            document.getElementById("mySidenav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        //Message Reply
        // $('#replyMessage').submit(function(event) {
        //     event.preventDefault();
        //     const formData = new FormData(this);

        //     $.ajax({
        //         url: '../libs/fetchAjax.php?pg=2041',
        //         method: 'POST',
        //         dataType: 'json',
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: (param) => {
        //             if (param.success) {
        //                 $('.messageBox').val('');
        //             } else if (param.error) {
        //                 // errorMessage.fadeIn()
        //                 // errorMessage.text(param.error);
        //                 setTimeout(() => {
        //                     // errorMessage.fadeOut();
        //                 }, 3000);
        //             }
        //         }
        //     })

        //     return false;
        // })

        // //Message Reply Mobile
        // $('#replyMessageTwo').submit(function(event) {
        //     event.preventDefault();
        //     const formData = new FormData(this);

        //     $.ajax({
        //         url: '../libs/fetchAjax.php?pg=2041',
        //         method: 'POST',
        //         dataType: 'json',
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: (param) => {
        //             if (param.success) {
        //                 $('.messageBox').val('');
        //             } else if (param.error) {
        //                 // errorMessage.fadeIn()
        //                 // errorMessage.text(param.error);
        //                 setTimeout(() => {
        //                     // errorMessage.fadeOut();
        //                 }, 3000);
        //             }
        //         }
        //     })

        //     return false;
        // })

        // //Show Chat
        // function showChat(ticket_id) {
        //     const token = $('.listContainer').attr('data-token'); //alert(token);
        //     const token_id = $('#messageBody').attr('data-token');
        //     const data = $('#messageHeader');
        //     const dataTwo = $('#bodyMessageOne');
        //     const warning = $('#warning__message');
        //     const inputToken = $('#tokenId');

        //     if(typeof loadChatMessages !== 'undefined'){
        //         clearInterval(loadChatMessages);
        //     }
            
        //     warning.hide();
        //     data.attr('data-id',token);
        //     dataTwo.attr('data-id',token);
        //     inputToken.val(ticket_id)
        //     const getData = data.attr('data-id'); 
        //     const getDataTwo = data.attr('data-id'); //alert(getData);

        //     $.ajax({
        //         url: '../libs/fetchAjax.php?pg=2039&id=' + ticket_id + '&token_id='+ token_id,
        //         method: 'GET',
        //         dataType: 'json',
        //         data: getData,
        //         contentType: false,
        //         processData: false,
        //         success: (param) => {
        //             if (param) {
        //                 data.html(param);
        //                 warning.show();
        //             }
        //         }
        //     })

        //     // Load chat Messages
        //     loadChatMessages = setInterval(() => {
        //         $.ajax({
        //             url: '../libs/fetchAjax.php?pg=2040&id=' + ticket_id + '&token_id='+ token_id,
        //             method: 'GET',
        //             dataType: 'json',
        //             data: getDataTwo,
        //             contentType: false,
        //             processData: false,
        //             success: (param) => {
        //                 if (param) {
        //                     dataTwo.html(param);
        //                 }
        //             }
        //         })
        //     }, 1000);

        // }

        // //Show Chat mobile
        // function showMessageMobile(ticket_id) {
        //     const token = $('.mobileContainer').attr('data-token'); //alert(token);
        //     const token_id = $('#messageMobileBody').attr('data-token');
        //     const data = $('#chat__messageHeaderMobile');
        //     const dataTwo = $('#bodyChatMobile');
        //     const inputToken = $('#tokenMobileId');

        //     // const warning = $('#warning__message');
        //     // warning.hide();
        //     data.attr('data-id',token);
        //     dataTwo.attr('data-id',token);
        //     inputToken.val(ticket_id);

        //     const getData = data.attr('data-id'); //alert(getData);
        //     const getDataTwo = data.attr('data-id'); //alert(getData)

        //     $.ajax({
        //         url: '../libs/fetchAjax.php?pg=2044&id='+ticket_id+'&token_id='+token_id,
        //         method: 'GET',
        //         dataType: 'json',
        //         data: getData,
        //         contentType: false,
        //         processData: false,
        //         success: (param) => {
        //             if (param) {
        //                 data.html(param);
        //                 // warning.show();
        //             }
        //         }
        //     })

        //     // Load chat Messages
        //     setInterval(() => {
        //         $.ajax({
        //             url: '../libs/fetchAjax.php?pg=2040&id='+ticket_id+'&token_id='+token_id,
        //             method: 'GET',
        //             dataType: 'json',
        //             data: getDataTwo,
        //             contentType: false,
        //             processData: false,
        //             success: (param) => {
        //                 if (param) {
        //                     dataTwo.html(param);
        //                 }
        //             }
        //         })
        //     }, 1000);
        // }

        // // Message List on desktop
        // $(document).ready(function(event) {
        //     const id = $('#chatMessageHeaderContent').attr('data-id'); //alert(id);

        //     setInterval(() => {
        //         $.ajax({
        //             url: '../libs/fetchAjax.php?pg=2038&id=' + id,
        //             method: 'GET',
        //             dataType: 'json',
        //             data: id,
        //             contentType: false,
        //             processData: false,
        //             success: (param) => {
        //                 if (param) {
        //                     $('#chatMessageHeaderContent').html(param);
        //                 }
        //             }
        //         })
        //     }, 1000);

        //     return false;
        // })

        // // Message List on mobile
        // $(document).ready(function(event) {
        //     const id = $('#chatMessageHeaderContentMobile').attr('data-id'); //alert(id);

        //     setInterval(() => {
        //         $.ajax({
        //             url: '../libs/fetchAjax.php?pg=2043&id=' + id,
        //             method: 'GET',
        //             dataType: 'json',
        //             data: id,
        //             contentType: false,
        //             processData: false,
        //             success: (param) => {
        //                 if (param) {
        //                     $('#chatMessageHeaderContentMobile').html(param);
        //                 }
        //             }
        //         })
        //     }, 1000);

        //     return false;
        // })

    </script>
</body>

</html>