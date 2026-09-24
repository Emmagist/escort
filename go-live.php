<?php
    require_once __DIR__ . '/inc/auth.php';
    require __DIR__ . "/inc/head.php";
    require __DIR__ . "/inc/aside.php";
    // require __DIR__ . "/inc/header.php";

    // $streamGuid = (string) ($_GET['stream_id'] ?? 0);
?>
<link rel="stylesheet" href="assets/css/broadcaster.css">
<input type="hidden" id="streamer">
<!--  Main wrapper -->
<div class="body-wrapper" role="main">
      

<!-- <div class="container-fluid"> -->
    <div class="live-page">

        <div class="live-container">

            <!-- TOP -->
            <div class="live-topbar">

                <div>
                    <h1 class="live-title">
                        <?= htmlspecialchars(ucwords($_SESSION['username'])) ?>'s Live
                    </h1>

                    <p class="live-subtitle">
                        Share your moment with your audience
                    </p>
                </div>

                <div class="live-status">
                    <span class="status-dot" id="status-dot"></span>

                    <span id="status">
                        OFFLINE
                    </span>
                </div>

            </div>


            <!-- MAIN -->
            <div class="stream-layout">

                <!-- VIDEO -->
                <div class="video-section">

                    <div class="video-wrapper">

                        <!-- VIDEO TOP -->
                        <div class="video-top">

                            <div class="live-badge">
                                <span></span>
                                LIVE
                            </div>

                            <div class="viewer-count">
                                👁
                                <span id="viewer-count">0</span>
                                viewers
                            </div>

                        </div>


                        <!-- LIVE VIDEO -->
                        <div id="local-video">

                            <div class="video-placeholder">

                                <div class="video-placeholder-icon">
                                    📹
                                </div>

                                <h3>You're not live yet</h3>

                                <p>
                                    Click "Go Live" to start your broadcast.
                                </p>

                            </div>

                        </div>


                        <!-- GIFT ANIMATION -->
                        <div class="gift-animation-area">

                            <div class="gift-animation" id="gift-animation">

                                <div class="gift-icon">
                                    🎁
                                </div>

                                <div>
                                    <strong id="gift-animation-name">
                                        Rose
                                    </strong>

                                    <small>
                                        sent by Viewer
                                    </small>
                                </div>

                            </div>

                        </div>


                        <!-- CONTROLS -->
                        <div class="video-controls">

                            <div class="control-group">

                                <button class="control-btn"
                                        title="Mute microphone">
                                    🎤
                                </button>

                                <button class="control-btn"
                                        title="Turn camera off">
                                    📹
                                </button>

                                <button class="control-btn"
                                        title="Settings">
                                    ⚙
                                </button>

                            </div>


                            <div class="control-group">

                                <button class="control-btn go-live" id="go_live_button">● Go Live</button>
                                <button type="hidden"  onclick="startBroadcast(`<?= htmlspecialchars($streamGuid) ?>`)"></button>

                                <button
                                    class="control-btn end"
                                    onclick="endBroadcast(`<?= htmlspecialchars($streamGuid) ?>`)">

                                    End Stream

                                </button>

                            </div>

                        </div>

                    </div>


                    <!-- HOST -->
                    <div class="host-info">

                        <div class="host-left">

                            <div class="host-avatar">
                                <?= strtoupper(substr($_SESSION['username'], 0, 1)) ?>
                            </div>

                            <div>

                                <div class="host-name">
                                    <?= htmlspecialchars(ucwords($_SESSION['username'])) ?>
                                </div>

                                <div class="host-role">
                                    Broadcaster
                                </div>

                            </div>

                        </div>

                        <div class="stream-id">
                            Stream ID:
                            <?= htmlspecialchars($streamGuid) ?>
                        </div>

                    </div>

                </div>


                <!-- RIGHT PANEL -->
                <aside class="side-panel">

                    <!-- TABS -->
                    <div class="panel-tabs">

                        <div class="panel-tab active">
                            🎁 Gifts
                        </div>

                        <div class="panel-tab">
                            💬 Chat
                        </div>

                    </div>


                    <!-- GIFTS -->
                    <div class="gift-section">

                        <div class="gift-header">

                            <h3>
                                Send a Gift
                            </h3>

                            <div class="coin-balance">
                                🪙 12,500
                            </div>

                        </div>


                        <!-- CATEGORIES -->
                        <div class="gift-categories">

                            <div class="gift-category active">
                                Popular
                            </div>

                            <div class="gift-category">
                                Love
                            </div>

                            <div class="gift-category">
                                Fun
                            </div>

                            <div class="gift-category">
                                Luxury
                            </div>

                        </div>


                        <!-- GIFT GRID -->
                        <div class="gift-grid">

                            <div class="gift-card"
                                onclick="previewGift('Rose', '🌹', 1)">

                                <div class="gift-icon">
                                    🌹
                                </div>

                                <span class="gift-name">
                                    Rose
                                </span>

                                <span class="gift-price">
                                    🪙 1
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Heart', '❤️', 10)">

                                <div class="gift-icon">
                                    ❤️
                                </div>

                                <span class="gift-name">
                                    Heart
                                </span>

                                <span class="gift-price">
                                    🪙 10
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Like', '👍', 20)">

                                <div class="gift-icon">
                                    👍
                                </div>

                                <span class="gift-name">
                                    Like
                                </span>

                                <span class="gift-price">
                                    🪙 20
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Coffee', '☕', 50)">

                                <div class="gift-icon">
                                    ☕
                                </div>

                                <span class="gift-name">
                                    Coffee
                                </span>

                                <span class="gift-price">
                                    🪙 50
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Cake', '🎂', 100)">

                                <div class="gift-icon">
                                    🎂
                                </div>

                                <span class="gift-name">
                                    Cake
                                </span>

                                <span class="gift-price">
                                    🪙 100
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Fire', '🔥', 250)">

                                <div class="gift-icon">
                                    🔥
                                </div>

                                <span class="gift-name">
                                    Fire
                                </span>

                                <span class="gift-price">
                                    🪙 250
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Diamond', '💎', 500)">

                                <div class="gift-icon">
                                    💎
                                </div>

                                <span class="gift-name">
                                    Diamond
                                </span>

                                <span class="gift-price">
                                    🪙 500
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Crown', '👑', 1000)">

                                <div class="gift-icon">
                                    👑
                                </div>

                                <span class="gift-name">
                                    Crown
                                </span>

                                <span class="gift-price">
                                    🪙 1,000
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Car', '🏎️', 2500)">

                                <div class="gift-icon">
                                    🏎️
                                </div>

                                <span class="gift-name">
                                    Super Car
                                </span>

                                <span class="gift-price">
                                    🪙 2,500
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Rocket', '🚀', 5000)">

                                <div class="gift-icon">
                                    🚀
                                </div>

                                <span class="gift-name">
                                    Rocket
                                </span>

                                <span class="gift-price">
                                    🪙 5,000
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Yacht', '🛥️', 10000)">

                                <div class="gift-icon">
                                    🛥️
                                </div>

                                <span class="gift-name">
                                    Yacht
                                </span>

                                <span class="gift-price">
                                    🪙 10K
                                </span>

                            </div>


                            <div class="gift-card"
                                onclick="previewGift('Universe', '🌌', 25000)">

                                <div class="gift-icon">
                                    🌌
                                </div>

                                <span class="gift-name">
                                    Universe
                                </span>

                                <span class="gift-price">
                                    🪙 25K
                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- CHAT -->
                    <div class="chat-section">

                        <div class="chat-header">
                            💬 Live Chat
                        </div>

                        <div class="chat-messages" id="chat-messages">

                            <div class="chat-message">
                                <strong>System:</strong>
                                Welcome to the live stream!
                            </div>

                            <div class="chat-message">
                                <strong>Viewer:</strong>
                                Amazing stream 🔥
                            </div>

                            <div class="chat-message">
                                <strong>John:</strong>
                                Hello everyone 👋
                            </div>

                        </div>

                        <div class="chat-input">

                            <input
                                type="text"
                                placeholder="Write a message..."
                                id="chat-input">

                            <button onclick="sendChatMessage()">
                                ➤
                            </button>

                        </div>

                    </div>

                </aside>

            </div>

        </div>

    <!-- </div> -->
</div>
<?php require "modal/modal.php";?>
<script src="assets/src/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/livekit-client/dist/livekit-client.umd.min.js"></script>
<script src="assets/src/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/sidebarmenu.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="assets/src/apexcharts/dist/apexcharts.min.js"></script>

<script src="assets/js/broadcaster/broadcaster.js"></script>
<script>

    

</script>
