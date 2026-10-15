
<?php

// declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/stream.php';

function heartbeatResponse(int $status, array $data): void
{
    http_response_code($status);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    heartbeatResponse(405, [
        'success' => false,
        'message' => 'Method not allowed.'
    ]);
}

$userId = trim((string)($_SESSION['token'] ?? ''));

$input = json_decode(
    file_get_contents('php://input'),
    true
);

$streamGuid = trim((string)($input['stream_id'] ?? ''));

if ($userId === '' || $streamGuid === '') {
    heartbeatResponse(400, [
        'success' => false,
        'message' => 'Authentication and stream ID are required.'
    ]);
}

if (!isset($db->myconn) || !($db->myconn instanceof mysqli)) {
    error_log('Heartbeat: database connection unavailable.');

    heartbeatResponse(500, [
        'success' => false,
        'message' => 'Database connection unavailable.'
    ]);
}

try {
    $stream = $streamModel->find($streamGuid);

    if (!$stream || $stream['status'] !== 'live') {
        heartbeatResponse(404, [
            'success' => false,
            'message' => 'Live stream not found.'
        ]);
    }

    $conn = $db->myconn;

    // Refresh this viewer's heartbeat, or create their record.
    $stmt = $conn->prepare(
        "INSERT INTO stream_viewers
            (stream_guid, user_id, last_seen)
         VALUES (?, ?, NOW())
         ON DUPLICATE KEY UPDATE last_seen = NOW()"
    );

    if (!$stmt) {
        throw new RuntimeException($conn->error);
    }

    $stmt->bind_param('ss', $streamGuid, $userId);
    $stmt->execute();
    $stmt->close();

    // A viewer is active if their heartbeat arrived within 45 seconds.
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

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $activeViewers = (int)($row['total'] ?? 0);

    $stmt->close();

    // Keep the stream's viewer_count in sync with active viewers.
    $stmt = $conn->prepare(
        "UPDATE " . TBL_STREAMS . "
         SET viewer_count = ?
         WHERE stream_guid = ?
           AND status = 'live'"
    );

    if (!$stmt) {
        throw new RuntimeException($conn->error);
    }

    $stmt->bind_param('is', $activeViewers, $streamGuid);
    $stmt->execute();
    $stmt->close();

    heartbeatResponse(200, [
        'success' => true,
        'viewer_count' => $activeViewers
    ]);

} catch (Throwable $e) {
    error_log('Heartbeat error: ' . $e->getMessage());

    heartbeatResponse(500, [
        'success' => false,
        'message' => 'Unable to update viewer heartbeat.'
    ]);
}
