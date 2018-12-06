<?php 

session_start();
require('../functions.php');
require('../dbconnect.php');

//v($_GET['feed_id'],"feed_id");

//公開期間の選択
$time_limit = array('6時間','24時間','3日','１週間','無期限');

//$num = array('1', '2', '3', '4', '5', '6', '7', '8', '9' );
//$d = count($num);

$time_num = -1; //0以外のデータを初期化
if (!empty($_POST)) {
    $time_num = $_POST['time_limit'];
}

$c = count($time_limit);
//公開期間の選択終わり


$pic_id = '';
$pic_id = $_GET['pic_id'];
// $pics = array();

$sql = 'SELECT `p`.*, `u`.`id`, `u`.`user_name` FROM `pics` AS `p` LEFT JOIN `users` AS `u` ON `p`.`user_id`=`u`.`id` WHERE `p`.`id` = ?' ;
$data = array($pic_id);

$stmt = $dbh->prepare($sql);
$stmt->execute($data);

//取得できた編集対象のデータを$feedに格納
$pic = $stmt->fetch(PDO::FETCH_ASSOC);

$s = $pic["time"];

//v($_GET['pic_id'],"pic_id");

//今データを格納した$feedを使って、画面に編集データを表示しましょう。
//更新処理（更新ボタンが押された時発動）
if (!empty($_POST)) {
    $update_sql = "UPDATE `pics` SET `content` = ? WHERE `pics`.`id` = ?";//更新したつぶやきをDBに上書き保存する

    $data = array($_POST["content"],$pic_id);
    //SQL文の実行
    $stmt = $dbh->prepare($update_sql);
    $stmt->execute($data);
    //タイムラインへの遷移
    header("Location: album01.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>アルバム／写真アップロード</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="css/header.css">
  <link rel="stylesheet" type="text/css"  href="css/barnar.css">
  <link rel="stylesheet" type="text/css"  href="css/style_1.css">
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
      <form method="post" enctype="multipart/form-data">


        <div class="box1">
          <h1><img src="../album_register/images/<?php echo $pic['pic_name']; ?>" width="400" height="300"></h1>
        </div>

        <div id="a_box" class="col-xs-9"><h4>＜コメント＞</h4>
            <textarea value="<?php echo $content ?>" name="content" id="content" placeholder="自由記入欄" cols="135" rows="3" ><?php echo $pic["content"]; ?></textarea><br>
            <?php if(isset($validations['content']) && $validations['content'] == 'blank'): ?>
              <span class="error_msg">コメントを入力してください</span>
            <?php endif; ?>
        </div>

        <div id="b_box" class="col-xs-9"><h4>＜公開期間＞</h4>
            <select name="time">
              <option value="-1"><?php echo $time_limit["$s"]; ?></option>
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
              <input type="submit" value="更新" class="btn btn-warning btn-xs" style="width:100px; height:38px;">
            </div>
          </center>
        </div>


      </form>
    </div>

<!-- 広告部分 -->
    <div class="col-xs-3" style="background-color:#DDDDDD; height:850px">
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