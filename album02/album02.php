<?php

    session_start();
    require('../functions.php');
    require('../dbconnect.php');


    $time_limit = array('6時間','24時間','3日','１週間','無期限');

    //$num = array('1', '2', '3', '4', '5', '6', '7', '8', '9' );
    //$d = count($num);

    $time_num = -1; //0以外のデータを初期化
    if (!empty($_POST)) {
        $time_num = $_POST['time_limit'];
    }

    $c = count($time_limit);



    $data = array();
    $sql = 'SELECT * FROM `users` WHERE `id` = 4';

    $stmt = $dbh->prepare($sql);//アロー演算子の左側をオブジェクトという
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $validations = array();
    $feed = '';



    $sql = 'SELECT `p`.*, `u`.`id`, `u`.`user_name` FROM `pics` AS `p` LEFT JOIN `users` AS `u` ON `p`.`user_id`=`u`.`id` ORDER BY `created` DESC LIMIT 15 OFFSET 9' ;
    $data = array();
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    $pics = array();

    while (true) {
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($record == false) {
            break;
        }
        $pics[] = $record;
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
</div><!-- ヘッダー終わり -->


<div class="row">
  <div id="a_box" ><br>
    <!-- <div class="box2"> -->
      <!-- <div><br>
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
      <div class="box2"><h1><img src="img/IMG_7352.jpg" width="150" class="img-circle""></h1></div>
      <div class="box2"><h1><br>PROFILE</h1></div><br>
 -->
      <center>
        <?php foreach($pics as $pic){ ?>
          <img src="../album_register/images/<?php echo $pic['pic_name']; ?>" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_<?php echo $pic['pic_name']; ?>" >
        <?php } ?>
        <img src="img/img10.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_1" >
        <img src="img/img11.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_2" >
        <img src="img/img12.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_3" >
        <img src="img/img13.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_4" >
        <img src="img/img14.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_5" >
        <img src="img/img15.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_6" >
        <img src="img/img16.jpeg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_7" >
        <img src="img/img17.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_8" >
        <img src="img/img18.jpeg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_9" >
        <img src="img/img19.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_10" >
        <img src="img/img20.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_11" >
        <img src="img/img21.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_12" >
        <img src="img/img22.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_13" >
        <img src="img/img23.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_14" >
        <img src="img/img24.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_15" >
        <img src="img/img25.jpeg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_16" >
        <img src="img/img26.jpeg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_17" >
        <img src="img/img27.png" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_18" >
        <img src="img/img28.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_19" >
        <img src="img/img29.jpg" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_20" >
        <img src="img/img30.png" width="300" height="225" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal_" >
        <br>
        <!-- <br><input type="submit" value="全ての写真をみる"> -->
        <br><a href="../album01/album01.php"><h4>PROFILE画面に戻る</h4></a>
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
                        <h4><textarea name="content" cols="57" rows="5"><?php echo $pic['content']; ?></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_1" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img10.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_2" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img11.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_3" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img12.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_4" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img13.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_5" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img14.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_6" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img15.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_7" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img16.jpeg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_8" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img17.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_9" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img18.jpeg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_10" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img19.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_11" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img20.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_12" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img21.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_13" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img22.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_14" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img23.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_15" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img24.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_16" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img25.jpeg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_17" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img26.jpeg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_18" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img27.png" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_19" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img28.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal_20" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                            <img src="img/img29.jpg" width="300" height="225">
                        </center>
                    </div>
                    <div class="modal-body">
                        <h3>＜コメント＞</h3>
                        <h4><textarea name="content" placeholder="自由記入欄" cols="57" rows="5"></textarea></h4>
                    </div>
                    <div class="modal-body">
                        <h3>＜公開期間＞</h3>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger"><h4>削除</h4></button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><h4>閉じる</h4></button>
                      <button type="button" class="btn btn-primary"><h4>更新</h4></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダル終わり -->

        <!-- 広告 -->
        <div class="col-xs-3" style="background-color:#DDDDDD; height:2400px">
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