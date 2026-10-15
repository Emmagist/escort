
<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/stream.php';

function leaveResponse(int $status, array $data): void
{
    http_response_code($status);
    echo json_encode($data);
    exit;
}

$input = json_decode(
    file_get_contents('php://input'),
    true
);

$userId = trim((string)($_SESSION['token'] ?? ''));
$streamGuid = trim((string)($input['stream_id'] ?? ''));

if ($userId === '' || $streamGuid === '') {
    leaveResponse(400, [
        'success' => false,
        'message' => 'Authentication and stream ID are required.'
    ]);
}

try {
    $conn = $db->myconn;

    $stmt = $conn->prepare(
        "DELETE FROM stream_viewers
         WHERE stream_guid = ? AND user_id = ?"
    );

    if (!$stmt) {
        throw new RuntimeException($conn->error);
    }

    $stmt->bind_param('ss', $streamGuid, $userId);
    $stmt->execute();
    $stmt->close();

    // Recalculate active viewers without counting stale heartbeats.
    $stmt = $conn->prepare(
        "SELECT COUNT(*) AS total
         FROM stream_viewers
         WHERE stream_guid = ?
           AND last_seen >= DATE_SUB(NOW(), INTERVAL 45 SECOND)"
    );

    if (!$stmt) {
        throw new RuntimeException($conn->error);
    }

    $stmt->bind_param('s', $streamGuid);
    $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();
    $activeViewers = (int)($row['total'] ?? 0);

    $stmt->close();

    $stmt = $conn->prepare(
        "UPDATE " . TBL_STREAMS . "
         SET viewer_count = ?
         WHERE stream_guid = ? AND status = 'live'"
    );

    if (!$stmt) {
        throw new RuntimeException($conn->error);
    }

    $stmt->bind_param('is', $activeViewers, $streamGuid);
    $stmt->execute();
    $stmt->close();

    leaveResponse(200, [
        'success' => true,
        'viewer_count' => $activeViewers
    ]);

} catch (Throwable $e) {
    error_log('Leave stream error: ' . $e->getMessage());

    leaveResponse(500, [
        'success' => false,
        'message' => 'Unable to update viewer count.'
    ]);
}
