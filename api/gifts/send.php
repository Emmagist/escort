<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/giftTransaction.php';


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

if (
    !isset($_SESSION['token']) ||
    trim((string)$_SESSION['token']) === ''
) {

    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Login required'
    ]);

    exit;
}


/*
|--------------------------------------------------------------------------
| Read JSON request
|--------------------------------------------------------------------------
*/

$raw = file_get_contents('php://input');

$data = json_decode($raw, true);

if (!is_array($data)) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Invalid request data'
    ]);

    exit;
}


/*
|--------------------------------------------------------------------------
| Request parameters
|--------------------------------------------------------------------------
*/

$streamGuid = trim(
    (string)($data['stream_id'] ?? '')
);

$giftGuid = trim(
    (string)($data['gift_guid'] ?? '')
);

$quantity = (int)(
    $data['quantity'] ?? 1
);


/*
|--------------------------------------------------------------------------
| Validate request
|--------------------------------------------------------------------------
*/

if ($streamGuid === '') {

    http_response_code(422);

    echo json_encode([
        'success' => false,
        'message' => 'Stream ID is required'
    ]);

    exit;
}


if ($giftGuid === '') {

    http_response_code(422);

    echo json_encode([
        'success' => false,
        'message' => 'Gift ID is required'
    ]);

    exit;
}


$quantity = max(1, min($quantity, 100));


/*
|--------------------------------------------------------------------------
| Sender
|--------------------------------------------------------------------------
*/

$senderId = trim(
    (string)$_SESSION['token']
);


/*
|--------------------------------------------------------------------------
| Send gift
|--------------------------------------------------------------------------
*/

try {

    $result = $giftTransactionModel->sendGift($streamGuid, $senderId, $giftGuid, $quantity);

    /*
    |--------------------------------------------------------------------------
    | Failed
    |--------------------------------------------------------------------------
    */
    if (!$result['success']) {
        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' => $result['message'] ?? 'Unable to send gift'
        ]);

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

    echo json_encode([
        'success' => true,
        'message' => 'Gift sent successfully',

        'gift' => $result['gift'],

        'coins_spent' => $result['coins_spent'],

        'streamer_coins' => $result['streamer_coins'],

        'balance' => $result['balance'],

        'transaction_guid' => $result['transaction_guid']
    ]);

    exit;

} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Unable to process gift',
        'error' => $e->getMessage()
    ]);

    exit;
}