<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/liveFollow.php';

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

$streamerId = trim(
    (string)($data['streamer_id'] ?? '')
);

$userId = (string)$_SESSION['token'];

$success = $followModel->follow(
    $userId,
    $streamerId
);

echo json_encode([
    'success' => $success,
    'following' => $success
]);