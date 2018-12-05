<?php

    session_start();
    require('../functions.php');
    require('../dbconnect.php');


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

    //DBからPROFILE情報データの取得
    
    $sql = 'SELECT * FROM `users` WHERE `id` = ?';
    $data = array($_SESSION['id']);
    $stmt = $dbh->prepare($sql);//アロー演算子の左側をオブジェクトという
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);
    v($signin_user,'$signin_user');

    $validations = array();
    $feed = '';
    //DBからPROFILE情報データの取得終了

    $sql = 'SELECT `p`.*, `u`.`user_name` FROM `pics` AS `p` LEFT JOIN `users` AS `u` ON `p`.`user_id`=`u`.`id` ORDER BY `created` DESC LIMIT 9 OFFSET 0' ;
    $data = array();
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

     // 表示用の配列を初期化
    $pics = array();

    while (true) {
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($record == false) {
            break;
        }
        $pics[] = $record;
    }

    //$s = $pics["time"];

    $i = 0;

    $id_sql = 'SELECT COUNT(*) as `id` FROM `pics`';
    $id_data = array();
    $id_stmt = $dbh->prepare($id_sql);
    $id_stmt->execute($id_data);

    $id_count_data = $id_stmt->fetch(PDO::FETCH_ASSOC);


    $feed = $stmt->fetch(PDO::FETCH_ASSOC);
        //$feed連想配列にlike数を格納するキーを用意し、数字を代入する
        //代入するlike数を取得するSQL文の実行
        $friends_sql = 'SELECT COUNT(*) as `friends_count` FROM `friends` WHERE `id` = ?';
        $friends_data = array($feed['id']);
        $friends_stmt = $dbh->prepare($friends_sql);
        $friends_stmt->execute($friends_data);

        $friends_count_data = $friends_stmt->fetch(PDO::FETCH_ASSOC);

        $feed['friends_count'] = $friends_count_data['friends_count'];

    $feeds = []; //投稿データを全て格納する配列

        //v($feed,'$feed');
        //[]は、配列の末尾にデータを追加するという意味

    //オートマでデリート処理　途中
    if (!empty($d_time) && $d_time < $send_date) {
        $sql='DELETE FROM `pics` WHERE `id`=?';
        $data=array($d_room_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }


?>

<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        
        <!-- viewport meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>アルバム／プロフィール</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css"  href="css/header.css">
        <link rel="stylesheet" type="text/css"  href="css/barnar.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>
        <!-- ヘッダー 開始-->
          <div class="row">
            <div class="col-xs-12" style="background-color: #003366; height: 90px">
              <h1 class="title" style="color:white;">🍒Cherry</h1>

            <li class="words">
                <a href="#">My Page</a>
            </li>
             
            <li class="words"><a href="../talk_main1.php">Talk</a>
            </li>


            <li class="words">
                <a href="../setting.php#friends">Add Friends</a>
            </li>
             

            <li class="words">
                <a href="../setting.php">Setting</a>
            </li>
             
             <li class="words">
                <a href="../fake.php">Fake Page</a>
            </li>

            <li class="words">
                <a href="../signout.php">Log Out</a>
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
          <button class="btn btn-primary"><h4>写真を追加</h4></button>
        </form>
      </div>
      <div><br>
        <form method="post" action="../setting.php">
          <button class="btn btn-primary"><h4>設定</h4></button>
        </form>
      </div>
    </div>
      <span hidden id="signin-user"><?php echo $signin_user['id']; ?></span>
      <div class="box3"><br><h2>ユーザー名：<?php echo $signin_user['user_name']; ?></h2><h2>ID：<?php echo $signin_user['id']; ?></h2><h2><span class="friends_count">友達：</span><?= $feed['friends_count']; ?>人</h2></div>
      <div class="box2"><h1><img src="../user_img/<?php echo $signin_user['user_img']?>" width="150" height="150" class="img-circle""></h1></div>
      <div class="box2"><center><h1><br>PROFILE</h1></center></div><br>

      <center>
        <?php foreach($pics as $pic){ ?>
          <img src="../album_register/images/<?php echo $pic['pic_name']; ?>" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_<?php echo $pic['pic_name']; ?>" >
        <?php } ?>
        <!-- <img src="img/img2.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_2" >
        <img src="img/img3.jpeg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_3" >
        <img src="img/img4.jpeg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_4" >
        <img src="img/img5.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_5" >
        <img src="img/img6.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_6" >
        <img src="img/img7.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_7" >
        <img src="img/img8.gif" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_8" >
        <img src="img/img9.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_9" > -->
        <br>
        <!-- <br><input type="submit" value="全ての写真をみる"> -->
        <br><a href="../album02/album02.php"><h4>全ての写真をみる</h4></a>
      </center>
    </div>

        <!-- モーダルダイアログ -->
        <?php foreach($pics as $pic){ ?>
        <div class="modal fade" id="demoNormalModal_<?php echo $pic['pic_name']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="demoModalTitle">写真の編集</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                          <img src="../album_register/images/<?php echo $pic['pic_name']; ?>" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h2><?php echo $pic['content']; ?></h2>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
                        <select name="time">
                          <option value="-1">選択してください</option>
                          <?php for($i=0; $i < $c; $i++): ?>
                            <?php if ($i == $pic['time']): ?>
                              <!--前回選択されたvalue（都道府県）なのでoptionタグにselected属性をつける　-->
                              <option value="<?php echo $i; ?>" selected><?php echo $time_limit[$i]; ?></option>
                            <?php else: ?>
                              <!--前回選択されたvalueと一致しないもしくはそもそもPOST送信されていないのでoptionタグをそのまま表示-->
                              <option value="<?php echo $i; ?>"><?php echo $time_limit[$i]; ?></option>
                             <?php endif; ?>
                          <?php endfor; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                      <?php if ($signin_user['id']==$pic['user_id']) :?>
                      <!-- <button type="button" class="btn btn-danger"><h4>削除</h4></button> -->
                      <a onclick="return confirm('ほんとに消すの？');" href="album01_delete.php?pic_id=<?= $pic['id'];?>" class="btn btn-danger btn-xs"><h4>削除</h4></a>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <!-- <button type="button" class="btn btn-primary"><h4>編集</h4></button> -->
                      <a href="album01_edit.php?pic_id=<?= $pic['id'];?>" class="btn btn-success btn-xs"><h4>編集</h4></a>
                      <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- モーダル終わり -->

        <!-- 広告 -->
        <div class="col-xs-3" style="background-color:#DDDDDD; height:950px">
        <div class="box5">
        <p>広告</p>
        </div>
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
    <!-- 広告終わり -->

    <!-- フッター -->
      <div class="row">
        <div class="col-xs-12" style="background-color: #003366; height:50px">
          <p class="footer">Designed by Cherry</p>
        </div>
      </div>
    <!-- フッター終わり -->
        
        <!-- jQuery、Popper.js、Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>