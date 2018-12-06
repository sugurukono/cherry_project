<?php
    session_start();
    // require('functions.php');
    require('dbconnect.php');

    // v($_POST, '$_POST');

    $validations = array();

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email != '' && $password != '') {
          // 空じゃなければSQLぶんをここに書く。
          $sql = 'SELECT * FROM `users` WHERE `email` =?';
          $stmt = $dbh->prepare($sql);
          $data = [$email];
          $stmt->execute($data);
          $record = $stmt->fetch(PDO::FETCH_ASSOC);



          if ($record == false) {
              $validations['signin'] = 'failed';
          }else{
              //パスワードの照合をかける
              $verify=password_verify($password, $record['password']);//一致していたらtrue
              if ($verify == true) {
                  //サインイン成功
                  $_SESSION["id"] = $record["id"];
                  header('Location: talk_main1.php');
                  exit();
              }else{
                  //パスワードミスったら
                  $validations['signin'] = 'failed';

              }
              }
          }else{
          //そうじゃなければblank
          $validations['signin'] = 'blank';
          
        }
    }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
   <style>
    .error_msg{
      color:red;
    }
  </style>
  <link rel="stylesheet" type="text/css"  href="top.css">
</head>
<body>
<!-- ヘッダー 開始-->
  <div class="row" >
    <div class="col-xs-12" style="background-color: pink; height: 90px" id="header">
      <h1 class="title" style="color:white;">🍒Cherry</h1>
      <ul class="list"> 
            <li class="words"><a href="#1">About Us</a>
            </li>
            <li class="words"><a href="#2">How To Use</a>
            </li>

            <a href="signup.php"><li class="signup_button">
            新規登録</li></a>
            
         </ul>
    </div>
  </div>
<!-- ヘッダー終わり -->
  <div class="img top_img">
    <div class="container">
      <div class="top_title">
        <h4>Cherry</h4>
      <div>
      <br>
      <form method="POST" action="" >
      <input class="login" type="email" name="email" placeholder="Email address" >
      <?php if(isset($validations['signin'])&& $validations['signin'] == 'blank'): ?>
        <span class="error_msg">メールアドレスが間違っています。</span>
      <?php endif; ?>

      <?php if(isset($validations['signin'])&& $validations['signin'] == 'failed'): ?>
        <span class="error_msg">サインインに失敗しました。</span>
      <?php endif; ?>
      </div>

      <div>
        <input class="login" type="password" name="password" placeholder="password"></div>
      <input class="login_button" type="submit" value="Login">
      </form>
    </div>
  </div>
   </div>
   </div>
<!-- トップ画終わり -->

  <div class="row">
    <div class="col-xs-12"  style="background-color: black; height:70px"><span class="a" float=center id="1">About Us</span></div>
  </div>
 
  <div class="row">
    <div class="col-xs-12"  style="background-color: black; height:400px">
       <div class="b"><p>人には誰でも、秘密にしておきたいことがあるものです。<br>
       私たちは、あなたが秘密にしておきたいトークや写真を<span class="yellow">守る場所</span>を提供します。</p></div>
 
      <div class="pic"><img src="img/d.jpg"></div>
      <div class="pic"><img src="img/sss1.jpg"></div>
      <div class="pic"><img src="img/a.jpg"></div>
    </div>
    </div>


      
 

    <div class="row">
    <div class="col-xs-4" style="background-color:black; height:300px"><p class="explain">あなたの選んだ友達や大切な人とのトークルームがあります。その内容がもし他の人に見られても問題がないように、知られたくないワードを<span class="yellow">別の文字に変換</span>することができます。</p></div>

    <div class="col-xs-4" style="background-color:black; height:300px"><p class="explain">あなたのマイページでは、あなたの心の中に閉まっておきたい画像を登録し、万が一他の人の目に触れることがないように、<span class="yellow">一定時間後に削除できる機能</span>がついています。あなたが好きな時間に設定できます。</p></div>
    <div class="col-xs-4" style="background-color:black; height:300px"><p class="explain">このサイトからアクセスしていると、他の人に秘密を持っていることが知られてしまう可能性があるので、<span class="yellow">ログイン画面は別にご用意</span>しています。新規登録後にEメールアドレスへURLをお送りします。もちろんこのページからもログインできます。</p></div>
    </div>

  <div class="row">
    <div class="col-xs-12"  style="background-color:#003366; height:70px"><span class="a" float=center id="2">How to Use</span></div>
  </div>


    <div class="col-xs-12" style="background-color:#003366; h">
      <img src="img/howtoalbum.jpeg"><br><br>
      <img src="img/howtotalk.jpeg"><br><br>
      <img src="img/howtosetting.jpeg"><br><br>
    </div>
  </div>
 
 <div class="row">
    <div class="col-xs-12"  style="background-color:black; height:70px"><span class="a" float=center>Register</span></div>
  </div>

    <div class="img bottom_img">
    <div class="container">
      <div class="register">
        <h4 >ご登録はこちらから</h4>
        <a href="signup.php"><p class="signup_button2">
            新規登録</p></a>
        <span class="kiyaku" data-toggle="modal" >※ご利用規約</span>


      </div>
    </div>
  </div>
<!-- フッター -->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height:50px">
      <p  class="footer">Designed by Cherry</p>
    </div>
  </div>
<!-- フッター終わり -->


</body>
</html>