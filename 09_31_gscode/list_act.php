<?php
include("funcs.php");
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM book_bm_table");
$status = $stmt->execute();

$id = $_REQUEST['id'];
if (!is_numeric($id) || $id <=0){
    print('1以上の数字を指定してください');
    exit();
}

$lists = $pdo->prepare('SELECT * FROM book_bm_table where id=?');
$lists->execute(array($id));
$list = $lists->fetch();

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


    <pre>
        タイトル：　<?php print($list['title']); ?><br>
        URL：　<a href="<?php print($list['bookurl']); ?>"><?php print($list['bookurl']); ?></a><br>
        コメント：　<?php print($list['comment']); ?><br>
    </pre>
    <a href="list.php">戻る</a>

</body>
</html>
