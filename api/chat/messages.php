<?php

use function GuzzleHttp\json_encode;

header('Content-Type: application/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/liveChat.php';

$streamGuid = trim((string)($_GET['stream_id'] ?? ''));

$afterId = trim((string)($_GET['after_id'] ?? ''));

$messages = $liveChat->getMessages($streamGuid, $afterId);

echo json_encode(['success' => true, 'message' => $messages]);