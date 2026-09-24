<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../classes/liveLike.php';

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

$streamGuid = trim(
    (string)($data['stream_id'] ?? '')
);

$userId = (string)$_SESSION['token'];

$result = $likeModel->like(
    $streamGuid,
    $userId
);

echo json_encode($result);