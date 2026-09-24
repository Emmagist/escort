<?php

require_once __DIR__ . '/inc/auth.php';

$streamGuid =
    trim((string) ($_GET['stream_id'] ?? ''));


if ($streamGuid === '') {

    header("Location: live-list");

    exit;
}

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/classes/stream.php';
require_once __DIR__ . '/classes/liveGift.php';


$stream =
    $streamModel->find($streamGuid);


if (!$stream) {

    header("Location: live-list");

    exit;
}


if ($stream['status'] !== 'live') {

    header("Location: live-list");

    exit;
}


$giftModel =
    new LiveGift($db);


$gifts =
    $giftModel->getAvailableGifts();


$viewerId =
    (string) ($_SESSION['token'] ?? 'guest');


    $streamerName = 'Streamer ' . substr((string) $stream['user_id'], -6);

    require __DIR__ . "/inc/head.php";
    require __DIR__ . "/inc/aside.php";
    require __DIR__ . "/inc/header.php";

?>

<link rel="stylesheet" href="assets/css/join-live.css">

<div class="container-fluid live-room-page">

    <!-- =====================================================
         TOP BAR
    ====================================================== -->

    <div class="live-room-topbar">

        <a href="live-list" class="live-back-btn">

            <i class="fa fa-arrow-left"></i>

        </a>


        <div class="live-room-title">

            <span class="live-dot"></span>

            LIVE

            <span id="viewer-count">
                <?= number_format((int) $stream['viewer_count']) ?>
            </span>

            viewers

        </div>


        <button
            type="button"
            class="live-share-btn"
            onclick="shareLiveStream()"
        >

            <i class="fa fa-share-alt"></i>

            Share

        </button>

    </div>


    <!-- =====================================================
         VIDEO
    ====================================================== -->

    <div class="live-video-wrapper">

        <div id="remote-video">

            <div class="video-loading">

                <div class="spinner-border text-light"></div>

                <p>
                    Connecting to live stream...
                </p>

            </div>

        </div>


        <!-- Floating reactions -->

        <div
            id="floating-reactions"
            class="floating-reactions"
        ></div>


        <!-- Stream overlay -->

        <div class="video-overlay-top">

            <div class="streamer-mini-profile">

                <div class="streamer-avatar">

                    <?= strtoupper(
                        substr($streamerName, 0, 1)
                    ) ?>

                </div>


                <div>

                    <strong>
                        <?= htmlspecialchars($streamerName) ?>
                    </strong>

                    <small>
                        Live now
                    </small>

                </div>


                <button
                    class="follow-btn"
                    id="follow-btn"
                >
                    Follow
                </button>

            </div>

        </div>


        <!-- Bottom video actions -->

        <div class="video-actions">

            <button
                type="button"
                onclick="sendLike()"
                class="video-action like-action"
            >

                <i class="fa fa-heart"></i>

                <span id="like-count">
                    <?= number_format(
                        (int) ($stream['like_count'] ?? 0)
                    ) ?>
                </span>

            </button>


            <button
                type="button"
                onclick="openGiftModal()"
                class="video-action gift-action"
            >

                <i class="fa fa-gift"></i>

                Gift

            </button>

        </div>

    </div>


    <!-- =====================================================
         STREAM INFO
    ====================================================== -->

    <div class="stream-info-card">

        <div class="streamer-main">

            <div class="streamer-large-avatar">

                <?= strtoupper(
                    substr($streamerName, 0, 1)
                ) ?>

            </div>


            <div class="streamer-details">

                <div class="streamer-name-line">

                    <strong>
                        <?= htmlspecialchars($streamerName) ?>
                    </strong>

                    <span class="verified-badge">

                        <i class="fa fa-check"></i>

                    </span>

                </div>


                <div class="streamer-status">

                    <span class="live-small-dot"></span>

                    Streaming now

                </div>

            </div>


            <button
                class="follow-main-btn"
                id="follow-main-btn"
            >
                Follow
            </button>

        </div>


        <h3 class="stream-title">

            <?= htmlspecialchars(
                (string) $stream['title']
            ) ?>

        </h3>

    </div>


    <!-- =====================================================
         CHAT
    ====================================================== -->

    <div class="live-chat-card">

        <div class="chat-header">

            <strong>
                Live Chat
            </strong>


            <span id="online-count">

                <?= number_format(
                    (int) $stream['viewer_count']
                ) ?>
                online

            </span>

        </div>


        <div
            id="chat-messages"
            class="chat-messages"
        >

            <div class="chat-system-message">

                Welcome to the live stream 👋

            </div>

        </div>


        <div class="chat-input-area">

            <input
                type="text"
                id="chat-input"
                maxlength="500"
                placeholder="Say something..."
                autocomplete="off"
            >


            <button
                type="button"
                onclick="sendMessage()"
                class="send-message-btn"
            >

                <i class="fa fa-paper-plane"></i>

            </button>

        </div>

    </div>


    <!-- =====================================================
         BOTTOM ACTION BAR
    ====================================================== -->

    <div class="live-bottom-bar">

        <button
            type="button"
            onclick="sendLike()"
        >

            <i class="fa fa-heart"></i>

            Like

        </button>


        <button
            type="button"
            onclick="openGiftModal()"
        >

            <i class="fa fa-gift"></i>

            Gift

        </button>


        <button
            type="button"
            onclick="shareLiveStream()"
        >

            <i class="fa fa-share-alt"></i>

            Share

        </button>


        <div class="coin-balance">

            <i class="fa fa-diamond"></i>

            <span id="coin-balance">

                0

            </span>

        </div>

    </div>

</div>


<!-- =========================================================
     GIFT MODAL
========================================================= -->

<div
    class="modal fade"
    id="giftModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content gift-modal-content">


            <div class="modal-header">

                <div>

                    <h5 class="modal-title">

                        <i class="fa fa-gift"></i>

                        Send a Gift

                    </h5>


                    <small class="text-muted">

                        Send a gift to
                        <?= htmlspecialchars($streamerName) ?>

                    </small>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">


                <div class="gift-wallet">

                    <div>

                        <small>
                            Gift Balance
                        </small>

                        <strong>

                            💎
                            <span id="modal-coin-balance">
                                0
                            </span>

                        </strong>

                    </div>


                    <button
                        type="button"
                        onclick="openBuyCoins()"
                        class="buy-coins-btn"
                    >

                        + Buy Coins

                    </button>

                </div>


                <div class="gift-grid">


                    <?php foreach ($gifts as $gift): ?>

                        <button
                            type="button"
                            class="gift-item"
                            data-gift-id="<?= htmlspecialchars(
                                $gift['gift_guid']
                            ) ?>"
                            data-gift-name="<?= htmlspecialchars(
                                $gift['name']
                            ) ?>"
                            data-gift-price="<?= (int) $gift['price'] ?>"
                            onclick="selectGift(this)"
                        >

                            <span class="gift-icon">

                                <?= htmlspecialchars(
                                    $gift['icon']
                                ) ?>

                            </span>


                            <span class="gift-name">

                                <?= htmlspecialchars(
                                    $gift['name']
                                ) ?>

                            </span>


                            <span class="gift-price">

                                💎 <?= number_format(
                                    (int) $gift['price']
                                ) ?>

                            </span>

                        </button>

                    <?php endforeach; ?>


                </div>


                <div
                    id="selected-gift-section"
                    class="selected-gift-section"
                    style="display:none;"
                >

                    <div>

                        Selected:

                        <strong id="selected-gift-name">
                        </strong>

                    </div>


                    <div class="quantity-control">

                        <button
                            type="button"
                            onclick="changeGiftQuantity(-1)"
                        >
                            −
                        </button>


                        <span id="gift-quantity">
                            1
                        </span>


                        <button
                            type="button"
                            onclick="changeGiftQuantity(1)"
                        >
                            +
                        </button>

                    </div>


                    <button
                        type="button"
                        onclick="sendGift()"
                        class="send-gift-btn"
                    >

                        SEND GIFT

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     BUY COINS MODAL
========================================================= -->

<div
    class="modal fade"
    id="buyCoinsModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Buy Gift Coins

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <div class="coin-package-grid">

                    <button
                        onclick="buyCoins(100)"
                        class="coin-package"
                    >

                        <strong>💎 100</strong>

                        <span>₦100</span>

                    </button>


                    <button
                        onclick="buyCoins(500)"
                        class="coin-package"
                    >

                        <strong>💎 500</strong>

                        <span>₦500</span>

                    </button>


                    <button
                        onclick="buyCoins(1000)"
                        class="coin-package"
                    >

                        <strong>💎 1,000</strong>

                        <span>₦1,000</span>

                    </button>


                    <button
                        onclick="buyCoins(2500)"
                        class="coin-package"
                    >

                        <strong>💎 2,500</strong>

                        <span>₦2,500</span>

                    </button>


                    <button
                        onclick="buyCoins(5000)"
                        class="coin-package"
                    >

                        <strong>💎 5,000</strong>

                        <span>₦5,000</span>

                    </button>


                    <button
                        onclick="buyCoins(10000)"
                        class="coin-package"
                    >

                        <strong>💎 10,000</strong>

                        <span>₦10,000</span>

                    </button>

                </div>


                <p class="text-muted small mt-3 mb-0">

                    Coin purchases can be connected to
                    your existing payment provider.

                </p>

            </div>

        </div>

    </div>

</div>

<?php require "inc/footer.php"; ?>
<script src="assets/js/join-live.js"></script>
