<?php

header(
    'Content-Type: application/json'
);

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../classes/liveKit.php';
require_once __DIR__ . '/../classes/stream.php';
require_once __DIR__ . '/../classes/streamKey.php';

if (!isset($_SESSION['token'])) {

    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Login required'
    ]);

    exit;
}

$streamGuid = (string) ($_POST['stream_id'] ?? 0);

$stream = $streamModel->find($streamGuid);

if (!$stream) {

    http_response_code(404);

    echo json_encode([
        'success' => false,
        'message' => 'Stream not found'
    ]);

    exit;
}

if ((string) $stream['user_id'] !== (string) $_SESSION['token']) {

    http_response_code(403);

    echo json_encode([
        'success' => false,
        'message' => 'Unauthorized'
    ]);

    exit;
}

$streamModel->end($streamGuid);

echo json_encode([

    'success' => true,

    'message' => 'Stream ended successfully'
]);