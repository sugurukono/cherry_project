<?php 
    session_start();
    require('dbconnect.php');
    require('functions.php');
    // v($_POST['folder_name'],"$_POST");
    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $folder_name=$_POST['folder_name'];
    $user_id= $signin_user['id'];

    $sql="INSERT INTO `folders` SET `folder_name`=?, `user_id`=?, created=NOW()";
    $data= array($folder_name,$user_id);
    $stmt=$dbh->prepare($sql);
    $stmt->execute($data);



    header('Location: setting.php');
    exit();


 ?>