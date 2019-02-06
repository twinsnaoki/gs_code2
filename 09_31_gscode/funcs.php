<?php
//共通に使う関数を記述


function h($a)
{
    return htmlspecialchars($a, ENT_QUOTES);
}


function db_conn(){
    try {
        $pdo = new PDO('mysql:dbname=book_db;charset=utf8;host=localhost','root','');
        return $pdo;  //functionの外に出す(グローバルへ)
      } catch (PDOException $e) {
        exit('DB-Connection-Error:' .$e->getMessage());
      }
}


function sqlError($stmt){
    $error = $stmt->errorInfo();
    exit("ErrorSQL:".$error[2]);
}


function redirect($page){
    header('Location: '.$page);
    exit;
}

 //グローバル変数しか使っていないから何も渡さなくてもよい 
 function sessChk(){
    if(!isset($_SESSION["chk_ssid"]) ||  //もしチェックSSIDがなかったり(または)
        $_SESSION["chk_ssid"]!=session_id()){  //セッションIDとチェックSSIDが違っていたりしたら
        exit("error");
    }else{  //成功した時
        session_regenerate_id(true);  //trueがないと新しいファイルが作られ続ける
        $_SESSION['chk_ssid']=session_id();
    }
}