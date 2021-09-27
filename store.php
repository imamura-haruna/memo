<?php

require_once(__DIR__ . '/initPdo.php');
//新しいデータを保存するアクション
$inputTitle = filter_input(INPUT_POST, 'title');
$inputContent = filter_input(INPUT_POST, 'content');

if (empty($inputTitle) || empty($inputContent)) {
    die("未記入の項目があります");
}

try {
    $pdo = initPdo();
    $sql = 'INSERT INTO pages (title, content)
        VALUE (:title, :content)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $inputTitle, PDO::PARAM_STR);
    $stmt->bindValue(':content', $inputContent, PDO::PARAM_STR);
    $result = $stmt->execute();

    if (!$result) {
        throw new Exception('保存に失敗しました');
    }
} catch (Exception $e) {
    die($e->getMessage());
}

header('Location: http://localhost/memo/index.php');
