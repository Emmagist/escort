```php
<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../classes/stream.php';
require_once __DIR__ . '/../classes/LiveGift.php';


if (empty($_SESSION['token'])) {

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


$streamGuid =
    trim((string) ($data['stream_id'] ?? ''));

$giftGuid =
    trim((string) ($data['gift_id'] ?? ''));

$quantity =
    (int) ($data['quantity'] ?? 1);


if ($streamGuid === '' || $giftGuid === '') {

    http_response_code(422);

    echo json_encode([
        'success' => false,
        'message' => 'Stream and gift are required'
    ]);

    exit;
}


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
        'message' => 'Stream is no longer live'
    ]);

    exit;
}


$senderId =
    (string) $_SESSION['token'];


$streamerId =
    (string) $stream['user_id'];


$result =
    $liveGiftModel->send(
        $streamGuid,
        $senderId,
        $streamerId,
        $giftGuid,
        $quantity
    );


echo json_encode($result);
