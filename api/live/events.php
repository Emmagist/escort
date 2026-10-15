
<?php

ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../classes/liveEvent.php';

function eventResponse(int $status, array $data): void
{
    http_response_code($status);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    eventResponse(405, [
        'success' => false,
        'message' => 'Method not allowed'
    ]);
}

$userId = trim((string)($_SESSION['token'] ?? ''));
$streamGuid = trim((string)($_GET['stream_id'] ?? ''));
$afterId = filter_var(
    $_GET['after_id'] ?? 0,
    FILTER_VALIDATE_INT
);

if ($userId === '') {
    eventResponse(401, [
        'success' => false,
        'message' => 'Login required'
    ]);
}

if ($streamGuid === '' || $afterId === false || $afterId < 0) {
    eventResponse(422, [
        'success' => false,
        'message' => 'Invalid stream or event cursor'
    ]);
}

try {

    $stream = $db->singleData(TBL_STREAMS, "stream_guid", "stream_guid = '$streamGuid' AND status = 'live'");

    if (!$stream) {
        eventResponse(404, [
            'success' => false,
            'message' => 'Live stream not found'
        ]);
    }

    eventResponse(200, [
        'success' => true,
        'events' => $eventsModel->getSince($streamGuid, $afterId)
    ]);

} catch (Throwable $e) {
    error_log('Live events error: ' . $e->getMessage());

    eventResponse(500, [
        'success' => false,
        'message' => 'Unable to load live events'
    ]);
}
