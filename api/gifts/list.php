<?php

header('Content-Type: applicatioon/json');

require_once __DIR__ . '/../../config/db.php';

$gifts = [];

$gifts = $db->selectAsc(TBL_LIVE_GIFTS, "*", "is_active = 1", "coins");

echo json_encode([
    'success' => true,
    'gifts' => $gifts
]);