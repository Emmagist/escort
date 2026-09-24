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

$data = json_decode(
    file_get_contents('php://input'),
    true
);

$title = trim(
    $data['title'] ?? ''
);

if ($title === '') {

    http_response_code(422);

    echo json_encode([
        'success' => false,
        'message' => 'Stream title is required'
    ]);

    exit;
}

$userId = (string) $_SESSION['token'];

$streamGuid = $streamModel->create($userId, $title);

$streamKey =
    $streamKeyModel->create(
        $streamGuid
    );

$stream =
    $streamModel->find(
        $streamGuid
    );

echo json_encode([

    'success' => true,

    'stream' => $stream,

    'stream_key' => $streamKey

]);