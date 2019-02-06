<?php
//最初にSESSIONを開始！！
session_start();

//0.外部ファイル読み込み
include("funcs.php");
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
  // $lpw = password_hash($lpw, PASSWORD_DEFAULT);

//1.  DB接続します
$pdo = db_conn();

//2. データ登録SQL作成
$sql = 'SELECT * FROM bk_user_table WHERE lid=:id AND life_flg=0';   
//life_flgの値を０に決め打ちしておけば退会した人ははいれないようにできる
//:のバインド関数はスペースは入れない
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $lid);
$res = $stmt->execute();

//3. SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//4. 抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//5. 該当レコードがあればSESSIONに値を代入
// セキュリティを高めるためにこうする
if(password_verify($lpw, $val['lpw'])){
// if( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id(); //ユニークキーを取得
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  header("Location: select.php");
}else{
  //logout処理を経由して全画面へ
  header("Location: login.php");
}

exit();
?>

