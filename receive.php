<?php
$bluaBlueInstance = 'http://localhost:8080';
header("Access-Control-Allow-Origin: $bluaBlueInstance", false);
header("Content-Type: application/json");
if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}
if (!file_exists('articles')) {
    mkdir("articles/" , 0777);
}

$data = file_get_contents('php://input');
if ($data) {
    file_put_contents('log.json', $data);
    $converted = json_decode($data, true);
    $fileName = 'articles/' . $converted['payload']['slug'] . '.json';
    if ($converted['event'] === 'deleted') {
        unlink($fileName);
    } else {
        file_put_contents($fileName, json_encode($converted['payload']));
    }

}
echo json_encode(['received' => true]);
