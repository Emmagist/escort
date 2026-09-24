<?php

require_once __DIR__ . '/inc/auth.php';
require_once __DIR__ . '/classes/stream.php';

$liveStreams = $streamModel->getLiveStreams(50);

require __DIR__ . "/inc/head.php";
require __DIR__ . "/inc/aside.php";
require __DIR__ . "/inc/header.php";

?>

<link rel="stylesheet" href="assets/css/live-list.css">


<div class="container-fluid">

    <div class="live-page-header">

        <div>

            <h1 class="live-page-title">
                Live Now
            </h1>

            <p class="live-page-subtitle">
                Join a live stream and connect with people online.
            </p>

        </div>


        <div class="live-status-count">

            <span class="live-status-dot"></span>

            <?= count($liveStreams) ?> Live Now

        </div>

    </div>


    <?php if (!empty($liveStreams)): ?>

        <div class="live-stream-grid">

            <?php foreach ($liveStreams as $stream): ?>

                <?php

                    $streamGuid = (string) ($stream['stream_guid'] ?? '');

                    $title = trim((string) ($stream['title'] ?? 'Live Stream'));

                    $userId = (string) ($stream['user_id'] ?? '');

                    $username = Users::findUsernameByToken($userId);

                    $viewers = (int) ($stream['viewer_count'] ?? 0);

                    $avatarLetter = Database::avatarLetter($username);

                ?>


                <div class="live-stream-card">


                    <div class="live-preview">

                        <span class="live-badge">

                            <span class="live-status-dot"
                                  style="width:6px;height:6px;"></span>

                            LIVE

                        </span>


                        <span class="live-viewers">

                            <i class="fa fa-eye"></i>

                            <?= number_format($viewers) ?>

                        </span>


                        <div class="live-preview-icon">

                            <i class="fa fa-video-camera"></i>

                        </div>

                    </div>


                    <div class="live-card-body">


                        <div class="streamer-row">

                            <div class="streamer-avatar">

                                <?= htmlspecialchars($avatarLetter) ?>

                            </div>


                            <div style="min-width:0;">

                                <p class="streamer-name">

                                    <?= htmlspecialchars(ucwords($username)) ?>

                                </p>

                                <p class="streamer-live-text">

                                    <i class="fa fa-circle"
                                       style="font-size:7px;"></i>

                                    Streaming now

                                </p>

                            </div>

                        </div>


                        <h3 class="stream-title">

                            <?= htmlspecialchars($title) ?>

                        </h3>


                        <div class="stream-meta">
                            <span class="viewer-count"><i class="fa fa-eye"></i> <?= number_format($viewers) ?>viewer<?= $viewers == 1 ? '' : 's' ?></span>
                            <a href="join-live?stream_id=<?= urlencode($streamGuid) ?>" class="join-live-btn">Join Live<i class="fa fa-arrow-right ms-1"></i></a>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="empty-live">

            <div class="empty-live-icon">

                <i class="fa fa-video-camera"></i>

            </div>


            <h4>
                No one is live right now
            </h4>


            <p>
                Check back later to join a live stream.
            </p>

        </div>


    <?php endif; ?>

</div>


<?php require "inc/footer.php"; ?>

