<?php
include("funcs.php");
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM book_bm_table");
$status = $stmt->execute();
$lists = $pdo->query('SELECT * FROM book_bm_table ORDER BY id DESC');

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマーク一覧</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<article>
    <?php while ($list = $lists->fetch()): ?>
        <p><a href="list_act.php?id=<?php print($list['id']); ?>"><?php print($list['title']); ?></a></p>
        <hr>
    <?php endwhile; ?>
</article>
<div>
<p><a href="login.php">ログイン画面へ戻る</a></p>
</div>

<!-- Main[End] -->


</body>
</html>
