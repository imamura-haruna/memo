<?php
require_once(__DIR__ . '/initPdo.php');

$search = filter_input(INPUT_GET, 'search');
$newSort = filter_input(INPUT_GET, 'sort_new');

try {
    $pdo = initPdo();

    if (!empty($search)) {
        $search = "%" . $search . "%";
        $sql = 'SELECT * FROM pages WHERE content LIKE :keyword';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':keyword', $search, PDO::PARAM_STR);
        $stmt->execute();
        $memoList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } elseif (!empty($newSort)) {
        //レコードの並び替え
        $sql = 'SELECT * 
            FROM pages 
            ORDER BY updated_at DESC';
        //sql文の実行準備
        $stmt = $pdo->prepare($sql);
        //sqlを実行する
        $stmt->execute();
        //取得したデータの全ての配列として取得する
        $memoList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        //pageテーブルにある全てのデータを取得するSQL文
        $sql = 'SELECT * 
            FROM pages';
        //sql文の実行準備
        $stmt = $pdo->prepare($sql);
        //sqlを実行する
        $stmt->execute();
        //取得したデータの全ての配列として取得する
        $memoList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="index.php" method="get">
        <input type="search" name="search" placeholder="キーワードを入力">
        <input type="submit" name="submit" value="検索">
    </form>

    <h1>メモ一覧</h1>

    <div class="mb-10">
        <a href="create.php">メモを追加</a>

        <div class="float-right">
            <form action="index.php" method="get">
                <input type="submit" name="sort_new" value="新しい順">
                <input type="submit" name="sort_old" value="古い順">
            </form>
        </div>
    </div>

    <table id="memo_table" class="table">
        <tr>
            <th>タイトル</th>
            <th>内容</th>
            <th>日時</th>
            <th>編集</th>
            <th>消去</th>

        </tr>
        <?php foreach ($memoList as $memo) : ?>
            <tr>
                <td><?php echo $memo['title']; ?></td>
                <td><?php echo $memo['content']; ?></td>
                <?php if (!empty($memo['updated_at'])) : ?>
                    <td><?php echo $memo['updated_at']; ?></td>
                <?php else : ?>
                    <td><?php echo $memo['created_at']; ?></td>
                <?php endif; ?>
                <!-- 指定のidのリンクに飛ぶようにする -->
                <!-- post=getの役割？？ -->
                <td><a href="edit.php?id=<?php echo $memo['id']; ?>">編集</a></td>
                <td><a href="delete.php?id=<?php echo $memo['id']; ?>">消去</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>