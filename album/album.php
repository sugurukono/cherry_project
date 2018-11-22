<?php

    session_start();
    require('../functions.php');
    require('../dbconnect.php');

    $data = array();
    $sql = 'SELECT * FROM `users` WHERE `id` = 4';

    $stmt = $dbh->prepare($sql);//アロー演算子の左側をオブジェクトという
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $validations = array();
    $feed = '';

    $feed = $stmt->fetch(PDO::FETCH_ASSOC);
        //$feed連想配列にlike数を格納するキーを用意し、数字を代入する
        //代入するlike数を取得するSQL文の実行
        $friends_sql = 'SELECT COUNT(*) as `friends_count` FROM `friends` WHERE `id` = ?';
        $friends_data = array($feed['id']);
        $friends_stmt = $dbh->prepare($friends_sql);
        $friends_stmt->execute($friends_data);

        $friends_count_data = $friends_stmt->fetch(PDO::FETCH_ASSOC);

        $feed['friends_count'] = $friends_count_data['friends_count'];

        v($feed,'$feed');
        //[]は、配列の末尾にデータを追加するという意味



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS" />
<title>アルバム／プロフィール</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/gallery05.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-1.2.1.pack.js"></script>
<script type="text/javascript">
$(function() {
$('a.large').fancybox();
});
</script>

<link rel="stylesheet" type="text/css"  href="css/header.css">
<link rel="stylesheet" type="text/css"  href="css/barnar.css">

</head>

<body>
  <!-- ヘッダー 開始-->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height: 90px">
      <h1 class="title" style="color:white;">🍒Cherry</h1>

    <li class="words">
        <a href="#">My Page</a>
    </li>
     
    <li class="words"><a href="#">Talk</a>
    </li>


    <li class="words">
        <a href="#">Add Friends</a>
    </li>
     

    <li class="words">
        <a href="#">Setting</a>
    </li>
     
     <li class="words">
        <a href="#">Fake Page</a>
    </li>

    <li class="words">
        <a href="#">Log Out</a>
    </li>
         </ul>
    </div>
  </div>
<!-- ヘッダー終わり -->

<div class="row">
  <div id="a_box" >
    <div class="box2">
      <div><br>
        <form method="post" action="../album_register/album_register.php">
          <button class="btn btn-primary">写真を追加</button>
        </form>
      </div>
      <div><br>
        <form method="post" action="../setting.php">
          <button class="btn btn-primary">写真を編集</button>
        </form>
      </div>
    </div>
      <span hidden id="signin-user"><?php echo $signin_user['id']; ?></span>
      <div class="box3"><h3>ユーザー名：<?php echo $signin_user['user_name']; ?></h3><h3>ID：<?php echo $signin_user['id']; ?></h3><h3><span class="friends_count">友達：<?= $feed['friends_count']; ?></span>人</h3></div>
      <div class="box2"><h1><img src="images/20181019035621IMG_7352.jpg"></h1></div>
      <div class="box2"><h1><br>PROFILE</h1></div><br>
    

    <div id="wrap" style="background-color:white;">
      <a class="large" rel="group" title="タイトル 1"
      href="images/1_b.jpg"><img class="smallimage" src="images/2_m4.jpg" /></a>
      <a class="large" rel="group" title="タイトル 2"
      href="images/2_b.jpg"><img class="smallimage" src="images/9_m4.jpg" /></a>
      <a class="large" rel="group" title="タイトル 3"
      href="images/3_b.jpg"><img class="smallimage" src="images/3_m44.jpg" /></a>
      <a class="large" rel="group" title="タイトル 4"
      href="images/4_b.jpg"><img class="smallimage" src="images/4_m44.jpg" /></a>
      <a class="large" rel="group" title="タイトル 5"
      href="images/5_b.jpg"><img class="smallimage" src="images/5_m44.jpg" /></a>
      <a class="large" rel="group" title="タイトル 6"
      href="images/6_b.jpg"><img class="smallimage" src="images/6_m4.jpg" /></a>
      <a class="large" rel="group" title="タイトル 7"
      href="images/7_b.jpg"><img class="smallimage" src="images/7_m4.jpg" /></a>
      <a class="large" rel="group" title="タイトル 8"
      href="images/8_b.jpg"><img class="smallimage" src="images/8_m4.jpg" /></a>
    </div>
  </div>

  <div class="col-xs-3" style="background-color:#DDDDDD; height:800px">
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

<!-- フッター -->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height:50px">
      <p class="footer">Designed by Cherry</p>
    </div>
  </div>
<!-- フッター終わり -->

</body>
</html>