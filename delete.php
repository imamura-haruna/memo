<?php

require(__DIR__ . '/initPdo.php');
require(__DIR__ . '/redirect.php');

$id = filter_input(INPUT_GET, 'id');

try {
    $pdo = initPdo();
    $sql = 'DELETE FROM pages WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
} catch (Exception $e) {
    die($e->getMessage());
}

$path = 'http://localhost/memo/index.php';
redirect($path);
