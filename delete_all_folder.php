<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    $signin_user['id'] = $_SESSION['Cherry']['signin_user_id'];

//フォルダーの全件削除
    //POST送信があったら
    if(!empty($_POST['delete_all_folder'])) {
        //友達一覧フォルダを読み出しそのidを変数化
        $sql = 'SELECT * FROM `folders` WHERE `folder_name`="友達一覧" AND `user_id`=?';
        $data = array($signin_user['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $folder =$stmt->fetch(PDO::FETCH_ASSOC);
        $folder_id = $folder['id'];
        // v($folder,'folder');

        $sql = 'DELETE FROM `friends_folders` WHERE `folder_owner_id`=? AND `folder_id`<>?';
        $data = array($signin_user['id'],$folder_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        $sql = 'DELETE FROM `folders` WHERE `user_id`=? AND `id`<>?';
        $data = array($signin_user['id'],$folder_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }

    header('Location: setting.php');
    exit();

?>