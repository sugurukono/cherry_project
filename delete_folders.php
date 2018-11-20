<?php 
    require('dbconnect.php');
    require('functions.php');
    v($_GET['folder_id'],"folder_id");

// 削除したいFeedのIDを取得
    $folder_id = $_GET['folder_id'];


// Delete文作成
    $sql = "DELETE FROM `folders` WHERE `folders`.`id`=?";



// Delete文実行(SQLインジェクションを防ぐ)
    $data = array($folder_id);//消したいデータ全部を何を使って引っ張ってくるか？の指定
    $stmt = $dbh->prepare($sql); //SQL文を用意。
    $stmt->execute($data);//$dataのデータを元に、全部消去！



// タイムライン一覧にもどる
    header('Location: setting.php');
    exit();










?>