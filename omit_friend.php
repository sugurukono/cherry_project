<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

$signin_user['id'] = $_SESSION['Cherry']['signin_user_id'];

//フォルダから友達の登録を外す
    if(!empty($_POST['delete_folder_friend'])) {
          //friends_foldersを消す
          $sql = 'DELETE FROM `friends_folders` WHERE `folder_id`=? AND `folder_owner_id`=? AND `friend_id`=?';
          $data = array($_POST['omit_folder_id'],$signin_user['id'],$_POST['omit_friend_id']);
          $stmt = $dbh->prepare($sql);
          $stmt->execute($data);
    }

    header('Location: setting.php');
    exit();

?>