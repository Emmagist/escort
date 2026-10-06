<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/CoinPackage.php';
require_once __DIR__ . '/../../classes/CoinWallet.php';


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['token']) || trim((string)$_SESSION['token']) === '') {

    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Please login to buy coins'
    ]);
    exit;
}


$userId = trim((string)$_SESSION['token']);


/*
|--------------------------------------------------------------------------
| Read JSON
|--------------------------------------------------------------------------
*/
$data = json_decode(file_get_contents('php://input'), true);

if (!is_array($data)) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);

    exit;
}


/*
|--------------------------------------------------------------------------
| Package
|--------------------------------------------------------------------------
*/
$packageGuid = (string)($data['package_guid'] ?? 0);

if (!$packageGuid) {
    http_response_code(422);

    echo json_encode([
        'success' => false,
        'message' => 'Coin package is required'
    ]);
    exit;
}


try {

    /*
    |--------------------------------------------------------------------------
    | Find package
    |--------------------------------------------------------------------------
    */
    $package = $coinPackage->findByGuid($packageGuid);

    if (!$package) {

        http_response_code(404);

        echo json_encode([
            'success' => false,
            'message' => 'Coin package not found'
        ]);

        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | Calculate coins
    |--------------------------------------------------------------------------
    */
    $coins = (int)$package['coins'];

    $bonusCoins = (int)$package['bonus_coins'];

    $totalCoins = $coins + $bonusCoins;


    if ($totalCoins <= 0) {

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' => 'Invalid coin package'
        ]);

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Generate transaction reference
    |--------------------------------------------------------------------------
    */

    $reference = 'COIN-' . strtoupper(bin2hex(random_bytes(8)));


    /*
    |--------------------------------------------------------------------------
    | LOCAL TEST PURCHASE
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    | This immediately credits the user's wallet.
    |
    | When Paystack/Stripe is added, this section should NOT
    | credit coins directly. The payment gateway webhook should
    | verify the payment first.
    |
    */

    $result = $coinWallet->credit(
        $userId,
        $totalCoins,
        $reference,
        'Purchased ' .
        $package['name'] .
        ' coin package'
    );


    if (!$result) {

        http_response_code(500);

        echo json_encode([
            'success' => false,
            'message' => 'Unable to credit coins'
        ]);

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    */

    echo json_encode([
        'success' => true,
        'message' => 'Coins purchased successfully',
        'purchase' => [
            'reference' => $reference,
            'package_guid' => (string)$package['package_guid'],
            'package_name' => $package['name'],
            'base_coins' => $coins,
            'bonus_coins' => $bonusCoins,
            'total_coins' => $totalCoins,
            'price' => (float)$package['price'],
            'currency' => $package['currency']
        ],
        'wallet' => [
            'balance_before' => $result['balance_before'],
            'balance' => $result['balance_after']
        ]
    ]);
    exit;
} catch (Throwable $e) {

    error_log(
        'Coin purchase API error: ' .
        $e->getMessage()
    );

    http_response_code(501);

    echo json_encode([
        'success' => false,
        'message' => 'Unable to complete coin purchase'
    ]);

    exit;
}