<?php

    //echo '<pre>';
    //var_dump($_POST);
    //echo '</pre>';

    session_start();
    require('../functions.php');
    require('../dbconnect.php');

    v($_POST, '$_POST');

    $validations = array();

    $file_name = $_FILES['img_name']['name'];
    v($file_name, '$file_name');
    if ($file_name == '') {
        $validations['img_name'] = 'blank';
    }

    $data = array($_SESSION['id']);
    $pref = array('6時間','24時間','3日','１週間','無期限');
    $sql = 'SELECT * FROM `pics` WHERE `id` = 1';

    $stmt = $dbh->prepare($sql);//アロー演算子の左側をオブジェクトという
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $validations = array();
    $feed = '';

    if (!empty($_POST)) {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        //DB登録処理
        //usersテーブルにユーザー情報の登録処理
        $sql = 'INSERT INTO `users` SET `name` = ?, `email` = ?, `password` = ?, `img_name` = ?, `created` = NOW()';
        $stmt = $dbh->prepare($sql);
        $data = array($name, $email, $hash_password, $file_name);
        $stmt->execute($data);

        unset($_SESSION['46_LearnSNS']);//テータを残しておかない。消す
        header('Location: thanks.php');
        exit();//処理を終了させる
        
    }


    $pref_num = -1; //0以外のデータを初期化
    if (!empty($_POST)) {
      $pref_num = $_POST['pref'];
    }

    $c = count($pref);

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
        <h1><img src="images/icon_camera1.jpeg"></h1>
        <h3>写真をアップロードする</h3>
        <input type="file" name="img_name" accept="image/*">
        <?php if(isset($validations['img_name']) && $validations['img_name'] == 'blank'): ?>
          <span class="error_msg">画像を選択してください</span>
        <?php endif; ?>
      </div>

      <div id="a_box" class="col-xs-9"><h4>＜コメント＞</h4>
        <textarea name="content" placeholder="自由記入欄" cols="135" rows="3"></textarea><br>
        <?php if(isset($validations['feed']) && $validations['feed'] == 'blank'): ?>
          <span class="error_msg">投稿データを入力してください</span>
        <?php endif; ?>
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
            <form method="POST" action="../album_register/album_register.php">
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