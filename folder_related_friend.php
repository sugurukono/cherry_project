<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');
    v($_GET['search_friend'],"search_friend");


    $search_friend = $_GET['search_friend']

    $sql= "SELECT * FROM `users` WHERE `id`=?"
    $data= array($search_friend);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    while (true) {
       $related_friend =$stmt->fetch(PDO::FETCH_ASSOC);

      if($related_friend == false){
        break;
      }
      $related_friends[]=$related_friend;
    }


    $related_friends = $_SESSION['Cherry']['related_friend'];

    header('Location: setting.php');
    exit();



?>