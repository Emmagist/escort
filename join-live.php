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




<div class="live-layout">

    <!-- LIVE VIDEO AND COMMENTS -->
    <section class="stream-section">

        <div class="video-card">

            <div class="video-top">
                <div class="live-badge">
                    <span class="live-dot"></span> LIVE
                </div>

                <div class="video-actions-top">
                    <button type="button" class="video-action"
                            onclick="toggleMute()" title="Mute or unmute">
                        🔊
                    </button>

                    <button type="button" class="video-action"
                            onclick="toggleFullscreen()" title="Fullscreen">
                        ⛶
                    </button>
                </div>
            </div>

            <div id="remote-video">
                <div class="video-loading">
                    <p>Connecting to live stream...</p>
                </div>
            </div>

            <div class="chat-messages live-comments-overlay"
                 id="chat-messages"
                 aria-live="polite">
                <div class="chat-message system">
                    <div class="chat-body">
                        <div class="chat-text">Welcome to the live stream!</div>
                    </div>
                </div>
            </div>

            <div id="live-event-overlay" aria-live="polite"></div>

            <div class="floating-likes" id="floating-likes"></div>

            <div class="video-side-actions">
                <button type="button" class="video-side-button" id="like-btn" onclick="likeStream()"><span class="video-side-icon">♥</span><span id="like-count">0</span></button>

                <button type="button" class="video-side-button"
                        onclick="shareStream()">
                    <span class="video-side-icon">↗</span>
                    <span>Share</span>
                </button>

                <button type="button" class="video-side-button"
                        onclick="copyStreamLink()">
                    <span class="video-side-icon">🔗</span>
                    <span>Copy</span>
                </button>

                <button type="button" class="video-side-button"
                        onclick="document.getElementById('gift-list').scrollIntoView({behavior:'smooth',block:'nearest'})">
                    <span class="video-side-icon">🎁</span>
                    <span>Gifts</span>
                </button>
            </div>

            <div class="video-bottom">
                <div class="streamer-mini">
                    <div class="streamer-avatar" id="streamer-avatar">S</div>

                    <div class="streamer-info">
                        <h4 id="streamer-name">Live Streamer</h4>
                        <span>
                            <span id="live-viewers"><?= (int)$stream['viewer_count'] ?></span>
                            viewers
                        </span>
                    </div>

                    <?php if (!$isOwner): ?>
                        <button type="button" class="follow-btn"
                                id="follow-btn" onclick="followStreamer()">
                            + Follow
                        </button>
                    <?php endif; ?>
                </div>

                <div class="stream-title" id="stream-title">
                    <?= htmlspecialchars($stream['title'], ENT_QUOTES, 'UTF-8') ?>
                </div>
            </div>
        </div>

        <!-- COMMENT INPUT: restored and connected to existing functions -->
        <div class="live-comment-composer">
            <input type="text"
                   id="chat-input"
                   class="chat-input"
                   placeholder="Say something to the streamer..."
                   maxlength="300"
                   autocomplete="off"
                   onkeydown="handleChatKey(event)">

            <button type="button"
                    class="chat-send"
                    onclick="sendChatMessage()"
                    aria-label="Send comment">
                ➤
            </button>
        </div>

    </section>

    <!-- GIFT PANEL ONLY — original gift IDs and card classes retained -->
    <aside class="chat-card gift-panel">

        <div class="gift-header">
            <div>
                <div class="gift-title">Send a gift</div>
                <div class="gift-subtitle">Support the streamer</div>
            </div>

            <button type="button" class="coin-balance"
                    onclick="openBuyCoins()">
                🪙 <span id="coin-balance">0</span> +
            </button>
        </div>

        <div class="gift-panel-label">
            <span>Choose your gift</span>
            <span>Tap to send</span>
        </div>

        <div class="gift-list" id="gift-list">
            <div class="gift-loading">Loading gifts...</div>
        </div>

        <div class="gift-panel-footer">
            🎁 Gifts help support your favourite streamer.
        </div>

    </aside>

</div>


<!-- Buy Coins Modal -->
<div id="coins-modal" class="coins-modal" aria-hidden="true">
    <div class="coins-modal-content">

        <div class="coins-modal-header">
            <h3>Buy Coins</h3>

            <button type="button"
                    onclick="closeBuyCoins()"
                    aria-label="Close Buy Coins modal">
                &times;
            </button>
        </div>

        <p>Choose a coin package to support your favourite streamer.</p>

        <div id="coin-packages">
            <p>Loading coin packages...</p>
        </div>

    </div>
</div>


<!-- Gift sent notification -->
<div id="gift-popup" class="gift-popup" role="status" aria-live="polite">
    <div class="gift-popup-content">
        <div id="gift-popup-icon" class="gift-popup-icon">🎁</div>
        <div>
            <div id="gift-popup-title" class="gift-popup-title">
                Gift Sent!
            </div>
            <div id="gift-popup-sub" class="gift-popup-sub">
                Your gift was sent to the streamer
            </div>
        </div>
    </div>
</div>

<?php require "inc/footer.php"; ?>
<script>
    const streamGuid = <?= json_encode($streamGuid) ?>;
    const streamerId = <?= json_encode((string) $stream['user_id']) ?>;
</script>

<script src="assets/js/join-live/viewer.js"></script>
<script src="assets/js/join-live/chat.js"></script>
<script src="assets/js/join-live/gifts.js"></script>
<script src="assets/js/join-live/likes.js"></script>
<script src="assets/js/join-live/follow.js"></script>
<script src="assets/js/join-live/events.js"></script>

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