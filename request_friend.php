<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    $signin_user['id'] = $_SESSION['Cherry']['signin_user_id'];
    $related_friend['id'] = $_POST['request_friend_id'];
    $all_friend_folder['id'] = $_SESSION['cherry']['all_friend_folder_id'];

    // v($signin_user['id'],'signin_user_id');
    // v($related_friend['id'],'related_friend_id');
    // v($all_friend_folder['id'],'all_friend_folder');

    //友達申請を送る
    if (!empty($_POST['request_friend'])) {
        $sql = 'SELECT * FROM `friends` WHERE `requester_id`=? AND `accepter_id`=?';
        $data= array($signin_user['id'],$related_friend['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
      //初めてのリクエストだったら
      if ($record == false) {
            //相手からのリクエストがないか確認しなきゃいけない
            $sql = 'INSERT INTO `friends` SET `requester_id`=?, `accepter_id`=?, `status`=1,`create_date`= NOW()';
            $data = array($signin_user['id'],$related_friend['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            //友達一覧に相手を追加する
            $sql = 'INSERT INTO `friends_folders` SET folder_id=?, friend_id=?, folder_owner_id=?';
            $data = array($all_friend_folder['id'],$related_friend['id'],$signin_user['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

      //２回目以降のリクエストだったら
      }else{
            $update_sql = 'UPDATE `friends` SET `status`=1,`update_date`= NOW() WHERE `requester_id`=? AND`accepter_id`=?';
            $data = array($signin_user['id'],$related_friend['id']);
            $stmt = $dbh->prepare($update_sql);
            $stmt->execute($data);
      }
    }

    header('Location: setting.php');
    exit();


?>