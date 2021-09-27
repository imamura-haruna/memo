<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メモの登録</title>
</head>

<body>
    <h1>メモ登録</h1>
    <form action="store.php" method="POST">
        <label>
            <p>title</p>
            <input type="text" name="title" placeholder="タイトル">
        </label>
        <p>本文</p>
        <textarea name="content" placeholder="本文"></textarea>
        <div class="botton">
            <input type="submit" value="送信">
        </div>
    </form>
</body>

</html>