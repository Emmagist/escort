<?php
header('Content-Type: applicatioon/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/giftWallet.php';

if (!isset($_SESSION['token'])) {
    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Login required'
    ]);

    exit;
}

$balance = $giftWalletModel->getBalance($_SESSION['token']);

echo json_encode([
    'success' => true,
    'coins' => $balance
]);