<?php

require_once(__DIR__ . '/initPdo.php');

try {
    // $id = $_GET['id'] ?? null;
    $id = filter_input(INPUT_GET, 'id');

    if (empty($id)) {
        throw new Exception('IDを指定してください');
    }

    $pdo = initPdo();

    // idを指定してデータを呼び出すSQL文
    $sql = 'SELECT * 
        FROM pages
        WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    // 受け取ったidをSQL文にセット
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $memo = $stmt->fetch(PDO::FETCH_ASSOC);

    // 対象のIDのメモがテーブルに存在しなかった場合
    if (empty($memo)) {
        throw new Exception('存在しないメモです');
    }
} catch (Exception $e) {
    die($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <title>メモアプリ</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>編集</h1>
    <form action="update.php" method="post">
        <!-- $memoが空でなければhtmlに表示させる -->

        <div>
            <label>title</label>
            <input type="text" name="title" value="<?php if (!empty($memo['title'])) echo (htmlspecialchars($memo['title'], ENT_QUOTES, 'UTF-8')); ?>">
        </div>

        <div>
            <label>本文</label>
            <input type="text" name="content" value="<?php if (!empty($memo['content'])) echo (htmlspecialchars($memo['content'], ENT_QUOTES, 'UTF-8')); ?>">
        </div>

        <!-- どのMemoを更新したいのかの目印の役割 -->
        <input type="hidden" name="id" value="<?php if (!empty($memo['id'])) echo (htmlspecialchars($memo['id'], ENT_QUOTES, 'UTF-8')); ?>">

        <input type="submit" value="編集する">
    </form>
</body>