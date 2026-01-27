<?php
require_once __DIR__ . '/constants.php';

function dbConnect() {
  try {
    $dsn = 'pgsql:host=' . DB_SERVER . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ));
    return $pdo;
  } catch (Exception $e) {
    return false;
  }
}

function dbGetChannels($pdo) {
  try {
    $stmt = $pdo->query('SELECT id, name FROM channels ORDER BY id');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    return false;
  }
}
?>
