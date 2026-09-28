<?php

require_once __DIR__ . '/inc/auth.php';
require_once __DIR__ . '/classes/stream.php';

$streamGuid = trim((string)($_GET['stream_id'] ?? ''));

if ($streamGuid === '') {
    header("Location: live-list");
    exit;
}

$stream = $streamModel->find($streamGuid);

if (!$stream || $stream['status'] !== 'live') {
    header("Location: live-list");exit;
}

$userId = (string)$_SESSION['token'];

$isOwner = ((string)$stream['user_id'] === $userId);

require __DIR__ . "/inc/head.php";
require __DIR__ . "/inc/aside.php";
require __DIR__ . "/inc/header.php";

?>

<script src="https://cdn.jsdelivr.net/npm/livekit-client/dist/livekit-client.umd.min.js"></script>

<link rel="stylesheet" href="assets/css/join-live.css">

<div class="container-fluid">
    <div class="live-page">

        <div class="live-layout">

            <!-- =================================================
                VIDEO
            ================================================= -->

            <section class="stream-section">

                <div class="video-card">

                    <div class="video-top">

                        <div class="live-badge">

                            <span class="live-dot"></span>

                            LIVE

                        </div>

                        <div class="video-actions-top">

                            <button
                                class="video-action"
                                onclick="toggleMute()">

                                🔊

                            </button>

                            <button
                                class="video-action"
                                onclick="toggleFullscreen()">

                                ⛶

                            </button>

                        </div>

                    </div>


                    <div id="remote-video">

                        <div class="video-loading">

                            Connecting to live stream...

                        </div>

                    </div>


                    <div
                        class="floating-likes"
                        id="floating-likes">
                    </div>


                    <div class="video-bottom">

                        <div class="streamer-mini">

                            <div
                                class="streamer-avatar"
                                id="streamer-avatar">

                                S

                            </div>

                            <div class="streamer-info">

                                <h4 id="streamer-name">

                                    Live Streamer

                                </h4>

                                <span>

                                    <span id="live-viewers">
                                        <?= (int)$stream['viewer_count'] ?>
                                    </span>

                                    viewers

                                </span>

                            </div>

                            <?php if (!$isOwner): ?>

                            <button
                                class="follow-btn"
                                id="follow-btn"
                                onclick="followStreamer()">

                                + Follow

                            </button>

                            <?php endif; ?>

                        </div>


                        <div
                            class="stream-title"
                            id="stream-title">

                            <?= htmlspecialchars(
                                $stream['title'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>

                        </div>

                    </div>

                </div>


                <!-- STREAM INFORMATION -->

                <div class="stream-info">

                    <div class="stream-info-row">

                        <div class="stats">

                            <span class="stat">

                                👁

                                <strong id="viewer-count">
                                    <?= (int)$stream['viewer_count'] ?>
                                </strong>

                            </span>

                            <span class="stat">

                                ❤️

                                <strong id="like-count">
                                    0
                                </strong>

                            </span>

                            <span class="stat">

                                🎁

                                <strong id="gift-count">
                                    0
                                </strong>

                            </span>

                        </div>


                        <div class="action-buttons">

                            <button
                                class="room-btn"
                                id="like-button"
                                onclick="likeStream()">

                                ❤️ Like

                            </button>

                            <button
                                class="room-btn"
                                onclick="shareStream()">

                                ↗ Share

                            </button>

                            <button
                                class="room-btn"
                                onclick="copyStreamLink()">

                                🔗 Copy

                            </button>

                        </div>

                    </div>

                </div>

            </section>


            <!-- =================================================
                CHAT
            ================================================= -->

            <aside class="chat-card">

                <div class="chat-header">

                    <div>

                        <div class="chat-title">

                            Live Chat

                        </div>

                        <div class="chat-subtitle">

                            Join the conversation

                        </div>

                    </div>

                    <div class="viewer-count">

                        👁

                        <span id="chat-viewers">
                            <?= (int)$stream['viewer_count'] ?>
                        </span>

                    </div>

                </div>


                <div
                    class="chat-messages"
                    id="chat-messages">

                    <div class="chat-message system">

                        <div class="chat-avatar">

                            ★

                        </div>

                        <div class="chat-body">

                            <div class="chat-user">

                                System

                            </div>

                            <div class="chat-text">

                                Welcome to the live stream!

                            </div>

                        </div>

                    </div>

                </div>


                <!-- GIFTS -->

                <div class="gift-section">

                    <div class="gift-header">

                        <div class="gift-title">

                            Send a gift

                        </div>

                        <button
                            class="coin-balance"
                            onclick="openBuyCoins()">

                            🪙

                            <span id="coin-balance">
                                0
                            </span>

                            <span>
                                +
                            </span>

                        </button>

                    </div>


                    <div
                        class="gift-list"
                        id="gift-list">

                        <div class="gift-loading">

                            Loading gifts...

                        </div>

                    </div>

                </div>


                <!-- CHAT INPUT -->

                <div class="chat-input-area">

                    <div class="chat-input-wrapper">

                        <input
                            type="text"
                            id="chat-input"
                            class="chat-input"
                            placeholder="Say something..."
                            maxlength="500"
                        >

                        <button
                            class="chat-send"
                            onclick="sendChatMessage()">

                            ➤

                        </button>

                    </div>

                </div>

            </aside>

        </div>

    </div>


    <!-- GIFT POPUP -->

    <div
        class="gift-popup"
        id="gift-popup">

        <div
            class="gift-popup-icon"
            id="gift-popup-icon">

            🎁

        </div>

        <div
            class="gift-popup-title"
            id="gift-popup-title">

            Gift Sent!

        </div>

        <div
            class="gift-popup-sub"
            id="gift-popup-sub">

            Your gift was sent to the streamer

        </div>

    </div>


    <!-- BUY COINS MODAL -->

    <div
        class="coins-modal"
        id="coins-modal">

        <div class="coins-modal-card">

            <button
                class="modal-close"
                onclick="closeBuyCoins()">

                ×

            </button>

            <h3>

                Buy Coins

            </h3>

            <p>

                Choose a coin package

            </p>

            <div
                id="coin-packages"
                class="coin-packages">

                Loading...

            </div>

        </div>

    </div>

<?php require "inc/footer.php"; ?>
<script>

const streamGuid =
    <?= json_encode($streamGuid) ?>;

const streamerId =
    <?= json_encode((string)$stream['user_id']) ?>;

</script>

<script src="assets/js/join-live/viewer.js"></script>
<script src="assets/js/join-live/chat.js"></script>
<script src="assets/js/join-live/gifts.js"></script>
<script src="assets/js/join-live/likes.js"></script>
<script src="assets/js/join-live/follow.js"></script>