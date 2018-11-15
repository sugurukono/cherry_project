<?php
    session_start();
    require('functions.php');

    $name = $_SESSION['Cherry_reg']['name'];
    $email =$_SESSION['Cherry_reg']['email'];
    $password =$_SESSION['Cherry_reg']['password'];
    $password_2=$_SESSION['Cherry_reg']['password_2'];


    if(!isset($_SESSION['Cherry_reg'])){
      header('Location:signup.php');
    }

    v($_POST,'$_POST');




?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="top.css">
  <link rel="stylesheet" type="text/css"  href="registers.css">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:700 rel="stylesheet">
</head>
<body>
<!-- ヘッダー 開始-->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height: 90px">
      <h1 class="title" style="color:white;">🍒Cherry</h1>
      
    </div>
  </div>
<!-- ヘッダー終わり -->

<!-- 登録部分 -->
  <div class="row">
    <div class="col-xs-9" style="background-color:white; height:700px">

      <h1 class="text_new">登録情報確認<span class="text_new2">Check Please</span></h1>
    <div >
        <p class="check"><span class="under">お名前：<?= $name ?></span></p>
               <p class="check"><span class="under">メールアドレス：<?= $email ?></span></p>
        <p class="check"><span class="under">パスワード：●●●●●●●●●●●●</span></p>
        <p class="check">上記の内容でお間違えないでしょうか？</p>

          <form method="POST" action="thanks.php">

          <div class="center">
            <input type ="button" class="square_btn3" value="戻る" onclick="history.back()">
            <input type="submit" class="square_btn2" value="アカウント作成">

          </div>




        </form>
    </div>
    </div>
<!--  登録部分 -->


    <!-- バナー -->
    <div class="col-xs-3" style="background-color:#DDDDDD; height:700px">
      <div class="box5">
      <p>広告</p>
      </div>
      <div class="box5">
      <p>広告</p>
      </div>
      <div class="box5">
      <p>広告</p>
      </div>
    </div>
  </div>
<!-- バナー終わり -->


<!-- フッター -->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height:50px">
      <p  class="footer">Designed by Cherry</p>
    </div>
  </div>
<!-- フッター終わり -->


</body>
</html>