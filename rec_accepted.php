<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

// リクエストを受け付けた場合
    $user_id=$_SESSION['id'];

    if (!empty($_GET['accept'])) {
        v($_GET['accepted'],'$_GET[accepted]');
        $accepts=array();
        $accepts=$_GET['accepted'];
        foreach ($accepts as $accept) {
            v($accept,'$accept');
            $sql='UPDATE `friends` SET `status`=2,`update_date`=NOW() WHERE `requester_id`=? AND `accepter_id`=?';
            $data=array($accept,$user_id);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
        }

        //全友だちファイルの中にユーザーの登録しているフレンド全てを入れる。
        // $sql='SELECT * FROM `friends` WHERE `requester_id`=? AND `accepter_id`=? AND `status`=2';
        // $data=array($accept,$user_id);
        // $stmt = $dbh->prepare($sql);
        // $stmt->execute($data);

        // while (true) {
        //   $exist_friend=$stmt->fetch(PDO::FETCH_ASSOC);
        // if ($exist_friend==false) {
        //   break;
        // }
        //   $exist_friends[]=$exist_friend;
        //   v($exist_friends,'$exist_friends');
        // }

        // if(!empty($exist_friends)){
        //   foreach($exist_friends as $exist_f_each);

        //   v($exist_f_each,'$exist_f_each');

          $sql='INSERT INTO `friends_folders` SET `folder_id`=1,`friend_id`=?, `folder_owner_id`=?';
          $data=array($accept,$user_id);
          $stmt = $dbh->prepare($sql);
          $stmt->execute($data);
        }
        // v($exist_friend,'$exist_friend');
        // v($exist_friend2,'$exist_friend2');

// リクエストを削除した場合
    if (!empty($_GET['block'])) {
      v($_GET['accepted'],'$_GET[accepted]');
      $blocks=array();
      $blocks=$_GET['accepted'];
      foreach($blocks as $block){
        v($block,'$block');
        $sql='DELETE FROM `friends` WHERE `requester_id`=? AND `accepter_id`=? AND `status`=1';
        $data=array($block,$user_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
      }

    }

    header('Location: talk_main1.php');
    exit();







?>