<?php 
    session_start();
    require('dbconnect.php');
    require('functions.php');

    $folder[]=$_GET['folder'];



    $sql='SELECT * FROM `users` INNER JOIN `friends_folders`
    ON `friends_folders`.`friend_id`= `users`.`id` WHERE `friends_folders`.`folder_owner_id`=?';
    $data= array($_SESSION['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $friends=[];

    while(true){
      $friend =$stmt->fetch(PDO::FETCH_ASSOC);

      if($friend == false){
        break;
      }
      $friends[]=$friend;
    }









?>