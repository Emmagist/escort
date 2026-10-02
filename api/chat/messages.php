<?php

// use function GuzzleHttp\json_encode;

header('Content-Type: application/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/liveChat.php';


$streamGuid = trim((string)($_GET['stream_id'] ?? ''));

$afterId = trim((int)($_GET['after_id'] ?? ''));

if($streamGuid === ''){
    http_response_code(422);

    echo json_encode([
        'success' => false,
        'message' => 'Stream ID is required',
        'messages' => []
    ]);
    exit;
}

$messages = $liveChat->getMessages($streamGuid, $afterId, 50);

echo json_encode(['success' => true, 'message' => $messages]);