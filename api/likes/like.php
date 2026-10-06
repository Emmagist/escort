<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/liveLike.php';
require_once __DIR__ . '/../../classes/stream.php';

if (!isset($_SESSION['token'])) {
    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Login required'
    ]);

    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$streamGuid = trim((string)($data['stream_id'] ?? ''));

$stream = $streamModel->find($streamGuid);

if ($stream['status'] !== 'live') {

    http_response_code(422);

    echo json_encode([
        'success' => false,
        'message' => 'Stream is no longer live'
    ]);

    exit;
}

$userId = (string)$_SESSION['token'];

$result = $likeModel->like($streamGuid, $userId);

echo json_encode($result);