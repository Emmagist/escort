<?php

header(
    'Content-Type: application/json'
);

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../classes/liveKit.php';
require_once __DIR__ . '/../classes/stream.php';
require_once __DIR__ . '/../classes/streamKey.php';

$streamGuid =
    (string) ($_GET['stream_id'] ?? 0);

$stream =
    $streamModel->find($streamGuid);

if (!$stream) {

    http_response_code(404);

    echo json_encode([
        'success' => false,
        'message' => 'Stream not found'
    ]);

    exit;
}

if ($stream['status'] !== 'live') {

    http_response_code(422);

    echo json_encode([
        'success' => false,
        'message' => 'Stream is not live'
    ]);

    exit;
}

if (isset($_SESSION['token'])) {

    $identity =
        'user:' . (string) $_SESSION['token'];

} else {

    $identity =
        'guest:' . bin2hex(random_bytes(8));
}

$token = $liveKit->createToken($identity, $stream['room_name'], false, true);

$streamModel->increaseViewers($streamGuid);

echo json_encode([

    'success' => true,

    'server_url' => LIVEKIT_URL,

    'token' => $token,

    'room' =>
        $stream['room_name']
]);