<?php

    //echo '<pre>';
    //var_dump($_POST);
    //echo '</pre>';

    session_start();
    require('../functions.php');

    v($_POST, '$_POST');

    $time_limit = array('6時間','24時間','3日','１週間','無期限');

    $content = '';
    $validations = array();

    if (!empty($_POST)) {
        
        $content=$_POST['content'];
        $time=$_POST['time'];
        
        if ($content == '') {
            $validations['content'] = 'blank';
        }

        $pic_name = $_FILES['img_name']['name'];
        v($pic_name, '$pic_name');
        if ($pic_name == '') {
            $validations['img_name'] = 'blank';
        }

        if (empty($validations)) {

            //画像アップロード処理
            v($_FILES, '$_FILES');

            //move_uploaded_file(送りたいファイルデータ, 送信先);
            $tmp_file = $_FILES['img_name']['tmp_name'];//選択した画像データ
            $pic_name = date('YmdHis') . $_FILES['img_name']['name'];
            $destination = 'images/'. $pic_name;//登録先と保存名
            move_uploaded_file($tmp_file, $destination);

            $_SESSION['Cherry']['content'] = $content;
            $_SESSION['Cherry']['time'] = $time;
            $_SESSION['Cherry']['pic_name'] = $pic_name;

            //HTMLのaタグと同じ処理をする関数
            //要は指定した文字列をURLを書き換えて実行する
            header('Location: album_register_edit.php');
            exit();
        }

    }


    $time_num = -1; //0以外のデータを初期化
    if (!empty($_POST)) {
        $time_num = $_POST['time_limit'];
    }

    $c = count($time_limit);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>アルバム／写真アップロード</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="css/header.css">
  <link rel="stylesheet" type="text/css"  href="css/barnar.css">
  <link rel="stylesheet" type="text/css"  href="css/style.css">
  <style>
    .error_msg {
      color: red;
      font-size: 12px;
    }
  </style>
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
      <form method="POST" action="album_register.php" enctype="multipart/form-data">


        <div class="box1">
          <h1><img src="images/icon_camera1.jpeg"></h1>
          <h3>写真をアップロードする</h3>
              <input type="file" name="img_name" accept="image/*">
              <?php if(isset($validations['img_name']) && $validations['img_name'] == 'blank'): ?>
                <span class="error_msg">画像を選択してください</span>
              <?php endif; ?>
        </div>

        <div id="a_box" class="col-xs-9"><h4>＜コメント＞</h4>
            <textarea value="<?php echo $content ?>" name="content" id="content" placeholder="自由記入欄" cols="135" rows="3" ></textarea><br>
            <?php if(isset($validations['content']) && $validations['content'] == 'blank'): ?>
              <span class="error_msg">コメントを入力してください</span>
            <?php endif; ?>
        </div>

        <div id="b_box" class="col-xs-9"><h4>＜公開期間＞</h4>
            <select name="time">
              <option value="-1">選択してください</option>
              <?php for($i=0; $i < $c; $i++): ?>
                <?php if ($i == $time_num): ?>
                  <!--前回選択されたvalue（都道府県）なのでoptionタグにselected属性をつける　-->
                  <option value="<?php echo $i; ?>" selected><?php echo $time_limit[$i]; ?></option>
                <?php else: ?>
                  <!--前回選択されたvalueと一致しないもしくはそもそもPOST送信されていないのでoptionタグをそのまま表示-->
                  <option value="<?php echo $i; ?>"><?php echo $time_limit[$i]; ?></option>
                 <?php endif; ?>
              <?php endfor; ?>
            </select>
        </div>

        <div id="c_box" class="col-xs-9">
          <center>
            <div><br>
              <input type="submit" value="内容確認">
            </div>
          </center>
        </div>


      </form>
    </div>

<!-- 広告部分 -->
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