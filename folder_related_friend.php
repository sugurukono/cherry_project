<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');
    // v($_GET['check_folder'],'check_folder');
    // v($_SESSION['cherry']['related_friend'],"$_SESSION[cherry][related_friend]");


    $friend_id=$_SESSION["cherry"]["related_friend"]["id"];
    // 空が左、右がデータが入っている。

    // v($friend_id,'$friend_id');


    $check_folder = $_GET['check_folder'];

    $sql='SELECT * FROM `folders` WHERE `id`=?';
    $data= array($check_folder);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $folder_name=$stmt->fetch(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM `friends_folders` WHERE `folder_id`=? AND `friend_id`=? AND `folder_owner_id`=?';
    $data= array($folder_name['id'],$friend_id,$folder_name['user_id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $record=$stmt->fetch(PDO::FETCH_ASSOC);
    // v($folder_name,'$folder_name');
        if ($record == false) {
            //初めてのフォルダ追加だったら
            $sql='INSERT INTO `friends_folders` SET `folder_id`=?, `friend_id`=?, `folder_owner_id`=?, `created`=NOW();';
            $data= array($folder_name['id'],$friend_id,$folder_name['user_id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
            //重複した友達追加だったら
        }else{
            $update_sql = 'UPDATE `friends_folders` SET `updated`= NOW() WHERE `folder_id`=? AND `friend_id`=? AND `folder_owner_id`=?';
            $data = array($folder_name['id'],$friend_id,$folder_name['user_id']);
            $stmt = $dbh->prepare($update_sql);
            $stmt->execute($data);
        }

    header('Location: setting.php');
    exit();



?>