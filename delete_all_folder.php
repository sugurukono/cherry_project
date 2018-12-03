<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    $signin_user['id'] = $_SESSION['Cherry']['signin_user_id'];

//フォルダーの全件削除
    if(!empty($_POST['delete_all_folder'])) {

        $sql = 'DELETE FROM `friends_folders` WHERE `folder_owner_id`=?';
        $data = array($signin_user['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        $sql = 'DELETE FROM `folders` WHERE `user_id`=?';
        $data = array($signin_user['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }

    header('Location: setting.php');
    exit();

?>