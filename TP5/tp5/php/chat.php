<?php
require_once __DIR__ . '/database.php';

ini_set('display_errors', '1');
error_reporting(E_ALL);

$db = dbConnect();
if ($db === false) {
  http_response_code(500);
  exit;
}

if (isset($_GET['request']) && $_GET['request'] === 'channels') {
  $channels = dbGetChannels($db);
  if ($channels === false) {
    http_response_code(500);
    exit;
  }

  if (isset($_GET['format']) && $_GET['format'] === 'raw') {
    print_r($channels);
    exit;
  }

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($channels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>
