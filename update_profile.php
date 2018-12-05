<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['error']=array();
    $error =array();


    if (!empty($_POST)) {

        $user_name = $_POST["name"];
        $search_id = $_POST["id"];
        $email = $_POST["email"];

        if ($user_name == '') {
            $error['user_name'] = 'blank';
        }
        if ($search_id == '') {
            $error['search_id'] = 'blank';
        }
        if ($email == '') {
            $error['email'] = 'blank';
        }
        if (empty($error)) {

            if (!empty($_FILES['img_name']['name'])) {
                $tmp_file = $_FILES['img_name']['tmp_name'];
                $user_img = date('YmdHis') . $_FILES['img_name']['name'];
                $destination = 'user_img/' . $user_img;
                move_uploaded_file($tmp_file, $destination);

            }else{
                $user_img = $signin_user['user_img'];
            }
            $update_sql = "UPDATE `users` SET `user_img`=?,`user_name`=?,`search_id`=?,`email`=?,`comments`=? WHERE id=?";
            $data = array($user_img,$_POST["name"],$_POST["id"],$_POST["email"],$_POST["comments"],$_SESSION["id"]);
            $stmt = $dbh->prepare($update_sql);
            $stmt->execute($data);
            header("Location: setting.php");
            exit();
            
        }else{
          //$errorをセッション変数に保存（setting.phpで使用したいから）
            $_SESSION['error']['name'] = $error['user_name'];
            $_SESSION['error']['search_id'] = $error['search_id'];
            $_SESSION['error']['email'] = $error['email'];
          //setting.phpに戻る
            header("Location: setting.php");
            exit();
        }
    }

?>