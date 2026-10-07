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
    header("Location: live-list");
    exit;
}

$userId = (string)$_SESSION['token'];

$isOwner = ((string)$stream['user_id'] === $userId);

require __DIR__ . "/inc/head.php";
require __DIR__ . "/inc/aside.php";
require __DIR__ . "/inc/header.php";

?>

<!-- =========================================================
     LIVEKIT
========================================================= -->

<script src="https://cdn.jsdelivr.net/npm/livekit-client/dist/livekit-client.umd.min.js"></script>

<!-- =========================================================
     LIVE CSS
========================================================= -->

<link rel="stylesheet" href="assets/css/join-live.css">


<div class="container-fluid">

    <div class="live-page">

        <div class="live-layout">


            <!-- =================================================
                 MAIN STREAM
            ================================================== -->

            <section class="stream-section">


                <!-- =================================================
                     VIDEO CARD
                ================================================== -->

                <div class="video-card">


                    <!-- =================================================
                         LIVE TOP BAR
                    ================================================== -->

                    <div class="video-top">

                        <div class="live-badge">

                            <span class="live-dot"></span>

                            LIVE

                        </div>


                        <div class="video-actions-top">

                            <button
                                type="button"
                                class="video-action"
                                onclick="toggleMute()"
                                title="Mute / Unmute">

                                🔊

                            </button>


                            <button
                                type="button"
                                class="video-action"
                                onclick="toggleFullscreen()"
                                title="Fullscreen">

                                ⛶

                            </button>

                        </div>

                    </div>



                    <!-- =================================================
                         LIVE VIDEO
                    ================================================== -->

                    <div id="remote-video">

                        <div class="video-loading">

                            <div class="video-loading-spinner"></div>

                            <span>
                                Connecting to live stream...
                            </span>

                        </div>

                    </div>



                    <!-- =================================================
                         TIKTOK STYLE COMMENTS
                    ================================================== -->

                    <div
                        class="live-comments-overlay"
                        id="live-comments-overlay">
                    </div>



                    <!-- =================================================
                         FLOATING LIKES
                    ================================================== -->

                    <div
                        class="floating-likes"
                        id="floating-likes">
                    </div>



                    <!-- =================================================
                         RIGHT SIDE VIDEO ACTIONS
                    ================================================== -->

                    <div class="video-side-actions">


                        <!-- LIKE -->

                        <button
                            type="button"
                            class="video-side-button"
                            id="video-like-button"
                            onclick="likeStream()">

                            <span class="video-side-icon">
                                ❤️
                            </span>

                            <span
                                class="video-side-count"
                                id="video-like-count">

                                0

                            </span>

                        </button>



                        <!-- SHARE -->

                        <button
                            type="button"
                            class="video-side-button"
                            onclick="shareStream()">

                            <span class="video-side-icon">
                                ↗
                            </span>

                            <span class="video-side-label">
                                Share
                            </span>

                        </button>



                        <!-- COPY -->

                        <button
                            type="button"
                            class="video-side-button"
                            onclick="copyStreamLink()">

                            <span class="video-side-icon">
                                🔗
                            </span>

                            <span class="video-side-label">
                                Copy
                            </span>

                        </button>



                        <!-- GIFT -->

                        <button
                            type="button"
                            class="video-side-button"
                            onclick="document.getElementById('gift-list').scrollIntoView({behavior:'smooth'})">

                            <span class="video-side-icon">
                                🎁
                            </span>

                            <span
                                class="video-side-count"
                                id="video-gift-count">

                                0

                            </span>

                        </button>

                    </div>



                    <!-- =================================================
                         STREAMER INFORMATION
                    ================================================== -->

                    <div class="video-bottom">


                        <div class="streamer-mini">


                            <!-- STREAMER AVATAR -->

                            <div
                                class="streamer-avatar"
                                id="streamer-avatar">

                                S

                            </div>



                            <!-- STREAMER DETAILS -->

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



                            <!-- FOLLOW -->

                            <?php if (!$isOwner): ?>

                                <button
                                    type="button"
                                    class="follow-btn"
                                    id="follow-btn"
                                    onclick="followStreamer()">

                                    + Follow

                                </button>

                            <?php endif; ?>


                        </div>



                        <!-- STREAM TITLE -->

                        <div
                            class="stream-title"
                            id="stream-title">

                            <?= ucwords(
                                htmlspecialchars(
                                    $stream['title'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                )
                            ) ?>

                        </div>

                    </div>

                </div>



                <!-- =================================================
                     STREAM INFORMATION
                ================================================== -->

                <div class="stream-info">

                    <div class="stream-info-row">


                        <!-- STATS -->

                        <div class="stats">


                            <span class="stat">

                                👁

                                <strong id="viewer-count">

                                    <?= (int)$stream['viewer_count'] ?>

                                </strong>

                            </span>



                            <span class="stat">

                                ❤️

                                <strong
                                    id="like-count"
                                    data-id="<?= htmlspecialchars($streamGuid, ENT_QUOTES, 'UTF-8') ?>">

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



                        <!-- ACTION BUTTONS -->

                        <div class="action-buttons">


                            <button
                                type="button"
                                class="room-btn"
                                id="like-button"
                                onclick="likeStream()">

                                ❤️ Like

                            </button>


                            <button
                                type="button"
                                class="room-btn"
                                onclick="shareStream()">

                                ↗ Share

                            </button>


                            <button
                                type="button"
                                class="room-btn"
                                onclick="copyStreamLink()">

                                🔗 Copy

                            </button>

                        </div>

                    </div>

                </div>

            </section>



            <!-- =================================================
                 DESKTOP CHAT PANEL
            ================================================== -->

            <aside class="chat-card">


                <!-- =================================================
                     CHAT HEADER
                ================================================== -->

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



                <!-- =================================================
                     CHAT MESSAGES
                ================================================== -->

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



                <!-- =================================================
                     GIFT SECTION
                ================================================== -->

                <div class="gift-section">


                    <div class="gift-header">


                        <div class="gift-title">

                            Send a gift

                        </div>


                        <!-- COIN BALANCE -->

                        <button
                            type="button"
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



                    <!-- GIFT LIST -->

                    <div
                        class="gift-list"
                        id="gift-list">

                        <div class="gift-loading">

                            Loading gifts...

                        </div>

                    </div>

                </div>



                <!-- =================================================
                     CHAT INPUT
                ================================================== -->

                <div class="chat-input-area">

                    <div class="chat-input-wrapper">


                        <input
                            type="text"
                            id="chat-input"
                            class="chat-input"
                            placeholder="Say something..."
                            maxlength="500"
                            autocomplete="off"
                        >


                        <button
                            type="button"
                            class="chat-send"
                            onclick="sendChatMessage()">

                            ➤

                        </button>

                    </div>

                </div>

            </aside>

        </div>

    </div>



    <!-- =========================================================
         GIFT SENT POPUP
    ========================================================== -->

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



    <!-- =========================================================
         BUY COINS MODAL
    ========================================================== -->

    <div
        class="coins-modal"
        id="coins-modal">


        <div class="coins-modal-card">


            <button
                type="button"
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

</div>



<?php require "inc/footer.php"; ?>



<!-- =========================================================
     JAVASCRIPT VARIABLES
========================================================== -->

<script>

const streamGuid =
    <?= json_encode($streamGuid) ?>;


const streamerId =
    <?= json_encode((string)$stream['user_id']) ?>;


const currentStreamTitle =
    <?= json_encode((string)$stream['title']) ?>;

</script>



<!-- =========================================================
     LIVE STREAM JAVASCRIPT
========================================================== -->

<script src="assets/js/join-live/viewer.js"></script>


<!-- =========================================================
     CHAT
========================================================== -->

<script src="assets/js/join-live/chat.js"></script>


<!-- =========================================================
     GIFTS
========================================================== -->

<script src="assets/js/join-live/gifts.js"></script>


<!-- =========================================================
     LIKES
========================================================== -->

<script src="assets/js/join-live/likes.js"></script>


<!-- =========================================================
     FOLLOW
========================================================== -->

<script src="assets/js/join-live/follow.js"></script>



<!-- =========================================================
     TIKTOK STYLE VIDEO COMMENTS
========================================================== -->

<script>

(function () {

    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */

    window.escapeChatHtml = function (value) {

        const div =
            document.createElement('div');

        div.textContent =
            String(value ?? '');

        return div.innerHTML;
    };



    /*
    |--------------------------------------------------------------------------
    | Show message over video
    |--------------------------------------------------------------------------
    */

    window.showLiveVideoComment = function (message) {

        const container =
            document.getElementById(
                'live-comments-overlay'
            );


        if (!container) {
            return;
        }


        const username =
            message.username ||
            message.name ||
            message.user_name ||
            'User';


        const text =
            message.message ||
            '';


        const avatar =
            message.avatar ||
            message.profile_image ||
            message.profile_image_url ||
            '';


        const firstLetter =
            username
                .charAt(0)
                .toUpperCase();


        const comment =
            document.createElement('div');


        comment.className =
            'live-comment';



        /*
        |--------------------------------------------------------------------------
        | Avatar
        |--------------------------------------------------------------------------
        */

        let avatarHtml = firstLetter;


        if (avatar) {

            avatarHtml = `

                <img
                    src="${escapeChatHtml(avatar)}"
                    alt=""
                    onerror="
                        this.style.display='none';
                        this.parentElement.innerText='${escapeChatHtml(firstLetter)}';
                    "
                >

            `;
        }



        /*
        |--------------------------------------------------------------------------
        | Comment HTML
        |--------------------------------------------------------------------------
        */

        comment.innerHTML = `

            <div class="live-comment-avatar">

                ${avatarHtml}

            </div>


            <div class="live-comment-body">

                <div class="live-comment-user">

                    ${escapeChatHtml(username)}

                </div>


                <div class="live-comment-text">

                    ${escapeChatHtml(text)}

                </div>

            </div>

        `;



        /*
        |--------------------------------------------------------------------------
        | Add comment
        |--------------------------------------------------------------------------
        */

        container.appendChild(comment);



        /*
        |--------------------------------------------------------------------------
        | Maximum visible comments
        |--------------------------------------------------------------------------
        */

        while (
            container.children.length > 7
        ) {

            container.removeChild(
                container.firstElementChild
            );

        }



        /*
        |--------------------------------------------------------------------------
        | Remove old comment
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            if (comment.parentNode) {

                comment.remove();

            }

        }, 8000);

    };

})();

</script>



<!-- =========================================================
     ENTER KEY FOR CHAT
========================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const input =
            document.getElementById(
                'chat-input'
            );


        if (!input) {
            return;
        }


        input.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Enter' &&
                    !event.shiftKey
                ) {

                    event.preventDefault();

                    sendChatMessage();

                }

            }
        );

    }
);

</script>