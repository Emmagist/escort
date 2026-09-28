<?php

header('Content-Type: applicatioon/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/giftTransaction.php';

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
$gift_guid = trim((string)($data['gift_guid'] ?? ''));
$quantity = trim((string)($data['quantity'] ?? 1));

$result = $giftTransactionModel->sendGift($streamGuid, (string)$_SESSION['token'], $gift_guid, $quantity);

echo json_encode($result);