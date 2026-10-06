<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/CoinPackage.php';

try {

    $packages = $coinPackage->getActivePackages();

    $response = [];

    foreach ($packages as $package) {

        $baseCoins = (int)$package['coins'];
        $bonusCoins = (int)$package['bonus_coins'];

        $response[] = [
            'id' => (int)$package['id'],
            'package_guid' => $package['package_guid'],
            'name' => $package['name'],
            'coins' => $baseCoins,
            'bonus_coins' => $bonusCoins,
            'total_coins' => $baseCoins + $bonusCoins,
            'price' => (float)$package['price'],
            'currency' => $package['currency']
        ];
    }

    echo json_encode([
        'success' => true,
        'packages' => $response
    ]);

    exit;

} catch (Throwable $e) {

    error_log(
        'Coin packages API error: ' .
        $e->getMessage()
    );

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Unable to load coin packages',
        'packages' => []
    ]);

    exit;
}