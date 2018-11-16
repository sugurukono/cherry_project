<?php 
    require('dbconnect.php');
    require('functions.php');
    // v($_POST['folder_name'],"$_POST");

    $folder_name=$_POST['folder_name'];
    $user_id=1;

    $sql="INSERT INTO `folders` SET `folder_name`=?, `user_id`=?, created=NOW()";

    $data= array($folder_name,$user_id);
    $stmt=$dbh->prepare($sql);
    $stmt->execute($data);


    header('Location:setting.php');
    exit();


 ?>