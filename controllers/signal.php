<?php
// signal.php
// Simple signaling endpoint (file-based). NOT production-ready.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Egulias\EmailValidator\EmailValidator;

require_once "ajaxRequest.php";


header('Content-Type: application/json');
$storage = __DIR__ . '/webrtc_signal.json';
$method = $_SERVER['REQUEST_METHOD'];

if (!file_exists($storage)) {
    file_put_contents($storage, json_encode(['offer' => null, 'answer' => null, 'offer_time' => null, 'answer_time' => null]));
}

$data = json_decode(file_get_contents($storage), true);

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

if ($action === 'post_offer' && $method === 'POST') {
    $payload = file_get_contents('php://input'); // raw SDP JSON
    // store offer
    $data['offer'] = json_decode($payload, true);
    $data['offer_time'] = date('c');
    // clear old answer when new offer arrives
    $data['answer'] = null;
    $data['answer_time'] = null;
    file_put_contents($storage, json_encode($data));
    echo json_encode(['ok' => true]);
    exit;
}

if ($action === 'post_answer' && $method === 'POST') {
    $payload = file_get_contents('php://input');
    $data['answer'] = json_decode($payload, true);
    $data['answer_time'] = date('c');
    file_put_contents($storage, json_encode($data));
    echo json_encode(['ok' => true]);
    exit;
}

if ($action === 'get_offer') {
    echo json_encode(['offer' => $data['offer'], 'offer_time' => $data['offer_time']]);
    exit;
}

if ($action === 'get_answer') {
    echo json_encode(['answer' => $data['answer'], 'answer_time' => $data['answer_time']]);
    exit;
}

// clear (for testing)
if ($action === 'clear') {
    $data = ['offer' => null, 'answer' => null, 'offer_time' => null, 'answer_time' => null];
    file_put_contents($storage, json_encode($data));
    echo json_encode(['ok' => true]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'invalid action']);
