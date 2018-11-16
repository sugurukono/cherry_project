<?php

    $pref = array('6時間','24時間','3日','１週間','無期限');

    $pref_num = -1; //0以外のデータを初期化
    if (!empty($_POST)) {
      $pref_num = $_POST['pref'];
    }

    $c = count($pref);

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
    <div class="col-xs-9" style="background-color:white; height:730px">
      <div class="box1"><img src="images/6_b.jpg"></div>
      <div id="a_box" class="col-xs-9"><h4>＜コメント＞</h4>
        <textarea name="content" placeholder="" cols="135" rows="3">このオムレツめちゃめちゃうまい！！！</textarea><br>
      </div>
      <div id="b_box" class="col-xs-9"><h4>＜公開期間＞</h4>
        <form method="POST" action="select_tag_for.php">
          <select name="pref">
            <option value="-1">選択してください</option>
            <?php for($i=0; $i < $c; $i++): ?>
              <?php if ($i == $pref_num): ?>
                <!--前回選択されたvalue（都道府県）なのでoptionタグにselected属性をつける　-->
                <option value="<?php echo $i; ?>" selected><?php echo $pref[$i]; ?></option>
              <?php else: ?>
                <!--前回選択されたvalueと一致しないもしくはそもそもPOST送信されていないのでoptionタグをそのまま表示-->
                <option value="<?php echo $i; ?>"><?php echo $pref[$i]; ?></option>
              <?php endif; ?>
            <?php endfor; ?>
          </select>
        </form>
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