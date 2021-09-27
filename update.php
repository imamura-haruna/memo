<?php
require_once(__DIR__ . '/initPdo.php');
require_once(__DIR__ . '/redirect.php');

$updateTitle = filter_input(INPUT_POST, 'title');
$updateContent = filter_input(INPUT_POST, 'content');
$id = filter_input(INPUT_POST, 'id');
try {
    $pdo = initPdo();

    $sql = 'UPDATE pages SET title = :title, content = :content WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $updateTitle, PDO::PARAM_STR);
    $stmt->bindValue(':content', $updateContent, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    redirect('http://localhost/memo/index.php');
} catch (PDOException $e) {
    die($e->getMessage());
}
