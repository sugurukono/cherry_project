<?php
//DBに接続
session_start();
require('../functions.php');
require('../dbconnect.php');
//http://localhost/LearnSNS/delete.php?feed_i=d10
//というURLでここのファイルにアクセスすると、？以降のfeed_idがGET送信されてくる
//$_GET["feed_id"]には１０が格納されている
v($_GET['pic_id'],"pic_id");


//削除「したいFeedのIDを取得
$pic_id=$_GET['pic_id'];


//Delete文を作成(SQLインジェクションを防ぐ)
$sql="DELETE FROM `pics` WHERE `pics` .`id`=?";

//実行
$data=array($_GET['pic_id']);
$stmt=$dbh->prepare($sql);
$stmt->execute($data);

//タイムライン一覧に戻る
header("Location: album01.php");
exit();


?>