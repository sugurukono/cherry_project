<?php
    session_start();
    require('functions.php');

    // v($_POST,'$_POST');

    $validations = array();
    $name = '';
    $email = '';
    $password = '';
    $password_2 ='';

    if (!empty($_POST)) {

      $name= $_POST['name'];
      $email= $_POST['email'];
      $password = $_POST['password'];
      $password_2 = $_POST['password_2'];

          if ($name == '') {
            $validations['name'] = 'blank';
          }

          if ($email == '') {
            $validations['email'] = 'blank';
          }
          $c = strlen($password);
          if ($password == '') {
            $validations['password'] = 'blank';
          }elseif ($c < 4 || 16 <$c) {
            $validations['password'] = 'length';
          }

          if ($password_2 == ''){
            $validations['password_2'] ='blank';

          }
          elseif($password_2 != $password ) {
            $validations['password_2'] = 'different';
          }//実装できないので聞く



          if (empty($validations)) {
            $_SESSION['Cherry_reg']['name'] = $name;
            $_SESSION['Cherry_reg']['email'] = $email;
            $_SESSION['Cherry_reg']['password'] = $password;
            $_SESSION['Cherry_reg']['password_2'] =$password_2;

            header('Location: check.php');
            exit();

          }


    }



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
      <ul class="list"> 
    </div>
  </div>
<!-- ヘッダー終わり -->

<!-- 登録部分 -->
  <div class="row">
    <div class="col-xs-9" style="background-color:white; height:750px">

      <h1 class="text_new">新規会員登録<span class="text_new2">New Register</span></h1>
    <div >
        <form method="POST" action="">
<!-- 名前 -->
          <input type="text" name="name" placeholder="Name" class="text" value="<?=$name; ?>">
          <?php if (isset($validations['name']) && $validations['name'] == 'blank'):?>
            <p> <span class="error_msg">お名前を入力ください。</span></p>
          <?php endif; ?>


<!-- メールアドレス -->
          <input type="email" name="email" placeholder="Email" class="text" value="<?=$email; ?>">
          <?php if (isset($validations['email']) && $validations['email'] == 'blank'):?>
            <p><span class="error_msg">メールアドレスを入力ください。</span></p>
          <?php endif; ?>


<!-- パスワード -->
          <input type="password" name="password" placeholder="Password" class="text" >
          <?php if(isset($validations['password'])&& $validations['password'] == 'blank'): ?>
            <p><span class="error_msg">パスワードを入力してください。</span></p>
          <?php endif; ?>
          <?php if(isset($validations['password']) && $validations['password'] == 'length'): ?>
            <p> <span class="error_msg">パスワードは４〜１６文字で設定してください。</span></p>
          <?php endif; ?>


<!-- パスワード確認用 -->
          <input type="password" name="password_2" placeholder="確認用 Password" class="text">
          <?php if(isset($validations['password_2'])&& $validations['password_2'] == 'blank'): ?>
            <p><span class="error_msg">パスワードを入力してください。</span></p>
          <?php endif; ?>
            <?php if(isset($validations['password_2']) && $validations['password_2'] == 'different'):?>
            <p><span class="error_msg">上記と同じパスワードを入力ください。</span></p>
          <?php endif; ?>


          <div class="center"><input type="submit" class="square_btn" value="確認">
          </div>


        </form>
    </div>
    </div>
<!--  登録部分 -->


    <!-- バナー -->
    <div class="col-xs-3" style="background-color:#DDDDDD; height:750px">
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