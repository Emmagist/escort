<?php

require_once __DIR__ . '/../config/db.php';

$update = $db->update(
    TBL_SUBSCRIPTIONS,
    "sub_status = 'inactive'",
    "end_date < NOW() AND sub_status = 'active'"
);

if ($update) {
    echo "Expired subscriptions updated successfully.\n";
} else {
    echo "No subscriptions were updated.\n";
}