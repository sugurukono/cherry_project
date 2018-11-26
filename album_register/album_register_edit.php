<?php

    //echo '<pre>';
    //var_dump($_POST);
    //echo '</pre>;

    session_start();
    require('../functions.php');
    require('../dbconnect.php');

    $time_limit = array('6時間','24時間','3日','１週間','無期限');

    //$_SESSIONの中に46_LearnSNSが定義されていなければsignupに強制的に飛ばす
    if (!isset($_SESSION['Cherry'])) {
        header('Location: alubum_register.php');
    }

    //v($_POST, '$_POST');

    //echo $POST['name']; 使えません
    $content = $_SESSION['Cherry']['content'];
    $time = $_SESSION['Cherry']['time'];
    $file_name = $_SESSION['Cherry']['pic_name'];

    //v($time, '$time');


    //POST送信されたら
    if (!empty($_POST)) {
        //DB登録処理
        //usersテーブルにユーザー情報の登録処理
        $sql = 'INSERT INTO `pics` SET `pic_name` = ?, `content` = ?, `time` = ?, `created` = NOW()';
        $stmt = $dbh->prepare($sql);
        $data = array($file_name, $content, $time );
        $stmt->execute($data);

        unset($_SESSION['Cherry']);//テータを残しておかない。消す
        header('Location: album_register_complete.php');
        exit();//処理を終了させる
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>アルバム／写真アップロード</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="css/header.css">
  <link rel="stylesheet" type="text/css"  href="css/barnar.css">
  <link rel="stylesheet" type="text/css"  href="css/style.css">
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
    <div class="col-xs-9" style="background-color:white; height:700px">
      <div class="box1">
      <!-- 画像 -->
        <h1><img src="images/<?= h($file_name);?>" width="250"></h1>
      </div>

      <!-- コメント -->
      <div id="a_box" class="col-xs-9"><h4>＜コメント＞</h4>
        <textarea name="content" placeholder="自由記入欄" cols="135" rows="3"><?= h($content); ?></textarea><br>
        <?php if(isset($validations['feed']) && $validations['feed'] == 'blank'): ?>
          <span class="error_msg">投稿データを入力してください</span>
        <?php endif; ?>
      </div>

      <!-- 公開期間 -->
      <div id="b_box" class="col-xs-9"><h4>＜公開期間＞</h4><br>
        <h4><?= $time_limit[$time]; ?></h4>
      </div>


      <div id="c_box" class="col-xs-9">
        <center>
          <div><br>
            <form method="POST" action="">
              <input type="hidden" name="dummy" value="1">
              <button class="btn btn-primary">戻る</button>
              <button class="btn btn-primary">写真を保存する</button>
            </form>
          </div>
        </center>
      </div>
    </div>

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


<!-- フッター -->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height:50px">
      <p  class="footer">Designed by Cherry</p>
    </div>
  </div>
<!-- フッター終わり -->


</body>
</html>