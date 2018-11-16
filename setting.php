<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

    $user_id = "";

    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($user_id);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql ='SELECT `folder_name`, `user_id` FROM `folders` WHERE `folder_name`';
    $data = array();
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $folders= [];

    while (true) {
      $folder= $stmt->fetch(PDO::FETCH_ASSOC);

      if ($folder == false) {
        break;
      }
    }


?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="header_only.css">
  <link rel="stylesheet" type="text/css"  href="setting.css">

</head>
<body>
<!-- ヘッダー 開始-->
  <div class="row" id="header">
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
    </div>
     <div class=row>
    <div class="col-xs-12" style="background-color: pink; height: 50px">

      <li class="menu">
        Setting Menu:
      </li>
      <li class="words2">
        <a href="#">Profile</a>
      </li>

      <li class="words2">
        <a href="#">Friends</a>
      </li>

      <li class="words2">
        <a href="#">Friends list</a>
      </li>

      <li class="words2">
        <a href="#">help</a>
      </li>

      <li class="words2">
        <a href="#">Q&A</a>
      </li>


    </div>
  </div>
  </div>


  <div class="img background">
    <div class="container">
      <div>
        <h1><span class="title_1">♦︎プロフィール編集♦︎</span></h1>
        
        <div class="row">
          <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin:30px 0px;">
          <div class="profile1">
              <p>プロフィール画像</p>
          <img src="img/profile_first.jpg" style="width: 300px; height: 300px;">
          <span class="square_btn"><input type="file" name="img_name" accept="image/*"></span>
          <input type="submit" value="更新" class="square_btn">

           </div>
           
             </div>
           <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin: 30px 0px;">
           <div class="profile2">
            <br>
          <b>お名前</b>
          <input type="text" name="name" placeholder="さくらんぼ" value="" class="text"><br>
          <b>ID設定</b>
          <input type="text" name="id" placeholder="sakura"value="" class="text"><br>
          <b>Emali</b>
          <input type="email" name="email" placeholder="sakura@gmail.com" value="" class="text"><br>
          <b>ひとこと</b>
          <textarea placeholder="🍒チェリー" class="text"></textarea>

          <input type="submit" value="更新" class="square_btn4" style="float: right;">
            </div>

            </div>
         
        </div>
      

    </div>
    </div>
    </div>

    <div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" >
    </div>
    </div>

    <div class="img background2">
    <div class="container">
      <div>
        <h1><span class="title_2">♦︎お友達検索♦︎</span></h1>
        <div class="row">
          <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin:30px 0px;">
            <div class="id">
            <b style="font-size: 20px;">ID検索：</b>
            <input type="text" name="search" value="" class="text">
            <input type="submit" value="検索" class="square_btn ">

            <b style="font-size: 20px">検索結果:さくらんぼくん</b>
            </div>
            <div class="pic"><img src="img/profile_first.jpg">

              </div>

           

        </div>
        <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin: 30px 0px;">
           <br>
           <br>

           <b class=asking>検索された方はこちらの方ですか？ <br>
            よろしければ、フォルダーを選んで登録しましょう！<br>
           </b>
           <br>
           <form method="POST" action="creat_folder.php">
           <b style="font-size: 20px">フォルダー新規作成</b>
           <input type="text" name="folder_name" class="text">
           <input type="submit" value="新規作成" class="square_btn">
           </form>
<!-- 友達検索・フォルダー作成 -->
           <br>
            <b style="font-size: 20px">フォルダー選択：</b>
            <div class="scrol_box">

<!-- フォルダーの行を作成 -->
            <?php foreach($folders as $folder_each) :?>
            <b href = "creat_fodler.php?folder_name=<?php echo $feed_each['id']; ?>"><?php echo $folder_name ?></b><button class="square_btn2">削除</button><br><br>
            <?php endforeach; ?>


            <b>男友だち</b><button class="square_btn2">削除</button><br><br>
            <b>女友だち</b><button class="square_btn2">削除</button><br><br>
            <b>職場</b><button class="square_btn2">削除</button><br><br>
          </div>
          <form>
          <input type="submit" value="登録" class="square_btn3" style="float: right; ">
          </form>
        </div>
        </div>
      </div>
<!-- 友達一覧 -->
      <div>
        <h1><span class="title_2">♦︎お友達一覧♦︎</span></h1>
        <div class="row">
          <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin:30px 0px;">
            <br>
            <br>
            <br>
            <b style="font-size: 20px">♦︎フォルダー♦︎</b><br>
            <br>
            <button class="friends_folder" data-toggle="modal" data-target="#demoNormalModal"> ダーリン</button>

            <button class="friends_folder" data-toggle="modal" data-target="#demoNormalModal"> 男友だち</button>

            <button class="friends_folder" data-toggle="modal" data-target="#demoNormalModal"> 女友だち
            </button>

            <button class="friends_folder" data-toggle="modal" data-target="#demoNormalModal"> 職場</button>
            <button class="delet_button" style="float: right;">全件削除</button>
        </div>
        <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin: 30px 0px;">
          <div>
            <br>
            <br>
            <br>
            <b style="font-size: 20px">フォルダー選択：</b>
            <br>
            <div class="scrol_box2">
            <b>みかんちゃん</b><button class="square_btn2">削除</button><br><br>
            <b>りんごちゃん</b><button class="square_btn2">削除</button><br><br>
            <b>ピーチちゃん</b><button class="square_btn2">削除</button><br><br>
            <b>メロンちゃん</b><button class="square_btn2">削除</button><br><br>
            <button class="delet_button2">全件削除</button>
          </div>
        </div>
        </div>
      </div>
    </div>
    </div>




<div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" >
    </div>
  </div>

    <div class="col-xs-12" style="background-color: white; height:200px">
       Help 使い方ガイド（TOPでも使用したもの？）


    </div>

<div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" >
    </div>
  </div>

<div class="col-xs-12" style="background-color: white; height:200px">
      Q&A  また後で適当に入れましょう。


    </div>


<div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" >
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