<?php

use function GuzzleHttp\json_encode;

header('Content-Type: application/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/liveChat.php';

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

$message = trim((string)($data['message'] ?? ''));

if ($message === '') {
    http_response_code(422);

    echo json_encode(['success' => false, 'message' =>'Message cannot be empty']);

    exit;
}

$result = $liveChat->send($streamGuid, $_SESSION['token'], $message);

echo json_encode(['success' => $result !== null, 'message' => $result['message'] ?? null]);