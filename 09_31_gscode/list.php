<?php
include("funcs.php");
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM book_bm_table");
$status = $stmt->execute();

$page = $_REQUEST['page'];
if ($page == ''){
    $page = 1;
}
$page = max($page, 1); //1以下にはならない処理
$counts = $pdo->query('SELECT COUNT(title) AS cnt FROM book_bm_table'); //最大値以上にならないようにする
$cnt = $counts->fetch();
$maxPage = ceil($cnt['cnt'] / 5);
$page = min($page, $maxPage);

$start = ($page - 1) * 5; 
$lists = $pdo->prepare('SELECT * FROM book_bm_table ORDER BY id DESC LIMIT ?, 5');
$lists->bindParam(1, $start, PDO::PARAM_INT);
$lists->execute();

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

<ul class="paging">
    <?php if ($page > 1): ?>
    <li><p><a href="list.php?page=<?php print($page -1); ?>">前のページへ</a></p></li>
    <?php else: ?>
    <li>前のページへ</li>
    <?php endif; ?>

    <?php if ($page < $maxPage): ?>
    <li><p><a href="list.php?page=<?php print($page +1); ?>">次のページへ</a></p></li>
    <?php else: ?>
    <li>次のページへ</li>
    <?php endif; ?>
</ul>



<p><a href="login.php">ログイン画面へ戻る</a></p>
</div>

<!-- Main[End] -->


</body>
</html>
