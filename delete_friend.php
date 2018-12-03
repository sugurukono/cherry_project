<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    $signin_user['id'] = $_SESSION['Cherry']['signin_user_id'];

//友達削除
    if(!empty($_POST['delete_friend'])) {
          //signin_userがrequesterだった場合
          // friendsフォルダを消す
          $sql = 'DELETE FROM `friends` WHERE `requester_id`=? AND `accepter_id`=?';
          $data = array($signin_user['id'],$_POST['delete_friend_id']);
          $stmt = $dbh->prepare($sql);
          $stmt->execute($data);
          // chatroomフォルダを消す
          $sql = 'DELETE FROM `chatroom` WHERE `owner_id`=? AND `menber_id`=?';
          $data = array($signin_user['id'],$_POST['delete_friend_id']);
          $stmt = $dbh->prepare($sql);
          $stmt->execute($data);
          //friends_foldersを消す
          $sql = 'DELETE FROM `friends_folders` WHERE `folder_owner_id`=? AND `friend_id`=?';
          $data = array($signin_user['id'],$_POST['delete_friend_id']);
          $stmt = $dbh->prepare($sql);
          $stmt->execute($data);
      }
    header('Location: setting.php');
    exit();

?>