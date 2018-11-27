<?php 
    session_start();
    require('functions.php');
    require('dbconnect.php');

    var_dump($_GET);
    var_dump($_SESSION['id']);
    $user_id=$_SESSION['id'];
    $comment=$_GET['comment'];
    $magic_com=$_GET['magic_com'];
    $time=$_GET['time'];

    if (!empty($_GET)) {
      $time=$_GET['time'];

        if ($time== 'now') {
        $sql='INSERT INTO `magic_changes`SET `user_id`=?, `comment`=?, `magic_comment`=?, `change_time`=0, `created`=NOW()';
        $data = array($user_id,$comment,$magic_com);
        }elseif($time=='1hour'){
        $sql='INSERT INTO `magic_changes`SET `user_id`=?, `comment`=?, `magic_comment`=?, `change_time`=1, `created`=NOW()';
        $data = array($user_id,$comment,$magic_com);

        }elseif ($time=='12hour') {
        $sql='INSERT INTO `magic_changes`SET `user_id`=?, `comment`=?, `magic_comment`=?, `change_time`=2, `created`=NOW()';
        $data = array($user_id,$comment,$magic_com);


        }elseif ($time=='24hour') {
        $sql='INSERT INTO `magic_changes`SET `user_id`=?, `comment`=?, `magic_comment`=?, `change_time`=3, `created`=NOW()';
        $data = array($user_id,$comment,$magic_com);
        }
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }


    header('Location: talk_main1.php');
    exit();





?>