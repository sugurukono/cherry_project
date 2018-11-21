<?php
    session_start();
    require('dbconnect.php');

    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($_POST)) {
        $update_sql = "UPDATE `users` SET `user_img`=?,`user_name`=?,`search_id`=?,`email`=?,`comments`=? WHERE id=?";
        $data = array($_POST["user_img"],$_POST["name"],$_POST["id"],$_POST["email"],$_POST["comments"],$_SESSION["id"]);
        $stmt = $dbh->prepare($update_sql);
        $stmt->execute($data);
        header("Location: setting.php");
        exit();

    }

?>