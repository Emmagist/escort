<?php

header(
    'Content-Type: application/json'
);

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../classes/liveKit.php';
require_once __DIR__ . '/../classes/stream.php';
require_once __DIR__ . '/../classes/streamKey.php';
require_once __DIR__ . './../vendor/autoload.php';

if (!isset($_SESSION['token'])) {

    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Login required'
    ]);

    exit;
}
$streamGuid = (string) ($_GET['stream_id'] ?? '');

$stream = $streamModel->find($streamGuid);

if (!$stream) {

    http_response_code(404);

    echo json_encode([
        'success' => false,
        'message' => 'Stream not found'
    ]);

    exit;
}

$userId = (string) $_SESSION['token'];

if ((string) $stream['user_id'] !== $userId) {

    http_response_code(403);

    echo json_encode([
        'success' => false,
        'message' => 'You do not own this stream'
    ]);

    exit;
}

$identity = 'user-' . $userId;

$token = $liveKit->createToken($identity, $stream['room_name'], true, true);

$streamModel->start($streamGuid);

echo json_encode([

    'success' => true,

    'server_url' => LIVEKIT_URL,

    'token' => $token,

    'room' => $stream['room_name']
]);