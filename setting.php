<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');


// usersテーブルからデータ取得
    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);


    // v($_SESSION,'$_SESSION');
    // v($signin_user,'$signin_user');
    $user_id="";
    $user_id = $signin_user['id'];
    $folder='';

//foldersテーブルからデータ取得①
    $sql = 'SELECT * FROM `folders` WHERE `user_id`=?';
    $data = array($_SESSION['id']);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
//$foldersに格納②
    while(true){
      $folder = $stmt->fetch(PDO::FETCH_ASSOC);

      if($folder == false){
        break;
      }
      $folders[] = $folder;

    }
    // v($folders,$folders);
    if (!empty($_GET['folder'])) {
      $folder=$_GET['folder'];
       // v($folder,"$folder");
    }


// フォルダーを押すと友達一覧が表示される処理
    $sql='SELECT `user_name`,`folder_id`,`friend_id` FROM `users` INNER JOIN `friends_folders`
    ON `friends_folders`.`friend_id`= `users`.`id` WHERE `friends_folders`.`folder_owner_id`=?';
    $data= array($_SESSION['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $friends=[];

    while(true){
        $friend =$stmt->fetch(PDO::FETCH_ASSOC);
        if($friend == false){
            break;
        }
            $friends[]=$friend;
    }

    // v($friends,'$friends');
    // v($_GET['folder'],'$_GET[folder]');
    // v($_GET['folder_id'],'$_GET[foler_id');
    // v($friend_each,'$friend_each');


// ID検索ファンクション
    if (!empty($_GET['search_friend'])) {
        $search_friend= $_GET['search_friend'];
        $sql= "SELECT * FROM `users` WHERE `search_id`=?";
        $data= array($search_friend);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $related_friend =$stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['cherry']['related_friend']=$related_friend;
    }

    // V($related_friend,'related_friend');

//友達申請を送る
    if (!empty($_POST['request_friend'])) {
        $sql = 'SELECT * FROM `friends` WHERE `requester_id`=? AND `accepter_id`=?';
        $data= array($signin_user['id'],$related_friend['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
      //初めてのリクエストだったら
      if ($record == false) {
            //相手からのリクエストがないか確認しなきゃいけない
            $sql = 'INSERT INTO `friends` SET `requester_id`=?, `accepter_id`=?, `status`=1,`create_date`= NOW()';
            $data = array($signin_user['id'],$related_friend['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
      //２回目以降のリクエストだったら
      }else{
            $update_sql = 'UPDATE `friends` SET `status`=1,`update_date`= NOW() WHERE `requester_id`=? AND`accepter_id`=?';
            $data = array($signin_user['id'],$related_friend['id']);
            $stmt = $dbh->prepare($update_sql);
            $stmt->execute($data);
      }
    }
    // v($signin_user,'$signin_user');
    // v($user_id,'user_id');

// プロフィール情報の読み込み

    $user_img = $signin_user['user_img'];
    $user_name = $signin_user['user_name'];
    $search_id = $signin_user['search_id'];
    $email = $signin_user['email'];
    $comments = $signin_user['comments'];

//バリデーション
    if(!empty($_SESSION['error'])){
        $error['user_name'] = $_SESSION['error']['name'];
        $error['search_id'] = $_SESSION['error']['search_id'];
        $error['email'] = $_SESSION['error']['email'];
  }

//友達削除
    if(!empty($_POST['delete_friend'])) {
          //signin_userがrequesterだった場合
          // friendsフォルダを消す
          $sql = 'DELETE FROM `friends` WHERE `requester_id`=? AND `accepter_id`=?';
          $data = array($signin_user['id'],$_POST['delete_friend_id']);
          $stmt = $dbh->prepare($sql);
          $stmt->execute($data);
          // chatroomフォルダを消す
          $sql = 'DELETE FROM `chatroom` WHERE `owner_id`=? AND `menber_id`=?';
          $data = array($signin_user['id'],$_POST['delete_friend_id']);
          $stmt = $dbh->prepare($sql);
          $stmt->execute($data);
      }
      // v($_POST['delete_friend'],'friend');

//フォルダーの全件削除
    if(!empty($_POST['delete_all_folder'])) {
        $sql = 'DELETE FROM `friends_folders` WHERE `folder_owner_id`=?';
        $data = array($signin_user['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }
// v($signin_user['id'],'$signin_user');
    // v($_POST['delete_all_folder'],'folder');

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Settings</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="header_only.css">
  <link rel="stylesheet" type="text/css"  href="setting.css">

  <!-- viewport meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<!-- ヘッダー 開始-->
  <div class="row" id="header">
    <div class="col-xs-12" style="background-color: #003366; height: 90px">
      <h1 class="title" style="color:white;">🍒Cherry</h1>

    <li class="words">
        <a href="#">My Page</a>
    </li>
    <li class="words"><a href="talk_main1.php">Talk</a>
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
          <form method="POST" action="update_profile.php" enctype="multipart/form-data">
          <div class="col-xs-6" style="height: 600px; background-color: #37b8e061; margin:30px 0px;">
            <div class="profile1">
              
                <b>プロフィール画像</b> 
                  <?php if($user_img == '') :?>
                  <img src="img/profile_first.jpg" style="width: 300px; height: 300px;">
                  <?php else : ?>
                <img src="user_img/<?php echo $user_img; ?>" style="width: 300px; height: 300px;">
                <?php endif; ?>
                <span class="square_btn"><input type="file" name="img_name" accept="image/*"></span>
            </div>
          </div>
          <div class="col-xs-6" style="height: 600px; background-color: #37b8e061; margin: 30px 0px;">
            <div class="profile2"><br>
                <b>お名前</b>
                <input type="text" name="name" placeholder="さくらんぼ" value="<?php echo htmlspecialchars($user_name); ?>" class="text"><br>
                <?php if (isset($error['user_name']) && $error['user_name'] == 'blank'):?>
                  <p> <span class="error_msg">お名前を入力してください。</span></p>
                <?php endif; ?>
                <b>ID設定</b>
                <input type="text" name="id" placeholder="sakura"value="<?php echo htmlspecialchars($search_id); ?>" class="text"><br>
                <?php if (isset($error['search_id']) && $error['search_id'] == 'blank'):?>
                  <p> <span class="error_msg">IDを入力してください。</span></p>
                <?php endif; ?>
                <b>Email</b>
                <input type="email" name="email" placeholder="sakura@gmail.com" value="<?php echo htmlspecialchars($email); ?>" class="text"><br>
                <?php if (isset($error['email']) && $error['email'] == 'blank'):?>
                  <p> <span class="error_msg">メールアドレスを入力してください。</span></p>
                <?php endif; ?>
                <b>ひとこと</b>
                <textarea placeholder="🍒チェリー" class="text" name="comments"><?php echo htmlspecialchars($comments); ?></textarea>
                <input type="submit" value="更新" class="square_btn4" style="float: right;">
              
            </div>
          </div>
          </form>
        </div>


    </div>
    </div>
    </div>

    <div class="row">
      <div class="col-xs-12" style="background-color:black; height:50px;" ></div>
    </div>

    <div class="img background2">
      <div class="container">
        <div>
          <h1><span class="title_2">♦︎友達検索♦︎</span></h1>
          <div class="row">
            <div class="col-xs-6" style="height: 600px; background-color: #37b8e061; margin:30px 0px;">

              <!-- ID検索 -->
              <div class="id">
                <b style="font-size: 20px;">IDを検索：</b>
                <form action="" method="GET">
                  <input type="text" name="search_friend" value="" class="text">
                  <input type="submit" value="検索" class="square_btn "><br>
                  <b style="font-size: 20px">検索結果:<?php if(!empty($_GET['search_friend'])): ?><?php echo $related_friend['user_name'] ?>
                  <?php endif; ?>
                  </b>
                </form>
              </div>

              <div class="pic">
                <?php if(empty($_GET['search_friend'])): ?>
                <img src="img/profile_first.jpg" style="width: 300px; height: 300px;">
                <?php elseif($related_friend['user_img'] == '') : ?>
                <img src="img/profile_first.jpg" style="width: 300px; height: 300px;">
                <?php else : ?>
                <img src="user_img/<?php echo $related_friend['user_img']; ?>" style="width: 300px; height: 300px;">
                <?php endif; ?>
              </div>
              
              <form method="POST" action="">
                <input type="submit" name="request_friend" value="友達申請を送る" class="square_btn3" style="float: right; ">
              </form>

            </div>

            <div class="col-xs-6" style="height: 600px; background-color: #37b8e061; margin: 30px 0px;">
              <br>
              <b class=asking>
                友達申請を送り終わりましたら、<br>
                こちらで友達をフォルダに登録しましょう！<br>
                ※友達が承諾した後に、実際にトークができます<br>
              </b>
<!-- 友達検索・フォルダー作成 -->
              <br>
              <form method="POST" action="creat_folder.php">
                <b style="font-size: 20px">フォルダー新規作成</b>
                <input type="text" name="folder_name" class="text">
                <input type="submit" value="新規作成" class="square_btn">
              </form>
              <b style="font-size: 20px">フォルダー選択：</b>
<!-- フォルダーの行を作成 -->
              <form action="folder_related_friend.php" method="GET">
                <div class="scrol_box">
                  <?php foreach($folders as $folder_each) :?>
                  <input type="checkbox" name="check_folder" value="<?php echo $folder_each['id']?>"><?php echo $folder_each['folder_name'] ;?>
                  <button class="square_btn2"><a onclick="return confirm('フォルダーを削除しますか？');" href="delete_folders.php?folder_id=<?php echo $folder_each['id']; ?>">フォルダーの削除</a></button>
                  <br><br>
                   <?php endforeach; ?>
                </div>
                <input type="submit" value="友達をフォルダーに登録" class="square_btn3" style="float: right; ">
              </form>
        </div>
      </div>
    </div>
      <!-- 友達一覧 -->
      <div>
        <h1><span class="title_2">♦︎友達一覧♦︎</span></h1>
        <div class="row">
          <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin:30px 0px;">
            <br>
            <b style="font-size: 20px">♦︎フォルダー♦︎</b><br>
            <br>

            <?php foreach($folders as $folder_each) :?>
              <form method="GET" action="" style="float: left">
                <input type="submit" name="folder" class="friends_folder" data-toggle="modal" data-target="#demoNormalModal" value="<?php echo $folder_each['folder_name']?>">
                <input type="hidden" name="folder_id" value="<?php echo $folder_each['id']?>">
              </form>
            <?php endforeach; ?>
              <form method="POST" action="">
                <input type="submit" name="delete_all_folder" class="square_btn3" onclick="return confirm('フォルダーを全件削除しますか？');"style="float: right;" value="フォルダーの全件削除">
              </form>
          </div>
        <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin: 30px 0px;">
        <div>
          <br>
          <b style="font-size: 20px">友達一覧：</b>
          <br>
          <div class="scrol_box2">


          <?php if (isset($_GET['folder_id'])): ?>
          <?php foreach($friends as $friend_each): ?>
          <?php if($friend_each['folder_id']== $_GET['folder_id']): ?>
          <b><?php echo $friend_each['user_name'] ?></b>
          <!-- 友達削除ボタンには警告を表示 -->
          <button type="button" class="square_btn2" data-toggle="modal" data-target="#demoNormalModal">友達削除</button>
          <!-- モーダルダイアログ -->
          <div class="modal fade" id="demoNormalModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="demoModalTitle">友達削除</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  友達削除すると、その友達とのトーク履歴が消え、相手からのメッセージを受信することができなくなります。<br>
                  削除した後にメッセージを送るためには再度リクエストを送信する必要があります。
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                  <form method="POST" action="">
                  <input type="hidden" name="delete_friend_id" value="<?php echo $friend_each['friend_id'] ?>">
                  <input type="submit" name="delete_friend" class="btn btn-primary" value="友達を削除する">
                  </form>
                </div>
              </div>
            </div>
          </div>
          <button class="square_btn2">フォルダー追加</button><br><br>
          <?php endif; ?>
          <?php endforeach; ?>
          <button class="delet_button2" >中身を<br>空にする</button>
          <?php endif ;?>
          </div>
        </div>
        </div>
        </div>
      </div>


  <div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" ></div>
  </div>


  <div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" ></div>
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

<!-- jQuery、Popper.js、Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>

</body>
</html>