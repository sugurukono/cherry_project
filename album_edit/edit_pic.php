<?php

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>写真編集ページ</title>
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

      <ul class="list"> 
            <li class="button">
            My Page
            </li>
            <li class="button">
             Talk
            </li>

            <li class="button">
            Add Friends
            </li>

            <li class="button">
            Setting
            </li>

            <li class="button">
            Fake Page
            </li>

            <li class="logout">
            LOG OUT
            </li>
         </ul>
    </div>
  </div>
<!-- ヘッダー終わり -->

  <div class="row">
    <div class="col-xs-9" style="background-color:white; height:730px">
      <div class="box1"><img src="images/6_b.jpg"></div>
      <div id="a_box" class="col-xs-9"><h4>＜コメント＞</h4>
        <textarea name="content" placeholder="" cols="135" rows="3">このオムレツめちゃめちゃうまい！！！</textarea><br>
      </div>
      <div id="b_box" class="col-xs-9"><h4>＜公開期間＞</h4>
          <input type="button" class="btn btn-default" value="24時間" style="background-color:#777777; width: 330px ">
          <input type="button" class="btn btn-default" value="1週間" style="width: 330px ">
          <select name="pref" style="width: 300px ">
            <option value="0">期間を指定する</option>
          </select>
      </div>
      <div id="c_box" class="col-xs-9">
        <center>
          <div><br>
            <form method="post" action="../album/album.php">
              <pre><button class="btn btn-primary">写真を保存する</button>                                <button class="btn btn-primary">写真を削除する</button></pre>
            </form>
          </div>
        </center>
      </div>
    </div>

    <div class="col-xs-3" style="background-color:#DDDDDD; height:730px">
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